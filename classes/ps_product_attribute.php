<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
*
* @version $Id$
* @package VirtueMart
* @subpackage classes
* @copyright Copyright (C) 2004-2005 Soeren Eberhardt. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/


/**
 * The class is is used to manage the product attributes.
 *
 */
class ps_product_attribute {
	var $classname = "ps_product_attribute";

	/**
	 * Validates that all variables for adding, updating an attribute
	 * are correct
	 *
	 * @param array $d
	 * @return boolean True when successful, false when not
	 */
	function validate(&$d) {
		global $vmLogger;
		$valid = true;
		if ($d["attribute_name"] == "") {
			$vmLogger->err( "An attribute name must be entered." );
			$valid = false;
		}
		elseif ($d["old_attribute_name"] != $d["attribute_name"]) {
			$db = new ps_DB;
			$q  = "SELECT attribute_name FROM #__{vm}_product_attribute_sku ";
			$q .= "WHERE attribute_name = '" . $d["attribute_name"] . "'";
			$q .= "AND product_id = '" . $d["product_id"] . "'";
			$db->setQuery($q);  $db->query();
			if ($db->next_record()) {
				$vmLogger->err( "A unique attribute name must be entered." );
				$valid = false;
			}
		}
		foreach ($d as $key => $value) {
			if (!is_array($value))
			$d[$key] = addslashes($value);
		}
		return $valid;
	}

	/**
	 * Validates all variables for deleting an attribute
	 *
	 * @param array $d
	 * @return boolean True when successful, false when not
	 */
	function validate_delete(&$d) {
		global $vmLogger;
		require_once(CLASSPATH. 'ps_product.php' );

		$ps_product = new ps_product;

		$db = new ps_DB;
		$q  = "SELECT product_id FROM #__{vm}_product_attribute_sku WHERE product_id = '" . $d["product_id"] . "' ";
		$db->setQuery($q);  $db->query();
		if ($db->num_rows() == 1 and
		$ps_product->parent_has_children($d["product_id"])) {
			$vmLogger->err( "Cannot delete last attribute while product has Items. Delete all Items first." );
			return false;
		}

		return true;

	}
	/**
	 * Adds an attribute record
	 *
	 * @param array $d
	 * @return boolean True when successful, false when not
	 */
	function add(&$d) {
		if (!$this->validate($d)) {
			return false;
		}

		$db = new ps_DB;
		$q  = "INSERT INTO #__{vm}_product_attribute_sku (product_id,attribute_name,";
		$q .= "attribute_list) VALUES ('" . $d["product_id"] . "','";
		$q .= $d["attribute_name"] . "','" . $d["attribute_list"] . "')";

		$db->setQuery($q);  $db->query();

		/** Insert new Attribute Name into child table **/
		$ps_product = new ps_product;
		$child_pid = $ps_product->get_child_product_ids($d["product_id"]);

		for($i = 0; $i < count($child_pid); $i++) {
			$q  = "INSERT INTO #__{vm}_product_attribute (product_id,attribute_name) ";
			$q .= "VALUES ('$child_pid[$i]','" . $d["attribute_name"] . "')";
			$db->setQuery($q);  $db->query();
		}

		return true;
	}

	/**
	 * Updates an attribute record
	 *
	 * @param array $d
	 * @return boolean True when successful, false when not
	 */
	function update(&$d) {
		if (!$this->validate($d)) {
			return false;
		}

		$db = new ps_DB;

		$q  = "UPDATE #__{vm}_product_attribute_sku SET ";
		$q .= "attribute_name='" . $d["attribute_name"] . "',";
		$q .= "attribute_list='" . $d["attribute_list"] . "' ";
		$q .= "WHERE product_id='" . $d["product_id"] . "' ";
		$q .= "AND attribute_name='" . $d["old_attribute_name"] . "' ";

		$db->setQuery($q);  $db->query();

		if ($d["old_attribute_name"] != $d["attribute_name"]) {
			$ps_product = new ps_product;
			$child_pid = $ps_product->get_child_product_ids($d["product_id"]);

			for($i = 0; $i < count($child_pid); $i++) {
				$q  = "UPDATE #__{vm}_product_attribute SET ";
				$q .= "attribute_name='" . $d["attribute_name"] . "' ";
				$q .= "WHERE product_id='$child_pid[$i]' ";
				$q .= "AND attribute_name='" . $d["old_attribute_name"] . "' ";
				$db->setQuery($q);  $db->query();
			}
		}
		return true;
	}

	/**
	* Controller for Deleting Records.
	*/
	function delete(&$d) {

		$record_id = $d["attribute_name"];

		if( is_array( $record_id)) {
			foreach( $record_id as $record) {
				if( !$this->delete_record( $record, $d ))
				return false;
			}
			return true;
		}
		else {
			return $this->delete_record( $record_id, $d );
		}
	}
	/**
	* Deletes one Record.
	*/
	function delete_record( $record_id, &$d ) {
		global $db;

		if (!$this->validate_delete($d)) {
			return false;
		}

		$q  = "DELETE FROM #__{vm}_product_attribute_sku ";
		$q .= "WHERE product_id = '" . $d["product_id"] . "' ";
		$q .= "AND attribute_name = '$record_id'";

		$db->setQuery($q);  $db->query();
		$ps_product = new ps_product;
		$child_pid = $ps_product->get_child_product_ids($d["product_id"]);

		for($i = 0; $i < count($child_pid); $i++) {
			$q  = "DELETE FROM #__{vm}_product_attribute ";
			$q .= "WHERE product_id = '$child_pid[$i]' ";
			$q .= "AND attribute_name = '$record_id' ";
			$db->setQuery($q);  $db->query();
		}
		return True;
	}
	/**
    * Lists all child/sister products of the given product
    *
    * @param int $product_id
    * @return string HTML code with Items, attributes & price
    */
	function list_attribute($product_id,$product_price) {
		//Use product_id to determine what type of child this product has, if it has none use drop
		$db = new PS_db;
		$q = "SELECT quantity_options,child_options,product_parent_id,child_option_ids FROM #__{vm}_product WHERE product_id='$product_id'";
		$db->query($q);
		$l_field = $db->f("child_options");
		$product_list = 'N';
		if($l_field) {
			$fields=explode(",",$l_field);
			$display_use_parent=array_shift($fields);
			$product_list=array_shift($fields);
			$display_header=array_shift($fields);
			$product_list_child=array_shift($fields);
			$product_list_type=array_shift($fields);
			$ddesc=array_shift($fields);
			$dw=array_shift($fields);
			$aw=array_shift($fields);
			$class_suffix=array_shift($fields);
		}
		else {
			$q = "SELECT product_parent_id,quantity_options,child_options,child_option_ids FROM #__{vm}_product WHERE product_id='".$db->f("product_parent_id")."'";
			$db->query($q);
			$l_field = $db->f("child_options");
			if($l_field) {
				$fields=explode(",",$l_field);
				$display_use_parent=array_shift($fields);
				$product_list=array_shift($fields);
				$display_header=array_shift($fields);
				$product_list_child=array_shift($fields);
				$product_list_type=array_shift($fields);
				$ddesc=array_shift($fields);
				$dw=array_shift($fields);
				$aw=array_shift($fields);
				$class_suffix=array_shift($fields);
			}
		}
		$l_field = $db->f("quantity_options");
		if($l_field) {
			$fields=explode(",",$l_field);
			$display_type=array_shift($fields);
		}
		if( empty($class_suffix) ) {
			$class_suffix = "";
		}
		if($db->f("child_option_ids") && $product_list == "N") {
			$product_list = "Y";
		}
        
		switch( $product_list ) {
			case "Y" :
				return $this->list_attribute_list($product_id,$display_use_parent,$product_list_child,$display_type,$class_suffix,$db->f("child_option_ids"),$dw,$aw,$display_header,$product_list_type);
				break;
			case "YM" :
				return $this->list_attribute_multi($product_id,$display_use_parent,$display_header,$product_list_child,$ddesc,$dw,$aw,$product_list_type,$class_suffix,$db->f("child_option_ids"),$product_price);
				break;
				
			case "N" :
			default:
				return $this->list_attribute_drop($product_id,$class_suffix);
				break;
		}
	}

