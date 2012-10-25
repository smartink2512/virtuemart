<?php
/**
 *
 * Main product information
 *
 * @package    VirtueMart
 * @subpackage Product
 * @author RolandD
 * @todo Price update calculations
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id$
 */

// Check to ensure this file is included in Joomla!
defined ('_JEXEC') or die('Restricted access'); ?>
<?php

	if (empty($this->sprices['virtuemart_product_price_id'])) {
		$this->sprices['virtuemart_product_price_id'] = '';
	}

	if (!class_exists ('calculationHelper')) {
		require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'calculationh.php');
	}
	$calculator = calculationHelper::getInstance ();

	$product = (object)array_merge ((array)$this->product, (array)$this->sprices);
	$price = $calculator->getProductPrices ($product);

	$currency_model = VmModel::getModel ('currency');
	$this->lists['currencies'] = JHTML::_ ('select.genericlist', $currency_model->getCurrencies (), 'mprices[product_currency][' . $this->i . ']', '', 'virtuemart_currency_id', 'currency_name', $product->product_currency);

	$DBTax = ''; //JText::_('COM_VIRTUEMART_RULES_EFFECTING') ;
	foreach ($calculator->rules['DBTax'] as $rule) {
		$DBTax .= $rule['calc_name'] . '<br />';
	}
	$this->DBTaxRules = $DBTax;

	$tax = ''; //JText::_('COM_VIRTUEMART_TAX_EFFECTING').'<br />';
	foreach ($calculator->rules['Tax'] as $rule) {
		$tax .= $rule['calc_name'] . '<br />';
	}
	foreach ($calculator->rules['VatTax'] as $rule) {
		$tax .= $rule['calc_name'] . '<br />';
	}
	$this->taxRules = $tax;

	$DATax = ''; //JText::_('COM_VIRTUEMART_RULES_EFFECTING');
	foreach ($calculator->rules['DATax'] as $rule) {
		$DATax .= $rule['calc_name'] . '<br />';
	}
	$this->DATaxRules = $DATax;

	if (!isset($product->product_tax_id)) {
		$product->product_tax_id = 0;
	}
	$this->lists['taxrates'] = ShopFunctions::renderTaxList ($product->product_tax_id, 'mprices[product_tax_id][' . $this->i . ']');
	if (!isset($product->product_discount_id)) {
		$product->product_discount_id = 0;
	}
	$this->lists['discounts'] = $this->renderDiscountList ($product->product_discount_id, 'mprices[product_discount_id][' . $this->i . ']');

	$this->lists['shoppergroups'] = ShopFunctions::renderShopperGroupList ($product->virtuemart_shoppergroup_id, false, 'mprices[virtuemart_shoppergroup_id][' . $this->i . ']');
	?>
