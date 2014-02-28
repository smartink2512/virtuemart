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
if (!defined('DEFINEDKEY')){
	define('DEFINEDKEY',1);
}
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

		$filename = self::_getEncryptSafepath () . DS . 'key.php';
		if (file_exists ($filename)) {
			include_once $filename;
		}

		return base64_decode (PRIVATE_KEY);

	}
	static function _getEncryptSafepath () {

		$safePath = VmConfig::get ('forSale_path', '');
		if (empty($safePath)) {
			return NULL;
		}
		$encryptSafePath = $safePath . self::ENCRYPT_SAFEPATH;
		return $encryptSafePath;
	}
	static function createEncryptFolder () {

		$folderName = self::_getEncryptSafepath ();

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