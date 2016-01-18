<?php
/**
 * @package     Joomla.Libraries
 * @subpackage  HTML
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved. 2016 The VirtueMart Project
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

/**
 * Utility class for form elements
 *
 * @since  1.5
 */
abstract class vHtmlForm {

	/**
	 * Adjusted for VMF
	 * @deprecated
	 * @return string
	 */
	public static function token() {
		return '<input type="hidden" name="' . vRequest::getFormToken(). '" value="1" />';
	}
}