	/**
	 * Lists all child/sister products of the given product
	 *
	 * @param int $product_id
	 * @return string HTML code with Items, attributes & price
	 */
	function list_attribute_drop($product_id,$cls_suffix) {

		global $VM_LANG, $CURRENCY_DISPLAY, $mm_action_url, $sess;

		require_once (CLASSPATH . 'ps_product.php' );
		$ps_product = new ps_product;
		$Itemid = $sess->getShopItemid();
		$category_id = mosGetParam( $_REQUEST, 'category_id', "" );
		$db = new ps_DB;
		$db_sku = new ps_DB;
		$db_item = new ps_DB;
        $tpl = new $GLOBALS['VM_THEMECLASS']();
        $tpl->set( "cls_suffix", $cls_suffix );
        $tpl->set( "product_id", $product_id );
        // Set Advanced Attributes
        $tpl->set("advanced_attribute", $this->list_advanced_attribute($product_id, $db->f("product_id")));
        $tpl->set("custom_attribute" , $this->list_custom_attribute($product_id, $db->f("product_id")));
		// Get list of children
		$q = "SELECT product_id,product_name FROM #__{vm}_product WHERE product_parent_id='$product_id' AND product_publish='Y'";
		$db->setQuery($q);
		$db->query();
		if( $db->num_rows() < 1 ) {
			// Try to Get list of sisters & brothers
			$q = "SELECT product_parent_id FROM #__{vm}_product WHERE product_id='$product_id'";
			$db->setQuery($q);
			$db->query();
			$child_id = $product_id;
			$product_id = $db->f("product_parent_id")!="0" ? $db->f("product_parent_id") : $product_id;
			$q = "SELECT product_id,product_name FROM #__{vm}_product WHERE product_parent_id='".$db->f("product_parent_id")."' AND product_parent_id<>0 AND product_publish='Y'";
			$db->setQuery($q);
			$db->query();
		}
		if( $db->num_rows() > 0 ) {
			$flypage = $ps_product->get_flypage( $product_id );
            $html = "<input type=\"hidden\" name=\"product_id\" value=\"$product_id\" />";
            $html .= "<label for=\"product_id_field\">".$VM_LANG->_PHPSHOP_PLEASE_SEL_ITEM."</label>: <br />";
			$html .= "<select class=\"inputbox\" onchange=\"var id = $('product_id_field')[selectedIndex].value; if(id != '') { loadNewPage( 'vmMainPage', '". $mm_action_url ."index2.php?option=com_virtuemart&amp;page=shop.product_details&amp;flypage=$flypage&amp;Itemid=$Itemid&amp;category_id=$category_id&amp;product_id=' + id ); }\" id=\"product_id_field\" name=\"prod_id[]\">\n";
			$html .= "<option value=\"$product_id\">".$VM_LANG->_PHPSHOP_SELECT."</option>";
			while ($db->next_record()) {
				$selected = isset($child_id) ? ($db->f("product_id")==$child_id ? "selected=\"selected\"" : "") : "";

				// Start row for this child
				$html .= "<option value=\"" . $db->f("product_id") . "\" $selected>";
				$html .= $db->f("product_name") . " - ";

				// For each child get attribute values by looping through attribute list
				$q = "SELECT product_id, attribute_name FROM #__{vm}_product_attribute_sku ";
				$q .= "WHERE product_id='$product_id' ORDER BY attribute_list ASC";
				$db_sku->setQuery($q);  $db_sku->query();

				while ($db_sku->next_record()) {
					$q = "SELECT attribute_name, attribute_value, product_id ";
					$q .= "FROM #__{vm}_product_attribute WHERE ";
					$q .= "product_id='" . $db->f("product_id") . "' AND ";
					$q .= "attribute_name='" . $db_sku->f("attribute_name") . "'";
					$db_item->setQuery($q);  $db_item->query();
					while ($db_item->next_record()) {
						$html .= $db_item->f("attribute_name") . " ";
						$html .= "(" . $db_item->f("attribute_value") . ")";
						if( !$db_sku->is_last_record() )
						$html .= '; ';
					}
				}
				// Attributes for this item are done.
				// Now get item price
				if( $_SESSION['auth']['show_prices'] ) {
					$price = $ps_product->get_price($db->f("product_id"));
					$price["product_price"] = $GLOBALS['CURRENCY']->convert( $price["product_price"], $price["product_currency"] );
					if( $_SESSION["auth"]["show_price_including_tax"] == 1 ) {
						$tax_rate = 1 + $ps_product->get_product_taxrate($db->f("product_id"));
						$price['product_price'] *= $tax_rate;
					}
					$html .= ' - '.$CURRENCY_DISPLAY->getFullValue($price["product_price"]);
				}
				$html .= "</option>\n";
			}
			$html .= "</select>\n";
            $tpl->set("drop_down", $html);
		}
		else {
			$html = "<input type=\"hidden\" name=\"product_id\" value=\"$product_id\" />\n";
			$html .= "<input type=\"hidden\" name=\"prod_id[]\" value=\"$product_id\" />\n";
            $tpl->set("drop_down", $html);
		}
		$html = $tpl->fetch_cache( 'product_details/includes/addtocart_drop.tpl.php');
		return array($html,"drop");
	}



	/**
	 * Lists all child/sister products of the given product
	 *
	 * @param int $product_id
	 * @return string HTML code with Items, attributes & price
	 */

