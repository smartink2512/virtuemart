<?php
/**
* mambo-phpShop Show-Product-Snapshop Mambot XTD
*
* @version $Id: mosproductsnap_xtd.php 431 2006-10-17 21:55:46 +0200 (Di, 17 Okt 2006) soeren_nb $
* @package mambo-phpShop
* @subpackage mambots
*
* @copyright (C) 2004-2005 Soeren Eberhardt
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
*
* www.mambo-phpshop.net
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
* mambo-phpShop Show-Product-Snapshop Mambot
*
* <b>Usage:</b>
* <code>{product_snapshot:id=XX,showname=y,showprice=n,showdesc=n,showaddtocart=y,displayeach=h,displaylist=v,width=90%,border=0,style=color:black;,align=left}</code>
* string sku (product_sku) for more than one, separate with vertical bar
* string showname (show the product name? y or n)
* string showprice (show the product price? y or n)
* string showdesc (show the product short description? y or n)
* string quantity (the quantity to add to cart. Separate with vertical bar when there's more than one product eg 1|2|1)
* string showaddtocart (show an "Add-to-cart" link? y or n)
* string displayeach (the horizontal or vertical orientation of the product attributes. h or v)
* string displaylist (the horizontal or vertical orientation of the products.
                       It only applies when there is more than one sku. h or v)
* string width (The width of the Table element)
* string border (The value of the Border attribute of the Table element)
* string style (the value for the style attribute of the Table element)
* string string align (defines the align of the table with the product snapshot)
*/
$_MAMBOTS->registerFunction( 'onPrepareContent', 'botProductSnap' );

global $ps_product;
//require_once( "$mosConfig_absolute_path/includes/mosproductsnapinc.php");
require_once( "$mosConfig_absolute_path/components/com_phpshop/phpshop_parser.php" );
include_class("product");

function botProductSnap( $published, &$row) {

	global $mosConfig_absolute_path, $mosConfig_live_site, $database;
	
	if (!$published) {
	    $row->text	 	= preg_replace("/{product_snapshot:.+?}/", '', $row->text);
	    return true;
	}
	
	/* load mosproductsnap info*/
	$query = "SELECT id FROM #__mambots WHERE element = 'mosproductsnap_xtd' AND folder = 'content'";
	$database->setQuery( $query );
	$id = $database->loadResult();
	$mambot = new mosMambot( $database );
	$mambot->load( $id );
	$bot_params =& new mosParameters( $mambot->params );

	$param_defaults = array(
						'id' => '0',
						'showname' => 'n',
						'showimage' => 'n',
						'showdesc' => 'n',
						'showprice' => 'n',
						'quantity' => '1',
						'showaddtocart' => 'n',
						'displaylist' => 'v',
						'displayeach' => 'h',
						'width' => '100',
						'border' => '0',
						'style' => '',
						'align' => ''
						);
	// get settings from admin mambot parameters
	foreach ($param_defaults as $key => $value) {
		$param_defaults[$key] = $bot_params->get( $key, $value );
	}
	
	$pshop_productsnap_entrytext = $row->text;
	$pshop_productsnap_matches = array();
	if (preg_match_all("/{product_snapshot:id=.+?}/", $pshop_productsnap_entrytext, $pshop_productsnap_matches, PREG_PATTERN_ORDER) > 0) {
		foreach ($pshop_productsnap_matches[0] as $pshop_productsnap_match) {
			$pshop_productsnap_output = "";
			$pshop_productsnap_match = str_replace("{product_snapshot:", "", $pshop_productsnap_match);
			$pshop_productsnap_match = str_replace("}", "", $pshop_productsnap_match);
		
		// Get Bot Parameters
			$pshop_productsnap_params = get_prodsnap_params($pshop_productsnap_match,$param_defaults);
		// Get the html
			$showsnapshot = return_snapshot($pshop_productsnap_params);
	
			$pshop_productsnap_entrytext = preg_replace("/{product_snapshot:.+?}/", $showsnapshot, $pshop_productsnap_entrytext, 1);
		}
		$row->text = $pshop_productsnap_entrytext;
	
	}
	return true;
}
/***************************************************************************\
   ** name: get_prodsnap_params($pshop_productsnap_match,$param_defaults)
   ** created by: mike howard
   ** description: compare and return parameters for product snap shot.
   ** parameters: string pshop_productsnap_match, array param_defaults
   ** returns: $html code
\***************************************************************************/
function get_prodsnap_params($pshop_productsnap_match,$param_defaults) {
	$params = explode(",",$pshop_productsnap_match);
	foreach ($params as $param) {
		$param = explode("=",$param);
		if (isset($param_defaults[$param[0]])){
			$param_defaults[$param[0]] = $param[1];
		}
	}
	$param_defaults['id'] = "'".str_replace("|","','",$param_defaults['id'])."'";
	$param_defaults['quantity'] = explode("|",$param_defaults['quantity']);
	return $param_defaults;
}

