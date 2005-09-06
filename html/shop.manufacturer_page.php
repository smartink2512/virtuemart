<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: shop.manufacturer_page.php,v 1.4 2005/01/30 21:50:08 soeren_nb Exp $
* @package mambo-phpShop
* @subpackage HTML
* @copyright (C) 2004-2005 Soeren Eberhardt
*
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
*
* www.mambo-phpshop.net
*/
mm_showMyFileName( __FILE__ );

$manufacturer_id = intval( mosGetParam( $_GET, 'manufacturer_id' ));

if( !empty( $manufacturer_id ) ) {
  $q  = "SELECT mf_name,mf_email,mf_desc,mf_url FROM #__pshop_manufacturer WHERE ";
  $q .= "manufacturer_id='$manufacturer_id'";
  $db->query($q);
  $db->next_record();
  
	$mf_name=$db->f("mf_name"); 
  $mf_email=$db->f("mf_email");
  $mf_desc=$db->f("mf_desc");
	$mf_url = $db->f("mf_url");  
  
  ?><h3><?php echo $mf_name;?></h3>
  
  <table align="center"cellspacing="0" cellpadding="0" border="0">
      <tr valign="top"> 
        <th colspan="2" align="center"class="sectiontableheader">
          <strong><? echo $PHPSHOP_LANG->_PHPSHOP_MANUFACTURER_FORM_INFO_LBL ?></strong>
        </th>
      </tr>
      <tr valign="top">
        <td align="center"colspan="2"><br />
          <?php echo "&nbsp;" . $mf_name . "<br />"; ?>
          <br /><br />
        </td>
      </tr>
  
      <tr>
        <td valign="top" align="center"colspan="2">
            <br /><? echo $PHPSHOP_LANG->_PHPSHOP_STORE_FORM_EMAIL ?>:&nbsp;
            <a href="mailto:<?php echo $mf_email; ?>"><?php echo $mf_email; ?></a>
            <br />
            <br /><a href="<? echo $mf_url ?>" target="_blank"><? echo $mf_url ?></a><br />
        </td>
      </tr>
      <tr>
        <td valign="top" align="left" colspan="2">
            <br /><? echo $mf_desc ?><br />
        </td>
      </tr>
    
  </table>
  <?php
}
?>
