<?php
/**
 *
 * Layout for the shopping cart, look in mailshopper for more details
 *
 * @package	VirtueMart
 * @subpackage Cart
 * @author Max Milbers
 * @author Yagendoo Media Team
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 *
 */

defined('_JEXEC') or die('Restricted access');

if (empty($this->vendor)) 
{
	$vendorModel = VmModel::getModel('vendor');
	$this->vendor = $vendorModel->getVendor();
}
$link = JURI::root().'index.php?option=com_virtuemart';

//==>	Company name
$vendorCompanyName = (!empty($this->vendor->vendorFields["fields"]["company"]["value"])) ? $this->vendor->vendorFields["fields"]["company"]["value"] : $this->vendor->vendor_store_name;
?>
<table style="width: 100%;" width="100%" cellspacing="0" cellpadding="0" border="0">
	<tr>
		<td style="font-size: <?php echo $this->vendor->vendor_mail_footer_font_size; ?>px">
			<?php if( $this->recipient === 'shopper' ): ?>
				<?php echo JText::_('COM_VIRTUEMART_MAIL_FOOTER'); ?> <a href="<?php echo $link; ?>"><?php echo $vendorCompanyName; ?></a><br />
				<br />
				<?php if(!empty($this->vendor->vendor_mail_free2)): ?>
					<?php echo $this->vendor->vendor_mail_free2; ?>
				<?php endif; ?>
			<?php else : ?>
				<br /><br />
			<?php endif; ?>			
		</td>
	</tr>
</table>