	function list_attribute_list($product_id, $display_use_parent,$child_link,$display_type,$cls_sfuffix,$child_ids,$dw,$aw,$display_header,$product_list_type) {
		global $VM_LANG, $CURRENCY_DISPLAY,$mm_action_url,$sess,$auth;
		global $mainframe;
		require_once (CLASSPATH . 'ps_product.php' );
		$ps_product = new ps_product;
		require_once(CLASSPATH . 'ps_product_type.php' );
		$ps_product_type = new ps_product_type;
		require_once(CLASSPATH . 'ps_product_category.php' );
		$ps_product_category = new ps_product_category;
		$Itemid = mosGetParam( $_REQUEST, 'Itemid', "" );
		$category_id = mosGetParam( $_REQUEST, 'category_id', "" );
		$curr_product = mosGetParam( $_REQUEST, 'product_id', "");
		$db = new ps_DB;
		$db_sku = new ps_DB;
		$db_item = new ps_DB;
        $tpl = new $GLOBALS['VM_THEMECLASS']();
        $tpl->set( "cls_suffix", $cls_sfuffix );
        $tpl->set( "product_id", $product_id );
        $tpl->set( "display_header", $display_header);
        $tpl->set( "display_product_type", $product_list_type);
		$html = "";
		// Get list of children
		$pp = $ps_product->parent_has_children($product_id);
		if($pp) {
			$q = "SELECT product_id,product_name,product_parent_id,product_sku,product_in_stock,product_full_image,product_thumb_image FROM #__{vm}_product WHERE product_publish='Y' AND product_parent_id='$product_id'  ";
		}
		else {
			$q = "SELECT product_id,product_name,product_parent_id,product_sku,product_in_stock,product_full_image,product_thumb_image FROM #__{vm}_product WHERE product_publish='Y' AND product_id='$product_id'  ";
		}
		if($child_ids) {
			$q .= "UNION ALL SELECT product_id,product_name,product_parent_id,product_sku,product_in_stock,product_full_image,product_thumb_image FROM #__{vm}_product WHERE product_publish='Y' AND  product_id IN ($child_ids)";
		}
		$db->setQuery($q);
		$db->query();
		if($pp) {
			$master_id = $product_id;
		}
		else {
			$master_id = $db->f("product_id");
		}
		if( $db->num_rows() < 1 ) {
			// Try to Get list of sisters & brothers
			$q = "SELECT product_parent_id FROM #__{vm}_product WHERE product_id='$product_id'";
			$db->setQuery($q);
			$db->query();
			$child_id = $product_id;
			$product_id = $db->f("product_parent_id")!="0" ? $db->f("product_parent_id") : $product_id;
			$parent_id= $db->f("product_parent_id");
			$q = "SELECT product_id,product_name,product_parent_id,product_sku,product_in_stock FROM #__{vm}_product WHERE product_parent_id='".$db->f("product_parent_id")."' AND product_parent_id<>0 AND product_publish='Y'";
			$db->setQuery($q);
			$db->query();
		}
		if(( $db->num_rows() > 0 ) ) {
        $products = array();
        $headings = array();
	    $i = 0;

			$ci=0;
			while ($db->next_record()) {
				$parent_id= $db->f("product_parent_id");
				$selected = isset($child_id) ? ($db->f("product_id")==$child_id ? "selected=\"selected\"" : "") : "";

				if (($db->f("product_id") <> $curr_product) && @$child_id) {
					continue;
				}
				// Start row for this child
				$q = "SELECT product_id, attribute_name FROM #__{vm}_product_attribute_sku ";
				if($pp) {
					$q .= "WHERE product_id='$product_id' ORDER BY attribute_list ASC";
				}
				else {
					$q .= "WHERE product_id='".$db->f("product_parent_id")."' ORDER BY attribute_list ASC";
				}
				$db_sku->setQuery($q);  $db_sku->query();
				$attrib_value = array();
                $attrib_heading = array();
				while ($db_sku->next_record()) {
					$q = "SELECT attribute_name,attribute_value ";
					$q .= "FROM #__{vm}_product_attribute WHERE ";
					$q .= "product_id='" . $db->f("product_id") . "' AND ";
					$q .= "attribute_name='" . $db_sku->f("attribute_name") . "'";
					$db_item->setQuery($q);  $db_item->query();
					while ($db_item->next_record()) {
                    
						$html_header =  "<span style=\"float: left;width: 20%;\" />";
						$html_header .= " " . $db_item->f("attribute_name") . "</span />\n";
                        $attrib_heading[] = $db_item->f("attribute_name");
						$attrib_value[] = $db_item->f("attribute_value");
					}
				}
                $tpl->set('headings', $attrib_heading);
                $tpl->set('desc_width',$dw);
                $tpl->set('attrib_width',$aw);
				// End show Header Row
				if ($ci % 2) {
					$bgcolor="vmRowOne";
				} else {
					$bgcolor="vmRowTwo";
				}
                $products[$ci]['bgcolor'] = $bgcolor;
				$flypage = $ps_product->get_flypage( $product_id );

                $products[$ci]['product_id'] = $db->f("product_id");
				// If this is a child of a parent set the correct product_id for page return
				if (@$child_id && $pp) {
                    $products[$ci]['parent_id'] = $db->f("product_id");
				}
				else {
					$master_id = $parent_id;
                    $products[$ci]['parent_id'] = $parent_id;
				}
                // Images
                // If it is item get parent:
		        $product_parent_id = $db->f("product_parent_id");
                if ($product_parent_id != 0) {
                    $dbp = new PS_db;
			        $dbp->query("SELECT product_full_image,product_thumb_image,product_name,product_s_desc FROM #__{vm}_product WHERE product_id='$product_parent_id'" );
			        $dbp->next_record();
		        }
                $product_full_image = $parent_id!=0 && !$db->f("product_full_image") ?
					$dbp->f("product_full_image") : $db->f("product_full_image"); // Change
                $product_thumb_image = $parent_id!=0 && !$db->f("product_thumb_image") ?
					$dbp->f("product_thumb_image") : $db->f("product_thumb_image"); // Change
                $productData = $db->get_row();
                $productArray = get_object_vars( $productData );
                $productArray["product_id"] = $db->f("product_id");
                $productArray["product_full_image"] = $product_full_image; // to display the full image on flypage
                $productArray["product_thumb_image"] = $product_thumb_image;

                $tpl->set( 'productArray', $productArray );
                foreach( $productArray as $property => $value ) {
	                $tpl->set( $property, $value);
                }
                // Assemble the thumbnail image as a link to the full image
                // This function is defined in the theme (theme.php)
                $product_image = $tpl->vmBuildFullImageLink( $productArray );
                $products[$ci]['product_image'] = $product_image;
                //Product Description
                if(($child_link == "Y" ) && !@$child_id) {
						$link = "<input type=\"hidden\" id=\"index_id".$db->f("product_id")."\" value=\"".$db->f("product_id")."\" />\n";
						$link .="<a name=\"".$db->f("product_name").$db->f("product_id")."\"  onclick=\"var id = $('index_id".$db->f("product_id")."').value; if(id != '') { loadNewPage( 'vmMainPage', '". $mm_action_url ."index2.php?option=com_virtuemart&page=shop.product_details&flypage=$flypage&Itemid=$Itemid&category_id=$category_id&product_id=' + id ); }\" >";
                }
                $html1 = $db->f("product_name");
                if(($child_link == "Y" ) && !@$child_id) {
                    $html1 .= "</a>";
                }
                $products[$ci]['product_title'] = $link.$html1;
				// For each child get attribute values by looping through attribute list
				foreach($attrib_value as $attribute) {
                    $products[$ci]['attrib_value'][] = $attribute;
				}

				//Show the quantity Box
                $products[$ci]['quantity_box'] = $this->show_quantity_box($master_id,$db->f("product_id"),"Y",$display_use_parent);
				// Attributes for this item are done.
				// Now get item price
				$price = $ps_product->get_price($db->f("product_id"));
				$price["product_price"] = $GLOBALS['CURRENCY']->convert( $price["product_price"], $price["product_currency"] );
				$actual_price = $ps_product->get_adjusted_attribute_price($db->f("product_id"));
				$actual_price["product_price"] = $GLOBALS['CURRENCY']->convert( $actual_price["product_price"], $actual_price["product_currency"] );
				if( $_SESSION["auth"]["show_price_including_tax"] == 1 ) {
					$tax_rate = 1 + $ps_product->get_product_taxrate($db->f("product_id"));
					$price['product_price'] *= $tax_rate;
					$actual_price['product_price'] *= $tax_rate;
				}
                $products[$ci]['price'] = $CURRENCY_DISPLAY->getFullValue($price["product_price"]);
                $products[$ci]['actual_price'] = $CURRENCY_DISPLAY->getFullValue($actual_price["product_price"]);

				// Ouput Product Type
				if($db->f("product_parent_id") != $product_id)
				$product_id = $db->f("product_parent_id");
                $product_type = "";
                if ($product_id!=0 && !$ps_product_type->product_in_product_type($db->f("product_id"))) {
					$product_type = $ps_product_type->list_product_type($product_id);
				}
				else {
					$product_type = $ps_product_type->list_product_type($db->f("product_id"));
				}
                $products[$ci]['product_type'] = $product_type;
				// Output Advanced Attributes
                $products[$ci]['advanced_attribute'] = $this->list_advanced_attribute($product_id, $db->f("product_id"));
				$products[$ci]['custom_attribute'] = $this->list_custom_attribute($product_id, $db->f("product_id"));
                $ci++;
			}
			if($display_type == "radio") {
				$list_type = "radio";
			}
			else {
				$list_type = "list";
			}
            // Get template and fill
            $tpl->set( 'products', $products );
            $html = $tpl->fetch_cache( 'product_details/includes/addtocart_list_single.tpl.php');
		}
		else {

			$html = "<input type=\"hidden\" name=\"product_id\" value=\"$product_id\" />\n";
			$html .= "<input type=\"hidden\" name=\"prod_id[]\" value=\"$product_id\" />\n";
			// This function lists the "advanced" simple attributes
			$html .= $this->list_advanced_attribute($product_id);
			// This function lists the "custom" simple attributes
			$html .= $this->list_custom_attribute($product_id);
			$html .= '<br />';
			$list_type = "drop";
		}

		return array($html,$list_type);
	}


