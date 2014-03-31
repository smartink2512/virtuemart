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

	function __construct ($method, $plugin) {
		$this->_method = $method;
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
	public function setOrder($order) {
		$this->order = $order;
	}
	public function unsetNonPayboxData ($paybox_data) {
		$returnFields = $this->getReturnFields();
		foreach ($paybox_data as $key => $value) {
			if (!in_array($key, $returnFields)) {
				unset($paybox_data[$key]);
			}
		}
		return $paybox_data;
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

	function getPbxAmount ($amount) {
		return round($amount * 100);

	}

	/**
	 * @param $total
	 * @return string
	 */
	function getPbxTotal ($total) {
		return str_pad($total, 3, "0", STR_PAD_LEFT);
	}

	/**
	 * @param $value
	 * @return string
	 */
	function getUniqueId ($value) {
		return $value . '-' . time();
	}

	/**
	 * @param $post
	 * @param $payboxKey
	 * @return string
	 */
	function getHmac ($post, $payboxKey) {

		$msg = '';

		$msg = $this->stringifyArray($post);
		$hmac = $this->generateHMAC($msg, $payboxKey);
		return $hmac;
	}

	function stringifyArray ($array) {
		$string = '';
		foreach ($array as $key => $value) {
			$string .= $key . "=" . $value . '&';
		}
		return substr($string, 0, -1);
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
		$paybox_ips = array('194.2.122.158', '195.25.7.166', '195.101.99.76');
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

	function getPayboxServerUrl () {


		if ($this->_method->shop_mode == 'test') {
			$url = 'https://preprod-tpeweb.paybox.com/php/';
		} else {
			$url = 'https://'.$this->getPayboxServerAvailable().'/php/';
		}
		return $url;

	}

	private function getPayboxServerAvailable () {

		$servers = array(
			'tpeweb.paybox.com', //serveur primaire
			'tpeweb1.paybox.com' //serveur secondaire
		);
		foreach ($servers as $server) {
			$doc = new DOMDocument();
			$doc->loadHTMLFile('https://' . $server . '/load.html');

			$server_status = "";
			$element = $doc->getElementById('server_status');
			if ($element) {
				$server_status = $element->textContent;
			}
			if ($server_status == "OK") {
				return $server;
			}
		}

		$this->plugin->debugLog('getPayboxServerAvailable : no server are available' . var_export($servers, true), 'error');
		return FALSE;
	}

	/**
	 * @param $paybox_data
	 * @return mixed
	 */
	function getOrderNumber ($order_number) {
		return $order_number;
	}

	/**
	 * @return array
	 */
	function getExtraPluginNameInfo () {

		return false;
	}

	/**
	 * @param $paybox_data
	 * @param $order
	 * @return mixed
	 */
	function getOrderHistory ($paybox_data, $order) {
		$amountInCurrency = vmPSPlugin::getAmountInCurrency($paybox_data['M'] * 0.01, $order['details']['BT']->order_currency);
		$order_history['comments'] = vmText::sprintf('VMPAYMENT_PAYBOX_PAYMENT_STATUS_CONFIRMED', $amountInCurrency['display'], $order['details']['BT']->order_number);
		$order_history['comments'] .= "<br />" . vmText::_('VMPAYMENT_PAYBOX_RESPONSE_S') . ' ' . $paybox_data['S'];

		$order_history['customer_notified'] = true;
		$status_success='status_success_'.$this->_method->debit_type;
		$order_history['order_status'] = $this->_method->$status_success;
		return $order_history;
	}

	/**
	 * @param        $keyfile
	 * @param bool   $pub
	 * @param string $pass
	 * @return bool|resource
	 */
	private function loadKey ($keyfile, $public_key = TRUE, $pass = '') {


		$fp = $filedata = $key = FALSE; // initialisation variables
		$fsize = filesize($keyfile); // taille du fichier
		if (!$fsize) {
			$this->plugin->pbxError('loadKey :' . 'Key File:' . $keyfile . ' not found');
			$this->plugin->debugLog('loadKey :' . 'Key File:' . $keyfile . ' not found', 'error');
			return FALSE;
		}
		$fp = fopen($keyfile, 'r'); // ouverture fichier
		if (!$fp) {
			$this->plugin->pbxError('Cannot open Key File' . $keyfile);
			$this->plugin->debugLog('loadKey :' . 'Cannot open Key File' . $keyfile, 'error');
			return FALSE;
		}
		$filedata = fread($fp, $fsize);
		fclose($fp);
		if (!$filedata) {
			$this->plugin->pbxError('Empty Key File' . $keyfile);
			$this->plugin->debugLog('loadKey :' . 'Empty Key File' . $keyfile, 'error');
			return FALSE;
		}
		if ($public_key) {
			$key = openssl_pkey_get_public($filedata);
		} // recuperation de la cle publique
		else // ou recuperation de la cle privee
		{
			$key = openssl_pkey_get_private(array($filedata, $pass));
		}
		return $key; // renvoi cle ( ou erreur )
	}

	/**
	 * @param $keyfile
	 * @param $queryString
	 * @return bool
	 */
	public function pbxIsValidSignature ($keyfile, $queryString) {
		//return true;
		$key = $this->loadKey($keyfile);
		if (!$key) {
			return false;
		}
		$sig = '';
		$queryStringNoSig = "";
		$this->GetSignedData($queryString, $queryStringNoSig, $sig);
		$sigDecoded=$this->getSig($sig, true);
		$sigNotDecoded=$this->getSig($sig, false);
		$verifySigDecoded = openssl_verify($queryStringNoSig, $sigDecoded, $key);
		$verifySigNotDecoded = openssl_verify($queryStringNoSig, $sigNotDecoded, $key);
		openssl_free_key($key);
		// openssl_verify: verification : 1 si valide, 0 si invalide, -1 si erreur
		if ($verifySigDecoded or $verifySigNotDecoded) {
			$msg = 'PbxVerSign :' . 'openssl_verify return value DECODED: ' . $verifySigDecoded . '<br />';
			$msg .= 'PbxVerSign :' . 'openssl_verify return value NOT DECODED: ' . $verifySigNotDecoded . '<br />';
			$this->plugin->debugLog($msg,'pbxIsValidSignature', 'debug');
			return true;
		}
		$msg = 'PbxVerSign :' . 'openssl_verify return value DECODED: ' . $verifySigDecoded . '<br />';
		$msg .= 'PbxVerSign :' . 'openssl_verify return value NOT DECODED: ' . $verifySigNotDecoded . '<br />';
		$msg .= '            ' . 'query sign ' . $queryString . '<br />';
		$msg .= '            ' . 'data ' . $queryStringNoSig . '<br />';
		//$msg .= '            ' . 'sig ' . $sig . '<br />';
		// we cannot send an error at this stage because may be the signature is not valid from the
		$this->plugin->debugLog($msg,'pbxIsValidSignature', 'debug');
		return false;

	}

	/**
	 * renvoi les donnes signees et la signature
	 * @param $qrystr
	 * @param $data
	 * @param $sig
	 */
	public function GetSignedData ($qrystr, &$data, &$sig) {
		//$qrystr=$_SERVER['QUERY_STRING'];
		$pos = strrpos($qrystr, '&'); // cherche dernier separateur
		$data = substr($qrystr, 0, $pos); // et voila les donnees signees
		$pos = strpos($qrystr, '=', $pos) + 1; // cherche debut valeur signature
		$sig = substr($qrystr, $pos);
	}

	/**
	 * @param $sig
	 * @param $doDecode
	 * @return string
	 */
	function getSig($sig, $doDecode) {
		if ($doDecode) {
			$this->plugin->debugLog('URL DO DECODE', 'debug');
			$sig = urldecode($sig);
		} else {
			$this->plugin->debugLog('URL NOT DECODE', 'debug');
		}
		$sig = base64_decode($sig); //decodage Base 64
		return $sig;
	}


}
