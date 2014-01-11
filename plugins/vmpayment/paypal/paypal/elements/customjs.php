<?php
/**
 *
 * Paypal   payment plugin
 *
 * @author Jeremy Magne
 * ${PHING.VM.COPYRIGHT}
 * @package VirtueMart
 * @subpackage payment
 * Copyright (C) 2004-2014 Virtuemart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
 *
 * http://virtuemart.net
 */


defined ('_JEXEC') or die();
jimport('joomla.form.formfield');

class JFormFieldCustomjs extends JFormField {

	protected $type = 'Customjs';

	protected function getInput() {
		
		JHtml::_('behavior.colorpicker');
		
		$doc = JFactory::getDocument();
		$doc->addScript(JURI::root(true).'/plugins/vmpayment/paypal/paypal/assets/js/admin.js');

		
		return '';		
	}

}