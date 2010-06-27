<?php
/**
 *
 * Modify user form view, User info
 *
 * @package	VirtueMart
 * @subpackage User
 * @author Oscar van Eijk, Max Milbers
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

//if($this->setForm){ 

// Implement Joomla's form validation
JHTML::_('behavior.formvalidation');
JHTML::stylesheet('vmpanels.css', VM_THEMEURL);
?>
<style type="text/css">
.invalid {
	border-color: #f00;
	background-color: #ffd;
	color: #000;
}
label.invalid {
	background-color: #fff;
	color: #f00;
}
</style>
<script language="javascript">
function myValidator(f, t)
{
	f.task.value=t;
	if (f.task.value=='cancel') {
		f.submit();
		return true;
	}
	if (document.formvalidator.isValid(f)) {
		f.submit();
		return true;
	} else {
		var msg = '<?php echo JText::_('VM_USER_FORM_MISSING_REQUIRED'); ?>';
		alert (msg);
	}
	return false;
}
</script>
<form method="post" id="userForm" name="userForm" action="<?php echo JRoute::_( 'index.php' ); ?>" class="form-validate">
<div style="text-align: right; width: 100%;">
	<button class="button" type="submit" onclick="javascript:return myValidator(userForm, 'save');" /><?php echo JText::_('Save'); ?></button>
	&nbsp;
	<button class="button" type="submit" onclick="javascript:return myValidator(userForm, 'cancel');" /><?php echo JText::_('Cancel'); ?></button>
</div>

<?php // }  
if ($this->userDetails->JUser->get('id') ) { ?>
<fieldset>
	<legend>
		<?php echo JText::_('VM_USER_FORM_SHIPTO_LBL'); ?>
	</legend>

	<a class="vmicon vmicon-16-editadd" href="index.php?option=com_virtuemart&view=user&task=edit&shipto=0&cid[]=<?php echo $this->userDetails->JUser->get('id'); ?>">
		<?php echo JText::_('VM_USER_FORM_ADD_SHIPTO_LBL'); ?>
	</a>

	<table class="adminform">
		<tr>
			<td>
				<?php echo $this->lists['shipTo']; ?>
			</td>
		</tr>
	</table>
</fieldset>
<?php  } ?>

<fieldset>
	<legend>
		<?php echo JText::_('VM_USERFIELDS_FORM_LBL'); ?>
	</legend>
<?php 
	$_k = 0;
	$_set = false;
	$_table = false;
	$_hiddenFields = '';

	if (count($this->userFields['functions']) > 0) {
		echo '<script language="javascript">'."\n";
		echo join("\n", $this->userFields['functions']);
		echo '</script>'."\n";
	}
	for ($_i = 0, $_n = count($this->userFields['fields']); $_i < $_n; $_i++) {
		// Do this at the start of the loop, since we're using 'continue' below!
		if ($_i == 0) {
			$_field = current($this->userFields['fields']);
		} else {
			$_field = next($this->userFields['fields']);
		}

		if ($_field['hidden'] == true) {
			$_hiddenFields .= $_field['formcode']."\n";
			continue;
		}
		if ($_field['type'] == 'delimiter') {
			if ($_set) {
				// We're in Fieldset. Close this one and start a new
				if ($_table) {
					echo '	</table>'."\n";
					$_table = false;
				}
				echo '</fieldset>'."\n";
			}
			$_set = true;
			echo '<fieldset>'."\n";
			echo '	<legend>'."\n";
			echo '		' . $_field['title'];
			echo '	</legend>'."\n";
			continue;
		}

		if (!$_table) {
			// A table hasn't been opened as well. We need one here, 
			echo '	<table class="adminform">'."\n";
			$_table = true;
		}
		echo '		<tr>'."\n";
		echo '			<td class="key">'."\n";
		echo '				<label for="'.$_field['name'].'_field">'."\n";
		echo '					'.$_field['title'] . ($_field['required']?' *': '')."\n";
		echo '				</label>'."\n";
		echo '			</td>'."\n";
		echo '			<td>'."\n";
		echo '				'.$_field['formcode']."\n";
		echo '			</td>'."\n";
		echo '		</tr>'."\n";
	}

	if ($_table) {
		echo '	</table>'."\n";
	}
	if ($_set) {
		echo '</fieldset>'."\n";
	}
	echo $_hiddenFields;
?>
<input type="hidden" name="user_info_id" value="<?php echo $this->userInfoID; ?>" />
<input type="hidden" name="address_type" value="BT" />

</fieldset> <?php
if($this->setForm){
	echo '</form>';
} ?>