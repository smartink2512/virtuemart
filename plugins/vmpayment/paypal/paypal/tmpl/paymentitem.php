<?php
/**
 *
 * Paypal payment plugin
 *
 * @author Max Milbers
 * @version $Id: paypal.php 7217 2013-09-18 13:42:54Z alatak $
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

if(!class_exists('vmPPButton')) require(VMPATH_PLUGINS .'/vmpayment/paypal/paypal/tmpl/ppbuttons.php');

$plugin = $viewData['method'];

echo vmPPButton::renderCheckoutButton($plugin).'<div class="clear"></div>';

/*if($plugin->offer_credit){
				$img = vmPPButton::getCreditLogo();
			} else {
				$img = vmPPButton::getExpressLogo();
			}
			$text = '';
			$logo = '<img src="'.$img.'" alt="'.$text.'" title="'.$text.'" style="width:20%;padding:2px;">';
			$html = '<div>'. VmText::sprintf('COM_VIRTUEMART_SELECT_BY_LOGO',$plugin->payment_name,$logo).'</div><div class="clear"></div>';*/
			