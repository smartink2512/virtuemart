<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
*
* @version $Id: checkout_register_form.php,v 1.5 2005/10/09 13:30:02 soeren_nb Exp $
* @package VirtueMart
* @subpackage html
* @copyright Copyright (C) 2004-2005 Soeren Eberhardt. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/
mm_showMyFileName( __FILE__ );

$missing = mosGetParam( $_REQUEST, "missing", "" );
?>
<script language="javascript" type="text/javascript" src="includes/js/mambojavascript.js"></script>
<script language="javascript" type="text/javascript">//<![CDATA[
function submitregistration() {
	var form = document.adminForm;
	var r = new RegExp("[\<|\>|\"|\'|\%|\;|\(|\)|\&|\+|\-]", "i");

	// do field validation
	<?php
	if (!$my->id ) {
		if( VM_SILENT_REGISTRATION != '1' ) { ?>

			if (form.username.value == "") {
				alert( "<?php echo _REGWARN_UNAME; ?>" );
				return false;
			}
			else if (r.exec(form.username.value) || form.username.value.length < 3) {
				alert( "<?php printf(_VALID_AZ09, _PROMPT_UNAME, 2);   ?>" );
				return false;
			}
			else if (form.password.value.length < 6) {
				alert( "<?php echo _REGWARN_PASS;?>" );
				return false;
			} else if (form.password2.value == "") {
				alert( "<?php echo _REGWARN_VPASS1;?>" );
				return false;
			} else if ((form.password.value != "") && (form.password.value != form.password2.value)){
				alert( "<?php echo _REGWARN_VPASS2;?>" );
				return false;
			} else if (r.exec(form.password.value)) {
				alert( "<?php printf( _VALID_AZ09, _REGISTER_PASS, 6 );?>" );
				return false;
			}
		<?php
		}
		?>
		if (form.email.value == "") {
			alert( "<?php echo _REGWARN_MAIL;    ?>" );
			return false;
		}
		<?php
	}
	if (MUST_AGREE_TO_TOS == '1') {
		if (!$my->id) echo "else"; ?>

		if (!form.agreed.checked) {
			alert( "<?php echo $VM_LANG->_PHPSHOP_AGREE_TO_TOS ?>" );
			return false;
		}
		<?php
	}
	if (MUST_AGREE_TO_TOS == '1' || !$my->id) echo "else "; ?>
	{
		return true;
	}
}
//]]></script>
<?php
$missing_style = "color: Red; font-weight: Bold;";

if (!empty( $missing )) {
	echo "<script type=\"text/javascript\">alert('"._CONTACT_FORM_NC."'); </script>\n";
}
?>

<div style="width:90%;">
<form action="<?php echo $mm_action_url ?>index.php" method="post" name="adminForm">

<div align="right">
<?php echo _REGISTER_TITLE . " (* = " . _CMN_REQUIRED . ")";?>
</div>
<?php
if (empty($my->id) && VM_SILENT_REGISTRATION != '1') { ?>
<br/>
<fieldset>
<legend><span class="sectiontableheader"><?php echo $VM_LANG->_PHPSHOP_ORDER_PRINT_CUST_INFO_LBL ?></span></legend>

<div style="float:left;width:30%;text-align:right;<?php if (stristr($missing,'username')) echo $missing_style ?>">
<?php echo "<label for=\"uname_field\">"._REGISTER_UNAME."</label>*"    ?>
</div>
<div style="float:left;width:60%;">
<input type="text" id="uname_field" name="username" size="40" value="<?php echo empty($_REQUEST['username']) ? '' : $_REQUEST['username']; ?>" class="inputbox" />
</div>
<br/><br/>

<div style="float:left;width:30%;text-align:right;<?php if (stristr($missing,'password')) echo $missing_style ?>" >
<?php echo "<label for=\"passwd_field\">"._REGISTER_PASS."</label>*"   ?></div>
<div style="float:left;width:60%;"><input class="inputbox" type="password" id="passwd_field" name="password" size="40" value="" /></div>
<br/><br/>

<div style="float:left;width:30%;text-align:right;<?php if (stristr($missing,'password2')) echo $missing_style ?>" >
<?php echo "<label for=\"password2\">"._REGISTER_VPASS."</label>*"  ?></div>
<div style="float:left;width:60%;"><input class="inputbox" type="password" id="password2" name="password2" size="40" value="" /></div>
<br/><br/>
</fieldset>
<?php
} ?>
<br/>
<fieldset>
<legend class="sectiontableheader"><?php echo $VM_LANG->_PHPSHOP_SHOPPER_FORM_BILLTO_LBL ?></legend>