	/**
	 * Lists all child/sister products of the given product
	 *
	 * @param int $product_id
	 * @return string HTML code with Items, attributes & price
	 */

	function list_attribute_multi($product_id,$display_use_parent,$display_header,$child_link,$dd,$dw,$aw,$pt,$cls_suffix,$child_ids,$product_price) {
		global $mainframe, $VM_LANG, $CURRENCY_DISPLAY,$mm_action_url,$sess,$auth;

		require_once (CLASSPATH . 'ps_product.php' );
		$ps_product = new ps_product;
		require_once(CLASSPATH . 'ps_product_type.php' );
		$ps_product_type = new ps_product_type;
		require_once(CLASSPATH . 'ps_product_category.php' );
		$ps_product_category = new ps_product_category;
		$Itemid = mosGetParam( $_REQUEST, 'Itemid', "" );
		$category_id = mosGetParam( $_REQUEST, 'category_id', "" );
		$curr_product = mosGetParam( $_REQUEST, 'product_id', "");
		$db = new ps_DB;
		$db_sku = new ps_DB;
		$db_item = new ps_DB;
        $tpl = new $GLOBALS['VM_THEMECLASS']();
        $tpl->set( "cls_suffix", $cls_suffix );
        $tpl->set( "product_id", $product_id );
        $tpl->set( "display_header", $display_header);
        $tpl->set( "display_product_type", $pt);
        $tpl->set( "product_price", $product_price);

		$html = "";
		// Get list of children
		$pp = $ps_product->parent_has_children($product_id);
		if($pp) {
			$q = "SELECT product_id,product_name,product_parent_id,product_sku,product_in_stock FROM #__{vm}_product WHERE product_publish='Y' AND product_parent_id='$product_id'  ";
		}
		else {
			$q = "SELECT product_id,product_name,product_parent_id,product_sku,product_in_stock FROM #__{vm}_product WHERE product_publish='Y' AND product_id='$product_id'  ";
		}
		if($child_ids) {
			$q .= "UNION ALL SELECT product_id,product_name,product_parent_id,product_sku,product_in_stock FROM #__{vm}_product WHERE product_publish='Y' AND  product_id IN ($child_ids)";
		}
		$db->setQuery($q);
		$db->query();
		if($pp) {
			$master_id = $product_id;
		}
		else {
			$master_id = $db->f("product_id");
		}
		if( $db->num_rows() < 1 ) {
			// Try to Get list of sisters & brothers
			$q = "SELECT product_parent_id FROM #__{vm}_product WHERE product_id='$product_id'";
			$db->setQuery($q);
			$db->query();
			$child_id = $product_id;
			$product_id = $db->f("product_parent_id")!="0" ? $db->f("product_parent_id") : $product_id;
			$parent_id= $db->f("product_parent_id");
			$q = "SELECT product_id,product_name,product_parent_id,product_sku,product_in_stock FROM #__{vm}_product WHERE product_parent_id='".$db->f("product_parent_id")."' AND product_parent_id<>0 AND product_publish='Y'";
			$db->setQuery($q);
			$db->query();
		}
		if(( $db->num_rows() > 0 ) ) {
        $products = array();
        $headings = array();
	    $i = 0;

			$ci=0;
			while ($db->next_record()) {
				$parent_id= $db->f("product_parent_id");
				$selected = isset($child_id) ? ($db->f("product_id")==$child_id ? "selected=\"selected\"" : "") : "";

				if (($db->f("product_id") <> $curr_product) && @$child_id) {
					continue;
				}
				// Start row for this child
				$q = "SELECT product_id, attribute_name FROM #__{vm}_product_attribute_sku ";
				if($pp) {
					$q .= "WHERE product_id='$product_id' ORDER BY attribute_list ASC";
				}
				else {
					$q .= "WHERE product_id='".$db->f("product_parent_id")."' ORDER BY attribute_list ASC";
				}
				$db_sku->setQuery($q);  $db_sku->query();
				$attrib_value = array();
                $attrib_heading = array();
				while ($db_sku->next_record()) {
					$q = "SELECT attribute_name,attribute_value ";
					$q .= "FROM #__{vm}_product_attribute WHERE ";
					$q .= "product_id='" . $db->f("product_id") . "' AND ";
					$q .= "attribute_name='" . $db_sku->f("attribute_name") . "'";
					$db_item->setQuery($q);  $db_item->query();
					while ($db_item->next_record()) {
                    
						$html_header =  "<span style=\"float: left;width: 20%;\" />";
						$html_header .= " " . $db_item->f("attribute_name") . "</span />\n";
                        $attrib_heading[] = $db_item->f("attribute_name");
						$attrib_value[] = $db_item->f("attribute_value");
					}
				}
                $tpl->set('headings', $attrib_heading);
                $tpl->set('desc_width',$dw);
                $tpl->set('attrib_width',$aw);
				// End show Header Row
				if ($ci % 2) {
					$bgcolor="vmRowOne";
				} else {
					$bgcolor="vmRowTwo";
				}
                $products[$ci]['bgcolor'] = $bgcolor;
				$flypage = $ps_product->get_flypage( $product_id );

                $products[$ci]['product_id'] = $db->f("product_id");
				// If this is a child of a parent set the correct product_id for page return
				if (@$child_id && $pp) {
                    $products[$ci]['parent_id'] = $db->f("product_id");
				}
				else {
					$master_id = $parent_id;
                    $products[$ci]['parent_id'] = $parent_id;
				}
                // Images
                // If it is item get parent:
		        $product_parent_id = $db->f("product_parent_id");
                if ($product_parent_id != 0) {
                    $dbp = new PS_db;
			        $dbp->query("SELECT product_full_image,product_thumb_image,product_name,product_s_desc FROM #__{vm}_product WHERE product_id='$product_parent_id'" );
			        $dbp->next_record();
		        }
                $product_full_image = $parent_id!=0 && !$db->f("product_full_image") ?
					$dbp->f("product_full_image") : $db->f("product_full_image"); // Change
                $product_thumb_image = $parent_id!=0 && !$db->f("product_thumb_image") ?
					$dbp->f("product_thumb_image") : $db->f("product_thumb_image"); // Change
                $productData = $db->get_row();
                $productArray = get_object_vars( $productData );
                $productArray["product_id"] = $db->f("product_id");
                $productArray["product_full_image"] = $product_full_image; // to display the full image on flypage
                $productArray["product_thumb_image"] = $product_thumb_image;

                $tpl->set( 'productArray', $productArray );
                foreach( $productArray as $property => $value ) {
	                $tpl->set( $property, $value);
                }
                // Assemble the thumbnail image as a link to the full image
                // This function is defined in the theme (theme.php)
                $product_image = $tpl->vmBuildFullImageLink( $productArray );
                $products[$ci]['product_image'] = $product_image;
                //Product Description
                if(($child_link == "Y" ) && !@$child_id) {
						$link = "<input type=\"hidden\" id=\"index_id".$db->f("product_id")."\" value=\"".$db->f("product_id")."\" />\n";
						$link .="<a name=\"".$db->f("product_name").$db->f("product_id")."\"  onclick=\"var id = $('index_id".$db->f("product_id")."').value; if(id != '') { loadNewPage( 'vmMainPage', '". $mm_action_url ."index2.php?option=com_virtuemart&page=shop.product_details&flypage=$flypage&Itemid=$Itemid&category_id=$category_id&product_id=' + id ); }\" >";
                }
                $html1 = $db->f("product_name");
                if(($child_link == "Y" ) && !@$child_id) {
                    $html1 .= "</a>";
                }
                $products[$ci]['product_title'] = $link.$html1;
				// For each child get attribute values by looping through attribute list
				foreach($attrib_value as $attribute) {
                    $products[$ci]['attrib_value'][] = $attribute;
				}

				//Show the quantity Box
                $products[$ci]['quantity_box'] = $this->show_quantity_box($master_id,$db->f("product_id"),"Y",$display_use_parent);
				// Attributes for this item are done.
				// Now get item price
				$price = $ps_product->get_price($db->f("product_id"));
				$price["product_price"] = $GLOBALS['CURRENCY']->convert( $price["product_price"], $price["product_currency"] );
				$actual_price = $ps_product->get_adjusted_attribute_price($db->f("product_id"));
				$actual_price["product_price"] = $GLOBALS['CURRENCY']->convert( $actual_price["product_price"], $actual_price["product_currency"] );
				if( $_SESSION["auth"]["show_price_including_tax"] == 1 ) {
					$tax_rate = 1 + $ps_product->get_product_taxrate($db->f("product_id"));
					$price['product_price'] *= $tax_rate;
					$actual_price['product_price'] *= $tax_rate;
				}
                $products[$ci]['price'] = $CURRENCY_DISPLAY->getFullValue($price["product_price"]);
                $products[$ci]['actual_price'] = $CURRENCY_DISPLAY->getFullValue($actual_price["product_price"]);

				// Ouput Product Type
				if($db->f("product_parent_id") != $product_id)
				$product_id = $db->f("product_parent_id");
                $product_type = "";
                if ($product_id!=0 && !$ps_product_type->product_in_product_type($db->f("product_id"))) {
					$product_type = $ps_product_type->list_product_type($product_id);
				}
				else {
					$product_type = $ps_product_type->list_product_type($db->f("product_id"));
				}
                $products[$ci]['product_type'] = $product_type;
				// Output Advanced Attributes
                $products[$ci]['advanced_attribute'] = $this->list_advanced_attribute($product_id, $db->f("product_id"));
				$products[$ci]['custom_attribute'] = $this->list_custom_attribute($product_id, $db->f("product_id"));
                $products[$ci]['flypage'] = $flypage;
                $products[$ci]['Itemid'] = $Itemid;
                $ci++;
			}
			$list_type = "multi";
            // Get template and fill
            $tpl->set( 'products', $products );
            $html = $tpl->fetch_cache( 'product_details/includes/addtocart_list_multi.tpl.php');
		}
		else {
			$html = "<input type=\"hidden\" name=\"product_id\" value=\"$product_id\" />\n";
			$html .= "<input type=\"hidden\" name=\"prod_id[]\" value=\"$product_id\" />\n";
			// This function lists the "advanced" simple attributes
			$html .= $this->list_advanced_attribute($product_id);
			// This function lists the "custom" simple attributes
			$html .= $this->list_custom_attribute($product_id);
			$html .= '<br />';
			$list_type = "drop";
		}
		return array($html,$list_type);
	}

