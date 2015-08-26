<?php
defined('VMPATH_ROOT') or die();
/**
 * virtuemart encrypt class, with some additional behaviours.
 *
 *
 * @package    VirtueMart
 * @subpackage Helpers
 * @author Max Milbers, Valérie Isaksen
 * @copyright Copyright (c) 2014 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
 *
 * http://virtuemart.net
 */

class vmCrypt {

	const ENCRYPT_SAFEPATH="keys";

	static function encrypt ($string) {

		$key = self::_getKey ();

		if(function_exists('mcrypt_encrypt')){
			// create a random IV to use with CBC encoding
			$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC);
			$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);

			return base64_encode ($iv.mcrypt_encrypt (MCRYPT_RIJNDAEL_256, $key, $string, MCRYPT_MODE_CBC,$iv));
		} else {
			return base64_encode ($string);
		}

	}

	static function decrypt ($string,$date=0) {

		if(empty($string)) return '';

		$key = self::_getKey ($date);
		if(!empty($key)){
			$ciphertext_dec = base64_decode($string);
			if(function_exists('mcrypt_encrypt')){
				$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC);
				//vmdebug('decrypt $iv_size', $iv_size ,MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC);
				// retrieves the IV, iv_size should be created using mcrypt_get_iv_size()
				$iv_dec = substr($ciphertext_dec, 0, $iv_size);
				//retrieves the cipher text (everything except the $iv_size in the front)
				$ciphertext_dec = substr($ciphertext_dec, $iv_size);
				//vmdebug('decrypt $iv_dec',$iv_dec,$ciphertext_dec);
				if(empty($iv_dec) and empty($ciphertext_dec)){
					vmdebug('Seems something not encrytped should be decrypted, return default ',$string);
					return $string;
				} else {
					$mcrypt_decrypt = mcrypt_decrypt (MCRYPT_RIJNDAEL_256, $key, $ciphertext_dec, MCRYPT_MODE_CBC, $iv_dec);

					return rtrim ($mcrypt_decrypt, "\0");
				}

			} else {
				return $ciphertext_dec;
			}

		} else {
			return $string;
		}

	}

	private static function _getKey ($date = 0) {

		$key = self::_checkCreateKeyFile($date);

		return base64_decode ($key);

	}

	private static function _checkCreateKeyFile($date){
		jimport('joomla.filesystem.file');

		vmSetStartTime('check');
		static $existingKeys = false;

		$keyPath = self::_getEncryptSafepath ();

		if(!$existingKeys){
			$dir = opendir($keyPath);
			if(is_resource($dir)){
				$existingKeys = array();
				while(false !== ( $file = readdir($dir)) ) {
					if (( $file != '.' ) && ( $file != '..' )) {
						if ( !is_dir($keyPath .DS. $file)) {
							$ext = Jfile::getExt($file);
							if($ext=='ini' and file_exists($keyPath .DS. $file)){
								$content = parse_ini_file($keyPath .DS. $file);
								if($content and is_array($content) and isset($content['unixtime'])){
									$key = $content['unixtime'];
									unset($content['unixtime']);
									$existingKeys[$key] = $content;
									//vmdebug('Reading '.$keyPath .DS. $file,$content);
								}

							} else {
								vmdebug('Resource says there is file, but does not exists? '.$keyPath .DS. $file);
							}
						} else {
							//vmdebug('Directory in they keyfolder?  '.$keyPath .DS. $file);
						}
					} else {
						//vmdebug('Directory in the keyfolder '.$keyPath .DS. $file);
					}
				}
			} else {
				static $warn = false;
				if(!$warn)vmWarn('Key folder in safepath unaccessible '.$keyPath);
				$warn = true;
			}
		}

		if($existingKeys and is_array($existingKeys) and count($existingKeys)>0){
			ksort($existingKeys);

			if(!empty($date)){
				$key = '';
				foreach($existingKeys as $unixDate=>$values){
					if(($unixDate-30) >= $date ){
						vmdebug('$unixDate '.$unixDate.' >= $date '.$date);
						continue;
					}
					vmdebug('$unixDate < $date');
					//$usedKey = $values;
					$key = $values['key'];
				}

				vmdebug('Use key file ',$key);
				//include($keyPath .DS. $usedKey.'.php');
			} else {
				$usedKey = end($existingKeys);
				$key = $usedKey['key'];
			}
			//vmTime('my time','check');
			return $key;
		} else {

			$usedKey = date("ymd");
			$filename = $keyPath . DS . $usedKey . '.ini';
			if (!JFile::exists ($filename)) {

				/*$token = vRequest::getHash(JUserHelper::genRandomPassword());

				$salt = JUserHelper::getSalt('crypt-md5');
				$hashedToken = md5($token . $salt)  ;
				$key = base64_encode($hashedToken);*/
				$key = base64_encode(self::getToken());

				$date = JFactory::getDate();
				$today = $date->toUnix();
				//$key = pack('H*',$key);
				$content = ';<?php die(); */
						[keys]
						key = "'.$key.'"
						unixtime = "'.$today.'"
						date = "'.date("Y-m-d H:i:s").'"
						; */ ?>';
				$result = JFile::write($filename, $content);
				//vmTime('my time','check');
				return $key;
			}
		}
		//vmTime('my time','check');
		//return pack('H*',$key);
	}

	private static function _getEncryptSafepath () {

		if (!class_exists('ShopFunctions'))
			require(VMPATH_ADMIN . DS . 'helpers' . DS . 'shopfunctions.php');
		$safePath = ShopFunctions::checkSafePath();
		if (empty($safePath)) {
			return NULL;
		}
		$encryptSafePath = $safePath . self::ENCRYPT_SAFEPATH;
		//echo 'my $encryptSafePath '.$encryptSafePath;
		//if(!JFolder::exists($encryptSafePath)){
			self::createEncryptFolder($encryptSafePath);
		//}
		return $encryptSafePath;
	}

	private static function createEncryptFolder ($folderName) {

		//$folderName = self::_getEncryptSafepath ();

		$exists = JFolder::exists ($folderName);
		if ($exists) {
			return TRUE;
		}
		$created = JFolder::create ($folderName);
		if ($created) {
			return TRUE;
		}
		$uri = JFactory::getURI ();
		$link = $uri->root () . 'administrator/index.php?option=com_virtuemart&view=config';
		VmError (vmText::sprintf ('COM_VIRTUEMART_CANNOT_STORE_CONFIG', $folderName, '<a href="' . $link . '">' . $link . '</a>', vmText::_ ('COM_VIRTUEMART_ADMIN_CFG_MEDIA_FORSALE_PATH')));
		return FALSE;
	}

	/**
	 * Creates a token for inputs by human, some chars are removed to reduce mistyping,
	 * All chars are upper case, 0 and O are omitted
	 *
	 * @author Max Milbers
	 * @param $length
	 * @return string
	 */
	static function getHumanToken($length) {
		return self::getToken( $length, "123456789ABCDEFGHIJKLMNPQRSTUVWXYZ" );
	}

	/**
	 * Creates a token
	 *
	 * @author Max Milbers
	 * @param $length Only keys of sizes 16, 24 or 32 are supported
	 * @param $pool pool to chose from
	 * @return string
	 */
	static function getToken($length=24, $pool = false)
	{
		$token = "";
		if(!$pool){
			$pool = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
			$pool.= "abcdefghijklmnopqrstuvwxyz";
			$pool.= "0123456789";
		}

		$max = strlen($pool) - 1;
		if (function_exists('openssl_random_pseudo_bytes') and (version_compare(PHP_VERSION, '5.3.4') >= 0)) {
			for ($i=0; $i < $length; $i++) {
				$token .= $pool[self::crypto_rand_secure(0, $max)];
			}
		} else {
			for ($i=0; $i < $length; $i++) {
				$token .= $pool[mt_rand(0, $max)];
			}
		}

		return $token;
	}

	/**
	 * http://stackoverflow.com/questions/1846202/php-how-to-generate-a-random-unique-alphanumeric-string or
	 * http://us1.php.net/manual/en/function.openssl-random-pseudo-bytes.php#104322
	 * @author Max Milbers
	 * @param $min
	 * @param $max
	 * @return mixed
	 */
	static function crypto_rand_secure($min, $max)
	{
		if (function_exists('openssl_random_pseudo_bytes') and (version_compare(PHP_VERSION, '5.3.4') >= 0)) {
			$range = $max - $min + 1;	//This is important, else we do not use the whole set.
			//if ($range < 1) return $min; // not so random...
			$log = ceil(log($range, 2));
			$bytes = (int) ($log / 8) + 1; // length in bytes
			$bits = (int) $log + 1; // length in bits
			$filter = (int) (1 << $bits) - 1; // set all lower bits to 1
			do {
					$rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
					$rnd = $rnd & $filter; // discard irrelevant bits
			} while ($rnd >= $range);

			return $min + $rnd;
		} else {
			//return mt_rand(0,$max);
			//$h = vRequest::getHash($seed);
			//echo '<br> '.$h;
			//return vRequest::getHash(mt_rand(0,255));
		}

	}



}