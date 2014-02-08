<?php
/**
 *
 * Realex payment plugin
 *
 * @author Valerie Isaksen
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

class RealexHelperCustomerData {
	const REALEX_FOLDERNAME = "realex";
	var $_selected_paymentmethod = '';
	var $_remote_cc_name = '';
	var $_remote_cc_type = '';
	var $_remote_cc_number = '';
	var $_remote_cc_cvv = '';
	var $_remote_cc_expire_month = '';
	var $_remote_cc_expire_year = '';
	var $_remote_cc_valid = false;
	var $_redirect_cc_selected = '';
	var $_remote_save_card = '';
	private $_errormessage = array();
	private $_remote_first_name = '';
	private $_remote_last_name = '';



	public function load ($virtuemart_paymentmethod_id) {

		//$this->clear();

		$session = JFactory::getSession();
		$sessionData = $session->get('realex_customer', 0, 'vm');

		if (!empty($sessionData)) {
			$data = unserialize($sessionData);
			if ($data['selected_paymentmethod']==$virtuemart_paymentmethod_id) {
				$this->_selected_paymentmethod = $data['selected_paymentmethod'];
				$this->redirect_cc_selected_ = $data['redirect_cc_selected_' . $virtuemart_paymentmethod_id];
				// card information
				$this->_remote_cc_type = $data['remote_cc_type_' . $virtuemart_paymentmethod_id];
				$this->_remote_cc_number = $this->decrypt($data['remote_cc_number_' . $virtuemart_paymentmethod_id]);
				$this->_remote_cc_cvv = $data['remote_cc_cvv_' . $virtuemart_paymentmethod_id];
				$this->_remote_cc_expire_month = $data['remote_cc_expire_month_' . $virtuemart_paymentmethod_id];
				$this->_remote_cc_expire_year = $data['remote_cc_expire_year_' . $virtuemart_paymentmethod_id];
				$this->_remote_cc_name = $data['remote_cc_name_' . $virtuemart_paymentmethod_id];
				$this->_remote_cc_valid = $data['remote_cc_valid_' . $virtuemart_paymentmethod_id];
				$this->_redirect_cc_selected = $data['redirect_cc_selected_' . $virtuemart_paymentmethod_id];
				$this->_remote_save_card = $data['remote_save_card_' . $virtuemart_paymentmethod_id];
			} else {
				$this->_selected_paymentmethod = 0;
				$this->redirect_cc_selected_ = '';
				// card information
				$this->_remote_cc_type = '';
				$this->_remote_cc_number = '';
				$this->_remote_cc_cvv = '';
				$this->_remote_cc_expire_month = '';
				$this->_remote_cc_expire_year = '';
				$this->_remote_cc_name = '';
				$this->_remote_cc_valid ='';
				$this->_redirect_cc_selected = '';
				$this->_remote_save_card = '';
			}
		}

	}

	public function loadPost ($virtuemart_paymentmethod_id) {

		// card information
		//$virtuemart_paymentmethod_id = JRequest::getVar('virtuemart_paymentmethod_id', 0);
if ($virtuemart_paymentmethod_id== JRequest::getVar('virtuemart_paymentmethod_id', 0)) {
	$data['selected_paymentmethod'] = $virtuemart_paymentmethod_id;
	$data['redirect_cc_selected_' . $virtuemart_paymentmethod_id] = JRequest::getVar('redirect_cc_selected_' . $virtuemart_paymentmethod_id, '');
	$data['remote_cc_type_' . $virtuemart_paymentmethod_id] = JRequest::getVar('remote_cc_type_' . $virtuemart_paymentmethod_id, '');
	$data['remote_cc_name_' . $virtuemart_paymentmethod_id] =  JRequest::getVar('remote_cc_name_' . $virtuemart_paymentmethod_id);
	$data['remote_cc_number_' . $virtuemart_paymentmethod_id] = $this->encrypt(str_replace(" ", "", JRequest::getVar('remote_cc_number_' . $virtuemart_paymentmethod_id, '')));
	$data['remote_cc_cvv_' . $virtuemart_paymentmethod_id] = JRequest::getInt('remote_cc_cvv_' . $virtuemart_paymentmethod_id, '');
	$data['remote_cc_expire_month_' . $virtuemart_paymentmethod_id] = JRequest::getVar('remote_cc_expire_month_' . $virtuemart_paymentmethod_id, '');
	$data['remote_cc_expire_year_' . $virtuemart_paymentmethod_id] = JRequest::getInt('remote_cc_expire_year_' . $virtuemart_paymentmethod_id, '');
	$data['remote_save_card_' . $virtuemart_paymentmethod_id] = JRequest::getInt('remote_save_card_' . $virtuemart_paymentmethod_id, '');
	$this->save($data);
}

	}

	public function save ($data) {
		$session = JFactory::getSession();
		$session->set('realex_customer', serialize($data), 'vm');
	}


	public function clear () {
		$session = JFactory::getSession();
		$session->clear('realex_customer', 'vm');
	}

	public function getVar ($var, $virtuemart_paymentmethod_id) {
		$data = $this->load($virtuemart_paymentmethod_id);
		return $this->{'_' . $var};
	}

	public function setVar ($var, $val) {
		$this->{'_' . $var} = $val;
	}

	static function encrypt ($string) {

		$key = self::getKey();
		return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, md5(md5($key))));
	}

	static function decrypt ($string) {

		$key = self::getKey();
		return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($string), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
	}

	static function getKey () {

		$filename = self::_getRealexSafepath() . DS . 'key.php';
		if (file_exists($filename)) {
			include_once $filename;
		}

		return base64_decode(USERFIELD_REALEX_KEY);

	}

	static function _getRealexSafepath () {

		$safePath = VmConfig::get('forSale_path', '');
		if (empty($safePath)) {
			return NULL;
		}
		$realexSafePath = $safePath . self::REALEX_FOLDERNAME;
		return $realexSafePath;
	}

}