	/**
	 * Creates drop-down boxes from advanced attribute format.
	 * @author Sean Tobin (byrdhuntr@hotmail.com)
	 * @param int $product_id
	 * @return string HTML code containing Drop Down Lists with Labels
	 */
	function list_advanced_attribute($product_id,$prod_id = null) {
		global $CURRENCY_DISPLAY, $ps_product;
		$db = new ps_DB;
		$auth = $_SESSION['auth'];
        $tpl = new $GLOBALS['VM_THEMECLASS']();
		if($product_id == 0)
		$product_id = $prod_id;
		$q = "SELECT product_id, attribute FROM #__{vm}_product WHERE product_id='$product_id'";
		$db->query($q);
		$db->next_record();
		$productPrice = $ps_product->get_price($product_id);

		$advanced_attribute_list=$db->f("attribute");
		if ($advanced_attribute_list) {
			$has_advanced_attributes=1;
			$fields=explode(";",$advanced_attribute_list);
			
            $attributes =array();
            $i = 0;
			foreach($fields as $field) {
                $html = "";
				$base=explode(",",$field);
				$title=array_shift($base);
				$titlevar=str_replace(" ","_",$title);
				$prod_index = $product_id;
				if ($prod_id)
				$prod_index = $prod_id;
                $attributes[$i]['product_id'] = $prod_index;
                $attributes[$i]['title'] = $title;
                $attributes[$i]['titlevar'] = $titlevar;
				foreach ($base as $base_value) {
					// the Option Text
					$attribtxt=substr($base_value,0,strrpos($base_value, '['));
					if( $attribtxt != "") {
						$vorzeichen=substr($base_value,strrpos($base_value, '[')+1,1); // negative, equal or positive?
						if( $_SESSION["auth"]["show_price_including_tax"] == 1 ) {
							$price = floatval(substr($base_value,strrpos($base_value, '[')+2))*(1+ @$_SESSION['product_sess'][$product_id]['tax_rate']); // calculate Tax
						}
						else {
							$price = floatval(substr($base_value,strrpos($base_value, '[')+2));
						}
						// Apply shopper group discount
						$price *= 1 - ($auth["shopper_group_discount"]/100);
						$price = $GLOBALS['CURRENCY']->convert( $price, $productPrice['product_currency'] );
						if ($price=="0") {
							$attribut_hint = "test";
						}
						$base_var=str_replace(" ","_",$base_value);
						$base_var=substr($base_var,0,strrpos($base_var, '['));
						$html.="<option value=\"$base_var\">$attribtxt";
						if( $_SESSION['auth']['show_prices'] ) {
							$html .= "&nbsp;(&nbsp;".$vorzeichen."&nbsp;".$CURRENCY_DISPLAY->getFullValue($price)."&nbsp;)";
						}
						$html .= "</option>";

					}
					else {
						$base_var=str_replace(" ","_",$base_value);
						$html.="<option value=\"$base_var\">$base_value</option>";
					}
				}
                $attributes[$i]['options_list'] = $html;
                $i++;
			}
		}

		if ($advanced_attribute_list) {
            $tpl->set( 'attributes', $attributes );
            return $tpl->fetch_cache( 'product_details/includes/addtocart_advanced_attribute.tpl.php');
		}
	}

