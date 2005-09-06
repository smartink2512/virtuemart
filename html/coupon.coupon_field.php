<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: coupon.coupon_field.php,v 1.3 2005/04/25 06:12:34 soeren_nb Exp $
* @package mambo-phpShop
* @subpackage HTML
* @author Erich Vinson
* @copyright (C) 2004 by Erich Vinson
* The author would like to thank Digitally Imported (www.di.fm) for good music to code to
*
* @author Soeren Eberhardt
* @copyright (C) 2004-2005 Soeren Eberhardt
*
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
*
* www.mambo-phpshop.net
*/
mm_showMyFileName( __FILE__ );

echo "<table width=\"100%\"><tr class=\"sectiontableentry1\"><td width=\"100%\">";

if (@$_SESSION['invalid_coupon'] == true) { 
  echo "<strong>" . $PHPSHOP_LANG->_PHPSHOP_COUPON_CODE_INVALID . "</strong><br/>"; 
}
if( !empty($_REQUEST['coupon_error']) ) {
 echo $_REQUEST['coupon_error']."<br/>";
}
echo $PHPSHOP_LANG->_PHPSHOP_COUPON_ENTER_HERE . "<br/>
    <form action=\"".$_SERVER['PHP_SELF'] . "\" method=\"post\">
		<input type=\"text\" name=\"coupon_code\" width=\"10\" maxlength=\"30\" class=\"inputbox\" />
		<input type=\"hidden\" name=\"Itemid\" value=\"".@$_REQUEST['Itemid']."\" />
		<input type=\"hidden\" name=\"do_coupon\" value=\"yes\" />
		<input type=\"hidden\" name=\"option\" value=\"com_phpshop\" />
		<input type=\"hidden\" name=\"page\" value=\"".$page."\" />
		<input type=\"submit\" value=\"" . $PHPSHOP_LANG->_PHPSHOP_COUPON_SUBMIT_BUTTON . "\" class=\"button\" />
		</form>
	</td>
</tr></table>";
	

?>
