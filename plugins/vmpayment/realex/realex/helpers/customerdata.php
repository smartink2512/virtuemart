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
	const REALEX_SESSION = "RealexCustomerData";
	private $_cc_name = '';
	private $_cc_type = '';
	private $_cc_number = '';
	private $_cc_cvv = '';
	private $_cc_expire_month = '';
	private $_cc_expire_year = '';
	private $_cc_valid = false;
	private $_selected_method = '';
	private $_redirect_cc_selected = '';
	private $_save_card = '';


	public function load () {

		//$this->_clear();
		/* TODO
		$store = 'none';
		$options['expire']= 60* 60;
		$session = JFactory::getSession($store,$options);
		*/
		$session = JFactory::getSession();
		$sessionData = $session->get(self::REALEX_SESSION, 0, 'vm');
		if (!class_exists('vmCrypt')) {
			require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'vmcrypt.php');
		}
		if (!empty($sessionData)) {
			$data = unserialize($sessionData);
			$this->_redirect_cc_selected = $data->redirect_cc_selected;
			$this->_save_card = $data->save_card;
			$this->_selected_method = $data->selected_method;
			// card information are not  saved  in session
		}

	}

	public function loadPost () {

		$this->_selected_method = vRequest::getInt('virtuemart_paymentmethod_id', 0);
		$this->_save_card = vRequest::getInt('save_card', 0);
		$redirect_cc_selected = vRequest::getInt('redirect_cc_selected_' . $this->_selected_method, 0);
		if ($redirect_cc_selected) {
			$this->_redirect_cc_selected = $redirect_cc_selected;
		}
		$cctype = vRequest::getString('cc_type', '');
		if ($cctype) {
			$this->_cc_type = $cctype;
		}
		/**
		 * name on CC should be restricted to letters only.
		 */
		$cc_name = vRequest::getString('cc_name', '');
		if ($cc_name) {
			$cc_name = $this->replaceNonAsciiCharacters($cc_name);
			$this->_cc_name = $cc_name;
		}

		$cc_number = vRequest::getString('cc_number', '');
		if ($cc_number) {
			$this->_cc_number = $cc_number;
		}

		$cc_cvv = vRequest::getInt('cc_cvv', '');
		if ($cc_cvv) {
			$this->_cc_cvv = $cc_cvv;
		}

		$cc_expire_month = vRequest::getInt('cc_expire_month', '');
		if ($cc_expire_month) {
			$this->_cc_expire_month = $cc_expire_month;
		}

		$cc_expire_year = vRequest::getInt('cc_expire_year', '');
		if ($cc_expire_year) {
			$this->_cc_expire_year = $cc_expire_year;
		}
		$this->save();

	}

	public function setCustomerData ($data) {
		$this->_cc_type = $data['cc_type'];
		$this->_cc_name = $data['cc_name'];
		$this->_cc_number = $data['cc_number'];
		$this->_cc_cvv = $data['cc_cvv'];
		$this->_cc_expire_month = $data['cc_expire_month'];
		$this->_cc_expire_year = $data['cc_expire_year'];
	}

	public function save () {

		$session = JFactory::getSession();
		$sessionData = new stdClass();
		$sessionData->selected_method = $this->_selected_method;
		$sessionData->redirect_cc_selected = $this->_redirect_cc_selected;
		$sessionData->save_card = $this->_save_card;
		// card information should not be saved  in session
		$session->set(self::REALEX_SESSION, serialize($sessionData), 'vm');
	}

	public function getVar ($var) {
		$this->load();
		return $this->{'_' . $var};
	}

	public function setVar ($var, $val) {
		$this->{'_' . $var} = $val;
	}

	public function clear () {
		$session = JFactory::getSession();
		$session->clear(self::REALEX_SESSION, 'vm');
	}
	function getMaskedCCnumber() {
		if (!class_exists('shopFunctionsF')) {
			require(JPATH_VM_SITE . DS . 'helpers' . DS . 'shopfunctionsf.php');
		}
		return  shopFunctionsF::mask_string($this->getVar('cc_number'), '*');
		$this->getVar('cc_number');

	}