	/**
	 * Creates textfields for customizable products from the custom attribute format
	 * @author Denie van Kleef (denievk@in2sports)
	 * @param unknown_type $product_id
	 * @return unknown
	 */
	function list_custom_attribute($product_id,$prod_id = null) {
		global $mosConfig_secret;
		$db = new ps_DB;
        $tpl = new $GLOBALS['VM_THEMECLASS']();
		if($product_id == 0)
		$product_id = $prod_id;

		$q = "SELECT product_id, custom_attribute from #__{vm}_product WHERE product_id='$product_id'";
		$db->query($q);
		$db->next_record();

		$custom_attr_list=$db->f("custom_attribute");
		if ($custom_attr_list) {
			$has_custom_attributes=1;
			$fields=explode(";",$custom_attr_list);
			$html = "";
			$prod_index = $product_id;
			if ($prod_id)
			$prod_index = $prod_id;
            $attributes =array();
            $i = 0;
			foreach($fields as $field)
			{
				$titlevar=str_replace(" ","_",$field);
				$title=ucfirst($field);
                $attributes[$i]['product_id'] = $prod_index;
                $attributes[$i]['title'] = $title;
                $attributes[$i]['titlevar'] = $titlevar;
				$i++;
			}
		}

		if ($custom_attr_list) {
            $tpl->set( 'attributes', $attributes );
            return $tpl->fetch_cache( 'product_details/includes/addtocart_custom_attribute.tpl.php');
		}
	}
	/**
	 * This function returns an array with all "advanced" attributes of the product specified by
	 * $product_id
	 *
	 * @param int $product_id
	 */
	function getAdvancedAttributes( $product_id ) {
		global $ps_product;
		if( is_null( $ps_product )) {
			$ps_product = new ps_product();
		}
		$attributes_array = array();
		$attributes = $ps_product->get_field( $product_id, 'attribute' );
		// Get each of the attributes into an array
		$product_attribute_keys = explode( ";", $attributes );
		foreach( $product_attribute_keys as $attribute ) {
			$attribute_name = substr( $attribute, 0, strpos($attribute, ",") );
			$attribute_values = substr( $attribute, strpos($attribute, ",")+1 );
			$attributes_array[$attribute_name]['name'] = $attribute_name;
			// Read the different attribute values into an array
			$attribute_values = explode(',', $attribute_values );
			$operand = '';
			$my_mod = 0;
			foreach( $attribute_values as $value ) {

				// Get the price modification for this attribute value
				$start = strpos($value, "[");
				$finish = strpos($value,"]", $start);

				$o = substr_count ($value, "[");
				$c = substr_count ($value, "]");	
				// check to see if we have a bracket (means: a price modifier)
				if (True == is_int($finish) ) {
					$length = $finish-$start;

					// We found a pair of brackets (price modifier?)
					if ($length > 1) {
						$my_mod=substr($value, $start+1, $length-1);
						//echo "before: ".$my_mod."<br>\n";
						if ($o != $c) { // skip the tests if we don't have to process the string
							if ($o < $c ) {
								$char = "]";
								$offset = $start;
							}
							else {
								$char = "[";
								$offset = $finish;
							}
							$s = substr_count($my_mod, $char);
							for ($r=1;$r<$s;$r++) {
								$pos = strrpos($my_mod, $char);
								$my_mod = substr($my_mod, $pos+1);
							}
						}
						$operand=substr($my_mod,0,1);

						$my_mod=substr($my_mod,1);

						
					}
				}
				if( $start > 0 ) {
					$value = substr($value, 0, $start);
				}
				$attributes_array[$attribute_name]['values'][$value]['name'] = $value;
				$attributes_array[$attribute_name]['values'][$value]['operand'] = $operand;
				$attributes_array[$attribute_name]['values'][$value]['adjustment'] = $my_mod;
			}
			
		}
		return $attributes_array;
		
	}
	/**
   * This checks if attributes values were chosen by the user
   * onCartAdd
   *
   * @param array $d
   * @return array $result
   */
	function cartGetAttributes( &$d ) {

		global $db;

		// added for the advanced attributes modification
		//get listing of titles for attributes (Sean Tobin)
		$attributes = array();
        if(!isset($d["prod_id"])) {
            $d["prod_id"] = $d["product_id"];
        }
		$q = "SELECT product_id, attribute, custom_attribute FROM #__{vm}_product WHERE product_id='".$d["prod_id"]."'";
		$db->query($q);

		$db->next_record();

		if(!$db->f("attribute") && !$db->f("custom_attribute")) {
			$q = "SELECT product_parent_id FROM #__{vm}_product WHERE product_id='".$d["prod_id"]."'";

			$db->query($q);
			$db->next_record();
			$q = "SELECT product_id, attribute, custom_attribute FROM #__{vm}_product WHERE product_id='".$db->f("product_parent_id")."'";
			$db->query($q);
			$db->next_record();
		}

		$advanced_attribute_list=$db->f("attribute");
		if ($advanced_attribute_list) {
			$fields=explode(";",$advanced_attribute_list);
			foreach($fields as $field) {
				$base=explode(",",$field);
				$title=array_shift($base);
				array_push($attributes,$title);
			}
		}

		$description="";
		$attribute_given = false;
		foreach($attributes as $a) {

			$pagevar=str_replace(" ","_",$a);
			$pagevar .= $d['prod_id'];
			if (!empty($d[$pagevar])) {
				$attribute_given = true;
			}
			if ($description!='') {
				$description.="; ";
			}

			$description.=$a.":";
			$description .= empty($d[$pagevar]) ? '' : $d[$pagevar];

		}
		rtrim($description);
		$d["description"] = $description;
		// end advanced attributes modification addition

		// added for custom fields by denie van kleef
		$custom_attribute_list=$db->f("custom_attribute");
		$custom_attribute_given = false;
		if ($custom_attribute_list) {
			$fields=explode(";",$custom_attribute_list);

			$description=$d["description"];

			foreach($fields as $field)
			{
				$pagevar=str_replace(" ","_",$field);
				$pagevar .= $d['prod_id'];
				if (!empty($d[$pagevar])) {
					$custom_attribute_given = true;
				}
				if ($description!='') {
					$description.="; ";
				}
				$description.=$field.":";
				$description .= empty($d[$pagevar]) ? '' : $d[$pagevar];

			}
			rtrim($description);
			$d["description"] = $description;
			// END add for custom fields by denie van kleef

		}

		$result['attribute_given'] = $attribute_given;
		$result['advanced_attribute_list'] = $advanced_attribute_list;
		$result['custom_attribute_given'] = $custom_attribute_given;
		$result['custom_attribute_list'] = $custom_attribute_list;

		return $result;
	}