/**************************************************************************
   ** name: return_snapshot($product_id)
   ** created by:
   ** description: return the html code to show a snapshot of a 
   **               product based on the product id.
   ** parameters: int product_id
   ** returns: array of parameters
   ***************************************************************************/
  function return_snapshot($params) {
  
    global  $sess,$PHPSHOP_LANG, $mosConfig_live_site, $ps_product;
    
    $ps_vendor_id = $_SESSION["ps_vendor_id"];
    $db = new ps_DB;
    $html = "";
	
    $q = "SELECT DISTINCT product_name,product_id,product_parent_id,product_thumb_image,product_s_desc FROM #__pshop_product WHERE product_id IN ({$params['id']})";
    $db->setQuery($q); $db->query();
	
	$product_count = $db->num_rows();
    if ($product_count > 0) {
		$html .= "<table class=\"productsnap\" width=\"{$params['width']}\" border=\"{$params['border']}\" style=\"{$params['style']}\" ";
		$html .= !empty($params['align']) ? "align=\"{$params['align']}\">" : ">";
		$html .= "\n";
		
		// set up how the rows and columns are displayed
		if ('v' == $params['displayeach']) {
			$row_sep_top = "<tr>\n";
			$row_sep_btm = "</tr>\n";
		} else {
			$row_sep_top = "";
			$row_sep_btm = "";
		}
		
		if ('h' == $params['displaylist']) {
			$start = "<tr>\n";
			$end = "</tr>\n";
		} else {
			$start = "";
			$end = "";
		}

		if ('h' == $params['displaylist'] && 'v' == $params['displayeach']) {
			$prod_top = "<td valign=\"top\"><table>\n";	
			$prod_btm = "</table></td>\n";
		} else if ($params['displaylist'] == $params['displayeach']) {
			$prod_top = "";
			$prod_btm = "";
		} else {
			$prod_top = "<tr>\n";	
			$prod_btm = "</tr>\n";
		}
		/*
		eg of display
		list h, each h
		-- prod_sep_top "" -- prod_sep_btm "" -- start = "<tr>" -- end = "</tr>" -- row_sep_top = "<td>" -- row_sep_btm = "</td>"
		<table><tr><td>name</td><td>image</td><td>name</td><td>image</td></tr></table>
		list h, each v
		-- prod_sep_top "<td><table>" -- prod_sep_btm "</table></td>" -- start = "<tr>" -- end = "</tr>" -- row_sep_top = "<tr><td>" -- row_sep_btm = "</td></tr>"
		<table><tr><td><table><tr><td>name</td></tr><tr><td>image</td></tr></table></td><td><table><tr><td>name</td></tr><tr><td>image</td></tr></table></td></tr></table>
		list v, each h
		-- prod_sep_top "<tr>" -- prod_sep_btm "</tr>" -- start = "" -- end = "" -- row_sep_top = "<td>" -- row_sep_btm = "</td>"
		<table><tr><td>name</td><td>image</td></tr><tr><td>name</td><td>image</td></tr></table>
		list v, each v
		-- prod_sep_top "" -- prod_sep_btm "" -- start = "" -- end = "" -- row_sep_top = "<tr><td>" -- row_sep_btm = "</td></tr>"
		<table><tr><td>name</td></tr><tr><td>image</td></tr><tr><td>name</td></tr><tr><td>image</td></tr></table>
		*/
		$i = 0;
		$html .= $start;
		while ($db->next_record()) {
		  $html .= $prod_top;
		  if ('y' == $params['showname']) {
			  $html .= $row_sep_top;
			  $html .= "<td class=\"product_name\" align=\"center\">".$db->f("product_name")."</td>\n";
			  $html .= $row_sep_btm;
		  }
		  if ('y' == $params['showimage']) {
			  $html .= $row_sep_top;
			  $url = "index.php?page=".$ps_product->get_flypage($db->f("product_id"));
			  if ($db->f("product_parent_id")) {
				  $url = "index.php?page=".$ps_product->get_flypage($db->f("product_parent_id"));
				  $url .= "&product_id=" . $db->f("product_parent_id");
			  } 
			  else {
				  $url = "index.php?page=".$ps_product->get_flypage($db->f("product_id"));
				  $url .= "&product_id=" . $db->f("product_id");
			  }
			  $html .= "<td class=\"image\" align=\"center\"><a href=\"". $sess->url(URL . $url)."\">";
			  $html .= "<img alt=\"".$db->f("product_name")."\" hspace=\"7\" src=\"".IMAGEURL."/product/".$db->f("product_thumb_image")."\" width=\"90\" border=\"0\" />";
			  $html .= "</a></td>\n";
			  $html .= $row_sep_btm;
		  }
		  if ('y' == $params['showdesc']){
			  $html .= $row_sep_top;
			  $html .= "<td class=\"desc\">".$db->f("product_s_desc")."</td>\n";
			  $html .= $row_sep_btm;
		  }
		  if ('y' == $params['showprice']) {
			  $html .= $row_sep_top;
			  //$html .= "<td class=\"price\">".$PHPSHOP_LANG->_PHPSHOP_CART_PRICE .": ". number_format($price["product_price"],2) . " " . $price["product_currency"]."</td>\n";
			  $html .= "<td class=\"price\">".str_replace( "$", "\\$", $ps_product->show_price($db->f("product_id")))."</td>\n";		  
			  $html .= $row_sep_btm;
		  }
		  if ('y' == $params['showaddtocart']) {
			  if (@$params['quantity'][$i] > 1) {
		      	$qty = $params['quantity'][$i];
			  } else {
			    $qty = 1;
			  }
			  $html .= $row_sep_top;
			  $html .= "<td class=\"addtocart\">";
			  $url = "index.php?page=shop.cart&func=cartAdd&quantity=$qty&product_id=" .  $db->f("product_id");
			  $html .= "<a href=\"". $sess->url(URL . $url)."\"> ".$PHPSHOP_LANG->_PHPSHOP_CART_ADD_TO;
			  if (@$params['quantity'][$i] > 1) {
				  $html .= " x$qty";
			  }
			  $html .= "</a><br />\n</td>";
			  $html .= $row_sep_btm;
		  }
		  $html .= $prod_btm;
		  $i ++;
		}
		$html .= $end;
		$html .= "</table>";
		return( $html );
    } else {
      print 'Product not found';
      return("");
    }
}

?>
