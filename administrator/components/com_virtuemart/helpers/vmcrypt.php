<?php
defined('JPATH_BASE') or die();
/**
 * virtuemart encrypt class, with some additional behaviours.
 *
 *
 * @package    VirtueMart
 * @subpackage Helpers
 * @authorValérie Isaksen
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

		$key = self::getKey ();

		return base64_encode (mcrypt_encrypt (MCRYPT_RIJNDAEL_256, md5 ($key), $string, MCRYPT_MODE_CBC, md5 (md5 ($key))));
	}

	static function decrypt ($string) {

		$key = self::getKey ();
		return rtrim (mcrypt_decrypt (MCRYPT_RIJNDAEL_256, md5 ($key), base64_decode ($string), MCRYPT_MODE_CBC, md5 (md5 ($key))), "\0");
	}

	static function getKey () {

		//$filename = self::_getEncryptSafepath () . DS . 'key.php';

		//if (!JFile::exists ($filename)) {
		$filename = self::_checkCreateKeyFile();
		//}

		if (JFile::exists ($filename)) {
			if (!defined('DEFINEDKEY')){
				define('DEFINEDKEY',1);
			}
			include_once $filename;
		}

		return base64_decode (PRIVATE_KEY);

	}

	static function _checkCreateKeyFile(){
		$filename = self::_getEncryptSafepath () . DS . 'key.php';
		if (!JFile::exists ($filename)) {

			$token = JUtility::getHash(JUserHelper::genRandomPassword());
			$salt = JUserHelper::getSalt('crypt-md5');
			$hashedToken = md5($token . $salt)  ;
			$key = base64_encode($hashedToken);
			$options = array('costs'=>VmConfig::get('cryptCost',8));

			if(!function_exists('password_hash')){
				require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'password_compat.php');
			}

			if(function_exists('password_hash')){
				$key = password_hash($key, PASSWORD_BCRYPT, $options);
			}

			$content = "<?php  defined('DEFINEDKEY') or die();
 define('PRIVATE_KEY', '".$key."'); ?>";
			$result = JFile::write($filename, $content);
		}
		return $filename;
	}

	static function _getEncryptSafepath () {

		if (!class_exists('ShopFunctions'))
			require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'shopfunctions.php');
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

	static function createEncryptFolder ($folderName) {

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
		VmError (JText::sprintf ('COM_VIRTUEMART_CANNOT_STORE_CONFIG', $folderName, '<a href="' . $link . '">' . $link . '</a>', JText::_ ('COM_VIRTUEMART_ADMIN_CFG_MEDIA_FORSALE_PATH')));
		return FALSE;
	}



}