<div style="float:left;width:30%;text-align:right;" >
<?php echo "<label for=\"user_title\">".$VM_LANG->_PHPSHOP_SHOPPER_FORM_TITLE."</label>" ?>:</div>
<div style="float:left;width:60%;"><?php $ps_html->list_user_title(empty($_REQUEST['title']) ? '' : $_REQUEST['title'], "id=\"user_title\""); ?></div>
<br/><br/>

<div style="float:left;width:30%;text-align:right;<?php if (stristr($missing,'first_name')) echo $missing_style ?>">
<?php echo "<label for=\"first_name\">".$VM_LANG->_PHPSHOP_SHOPPER_FORM_FIRST_NAME."</label>*"  ?>:</div>
<div style="float:left;width:60%;">
<input type="text" id="first_name" name="first_name" size="40" value="<?php echo empty($_REQUEST['first_name']) ? '' : $_REQUEST['first_name']; ?>" class="inputbox" />
</div>
<br/><br/>

<div style="float:left;width:30%;text-align:right;<?php if (stristr($missing,'last_name')) echo $missing_style ?>" >
<?php echo "<label for=\"last_name\">".$VM_LANG->_PHPSHOP_SHOPPER_FORM_LAST_NAME."</label>*" ?>:</div>
<div style="float:left;width:60%;">
<input type="text" id="last_name" name="last_name" size="40" value="<?php echo empty($_REQUEST['last_name']) ? '' : $_REQUEST['last_name']; ?>" class="inputbox" />
</div>
<br/><br/>

<div style="float:left;width:30%;text-align:right;">
<?php echo "<label for=\"middle_name\">".$VM_LANG->_PHPSHOP_SHOPPER_FORM_MIDDLE_NAME."</label>"  ?>:</div>
<div style="float:left;width:60%;">
<input type="text" id="middle_name" name="middle_name" size="40" value="<?php echo empty($_REQUEST['middle_name']) ? '' : $_REQUEST['middle_name']; ?>" class="inputbox" />
</div>
<br/><br/>
<div style="float:left;width:30%;text-align:right;" >
<?php echo "<label for=\"company\">".$VM_LANG->_PHPSHOP_SHOPPER_FORM_COMPANY_NAME."</label>" ?>:</div>
<div style="float:left;width:60%;">
<input type="text" id="company" name="company" size="40" value="<?php echo empty($_REQUEST['company']) ? '' : $_REQUEST['company']; ?>" class="inputbox" />
</div>
<br/><br/>

<div style="float:left;width:30%;text-align:right;<?php if (stristr($missing,'address_1')) echo $missing_style ?>">
<?php echo "<label for=\"address_1\">".$VM_LANG->_PHPSHOP_SHOPPER_FORM_ADDRESS_1."</label>*" ?>:</div>
<div style="float:left;width:60%;">
<input type="text" id="address_1" name="address_1" size="40" value="<?php echo empty($_REQUEST['address_1']) ? '' : $_REQUEST['address_1']; ?>" class="inputbox" />
</div>
<br/><br/>

<div style="float:left;width:30%;text-align:right;" >
<?php echo "<label for=\"address_2\">".$VM_LANG->_PHPSHOP_SHOPPER_FORM_ADDRESS_2."</label>" ?>:</div>
<div style="float:left;width:60%;">
<input type="text" id="address_2" name="address_2" size="40" value="<?php echo empty($_REQUEST['address_2']) ? '' : $_REQUEST['address_2']; ?>" class="inputbox" />
</div>
<br/><br/>

<div style="float:left;width:30%;text-align:right;<?php if (stristr($missing,'city')) echo $missing_style ?>">
<?php echo "<label for=\"city\">".$VM_LANG->_PHPSHOP_SHOPPER_FORM_CITY."</label>*" ?>:</div>
<div style="float:left;width:60%;">
<input type="text" id="city" name="city" size="40" value="<?php echo empty($_REQUEST['city']) ? '' : $_REQUEST['city']; ?>" class="inputbox" />
</div>
<br/><br/>

<div style="float:left;width:30%;text-align:right;<?php if (stristr($missing,'zip')) echo $missing_style ?>">
<?php echo "<label for=\"zip\">".$VM_LANG->_PHPSHOP_SHOPPER_FORM_ZIP."</label>*" ?>:</div>
<div style="float:left;width:60%;">
<input type="text" id="zip" name="zip" size="10" value="<?php echo empty($_REQUEST['zip']) ? '' : $_REQUEST['zip']; ?>" class="inputbox" />
</div>
<br/><br/>