<table class="adminform">

    <tr class="row1">
        <td width="120px">
            <div style="text-align: right; font-weight: bold;">
								<span
                                        class="hasTip"
                                        title="<?php echo JText::_ ('COM_VIRTUEMART_PRODUCT_FORM_PRICE_COST_TIP'); ?>">
									<?php echo JText::_ ('COM_VIRTUEMART_PRODUCT_FORM_PRICE_COST') ?>
								</span>
            </div>
        </td>
        <td width="140px"><input
                type="text"
                class="inputbox"
                name="mprices[product_price][]"
                size="12"
                style="text-align:right;"
                value="<?php echo $price['costPrice']; ?>"/>
            <input type="hidden"
                   name="mprices[virtuemart_product_price_id][]"
                   value="<?php echo $this->sprices['virtuemart_product_price_id']; ?>"/>
        </td>
        <td colspan="3">
			<?php echo $this->lists['currencies']; ?>
        </td>
        <td>
			<?php echo $this->lists['shoppergroups']; echo JText::_('COM_VIRTUEMART_SHOPPER_FORM_GROUP')?>
        </td>
    </tr>
    <tr class="row0">
        <td>
            <div style="text-align: right; font-weight: bold;">
								<span
                                        class="hasTip"
                                        title="<?php echo JText::_ ('COM_VIRTUEMART_PRODUCT_FORM_PRICE_BASE_TIP'); ?>">
									<?php echo JText::_ ('COM_VIRTUEMART_PRODUCT_FORM_PRICE_BASE') ?>
								</span>
            </div>
        </td>
        <td><input
                type="text"
                readonly
                class="inputbox readonly"
                name="mprices[basePrice][]"
                size="12"
                value="<?php echo $price['basePrice']; ?>"/>&nbsp;
			<?php echo $this->vendor_currency;   ?>
        </td>
		<?php /*    <td width="17%"><div style="text-align: right; font-weight: bold;">
							<?php echo JText::_('COM_VIRTUEMART_RATE_FORM_VAT_ID') ?></div>
                        </td> */ ?>
        <td colspan="2">
			<?php echo $this->lists['taxrates']; ?><br/>
        </td>
        <td>
	                        <span class="hasTip" title="<?php echo JText::_ ('COM_VIRTUEMART_RULES_EFFECTING_TIP') ?>">
							<?php echo JText::_ ('COM_VIRTUEMART_TAX_EFFECTING') . '<br />' . $this->taxRules ?>
		                    </span>
        </td>
        <td>
	        <?php echo  vmJsApi::jDate($product->product_price_publish_up, 'mprices[product_price_publish_up][]') ; ?>
        </td>
    </tr>
    <tr class="row1">
        <td>
            <div style="text-align: right; font-weight: bold;">
				<span
	                class="hasTip"
	                title="<?php echo JText::_ ('COM_VIRTUEMART_PRODUCT_FORM_PRICE_FINAL_TIP'); ?>">
					<?php echo JText::_ ('COM_VIRTUEMART_PRODUCT_FORM_PRICE_FINAL') ?>
				</span>
            </div>
        </td>
        <td><input
                type="text"
                name="mprices[salesPrice][]"
                size="12"
                style="text-align:right;"
                value="<?php echo $price['salesPriceTemp']; ?>"/>
			<?php echo $this->vendor_currency;   ?>
        </td>
		<?php /*  <td width="17%"><div style="text-align: right; font-weight: bold;">
							<?php echo JText::_('COM_VIRTUEMART_PRODUCT_FORM_DISCOUNT_TYPE') ?></div>
                        </td>*/ ?>
        <td colspan="2">
			<?php echo $this->lists['discounts']; ?> <br/>
        </td>
        <td>
	                    <span class="hasTip" title="<?php echo JText::_ ('COM_VIRTUEMART_RULES_EFFECTING_TIP') ?>">
						<?php if (!empty($this->DBTaxRules)) {
		                    echo JText::_ ('COM_VIRTUEMART_RULES_EFFECTING') . '</span><br />' . $this->DBTaxRules . '<br />';

	                    }
		                    if (!empty($this->DATaxRules)) {
			                    echo JText::_ ('COM_VIRTUEMART_RULES_EFFECTING') . '<br />' . $this->DATaxRules;
		                    }

// 						vmdebug('my rules',$this->DBTaxRules,$this->DATaxRules); echo JText::_('COM_VIRTUEMART_PRODUCT_FORM_DISCOUNT_EFFECTING').$this->DBTaxRules;  ?>
						</span>
        </td>
        <td>
	        <?php echo  vmJsApi::jDate($product->product_price_publish_down, 'mprices[product_price_publish_down][]') ; ?>
        </td>
    </tr>
    <tr>

    </tr>

    <tr class="row0">
        <td class="row1" colspan="2" style="background-color:#EEEEEE">
			<span
                    class="hasTip"
                    title="<?php echo JText::_ ('COM_VIRTUEMART_PRODUCT_FORM_CALCULATE_PRICE_FINAL_TIP'); ?>">
			<?php echo JText::_ ('COM_VIRTUEMART_PRODUCT_FORM_CALCULATE_PRICE_FINAL'); ?>
			</span>
            <input type="checkbox" name="mprices[use_desired_price][]" value="1"/>
        </td>
        <td width="60px">
            <div style="text-align: right; font-weight: bold;">
				<span
                        class="hasTip"
                        title="<?php echo JText::_ ('COM_VIRTUEMART_PRODUCT_DISCOUNT_OVERRIDE_TIP'); ?>">
					<?php echo JText::_ ('COM_VIRTUEMART_PRODUCT_DISCOUNT_OVERRIDE') ?>
				</span>
            </div>
        </td>
        <td width="120px">
            <input type="text"
                   size="12"
                   style="text-align:right;" name="mprices[product_override_price][]"
                   value="<?php echo $product->product_override_price ?>"/>
			<?php echo $this->vendor_currency;   ?>
        </td>
        <td><?php
// 							echo VmHtml::checkbox('override',$this->product->override);
			$options = array(0 => JText::_ ('COM_VIRTUEMART_DISABLED'), 1 => JText::_ ('COM_VIRTUEMART_OVERWRITE_FINAL'), -1 => JText::_ ('COM_VIRTUEMART_OVERWRITE_PRICE_TAX'));

			echo VmHtml::radioList ('mprices[override]['.$this->i.']', $product->override, $options);

			?>
        </td>
        <td>
            <input type="text"
                   size="12"
                   style="text-align:right;" name="mprices[price_quantity_start][]"
                   value="<?php echo $product->price_quantity_start ?>"/>
            <input type="text"
                   size="12"
                   style="text-align:right;" name="mprices[price_quantity_end][]"
                   value="<?php echo $product->price_quantity_end ?>"/>
        </td>
    </tr>
</table>
<?php
	$this->i++;

?>
