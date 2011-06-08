<?php
/**
*
* Description
*
* @package	VirtueMart
* @subpackage ShopperGroup
* @author Markus �hler
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
defined('_JEXEC') or die('Restricted access');
JHTML::_('behavior.tooltip');
AdminMenuHelper::startAdminArea();
?>

<form action="index.php" method="post" name="adminForm">

<div class="col50">
	<fieldset class="adminform">
	<legend><?php echo JText::_('COM_VIRTUEMART_SHOPPERGROUP_DETAILS'); ?></legend>
	<table class="admintable">
		<tr>
			<td width="110" class="key">
				<label for="shopper_group_name">
					<?php echo JText::_('COM_VIRTUEMART_SHOPPERGROUP_NAME'); ?>
				</label>
			</td>
			<td>
				<input class="inputbox" type="text" name="shopper_group_name" id="shopper_group_name" size="50" value="<?php echo $this->shoppergroup->shopper_group_name; ?>" />
			</td>
		</tr>
		<tr>
			<td width="110" class="key">
				<label for="virtuemart_vendor_id">
					<?php echo JText::_('COM_VIRTUEMART_VENDOR'); ?>
				</label>
			</td>
			<td>
				<?php echo $this->vendorList; ?>
			</td>
		</tr>
		<?php
		if ($this->shoppergroup->default == 1) { 
			?>
			<tr>
				<td width="110" class="key">
					<label for="default">
						<span class="editlinktip hasTip" title="<?php echo JText::_('COM_VIRTUEMART_SHOPPERGROUP_DEFAULT_TIP'); ?>">
					  <?php echo JText::_('COM_VIRTUEMART_SHOPPERGROUP_DEFAULT'); ?>
						</span>
					</label>
				</td>
				<td>
					<img src="templates/khepri/images/menu/icon-16-default.png" alt="<?php echo JText::_( 'Default' ); ?>" />
				</td>
			</tr>
			<?php
		} ?>
		<tr>
			<td width="110" class="key">
				<label for="shopper_group_desc">
					<?php echo JText::_('COM_VIRTUEMART_SHOPPERGROUP_DESCRIPTION'); ?>
				</label>
			</td>
			<td>
				<textarea rows="10" cols="30" name="shopper_group_desc" id="shopper_group_desc"><?php echo $this->shoppergroup->shopper_group_desc; ?></textarea>
			</td>
		</tr>
	</table>
	</fieldset>
</div>

	<input type="hidden" name="default" value="<?php echo $this->shoppergroup->default ?>" />
	<input type="hidden" name="option" value="com_virtuemart" />
	<input type="hidden" name="virtuemart_shoppergroup_id" value="<?php echo $this->shoppergroup->virtuemart_shoppergroup_id; ?>" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="controller" value="shoppergroup" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>

<?php AdminMenuHelper::endAdminArea(); ?>