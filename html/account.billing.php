<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
*
* @version $Id: account.billing.php,v 1.3 2005/09/29 20:02:18 soeren_nb Exp $
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

$mainframe->setPageTitle( $VM_LANG->_PHPSHOP_USER_FORM_BILLTO_LBL );
      
$next_page = mosGetParam( $_REQUEST, "next_page", "account.index");
$Itemid = mosGetParam( $_REQUEST, "Itemid", null);

$missing = mosGetParam( $vars, 'missing' );
$missing_style = "color: Red; font-weight: Bold;";

if (!empty($missing))
    echo "<script type=\"text/javascript\"> alert('"._CONTACT_FORM_NC."'); </script>\n";

$q =  "SELECT * FROM #__users, #__{vm}_user_info 
		WHERE user_id='" . $auth["user_id"] . "' 
		AND user_id = id
		AND address_type='BT' ";
$db->query($q);
$db->next_record();    
$db_shoppergroup = new ps_DB;
$q_sg = "SELECT shopper_group_id FROM #__{vm}_shopper_vendor_xref";
$q_sg .= " WHERE user_id ='".$auth["user_id"]."'";
$db_shoppergroup->query($q_sg);
$db_shoppergroup->next_record();

$shopper_group_id = $db_shoppergroup->f("shopper_group_id");

echo "<div><a href=\"".$sess->url( SECUREURL ."index.php?page=account.index")."\" title=\"".$VM_LANG->_PHPSHOP_ACCOUNT_TITLE."\">"
      .$VM_LANG->_PHPSHOP_ACCOUNT_TITLE."</a> -&gt; "
      .$VM_LANG->_PHPSHOP_USER_FORM_BILLTO_LBL."</div><br/>";
?>
<!-- Registration form -->
<form action="<?php echo $mm_action_url."index.php" ?>" method="post" name="adminForm">
  <input type="hidden" name="option" value="<?php echo $option ?>" />
  <input type="hidden" name="page" value="<?php echo $next_page; ?>" />
  <input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />
  <input type="hidden" name="func" value="shopperupdate" />
  <input type="hidden" name="username" value="<?php echo $auth["username"] ?>" />
  <input type="hidden" name="user_info_id" value="<?php $db->p("user_info_id"); ?>" />
  <input type="hidden" name="id" value="<?php echo $auth["user_id"] ?>" />
  <input type="hidden" name="user_id" value="<?php echo $auth["user_id"] ?>" />
  <input type="hidden" name="shopper_group_id" value="<?php echo $shopper_group_id; ?>" />
  <input type="hidden" name="address_type" value="BT" />
  
