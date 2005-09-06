<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: product.product_category_list.php,v 1.4 2005/03/23 07:09:30 soeren_nb Exp $
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
<form name="adminForm" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    <input type="hidden" name="option" value="com_phpshop" />
    <input type="hidden" name="page" value="product.product_category_list" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="func" value="reorder" />
    <input type="hidden" name="boxchecked" value="" />

<img src="<?php echo IMAGEURL ?>ps_image/categories.gif" border="0" />
<span class="sectionname"><?php echo $PHPSHOP_LANG->_PHPSHOP_CATEGORY_LIST_LBL ?></span>
<br /><br />

<table class="adminlist" width="100%" border="0">
    <tr>
        <th width="5%">#</th>
        <th width="25%"><?php echo $PHPSHOP_LANG->_PHPSHOP_CATEGORY_FORM_NAME ?></th>
        <th width="30%"><?php echo $PHPSHOP_LANG->_PHPSHOP_CATEGORY_FORM_DESCRIPTION ?></th>
        <th width="25%"><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCTS_LBL ?></th>
        <th width="5%"><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_LIST_PUBLISH ?>?</th>
        <th width="5%"><?php echo $PHPSHOP_LANG->_PHPSHOP_MODULE_LIST_ORDER ?></th>
        <th width="5%"><?php echo _E_REMOVE ?></th>
    </tr><?php 

    $ps_product_category->traverse_tree_down("maintext");

?>
</table>
</form>
