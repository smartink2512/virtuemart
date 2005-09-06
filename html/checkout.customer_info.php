<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: checkout.customer_info.php,v 1.7 2005/06/18 09:01:18 soeren_nb Exp $
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
/*
* This file show the customer information in a table
* while checking out
*/
$db = new ps_DB;
$q  = "SELECT * from #__users WHERE ";
$q .= "id='" . $auth["user_id"] . "' ";
$q .= "AND address_type='BT'";
$db->query($q);
$db->next_record(); ?>

<!-- Customer Information --> 
    <table border="0" cellspacing="0" cellpadding="2" width="100%">
        <tr class="sectiontableheader">
            <th colspan="2" align="left"><?php echo $PHPSHOP_LANG->_PHPSHOP_ORDER_PRINT_CUST_BILLING_LBL ?></th>
        </tr>
        <tr>
           <td nowrap="nowrap" width="10%" align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_ORDER_PRINT_COMPANY ?>: </td>
           <td width="90%">
           <?php
             $db->p("company");
           ?>
           </td>
        </tr>
        <tr>
           <td nowrap="nowrap" width="10%" align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_SHOPPER_LIST_NAME ?>: </td>
           <td width="90%"><?php
             echo $db->f("first_name"). " " . $db->f("middle_name") ." " . $db->f("last_name"); ?>
           </td>
        </tr>
        <tr>
           <td nowrap="nowrap" width="10%" align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_ADDRESS ?>: </td>
           <td width="90%">
           <?php
             $db->p("address_1");
             echo "<br />";
             $db->p("address_2");
           ?>
           </td>
        </tr>
        <tr>
           <td nowrap="nowrap" width="10%" align="right">&nbsp;</td>
           <td width="90%">
           <?php
             $db->p("city");
             echo ",";
             $db->p("state");
             echo " ";
             $db->p("zip");
             echo "<br /> ";
             $db->p("country");
           ?>
           </td>
        </tr>
        <tr>
           <td nowrap="nowrap" width="10%" align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_ORDER_PRINT_PHONE ?>: </td>
           <td width="90%">
           <?php
             $db->p("phone_1");
           ?>
           </td>
        </tr>
        <tr>
           <td nowrap="nowrap"width="10%" align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_ORDER_PRINT_FAX ?>: </td>
           <td width="90%">
           <?php
             $db->p("fax");
           ?>
           </td>
        </tr>
        <tr>
           <td nowrap="nowrap" width="10%" align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_ORDER_PRINT_EMAIL ?>: </td>
           <td width="90%">
           <?php
             $db->p("email");
           ?>
           </td>
        </tr>
        <tr><td align="center" colspan="2"><a href="<?php $sess->purl( SECUREURL ."index.php?page=account.billing&next_page=$page"); ?>">
            (<?php echo $PHPSHOP_LANG->_PHPSHOP_UDATE_ADDRESS ?>)</a>
            </td>
        </tr>
    </table>
    <!-- customer information ends -->
    <br />
