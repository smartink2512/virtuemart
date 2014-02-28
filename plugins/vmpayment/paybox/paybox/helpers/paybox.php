<?php
/**
 *
 * Paybox payment plugin
 *
 * @author Valérie Isaksen
 * @version $Id$
 * @package VirtueMart
 * @subpackage payment
 * ${PHING.VM.COPYRIGHT}
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
 *
 * http://virtuemart.net
 */


defined('_JEXEC') or die('Restricted access');


class  PayboxHelperPaybox {

	const RESPONSE_SUCCESS = '00000';

	const TYPEPAIEMENT_CARTE = 'CARTE';

	const TYPECARTE_CB = 'CB';

	const TYPE_DIRECT_AUTHORIZATION_ONLY = '00001';
	const TYPE_DIRECT_CAPTURE = '00002';
	const TYPE_DIRECT_AUTHORIZATION_CAPTURE = '00003';

	function __construct ($plugin) {
		$this->plugin = $plugin;
	}

	public function getReturnFields () {
		$fields = array(
			'M',
			'R',
			'T',
			'A',
			'B',
			'P',
			'C',
			'S',
			'Y',
			'E',
			'D',
			'I',
			'N',
			'J',
			'H',
			'G',
			'O',
			'F',
			'W',
			'Z',
			'K', // MUST BE THE LAST ONE
		);
		return $fields;
	}

	public function getReturn () {

		$returnFieldsString = '';
		$returnFields = $this->getReturnFields();
		foreach ($returnFields as $returnField) {
			$returnFieldsString .= $returnField . ":" . $returnField . ';';
		}
		return substr($returnFieldsString, 0, -1);;

	}

	public function getType () {
		switch ($this->_method->type) {

			case 'authorization_capture':
				return self::TYPE_DIRECT_AUTHORIZATION_CAPTURE;
				break;
			case 'authorization_only':
			default:
				return self::TYPE_DIRECT_AUTHORIZATION_ONLY;
				break;
		}

	}

	function getUniqueId ($value) {
		return $value . '-' . time();
	}

	function getHmac ($post, $payboxKey) {

		$msg = '';

		foreach ($post as $key => $value) {
			$msg .= $key . "=" . $value . '&';
		}
		$msg = substr($msg, 0, -1);
		$hmac = $this->generateHMAC($msg, $payboxKey);
		return $hmac;
	}


	public function getHashAlgo () {

		return "SHA512";
	}

	public function generateHMAC ($msg, $payboxKey) {
		$binKey = pack("H*", $payboxKey);
		$hmac = strtoupper(hash_hmac($this->getHashAlgo(), $msg, $binKey));
		return $hmac;
	}

	public function checkIps () {
		// TODO REMOVE MY IP
		$paybox_ips = array('194.2.122.158', '195.25.7.166', '195.101.99.76','88.186.104.215');
		if (!in_array($_SERVER['REMOTE_ADDR'], $paybox_ips)) {
			$text = "Received not authorized IP: <br />Server IP=" . $_SERVER['REMOTE_ADDR'];
			$text .= " <br />authorized IPs: =" . var_export($paybox_ips, true);
			$this->plugin->debugLog('checkIps :' . $text, 'error');
			return false;
		}
		return true;
	}


	function getLangue () {

		/*
		* Langue utilisée par Paybox pour l’affichage de la page de paiement.
			* Par défaut, la page est en français. Les valeurs possibles sont
		* FRA (Français), GBR (Anglais), ESP (Espagnol), ITA (Italien), DEU (Allemand), NLD (Hollandais) et SWE (Suédois).
			*/
		$langPaybox = array(
			'fr' => 'FRA',
			'en' => 'GBR',
			'es' => 'ESP',
			'it' => 'ITA',
			'de' => 'DEU',
			'nl' => 'NLD',
			'se' => 'SWE',
			'pt' => 'PRT',
		);
		$lang = JFactory::getLanguage();
		$tag = strtolower(substr($lang->get('tag'), 0, 2));
		if (array_key_exists($tag, $langPaybox)) {
			return $langPaybox[$tag];
		} else {
			return $langPaybox['en'];
		}
	}

	function getTypePaiement () {
		return self::TYPEPAIEMENT_CARTE;
	}

	function getTypeCarte () {
		return self::TYPECARTE_CB;
	}

	function getTime () {
		return date("c");
	}

	function getPayboxUrl ($shop_mode) {
		if ($shop_mode == 'test') {
			$url = 'https://preprod-tpeweb.paybox.com/php/';
			//$url = 'https://preprod-tpeweb.paybox.com/cgi/MYchoix_pagepaiement.cgi';
		} else {
			$url = "https://tpeweb.paybox.com/php/";
		}
		return $url;

	}


	/**
	 * @param        $keyfile
	 * @param bool   $pub
	 * @param string $pass
	 * @return bool|resource
	 */
	private function loadKey ($keyfile, $pub = TRUE, $pass = '') {


		$fp = $filedata = $key = FALSE; // initialisation variables
		$fsize = filesize($keyfile); // taille du fichier
		if (!$fsize) {
			VmError('loadKey :' . 'Key File' . $keyfile . 'not found');
			$this->plugin->debugLog('loadKey :' . 'Key File' . $keyfile . 'not found', 'error');
			return FALSE;
		}
		$fp = fopen($keyfile, 'r'); // ouverture fichier
		if (!$fp) {
			vmError('Cannot open Key File' . $keyfile);
			$this->plugin->debugLog('loadKey :' . 'Cannot open Key File' . $keyfile, 'error');
			return FALSE;
		}
		$filedata = fread($fp, $fsize);
		fclose($fp);
		if (!$filedata) {
			vmError('Empty Key File' . $keyfile);
			$this->plugin->debugLog('loadKey :' . 'Empty Key File' . $keyfile, 'error');
			return FALSE;
		}
		if ($pub) {
			$key = openssl_pkey_get_public($filedata);
		} // recuperation de la cle publique
		else // ou recuperation de la cle privee
		{
			$key = openssl_pkey_get_private(array($filedata, $pass));
		}
		return $key; // renvoi cle ( ou erreur )
	}




	public function PbxVerSign ($keyfile, $qrystr) {
		//return true;
		$key = $this->loadKey($keyfile);
		if (!$key) {
			return false;
		}
		$sig = '';
		$data = "";
		$this->GetSignedData($qrystr, $data, $sig);
		$openSsl = openssl_verify($data, $sig, $key);
		openssl_free_key($key);
		// openssl_verify: verification : 1 si valide, 0 si invalide, -1 si erreur
		if ($openSsl !== 1) {
			$this->plugin->debugLog('PbxVerSign :' . 'openssl_verify ' . $openSsl, 'error');
			return false;
		}

		return true;
	}

	// renvoi les donnes signees et la signature
	public function GetSignedData ($qrystr, &$data, &$sig) {
		$pos = strrpos($qrystr, '&'); // cherche dernier separateur
		$data = substr($qrystr, 0, $pos); // et voila les donnees signees
		$pos = strpos($qrystr, '=', $pos) + 1; // cherche debut valeur signature
		$sig = substr($qrystr, $pos);
		$sig = urldecode($sig);
		$sig = base64_decode($sig); //decodage Base 64
	}


}