<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: account.shipping.php,v 1.7 2005/07/26 20:05:35 soeren_nb Exp $
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

if( isset($_VERSION)) {
 $mainframe->setPageTitle( $PHPSHOP_LANG->_PHPSHOP_USER_FORM_SHIPTO_LBL );
}

echo "<div><a href=\"".$sess->url( SECUREURL ."index.php?page=account.index")."\" title=\"".$PHPSHOP_LANG->_PHPSHOP_ACCOUNT_TITLE."\">"
      .$PHPSHOP_LANG->_PHPSHOP_ACCOUNT_TITLE."</a> -&gt; "
      .$PHPSHOP_LANG->_PHPSHOP_USER_FORM_SHIPTO_LBL."</div><br/>";
      
$q  = "SELECT * FROM #__pshop_user_info WHERE ";
$q .= "(address_type='ST' OR address_type='st') ";
$q .= "AND user_id='" . $auth["user_id"] . "'";
$db->query($q);
?>
<fieldset>
   <legend class="sectiontableheader"><?php echo $PHPSHOP_LANG->_PHPSHOP_USER_FORM_SHIPTO_LBL ?></legend>
   <br/><br/>
   <div><?php echo $PHPSHOP_LANG->_PHPSHOP_ACC_BILL_DEF; ?></div>
   <br/>
<?php
  while( $db->next_record() ) {
?>
   <div>
   -<a href="<?php $sess->purl(SECUREURL . "index.php?next_page=account.shipping&page=account.shipto&user_info_id=" . $db->f("user_info_id")); ?>">
   <?php echo $db->f("address_type_name"); ?></a>
   </div>
   <br/>
<?php
  }
?>
   <br/><br/>
   <div>
      <a class="button" href="<?php $sess->purl(SECUREURL . "index.php?page=account.shipto&next_page=account.shipping"); ?>"><? echo $PHPSHOP_LANG->_PHPSHOP_USER_FORM_ADD_SHIPTO_LBL ?></a>
   </div>
</fieldset>
<!-- Body ends here -->