	function show_radio_quantity_box() {
		$html ="<input type=\"text\" class=\"inputboxquantity\"\" size=\"4\" id=\"quantity_adjust\" "
           ." name=\"quantity_adjust\" value=\"1\" style=\"vertical-align: middle;\" onchange=\"alterQuantity(this.form)\"/>";
		$html .="<input type=\"button\" style=\"width:10px;vertical-align:middle;height:10px;background: url(".VM_THEMEURL."images/up_small.gif ) no-repeat center;\" onclick=\"var qty_el = document.getElementById('quantity_adjust'); var qty = qty_el.value; if( !isNaN( qty )) qty_el.value++;alterQuantity(this.form);return false;\" />
            <input type=\"button\" style=\"width:10px;vertical-align:middle;height:10px;background: url(".VM_THEMEURL."images/down_small.gif ) no-repeat center;\" onclick=\"var qty_el = document.getElementById('quantity_adjust'); var qty = qty_el.value; if( !isNaN( qty ) && qty > 0 ) qty_el.value--;alterQuantity(this.form);return false;\" />
            ";
		return $html;
	}

	function show_quantity_box($product_id,$prod_id,$child=false,$use_parent=false) {
		Global $VM_LANG;

		if($child == 'Y') {
			//We have a child list so get the current quantity;
			$quantity = 0;
			for ($i=0;$i<$_SESSION["cart"]["idx"];$i++) {
				if ($_SESSION['cart'][$i]["product_id"] == $prod_id) {
					$quantity= $_SESSION['cart'][$i]["quantity"];
				}
			}
		}
		else {
			$quantity = mosGetParam( $_REQUEST, 'quantity', 1 );
		}
		// Detremine which style to use
		if($use_parent == "Y") {
			$id = $product_id;
		}
		else {
			$id = $prod_id;
		}
		//Get style to use
		$db = new PS_db;
		$q = "SELECT quantity_options,product_parent_id FROM #__{vm}_product WHERE product_id='$id'";
		$db->query($q);
		$q_field = $db->f("quantity_options");
		if($q_field) {
			$fields=explode(",",$q_field);
			$display_type=array_shift($fields);
			$display_start=array_shift($fields);
			$display_end=array_shift($fields);
			$display_step=array_shift($fields);
		}
		//Determine if label to be used
		$html = "";
		if(!$child) {
			$html ="<label for=\"quantity$prod_id\" class=\"quantity_box\">".$VM_LANG->_PHPSHOP_CART_QUANTITY.":&nbsp;</label>";
		}
		//Start output of quantity
		//Check for incompatabilities and reset to normal

		if(!@$display_type || (@$display_type == "hide" && $child == 'Y') || (@$display_type == "radio" && $child == 'YM') || (@$display_type == "radio" && !$child)) {
			$display_type = "none";
		}
		switch($display_type) {
			case "radio" : //Radio Box
				$html .= "<input type=\"hidden\" id=\"quantity".$prod_id."\" name=\"quantity[]\" value=\"".$quantity."\" />";
				$html .= "<input type=\"radio\" class=\"quantitycheckbox\" id=\"selItem".$prod_id."\" name=\"selItem\" value=\"0\" ";
				if ($quantity > 0 ) {
					$html .= "checked=\"checked\" ";
				}
				$html .= "onclick=\"alterQuantity(this.form)\" />";
				break;
			case "hide" : // Hide box - but set quantity to 1!
				$html .= "<input type=\"hidden\" id=\"quantity".$prod_id."\" name=\"quantity[]\" value=\"1\" />";
				break;
			case "check" :
				$html .= "<input type=\"hidden\" id=\"quantity".$prod_id."\" name=\"quantity[]\" value=\"".$quantity."\" style=\"vertical-align: middle;\"/>
                <input type=\"checkbox\" class=\"quantitycheckbox\" id =\"check$id\" name=\"check[]\" ";
				if ($quantity > 0 )
				$html .= "checked=\"checked\"";
				$html .= " value=\"1\" onClick=\"javascript: if(this.checked==true) document.getElementById('quantity".$prod_id."').value = 1; else {document.getElementById('quantity".$prod_id."').value=0;} \"/> ";
				break;
			case "drop" :
				$html .= "<input type=\"hidden\" id=\"quantity".$prod_id."\" name=\"quantity[]\" value=\"".$quantity."\" />";
				$code = "<select class=\"inputboxquantity\" id=\"drop".$prod_id."\" name=\"drop[]\" onChange=\"javascript: document.getElementById('quantity".$prod_id."').value = this.options[this.selectedIndex].value ; \"";
				for($i=$display_start;$i<$display_end+1;$i += $display_step) {
					$code .= "  <option value=\"$i\"";
					if ($i == $quantity) {
						$code .= " selected=\"selected\"";
					}
					$code .= ">$i</option>\n";
				}
				$code .= "</select>\n";
				$html .= $code;
				break;
			case "none" :

				$html .= "<input type=\"text\" class=\"inputboxquantity\" size=\"4\" id=\"quantity$prod_id\" name=\"quantity[]\" value=\"".$quantity."\" />
	            <input type=\"button\" style=\"width:10px;vertical-align:middle;height:10px;background: url(".VM_THEMEURL."images/up_small.gif ) no-repeat center;\" onclick=\"var qty_el = document.getElementById('quantity".$prod_id."'); var qty = qty_el.value; if( !isNaN( qty )) qty_el.value++;return false;\" />
	            <input type=\"button\" style=\"width:10px;vertical-align:middle;height:10px;background: url(".VM_THEMEURL."images/down_small.gif ) no-repeat center;\" onclick=\"var qty_el = document.getElementById('quantity".$prod_id."'); var qty = qty_el.value; if( !isNaN( qty ) && qty > 0 ) qty_el.value--;return false;\" />
                ";
				break;
		}
		return $html;


	}
	

