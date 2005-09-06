<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: affiliate.affiliate_form.php,v 1.4 2005/01/27 19:34:00 soeren_nb Exp $
* @package mambo-phpShop
* @subpackage HTML
* Contains code from PHPShop(tm):
* 	@copyright (C) 2000 - 2004 Edikon Corporation (www.edikon.com)
*	Community: www.phpshop.org, forums.phpshop.org
* Conversion to Mambo and the rest:
* 	@copyright (C) 2004-2005 Soeren Eberhardt
*
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
*
* www.mambo-phpshop.net
*/
mm_showMyFileName( __FILE__ );
?>
<h2><?php echo $PHPSHOP_LANG->_PHPSHOP_AFFILIATE_LIST_LBL ?></h2>

<?php
$affiliate_id = mosgetparam( $_REQUEST, 'affiliate_id' );

if (!empty($affiliate_id)) {
  $q = "SELECT * FROM #__pshop_affiliate,#__users ";
  $q .="WHERE affiliate_id='$affiliate_id'";
  //$q .= " AND user_info_id = id ";
  $db->query($q);  
  $db->next_record();
} 

?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" name="adminForm" enctype="multipart/form-data">
  <input type="hidden" name="func" value="<?php echo isset($affiliate_id) ? "affiliateUpdate" : "";  ?>" />
  <input type="hidden" name="page" value="<?php echo $modulename ?>.affiliate_list" />
  <input type="hidden" name="option" value="com_phpshop" />
  <input type="hidden" name="task" value="" />
  <?php $limitstart = mosgetparam( $_REQUEST, 'limitstart'); ?>
  <input type="hidden" name="limitstart" value="<?php echo $limitstart ?>" />
  <input type="hidden" name="affiliate_id" value="<?php $db->sp("affiliate_id") ?>" />
  <table width="80%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr> 
      <td width="30%"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_SHOPPER_FORM_ADDRESS_INFO_LBL ?></strong></td>
      <td width="70%">&nbsp;</td>
    </tr>
    <tr> 
      <td align="right" width="30%" height="20"><?php echo $PHPSHOP_LANG->_PHPSHOP_SHOPPER_FORM_COMPANY_NAME ?>:</td>
      <td width="70%" height="20"> 
        <?php echo $db->f("company") ? $db->f("company") : "N/A" ?>
      </td>
    </tr>
    <tr> 
     <td align="right" width="30%" height="20" ><?php echo $PHPSHOP_LANG->_PHPSHOP_AFFILIATE_FORM_ACTIVE ?>:</td>
      <td width="70%" height="20" >
        <input type = "checkbox" name ="active" <?php if($db->f("active") =='Y') echo "checked"; else echo "unchecked"; ?>>
      </td>
    </tr>
    <tr> 
      <td align="right" width="30%" height="20" ><?php echo $PHPSHOP_LANG->_PHPSHOP_AFFILIATE_FORM_RATE ?>:</td>
      <td width="70%" height="20" >
        <input type = "text" name ="rate" <?php echo($db->f("rate"))?> size="2" maxlength="2" value="<?php $db->p("rate"); ?>">
      </td>
    </tr>
    <tr> 
      <td align="right" width="30%" height="20" ><?php echo $PHPSHOP_LANG->_PHPSHOP_USER_FORM_EMAIL ?>:</td>
      <td width="70%" height="20">
        <a href = "mailto:<?php $db->sp("email")?>"><?php $db->p("email")?></a>
      </td>
    </tr>
    <tr> 
      <td align="right" width="30%" height="20" >&nbsp;</td>
      <td width="70%" height="20">&nbsp;</td>
    </tr>
  </table>

</form>