private function replaceNonAsciiCharacters($string){
	$replacements=$this->getReplacements();
	$string = strtr($string, $replacements);
	return $string;
}

	/**
	 * Return array of URL characters to be replaced.
	 *
	 * @return array
	 */
	public function getReplacements()
	{
	return	array (
			'Á' => 'A',
			'Â' => 'A',
			'Å' => 'A',
			'Ă' => 'A',
			'Ä' => 'A',
			'À' => 'A',
			'Æ' => 'A',
			'Ć' => 'C',
			'Ç' => 'C',
			'Č' => 'C',
			'Ď' => 'D',
			'É' => 'E',
			'È' => 'E',
			'Ë' => 'E',
			'Ě' => 'E',
			'Ê' => 'E',
			'Ì' => 'I',
			'Í' => 'I',
			'Î' => 'I',
			'Ï' => 'I',
			'Ĺ' => 'L',
			'ľ' => 'l',
			'Ľ' => 'L',
			'Ń' => 'N',
			'Ň' => 'N',
			'Ñ' => 'N',
			'Ò' => 'O',
			'Ó' => 'O',
			'Ô' => 'O',
			'Õ' => 'O',
			'Ö' => 'O',
			'Ø' => 'O',
			'Ŕ' => 'R',
			'Ř' => 'R',
			'Š' => 'S',
			'Ś' => 'S',
			'Ť' => 'T',
			'Ů' => 'U',
			'Ú' => 'U',
			'Ű' => 'U',
			'Ü' => 'U',
			'Û' => 'U',
			'Ý' => 'Y',
			'Ž' => 'Z',
			'Ź' => 'Z',
			'á' => 'a',
			'â' => 'a',
			'å' => 'a',
			'ä' => 'a',
			'à' => 'a',
			'æ' => 'a',
			'ć' => 'c',
			'ç' => 'c',
			'č' => 'c',
			'ď' => 'd',
			'đ' => 'd',
			'é' => 'e',
			'ę' => 'e',
			'ë' => 'e',
			'ě' => 'e',
			'è' => 'e',
			'ê' => 'e',
			'ì' => 'i',
			'í' => 'i',
			'î' => 'i',
			'ï' => 'i',
			'ĺ' => 'l',
			'ń' => 'n',
			'ň' => 'n',
			'ñ' => 'n',
			'ò' => 'o',
			'ó' => 'o',
			'ô' => 'o',
			'ő' => 'o',
			'ö' => 'o',
			'ø' => 'o',
			'š' => 's',
			'ś' => 's',
			'ř' => 'r',
			'ŕ' => 'r',
			'ť' => 't',
			'ů' => 'u',
			'ú' => 'u',
			'ù' => 'u',
			'ű' => 'u',
			'ü' => 'u',
			'û' => 'u',
			'ý' => 'y',
			'ž' => 'z',
			'ź' => 'z',
			'˙' => '-',
			'ß' => 'ss',
			'Ą' => 'A',
			'µ' => 'u',
			'ą' => 'a',
			'Ę' => 'E',
			'ż' => 'z',
			'Ż' => 'Z',
			'ł' => 'l',
			'Ł' => 'L',
			'А' => 'A',
			'а' => 'a',
			'Б' => 'B',
			'б' => 'b',
			'В' => 'V',
			'в' => 'v',
			'Г' => 'G',
			'г' => 'g',
			'Д' => 'D',
			'д' => 'd',
			'Е' => 'E',
			'е' => 'e',
			'Ж' => 'Zh',
			'ж' => 'zh',
			'З' => 'Z',
			'з' => 'z',
			'И' => 'I',
			'и' => 'i',
			'Й' => 'I',
			'й' => 'i',
			'К' => 'K',
			'к' => 'k',
			'Л' => 'L',
			'л' => 'l',
			'М' => 'M',
			'м' => 'm',
			'Н' => 'N',
			'н' => 'n',
			'О' => 'O',
			'о' => 'o',
			'П' => 'P',
			'п' => 'p',
			'Р' => 'R',
			'р' => 'r',
			'С' => 'S',
			'с' => 's',
			'Т' => 'T',
			'т' => 't',
			'У' => 'U',
			'у' => 'u',
			'Ф' => 'F',
			'ф' => 'f',
			'Х' => 'Kh',
			'х' => 'kh',
			'Ц' => 'Tc',
			'ц' => 'tc',
			'Ч' => 'Ch',
			'ч' => 'ch',
			'Ш' => 'Sh',
			'ш' => 'sh',
			'Щ' => 'Shch',
			'щ' => 'shch',
			'Ы' => 'Y',
			'ы' => 'y',
			'Э' => 'E',
			'э' => 'e',
			'Ю' => 'Iu',
			'ю' => 'iu',
			'Я' => 'Ia',
			'я' => 'ia',
			'Ъ' => '',
			'ъ' => '',
			'Ь' => '',
			'ь' => '',
			'Ё' => 'E',
			'ё' => 'e',
			'ου' => 'ou',
			'ού' => 'ou',
			'α' => 'a',
			'β' => 'b',
			'γ' => 'g',
			'δ' => 'd',
			'ε' => 'e',
			'ζ' => 'z',
			'η' => 'i',
			'θ' => 'th',
			'ι' => 'i',
			'κ' => 'k',
			'λ' => 'l',
			'μ' => 'm',
			'ν' => 'n',
			'ξ' => 'ks',
			'ο' => 'o',
			'π' => 'p',
			'ρ' => 'r',
			'σ' => 's',
			'τ' => 't',
			'υ' => 'i',
			'φ' => 'f',
			'χ' => 'x',
			'ψ' => 'ps',
			'ω' => 'o',
			'ά' => 'a',
			'έ' => 'e',
			'ί' => 'i',
			'ή' => 'i',
			'ό' => 'o',
			'ύ' => 'i',
			'ώ' => 'o',
			'Ου' => 'ou',
			'Ού' => 'ou',
			'Α' => 'a',
			'Β' => 'b',
			'Γ' => 'g',
			'Δ' => 'd',
			'Ε' => 'e',
			'Ζ' => 'z',
			'Η' => 'i',
			'Θ' => 'th',
			'Ι' => 'i',
			'Κ' => 'k',
			'Λ' => 'l',
			'Μ' => 'm',
			'Ν' => 'n',
			'Ξ' => 'ks',
			'Ο' => 'o',
			'Π' => 'p',
			'Ρ' => 'r',
			'Σ' => 's',
			'Τ' => 't',
			'Υ' => 'i',
			'Φ' => 'f',
			'Χ' => 'x',
			'Ψ' => 'ps',
			'Ω' => 'o',
			'ς' => 's',
			'Ά' => 'a',
			'Έ' => 'e',
			'Ή' => 'i',
			'Ί' => 'i',
			'Ό' => 'o',
			'Ύ' => 'i',
			'Ώ' => 'o',
			'ϊ' => 'i',
			'ΐ' => 'i',

		);

	}
}