<div style="float:left;width:30%;text-align:right;<?php if (stristr($missing,'country')) echo $missing_style ?>">
<?php echo "<label for=\"country_field\">".$VM_LANG->_PHPSHOP_SHOPPER_FORM_COUNTRY."</label>*" ?>:</div>
<div style="float:left;width:60%;">
<?php $ps_html->list_country("country", empty($_REQUEST['country']) ? $vendor_country : $_REQUEST['country'], "id=\"country_field\" onchange=\"changeStateList();\"") ?>
</div>
<br/><br/>
<?php
if (CAN_SELECT_STATES == '1') {
	?>
	<div style="float:left;width:30%;text-align:right;<?php if (stristr($missing,'state')) echo $missing_style ?>">
	<?php echo "<label for=\"state\">".$VM_LANG->_PHPSHOP_SHOPPER_FORM_STATE."</label>" ?>:</div>
	<div style="float:left;width:60%;"><?php
	echo $ps_html->dynamic_state_lists( "country", "state", empty($_REQUEST['country']) ? $vendor_country : $_REQUEST['country'], empty($_REQUEST['state']) ? '' : $_REQUEST['state'] );
	echo "<noscript>\n";
	$ps_html->list_states("state", empty($_REQUEST['state']) ? '' : $_REQUEST['state'], "", "id=\"state\"");
	echo "</noscript>\n";
	?>

	</div>
	<br/><br/>
	<?php } ?>

	<div style="float:left;width:30%;text-align:right;" >
	<?php echo "<label for=\"phone_1\">".$VM_LANG->_PHPSHOP_SHOPPER_FORM_PHONE."</label>*" ?>:</div>
	<div style="float:left;width:60%;">
	<input type="text" id="phone_1" name="phone_1" size="40" value="<?php echo empty($_REQUEST['phone_1']) ? '' : $_REQUEST['phone_1']; ?>" class="inputbox" />
	</div>
	<br/><br/>

	<div style="float:left;width:30%;text-align:right;" >
	<?php echo "<label for=\"fax\">".$VM_LANG->_PHPSHOP_SHOPPER_FORM_FAX."</label>" ?>:</div>
	<div style="float:left;width:60%;">
	<input type="text" id="fax" name="fax" size="40" value="<?php echo empty($_REQUEST['fax']) ? '' : $_REQUEST['fax']; ?>" class="inputbox" />
	</div>
	<br/><br/>

	<div style="float:left;width:30%;text-align:right;<?php if (stristr($missing,'email')) echo $missing_style ?>" >
	<?php echo "<label for=\"email_field\">"._REGISTER_EMAIL."</label>*"  ?></div>
	<div style="float:left;width:60%;"><input type="text" id="email_field" name="email" size="40" value="<?php echo empty($_REQUEST['email']) ? '' : $_REQUEST['email']; ?>" class="inputbox" /></div>

	</fieldset>


	<?php
	if (LEAVE_BANK_DATA == '1') {
		$selected[0] = @$_REQUEST['bank_account_type']=="Checking" ? 'selected="selected"' : '';
		$selected[1] = @$_REQUEST['bank_account_type']=="Business Checking" ? 'selected="selected"' : '';
		$selected[2] = @$_REQUEST['bank_account_type']=="Savings" ? 'selected="selected"' : ''; ?>
		<br/>
		<fieldset>
		<legend class="sectiontableheader"><?php echo $VM_LANG->_PHPSHOP_ACCOUNT_BANK_TITLE ?></legend>
		<div style="float:left;width:30%;text-align:right;"><?php echo "<label for=\"bank_account_holder\">".$VM_LANG->_PHPSHOP_ACCOUNT_LBL_BANK_ACCOUNT_HOLDER."</label>" ?>:</div>
		<div style="float:left;width:60%;"><input type="text" class="inputbox" id="bank_account_holder" name="bank_account_holder" size="24" value="<?php echo empty($_REQUEST['bank_account_holder']) ? '' : $_REQUEST['bank_account_holder']; ?>" /></div>
		<br/><br/>

		<div style="float:left;width:30%;text-align:right;"><?php echo "<label for=\"bank_account_nr\">".$VM_LANG->_PHPSHOP_ACCOUNT_LBL_BANK_ACCOUNT_NR."</label>" ?>:</div>
		<div style="float:left;width:60%;"><input type="text" class="inputbox" id="bank_account_nr" name="bank_account_nr" size="24" value="<?php echo empty($_REQUEST['bank_account_nr']) ? '' : $_REQUEST['bank_account_nr']; ?>" /></div>
		<br/><br/>

		<div style="float:left;width:30%;text-align:right;"><?php echo "<label for=\"bank_sort_code\">".$VM_LANG->_PHPSHOP_ACCOUNT_LBL_BANK_SORT_CODE."</label>" ?>:</div>
		<div style="float:left;width:60%;"><input type="text" class="inputbox" id="bank_sort_code" name="bank_sort_code" size="24" value="<?php echo empty($_REQUEST['bank_sort_code']) ? '' : $_REQUEST['bank_sort_code'];?>" /></div>
		<br/><br/>

		<div style="float:left;width:30%;text-align:right;"><?php echo "<label for=\"bank_name\">".$VM_LANG->_PHPSHOP_ACCOUNT_LBL_BANK_NAME."</label>" ?>:</div>
		<div style="float:left;width:60%;"><input type="text" class="inputbox" id="bank_name" name="bank_name" size="24" value="<?php echo empty($_REQUEST['bank_name']) ? '' : $_REQUEST['bank_name']; ?>" /></div>
		<br/><br/>

		<div style="float:left;width:30%;text-align:right;"><?php echo "<label for=\"bank_account_type\">".$VM_LANG->_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE."</label>" ?>:</div>
		<div style="float:left;width:60%;">
		<select class="inputbox" id="bank_account_type" name="bank_account_type">
		<option <?php echo $selected[0] ?> value="Checking"><?php echo $VM_LANG->_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE_CHECKING ?></option>
		<option <?php echo $selected[1] ?> value="Business Checking"><?php echo $VM_LANG->_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE_BUSINESSCHECKING ?></option>
		<option <?php echo $selected[2] ?> value="Savings"><?php echo $VM_LANG->_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE_SAVINGS ?></option>
		</select>
		</div>
		<br/><br/>
		<div style="float:left;width:30%;text-align:right;"><?php echo "<label for=\"bank_iban\">".$VM_LANG->_PHPSHOP_ACCOUNT_LBL_BANK_IBAN."</label>" ?>:</div>
		<div style="float:left;width:60%;"><input type="text" class="inputbox" id="bank_iban" name="bank_iban" size="24" value="<?php echo empty($_REQUEST['bank_iban']) ? '' : $_REQUEST['bank_iban']; ?>" /></div>
		</fieldset>
		<?php
	}
	?>
	<br/>
	<fieldset>
	<legend class="sectiontableheader"><?php echo _BUTTON_SEND_REG ?></legend>
	<div style="text-align:center;">
	<?php
	if (MUST_AGREE_TO_TOS == '1') {
		?>
		<div style="<?php if (stristr($missing,'agreed')) echo "border:red solid 1px;"; ?>" >
		<input type="checkbox" id="agreed" name="agreed" value="1" class="inputbox" />

		<script type="text/javascript">//<![CDATA[
		document.write('<label for="agreed"><a href="javascript:void window.open(\'<?php echo $mosConfig_live_site ?>/index2.php?option=com_virtuemart&page=shop.tos&pop=1\', \'win2\', \'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no\');">');
		document.write('<?php echo $VM_LANG->_PHPSHOP_I_AGREE_TO_TOS ?></a></label>');
		//]]></script>
		<noscript><label for="agreed"><a target="_blank" href="<?php echo $mosConfig_live_site ?>/index.php?option=com_virtuemart&page=shop.tos" title="<?php echo $VM_LANG->_PHPSHOP_I_AGREE_TO_TOS ?>">
		<?php echo $VM_LANG->_PHPSHOP_I_AGREE_TO_TOS ?></a></label></noscript>

		</div>
		<br/><br/>
		<?php
	} ?>
	<input type="submit" value="<?php echo _BUTTON_SEND_REG; ?>" class="button" onclick="return( submitregistration());" />
	</div>

	<input type="hidden" name="Itemid" value="<?php echo @$_REQUEST['Itemid'] ?>" />
	<input type="hidden" name="gid" value="<? echo $my->gid ?>" />
	<input type="hidden" name="option" value="com_virtuemart" />
	<input type="hidden" name="remember" value="yes" />
	<input type="hidden" name="useractivation" value="<?php echo $mosConfig_useractivation; ?>" />
	<input type="hidden" name="func" value="shopperadd" />
	<input type="hidden" name="page" value="checkout.index" />
	</fieldset>
	</form>
	</div>
