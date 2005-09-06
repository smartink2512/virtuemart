<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/** Changed Product Type - Begin */

/* $Id: shop.parameter_search.php,v 1.1 2005/05/02 19:48:16 soeren_nb Exp $
* 
* @package Mambo
* @Copyright (C) 2000 - 2003 Miro International Pty Ltd
* @ All rights reserved
* @ Mambo Open Source is Free Software
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @version $Revision: 1.1 $
*
* @sub-package mambo-phpShop
* 
* www.mambo-phpshop.net
*
Advanced Attributes search for phpShop
By Zdenek Dvorak (zdenek.dvorak@seznam.cz)
 */

?>
<h2><?php echo $PHPSHOP_LANG->_PHPSHOP_PARAMETER_SEARCH ?></h2>

<table width="100%" border="0" cellpadding="2" cellspacing="0">
<tr>
	<td><?php echo $PHPSHOP_LANG->_PHPSHOP_PARAMETER_SEARCH_TEXT1 ?></td>
</tr>
<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>
		<table width="100%" border="0" cellpadding="2" cellspacing="0">
<?php
	$q  = "SELECT * FROM #__pshop_product_type ";
	$q .= "WHERE product_type_publish='Y' ";
	$q .= "ORDER BY product_type_list_order";
	$db->query($q);
	while ($db->next_record()) {
		echo "<tr><td>";
		echo "<a href=\"".URL."index.php?option=com_phpshop&page=shop.parameter_search_form&product_type_id=".$db->f("product_type_id")."&Itemid=".$_REQUEST['Itemid']."\">";
		echo $db->f("product_type_name");
		echo "</a></td>\n<td>";
		echo $db->f("product_type_description");
		echo "</td></tr>";
	}
	echo "</table>\n";
	
	if ($db->num_rows() == 0) {
		echo $PHPSHOP_LANG->_PHPSHOP_PARAMETER_SEARCH_NO_PRODUCT_TYPE;
	}
?>
	</td>
</tr>
</table>
<!-- /** Changed Product Type - End */ -->