<div style="width:90%;">
  <fieldset>
     <legend class="sectiontableheader"><?php echo $VM_LANG->_PHPSHOP_USER_FORM_BILLTO_LBL ?></legend>
      <br/><div align="right">
      <?php echo "(* = " . _CMN_REQUIRED . ")";?>
    </div>
   
      <div style="float:left;width:30%;text-align:right;">
        <?php echo _REGISTER_UNAME ?>
      </div>
      <div style="float:left;width:60%;"><?php $db->p("username"); ?>
        <input type="hidden" id="username_field" name="username" size="40" value="<?php $db->p("username"); ?>" class="inputbox" />
      </div>
      <br/><br/>
        
      <div style="float:left;width:30%;text-align:right;<?php if (stristr($missing,'email')) echo $missing_style ?>" >
        <?php echo "<label for=\"email_field\">"._REGISTER_EMAIL."</label>*"  ?></div>
      <div style="float:left;width:60%;"><input type="text" id="email_field" name="email" size="40" value="<?php $db->sp("email") ?>" class="inputbox" /></div>
    <br/><br/>
      
      <div style="float:left;width:30%;text-align:right;" >
        <?php echo "<label for=\"company\">".$VM_LANG->_PHPSHOP_SHOPPER_FORM_COMPANY_NAME."</label>" ?>:</div>
      <div style="float:left;width:60%;"> 
        <input type="text" id="company" name="company" size="40" value="<?php $db->sp("company"); ?>" class="inputbox" />
      </div>
    <br/><br/>
    
      <div style="float:left;width:30%;text-align:right;" >
        <?php echo "<label for=\"user_title\">".$VM_LANG->_PHPSHOP_SHOPPER_FORM_TITLE."</label>" ?>:</div>
      <div style="float:left;width:60%;"><?php $ps_html->list_user_title($db->sf("title"), "id=\"user_title\""); ?></div>
    <br/><br/>
     
      <div style="float:left;width:30%;text-align:right;<?php if (stristr($missing,'first_name')) echo $missing_style ?>">
        <?php echo "<label for=\"first_name\">".$VM_LANG->_PHPSHOP_SHOPPER_FORM_FIRST_NAME."</label>*"  ?>:</div>
      <div style="float:left;width:60%;"> 
        <input type="text" id="first_name" name="first_name" size="40" value="<?php $db->sp("first_name"); ?>" class="inputbox" />
      </div>
    <br/><br/>
     
      <div style="float:left;width:30%;text-align:right;<?php if (stristr($missing,'last_name')) echo $missing_style ?>" >
      <?php echo "<label for=\"last_name\">".$VM_LANG->_PHPSHOP_SHOPPER_FORM_LAST_NAME."</label>*" ?>:</div>
      <div style="float:left;width:60%;"> 
        <input type="text" id="last_name" name="last_name" size="40" value="<?php $db->sp("last_name"); ?>" class="inputbox" />
      </div>
    <br/><br/>
     
      <div style="float:left;width:30%;text-align:right;">
        <?php echo "<label for=\"middle_name\">".$VM_LANG->_PHPSHOP_SHOPPER_FORM_MIDDLE_NAME."</label>"  ?>:</div>
      <div style="float:left;width:60%;"> 
        <input type="text" id="middle_name" name="middle_name" size="40" value="<?php $db->sp("middle_name"); ?>" class="inputbox" />
      </div>
      <br/><br/>
     
      <div style="float:left;width:30%;text-align:right;<?php if (stristr($missing,'address_1')) echo $missing_style ?>">
      <?php echo "<label for=\"address_1\">".$VM_LANG->_PHPSHOP_SHOPPER_FORM_ADDRESS_1."</label>*" ?>:</div>
      <div style="float:left;width:60%;"> 
        <input type="text" id="address_1" name="address_1" size="40" value="<?php $db->sp("address_1"); ?>" class="inputbox" />
      </div>
    <br/><br/>
     
      <div style="float:left;width:30%;text-align:right;" >
        <?php echo "<label for=\"address_2\">".$VM_LANG->_PHPSHOP_SHOPPER_FORM_ADDRESS_2."</label>" ?>:</div>
      <div style="float:left;width:60%;"> 
        <input type="text" id="address_2" name="address_2" size="40" value="<?php $db->sp("address_2"); ?>" class="inputbox" />
      </div>
    <br/><br/>
     
      <div style="float:left;width:30%;text-align:right;<?php if (stristr($missing,'city')) echo $missing_style ?>">
      <?php echo "<label for=\"city\">".$VM_LANG->_PHPSHOP_SHOPPER_FORM_CITY."</label>*" ?>:</div>
      <div style="float:left;width:60%;"> 
        <input type="text" id="city" name="city" size="40" value="<?php $db->sp("city"); ?>" class="inputbox" />
      </div>
    <br/><br/>
     
      <div style="float:left;width:30%;text-align:right;<?php if (stristr($missing,'zip')) echo $missing_style ?>">
      <?php echo "<label for=\"zip\">".$VM_LANG->_PHPSHOP_SHOPPER_FORM_ZIP."</label>*" ?>:</div>
      <div style="float:left;width:60%;"> 
        <input type="text" id="zip" name="zip" size="10" value="<?php $db->sp("zip"); ?>" class="inputbox" />
      </div>
    <br/><br/>
     
      <div style="float:left;width:30%;text-align:right;<?php if (stristr($missing,'country')) echo $missing_style ?>">
      <?php echo "<label for=\"country_field\">".$VM_LANG->_PHPSHOP_SHOPPER_FORM_COUNTRY."</label>*" ?>:</div>
      <div style="float:left;width:60%;">
        <?php $ps_html->list_country("country", $db->sf("country"), "id=\"country_field\" onchange=\"changeStateList();\"") ?>
      </div>
    <br/><br/>
    <?php 
    if (CAN_SELECT_STATES == '1') {
?>
      <div style="float:left;width:30%;text-align:right;<?php if (stristr($missing,'state')) echo $missing_style ?>">
      <?php echo "<label for=\"state\">".$VM_LANG->_PHPSHOP_SHOPPER_FORM_STATE."</label>" ?>:</div>
      <div style="float:left;width:60%;"> 
        <?php 
        
      echo $ps_html->dynamic_state_lists( "country", "state", $db->sf('country'), $db->sf('state') );
      echo "<noscript>\n";
      $ps_html->list_states("state", $db->sf('state'), "", "id=\"state\"");
      echo "</noscript>\n";
      ?>
      </div>
    <br/><br/>
    <?php } ?>
     
      <div style="float:left;width:30%;text-align:right;" >
        <?php echo "<label for=\"phone_1\">".$VM_LANG->_PHPSHOP_SHOPPER_FORM_PHONE."</label>*" ?>:</div>
      <div style="float:left;width:60%;"> 
        <input type="text" id="phone_1" name="phone_1" size="40" value="<?php $db->sp("phone_1"); ?>" class="inputbox" />
      </div>
    <br/><br/>
     
      <div style="float:left;width:30%;text-align:right;" >
        <?php echo "<label for=\"phone_2\">".$VM_LANG->_PHPSHOP_SHOPPER_FORM_PHONE2."</label>" ?>:</div>
      <div style="float:left;width:60%;"> 
        <input type="text" id="phone_2" name="phone_2" size="40" value="<?php $db->sp("phone_2"); ?>" class="inputbox" />
      </div>
    <br/><br/>
     
      <div style="float:left;width:30%;text-align:right;" >
        <?php echo "<label for=\"fax\">".$VM_LANG->_PHPSHOP_SHOPPER_FORM_FAX."</label>" ?>:</div>
      <div style="float:left;width:60%;"> 
        <input type="text" id="fax" name="fax" size="40" value="<?php $db->sp("fax"); ?>" class="inputbox" />
      </div>  
    <br/><br/>
    
    <!-- If you wish show a EXTRA FIELD only in shipping address (not in this form) add into condition "false && ".
         For example: if( false && $VM_LANG->_PHPSHOP_SHOPPER_FORM_EXTRA_FIELD_1 != "" ) -->
    <!-- EXTRA FIELD 1 - BEGIN - You can move this section into any other position of form. -->
    <?php if( $VM_LANG->_PHPSHOP_SHOPPER_FORM_EXTRA_FIELD_1 != "" ) { ?>
      <div style="float:left;width:30%;text-align:right;" >
        <?php echo "<label for=\"extra_field_1\">".$VM_LANG->_PHPSHOP_SHOPPER_FORM_EXTRA_FIELD_1."</label>" ?>:</div>
      <div style="float:left;width:60%;"> 
        <input type="text" id="extra_field_1" name="extra_field_1" size="40" value="<?php $db->sp("extra_field_1"); ?>" class="inputbox" />
      </div>
    <br/><br/>
    <?php } ?>
    <!-- EXTRA FIELD 1 - END -->
    
    <!-- EXTRA FIELD 2 - BEGIN - You can move this section into any other position of form. -->
    <?php if( $VM_LANG->_PHPSHOP_SHOPPER_FORM_EXTRA_FIELD_2 != "" ) { ?>
      <div style="float:left;width:30%;text-align:right;" >
        <?php echo "<label for=\"extra_field_2\">".$VM_LANG->_PHPSHOP_SHOPPER_FORM_EXTRA_FIELD_2."</label>" ?>:</div>
      <div style="float:left;width:60%;"> 
        <input type="text" id="extra_field_2" name="extra_field_2" size="40" value="<?php $db->sp("extra_field_2"); ?>" class="inputbox" />
      </div>
    <br/><br/>
    <?php } ?>
    <!-- EXTRA FIELD 2 - END -->
    
    <!-- EXTRA FIELD 3- BEGIN - You can move this section into any other position of form. -->
    <?php if( $VM_LANG->_PHPSHOP_SHOPPER_FORM_EXTRA_FIELD_3 != "" ) { ?>
      <div style="float:left;width:30%;text-align:right;" >
        <?php echo "<label for=\"extra_field_3\">".$VM_LANG->_PHPSHOP_SHOPPER_FORM_EXTRA_FIELD_3."</label>" ?>:</div>
      <div style="float:left;width:60%;"> 
        <input type="text" id="extra_field_3" name="extra_field_3" size="40" value="<?php $db->sp("extra_field_3"); ?>" class="inputbox" />
      </div>
    <br/><br/>
    <?php } ?>
    <!-- EXTRA FIELD 3 - END -->
    
    <!-- EXTRA FIELD 4 - BEGIN - You can move this section into any other position of form. -->
    <?php if( $VM_LANG->_PHPSHOP_SHOPPER_FORM_EXTRA_FIELD_4 != "" ) { ?>
      <div style="float:left;width:30%;text-align:right;" >
        <?php echo "<label for=\"extra_field_4\">".$VM_LANG->_PHPSHOP_SHOPPER_FORM_EXTRA_FIELD_4."</label>" ?>:</div>
      <div style="float:left;width:60%;"><?php $ps_html->list_extra_field_4($db->sf("extra_field_4"), "id=\"extra_field_4\""); ?></div>
    <br/><br/>
    <?php } ?>
    <!-- EXTRA FIELD 4 - END -->
    
    <!-- EXTRA FIELD 5 BEGIN - You can move this section into any other position of form. -->
    <?php if( $VM_LANG->_PHPSHOP_SHOPPER_FORM_EXTRA_FIELD_5 != "" ) { ?>
      <div style="float:left;width:30%;text-align:right;" >
        <?php echo "<label for=\"extra_field_5\">".$VM_LANG->_PHPSHOP_SHOPPER_FORM_EXTRA_FIELD_5."</label>" ?>:</div>
      <div style="float:left;width:60%;"><?php $ps_html->list_extra_field_5($db->sf("extra_field_5"), "id=\"extra_field_5\""); ?></div>
    <br/><br/>
    <?php } ?>
    <!-- EXTRA FIELD 5 - END -->
    
    <?php 
    if (LEAVE_BANK_DATA == '1') { 
      $selected[0] = $db->sf("bank_account_type")=="Checking" ? 'selected="selected"' : '';
      $selected[1] = $db->sp("bank_account_type")=="Business Checking" ? 'selected="selected"' : '';
      $selected[2] = $db->sp("bank_account_type")=="Savings" ? 'selected="selected"' : ''; ?>
        
      <fieldset>
        <legend class="sectiontableheader"><?php echo $VM_LANG->_PHPSHOP_ACCOUNT_BANK_TITLE ?></legend>
        <div style="float:left;width:30%;text-align:right;"><?php echo $VM_LANG->_PHPSHOP_ACCOUNT_LBL_BANK_ACCOUNT_HOLDER ?>:</div>
        <div style="float:left;width:60%;"><input type="text" class="inputbox" name="bank_account_holder" size="24" value="<?php $db->sp("bank_account_holder"); ?>" /></div>
    <br/><br/>
    
        <div style="float:left;width:30%;text-align:right;"><?php echo $VM_LANG->_PHPSHOP_ACCOUNT_LBL_BANK_ACCOUNT_NR ?>:</div>
        <div style="float:left;width:60%;"><input type="text" class="inputbox" name="bank_account_nr" size="24" value="<?php $db->sp("bank_account_nr"); ?>" /></div>
    <br/><br/>
    
        <div style="float:left;width:30%;text-align:right;"><?php echo $VM_LANG->_PHPSHOP_ACCOUNT_LBL_BANK_SORT_CODE ?>:</div>
        <div style="float:left;width:60%;"><input type="text" class="inputbox" name="bank_sort_code" size="24" value="<?php $db->sp("bank_sort_code");?>" /></div>
    <br/><br/>
    
        <div style="float:left;width:30%;text-align:right;"><?php echo $VM_LANG->_PHPSHOP_ACCOUNT_LBL_BANK_NAME ?>:</div>
        <div style="float:left;width:60%;"><input type="text" class="inputbox" name="bank_name" size="24" value="<?php $db->sp("bank_name"); ?>" /></div>
    <br/><br/>
    
        <div style="float:left;width:30%;text-align:right;"><?php echo $VM_LANG->_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE ?>:</div>
        <div style="float:left;width:60%;">
          <select class="inputbox" name="bank_account_type">
            <option <?php echo $selected[0] ?> value="Checking"><?php echo $VM_LANG->_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE_CHECKING ?></option>
            <option <?php echo $selected[1] ?> value="Business Checking"><?php echo $VM_LANG->_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE_BUSINESSCHECKING ?></option>
            <option <?php echo $selected[2] ?> value="Savings"><?php echo $VM_LANG->_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE_SAVINGS ?></option>
          </select>
        </div>  
        <div style="float:left;width:30%;text-align:right;"><?php echo $VM_LANG->_PHPSHOP_ACCOUNT_LBL_BANK_IBAN ?>:</div>
        <div style="float:left;width:60%;"><input type="text" class="inputbox" name="bank_iban" size="24" value="<?php $db->sp("bank_iban"); ?>" /></div>
      </fieldset>
      <?php 
    } 
?>
  <br/><br/>
    <div style="float:left;width:90%;text-align:center;"> 
        <span><input type="submit" class="button" name="submit" value="<?php echo _E_SAVE ?>" /></span>
        <span style="margin-left:10px;"><a href="<?php $sess->purl( SECUREURL."index.php?page=account.index") ?>" class="button"><?php echo _BACK ?></a></span>
    </div>

  </fieldset>
  </div>
</form>
