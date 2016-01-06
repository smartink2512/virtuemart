<?php
/**
*
* @package	VirtueMart
* @subpackage Helpers
* @author Max Milbers
* @copyright Copyright (c) 2014 VirtueMart Team. All rights reserved.
* @license LGPLv3
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/

class vObject {

	protected $_name;

	function getName() {

		if (empty($this->_name)) {
			$this->_name = $this->__toString();
		}
		return $this->_name;
	}

	public function __toString() {
		return get_class($this);
	}

	public function get($prop, $def = null) {
		if (isset($this->$prop)) {
			return $this->$prop;
		}
		return $def;
	}

	public function set($prop, $value = null) {
		$prev = isset($this->$prop) ? $this->$prop : null;
		$this->$prop = $value;
		return $prev;
	}

	public function setProperties($props) {

		if (is_array($props) || is_object($props)) {

			foreach ( $props as $k => $v) {
				if ('_' != substr($k, 0, 1)) {
					$this->$k = $v;
				}
			}
			return true;
		} else {
			return false;
		}
	}

	public function getProperties($public = true) {

		$vars = get_object_vars($this);
		if ($public) {
			foreach ($vars as $key => $value) {
				if ('_' == substr($key, 0, 1)) {
					unset($vars[$key]);
				}
			}
		}
		return $vars;
	}

	/**
	 * Assign variable for the object (by reference).
	 *
	 * Do not set variables that begin with an underscore;
	 * these are private properties.
	 *
	 * <code>
	 * $view = new JView;
	 *
	 * // Assign by name and value
	 * $view->assignRef('var1', $ref);
	 *
	 * // Assign directly
	 * $view->ref = &$var1;
	 * </code>
	 *
	 * @param   string  $key   The name for the reference in the view.
	 * @param   mixed   &$val  The referenced variable.
	 *
	 * @return  boolean  True on success, false on failure.
	 */
	public function assignRef($key, &$val) {

		if (is_string($key)){
			$this->$key = &$val;
			return true;
		}

		return false;
	}
}