	function loadAttributeExtension($attribute_string = false)
	{
		global $VM_LANG;
		
		echo '<input type="hidden" name="js_lbl_title" value="'.$VM_LANG->_PHPSHOP_USER_FORM_TITLE.'" />
		      <input type="hidden" name="js_lbl_property" value="'.$VM_LANG->_PHPSHOP_PRODUCT_FORM_PROPERTY.'" />
		      <input type="hidden" name="js_lbl_property_new" value="'.$VM_LANG->_PHPSHOP_PRODUCT_FORM_PROPERTY_NEW.'" />
		      <input type="hidden" name="js_lbl_attribute_new" value="'.$VM_LANG->_PHPSHOP_PRODUCT_FORM_ATTRIBUTE_NEW.'" />
		      <input type="hidden" name="js_lbl_attribute_delete" value="'.$VM_LANG->_PHPSHOP_PRODUCT_FORM_ATTRIBUTE_DELETE.'" />
		      <input type="hidden" name="js_lbl_price" value="'.$VM_LANG->_PHPSHOP_CART_PRICE.'" />';
		
		if (!$attribute_string) {
			// product has no attributes
			?>
			<table id="attributeX_table_0" cellpadding="0" cellspacing="0" border="0" class="adminform" width="30%">
			  <tbody width="30%">
			  <tr>
			    <td width="5%"><?php echo $VM_LANG->_PHPSHOP_USER_FORM_TITLE;?></td>
			    <td align="left" colspan="2">
			    <input type="text" name="attributeX[0][name]" value="" size="60"/>
			    </td>
			    <td colspan="3" align="left">
			    <a href="javascript: newAttribute(1)"><?php echo $VM_LANG->_PHPSHOP_PRODUCT_FORM_ATTRIBUTE_NEW;?></a> | 
			    <a href="javascript: newProperty(0)"><?php echo $VM_LANG->_PHPSHOP_PRODUCT_FORM_PROPERTY_NEW;?></a>
			    </td>
			  </tr>
			  <tr id="attributeX_tr_0_0">
			  	 <td width="5%">&nbsp;</td>
			     <td width="10%" align="left">Property</td>
			     <td align="left" width="20%"><input type="text" name="attributeX[0][value][]" value="" size="40"/></td>
			     <td align="left" width="5%">Price</td>
			     <td align="left" width="60%"><input type="text" name="attributeX[0][price][]" size="10" value=""/></td>
			   </tr>
			   </tbody>
			</table>   
			<?php
			return;
		}
		
		// split multiple attributes
		$dropdownlists = explode(';', $attribute_string);

		for ($i = 0, $n = count($dropdownlists); $i < $n; $i++)
		{
			$dropdownlist  = $dropdownlists[$i];
			$options       = explode(',', $dropdownlist);
			$dropdown_name = $options[0];
			
			// display each attribute in the first loop...
			?>
			<table id="attributeX_table_<?php echo $i;?>" cellpadding="0" cellspacing="0" border="0" class="adminform" width="30%">
			  <tbody width="30%">
			  <tr>
			    <td width="5%"><?php echo $VM_LANG->_PHPSHOP_USER_FORM_TITLE;?></td>
			    <td align="left" colspan="2">
			    <input type="text" name="attributeX[<?php echo $i;?>][name]" value="<?php echo $dropdown_name;?>" size="60"/>
			    </td>
			    <td colspan="3" align="left">
			    <a href="javascript:newAttribute(<?php echo ($i+1);?>)"><?php echo $VM_LANG->_PHPSHOP_PRODUCT_FORM_ATTRIBUTE_NEW;?></a> | 
			    <?php if ($i != 0) { ?><a href="javascript:deleteAttribute(<?php echo ($i);?>)"><?php echo $VM_LANG->_PHPSHOP_PRODUCT_FORM_ATTRIBUTE_DELETE;?></a> | <?php }?>
			    <a href="javascript:newProperty(<?php echo ($i);?>)"><?php echo $VM_LANG->_PHPSHOP_PRODUCT_FORM_PROPERTY_NEW;?></a>
			    </td>
			  </tr>
			  <?php
			  // ... and the properties and prices in the second
			  for ($i2 = 1, $n2 = count($options);$i2 < $n2; $i2++)
			  {
			  	$value = $options[$i2];

			  	if (explode('[', $value)) {
			  		$value_price = explode('[', $value);
			  		?>
			  	    <tr id="attributeX_tr_<?php echo $i."_".$i2;?>">
			  	      <td width="5%">&nbsp;</td>
			          <td width="10%" align="left"><?php echo $VM_LANG->_PHPSHOP_PRODUCT_FORM_PROPERTY;?></td>
			          <td align="left" width="20%"><input type="text" name="attributeX[<?php echo $i;?>][value][]" value="<?php echo $value_price[0];?>" size="40"/></td>
			          <td align="left" width="5%"><?php echo $VM_LANG->_PHPSHOP_CART_PRICE;?></td>
			          <td align="left" width="60%"><input type="text" name="attributeX[<?php echo $i;?>][price][]" size="5" value="<?php echo str_replace(']','',@$value_price[1]);?>"/><a href="javascript:deleteProperty(<?php echo ($i);?>,'<?php echo $i."_".$i2;?>');">X</a></td>
			        </tr>
			  	  <?php
			  	}
			  	else {
			  	  ?>
			  	  <tr id="attributeX_tr_<?php echo $i."_".$i2;?>">
			  	    <td width="5%">&nbsp;</td>
			        <td width="10%" align="left"><?php echo $VM_LANG->_PHPSHOP_PRODUCT_FORM_PROPERTY;?></td>
			        <td align="left" width="20%"><input type="text" name="attributeX[<?php echo $i;?>][value][]" value="<?php echo $value;?>" size="40"/></td>
			        <td align="left" width="5%"><?php echo $VM_LANG->_PHPSHOP_CART_PRICE;?></td>
			        <td align="left" width="60%"><input type="text" name="attributeX[<?php echo $i;?>][price][]" size="10"/><a href="javascript:deleteProperty(<?php echo ($i);?>,'<?php echo $i."_".$i2;?>');">X</a></td>
			      </tr>
			  	  <?php
			  	}
			  }
			  ?>
			  </tbody>
			</table>
			<?php
		}
	}


	function formatAttributeX()
	{
		// request attribute pieces
		$attributeX = mosGetParam($_POST, 'attributeX', array(0));
		$attribute_string = '';

		// no pieces given? then return 
		if (empty($attributeX)) {
			return $attribute_string;
		}

		// put the pieces together again
		for ($i = 0, $n = count($attributeX); $i < $n; $i++)
		{
			$attributes = $attributeX[$i];

			// continue only if the attribute has a name
			if (!empty($attributes['name'])) {
				
				$attribute_string .= trim($attributes['name']);

				for ($i2 = 0, $n2 = count($attributes['value']); $i2 < $n2; $i2++) {
					$value = $attributes['value'][$i2];
					$price = $attributes['price'][$i2];


					if (!empty($value)) {
						$attribute_string .= ','.trim($value);

						if (!empty($price)) {
							
							// add the price only if there is an operand
							if (strstr($price, '+') OR (strstr($price, '-')) OR (strstr($price, '='))) {
								$attribute_string .= '['.trim($price).']';
							}
							
						}
						
					}
					
				}
				
				// add attribute separator only if it's not the last one!
				// otherwise you would get an another, empty attribute right behind
				if (($i + 1) < $n) {
					
					$attribute_string .= ';';
					
				}
				
			}

		}

		return trim($attribute_string);
	}
}
?>
