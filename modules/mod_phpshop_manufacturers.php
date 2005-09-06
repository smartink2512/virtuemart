<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
* Manufacturer Module
*
* NOTE: THIS MODULE REQUIRES THE MAMBO-PHPSHOP COMPONENT!
/*
* @version $Id: mod_phpshop_manufacturers.php,v 1.4 2005/09/04 20:09:34 soeren_nb Exp $
* @package mambo-phpShop
* @subpackage modules
*
* @copyright (C) 2004-2005 Soeren Eberhardt
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
*
* www.mambo-phpshop.net
*/

global $mosConfig_absolute_path;

$text_before = $params->get( 'text_before', '');
$show_dropdown = $params->get( 'show_dropdown', 1);
$show_linklist = $params->get( 'show_linklist', 1);
$auto = $params->get( 'auto', 0);

$category_id = mosGetParam( $_REQUEST, 'category_id', '' );

// the configuration file for PHPShop
require_once( $mosConfig_absolute_path."/components/com_phpshop/phpshop_parser.php");
$sess = new ps_session;

$query  = "SELECT distinct a.manufacturer_id,a.mf_name FROM #__pshop_manufacturer AS a ";
if ($auto == 1 && !empty( $category_id ) ) {
    $query .= ", #__pshop_product_category_xref AS d, "
    . " #__pshop_product AS b, "
    . " #__pshop_product_mf_xref AS c "
    . " WHERE d.category_id='$category_id'"
    . " AND d.product_id = b.product_id "
    . " AND b.product_id = c.product_id AND c.manufacturer_id = a.manufacturer_id ";
}
$query .= "ORDER BY mf_name ASC";
  
$database->setQuery( $query );
$database->query();
$res = $database->loadObjectList();
    
?>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">

<table cellpadding="1" cellspacing="1" border="0" width="80%">

<?php if( $show_linklist == 1 ) { ?>
  <!--BEGIN manufacturer DropDown List --> 
  <tr> 
    <td colspan="2">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td><?php echo $text_before ?></td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <?php foreach( $res as $manufacturer) { ?>
            <tr>
                <td><a href="<?php echo $sess->url( URL."index.php?option=com_phpshop&page=shop.browse&manufacturer_id=". $manufacturer->manufacturer_id ) ?>">
                    <?php echo $manufacturer->mf_name; ?>
                    </a>
                </td>
            </tr>
        <?php } ?>
      </table>
    </td>
  </tr>
<?php 
}
if( $show_dropdown == 1 ) { ?>
  <tr> 
    <td colspan="2"> 
        <input type="hidden" name="option" value="com_phpshop" />
        <input type="hidden" name="page" value="shop.browse" />
        <br/>
        <select class="inputbox" name="manufacturer_id">
            <option value=""><?php echo _CMN_SELECT ?></option>
        <?php  
	foreach ($res as $manufacturer) { ?>
            <option value="<?php echo $manufacturer->manufacturer_id ?>"><?php echo $manufacturer->mf_name ?></option>
          <?php 
	} ?>
        </select>
    </td>
  </tr>
  <tr>
      <td>
          <input class="button" type="submit" name="manufacturerSearch" value="<?php echo _SEARCH_TITLE ?>" />
      </td>
  </tr>
<?php 
} 
?>
<!-- End Manufacturer Module --> 
</table>
</form>