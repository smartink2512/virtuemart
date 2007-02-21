<?php
/**
* VirtueMart Show-Product-Snapshop Mambot
*
* @version $Id$
* @package VirtueMart
* @subpackage mambots
*
* @copyright (C) 2004-2007 Soeren Eberhardt
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*
* VirtueMart is Free Software.
* VirtueMart comes with absolute no warranty.
*
* http://virtuemart.net
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/**
* VirtueMart Show-Product-Snapshop Mambot
*
* <b>Usage:</b>
* <code>{product_snapshot:id=XX,showprice,showdesc,showaddtocart,container_align,container_width,container_margin,container_padding,text_align,image_align,vspace,hspace,border_width,border_color,border_style}</code>
* int id (product_id)
* boolean showprice (show the product price?)
* boolean showdesc (show the product short description?)
* boolean showaddtocart (show an "Add-to-cart" link?)
* string align (defines the align of the table with the product snapshot)
*/

$_MAMBOTS->registerFunction( 'onPrepareContent', 'mosProductSnapshotPlugin_onPrepareContent' );


function mosProductSnapshotPlugin_onPrepareContent( $published, &$row, &$params, $page=0  ) {
	global $ps_product, $mosConfig_absolute_path;

	require_once( $mosConfig_absolute_path . "/components/com_virtuemart/virtuemart_parser.php" );
	include_class("product");

	$pshop_productsnap_entrytext = $row->text;
	$pshop_productsnap_matches = array();
	if (preg_match_all("/{product_snapshot:id=.+?}/", $pshop_productsnap_entrytext, $pshop_productsnap_matches, PREG_PATTERN_ORDER) > 0) {

		foreach ($pshop_productsnap_matches[0] as $pshop_productsnap_match) {
			$pshop_productsnap_output = "";
			$pshop_productsnap_match = str_replace("{product_snapshot:id=", "", $pshop_productsnap_match);
			$pshop_productsnap_match = str_replace("}", "", $pshop_productsnap_match);

			// Get Bot Parameters
			$productsnap_params = array();
			$productsnap_params = explode(",", $pshop_productsnap_match);

			// Assign Bot Parameters
			$id = $productsnap_params[0];
			if( !empty( $id )) {
				$showsnapshot = return_snapshot( $productsnap_params );
			}
			else {
				$showsnapshot = 'Error: '.__FUNCTION__.' received no product ID<br/>';
			}
			$pshop_productsnap_entrytext = preg_replace("/{product_snapshot:id=.+?}/", $showsnapshot, $pshop_productsnap_entrytext, 1);
		}
		$row->text = $pshop_productsnap_entrytext;

	}
}

/**************************************************************************
** name: return_snapshot($product_id)
** created by: soeren
** description: return the html code to show a snapshot of a
**               product based on the product id.
** parameters: int product_id
** returns: $html code
***************************************************************************/
function return_snapshot($productsnap_params) {

	global  $sess,$VM_LANG, $mosConfig_absolute_path, $ps_product;
	$ps_vendor_id = $_SESSION["ps_vendor_id"];
	$auth = $_SESSION["auth"];
	$db = new ps_DB;
	$html = "";
	// Pick up the Paramters from the productsnap tag
	$product_id = $productsnap_params[0];
	$showprice = @$productsnap_params[1]=='true' ? true : false;
	$showdesc = @$productsnap_params[2]=='true' ? true : false;
	$showaddtocart = @$productsnap_params[3]=='true' ? true : false;
	$container_align  = mosGetParam( $productsnap_params, 4, 'none' );
	$container_width = (int)mosGetParam( $productsnap_params, 5, 150 );
	$container_margin = (int)mosGetParam( $productsnap_params, 6, 2 );
	$container_padding = (int)mosGetParam( $productsnap_params, 7, 2 );
	$text_align = mosGetParam( $productsnap_params, 8, 'left' );
	$image_align = mosGetParam( $productsnap_params, 9, '' );
	$vspace = (int)mosGetParam( $productsnap_params, 10, 5 );
	$hspace = (int)mosGetParam( $productsnap_params, 11, 5 );
	$border_width = (int)mosGetParam( $productsnap_params, 12, '' );
	$border_color = mosGetParam( $productsnap_params, 13, 'black' );
	$border_style = mosGetParam( $productsnap_params, 14, 'solid' );
	
	$q = "SELECT product_name,product_id,product_parent_id,product_thumb_image,product_s_desc
			FROM #__{vm}_product WHERE product_id=$product_id ";
	$db->setQuery($q); $db->query();

	if ($db->next_record()) {
		$style = 'float:'.$container_align.';';
		$style .= 'width:'.$container_width.'px;';
		$style .= 'margin:'.$container_margin.'px;';
		$style .= 'padding:'.$container_padding.'px;';
		$style .= 'text-align:'.$text_align.';';
		if( $border_width > 0 ) {
			$style .= 'border-width:'.$border_width.'px;';
			$style .= 'border-style:'.$border_style.';';
			$style .= 'border-color:'.$border_color.';';
		}
		$html .= "<div style=\"$style\">\n";

		$html .= "<div style=\"font-weight: bold;\">".$db->f("product_name")."</div>\n";

		$url = "index.php?page=".$ps_product->get_flypage($db->f("product_id"));
		if ($db->f("product_parent_id")) {
			$url = "index.php?page=shop.product_details&amp;flypage=".$ps_product->get_flypage($db->f("product_parent_id"));
			$url .= "&amp;product_id=" . $db->f("product_parent_id");
		}
		else {
			$url = "index.php?page=shop.product_details&amp;flypage=".$ps_product->get_flypage($db->f("product_id"));
			$url .= "&amp;product_id=" . $db->f("product_id");
		}

		$html .= "<div style=\"font-weight: bold;\">
					<a title=\"".$db->f("product_name")."\" href=\"". $sess->url(URL . $url)."\">";
		$html .= $ps_product->image_tag( $db->f("product_thumb_image"), "alt=\"".$db->f("product_name")."\" hspace=\"$hspace\" vspace=\"$vspace\" align=\"$image_align\"" );

		$html .= "</a></div>\n";

		if ($showdesc) {
			$html .= "<span>".$db->f("product_s_desc")."</span>\n";
		}

		if ($showprice)
		$html .= "<div style=\"font-weight: bold;\">".$VM_LANG->_PHPSHOP_CART_PRICE .": ".str_replace( "$", "\\$", $ps_product->show_price($db->f("product_id")))."</div>\n";

		if ($showaddtocart) {
			$html .= "<div>";
			$url = "index.php?page=shop.cart&func=cartAdd&product_id=" .  $db->f("product_id");
			$html .= "<a href=\"". $sess->url(URL . $url)."\">&gt; ".$VM_LANG->_PHPSHOP_CART_ADD_TO." &lt;</a></div>\n";
		}
		$html .= "</div>\n";
		return( $html );
	}

	else {
		// product_id not found
		return("");
	}
}
?>
