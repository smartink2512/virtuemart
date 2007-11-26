<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ) ;
/**
 *
 * @version $Id$
 * @package VirtueMart
 * @subpackage classes
 * @copyright Copyright (C) 2004-2007 soeren - All rights reserved.
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
 * The class is is used to manage the discounts in your store.
 *
 */
class ps_product_discount {
	
	/**
	 * Validates the input parameters onBeforeDiscountAdd
	 *
	 * @param array $d
	 * @return boolean
	 */
	function validate_add( $d ) {
		
		if( ! $d["amount"] ) {
			$GLOBALS['vmLogger']->err( 'You must enter an amount for the Discount.');
			return False ;
		}
		if( $d["is_percent"] == "" ) {
			$GLOBALS['vmLogger']->err( 'You must select a Discount type.');
			return False ;
		}
		return True ;
	}
	
	/**
	 * Validates the Input Parameters onBeforeDiscountUpdate
	 *
	 * @param array $d
	 * @return boolean
	 */
	function validate_update( $d ) {
		
		if( empty($d["amount"]) ) {
			$GLOBALS['vmLogger']->err( 'You must enter an amount for the Discount.' );
			return False ;
		}
		if( $d["is_percent"] == "" ) {
			$GLOBALS['vmLogger']->err( 'You must enter an amount type for the Discount.' );
			return False ;
		}
		if( ! $d["discount_id"] ) {
			$GLOBALS['vmLogger']->err( 'You must specifiy a discount to Update.' );
			return False ;
		}
		return true ;
	}
	
	/**
	 * Validates the Input Parameters onBeforeDiscountUpdate
	 *
	 * @param array $d
	 * @return boolean
	 */
	function validate_delete( $discount_id ) {
		
		if( ! $discount_id ) {
			$GLOBALS['vmLogger']->err( 'Please select a Discount to delete' );
			return False ;
		}
		
		return True ;
	
	}

	/**
	 * creates a new discount record
	 *
	 * @param array $d
	 * @return boolean
	 */
	function add( &$d ) {
		
		$db = new ps_DB( ) ;
		
		if( ! $this->validate_add( $d ) ) {
			return False ;
		}
		
		if( ! empty( $d["start_date"] ) ) {
			$day = substr( $d["start_date"], 8, 2 ) ;
			$month = substr( $d["start_date"], 5, 2 ) ;
			$year = substr( $d["start_date"], 0, 4 ) ;
			$d["start_date"] = mktime( 0, 0, 0, $month, $day, $year ) ;
		} else {
			$d["start_date"] = 0;
		}
		if( ! empty( $d["end_date"] ) ) {
			$day = substr( $d["end_date"], 8, 2 ) ;
			$month = substr( $d["end_date"], 5, 2 ) ;
			$year = substr( $d["end_date"], 0, 4 ) ;
			$d["end_date"] = mktime( 0, 0, 0, $month, $day, $year ) ;
		} else {
			$d["end_date"] = 0;
		}
		$fields = array('(amount' => vmRequest::getFloat('amount'), 
								'is_percent' => vmRequest::getInt('is_percent'), 
								'start_date' => $d["start_date"], 
								'end_date' => $d["end_date"]
								);
		$db->buildQuery('INSERT', '#__{vm}_product_discount', $fields );
		$db->query() ;
		
		$GLOBALS['vmLogger']->info( 'The Product Discount has been added.');
		$_REQUEST['discount_id'] = $db->last_insert_id() ;
		
		return True ;
	
	}
	
	/**
	 * updates discount information
	 *
	 * @param array $d
	 * @return boolean
	 */
	function update( &$d ) {
		$db = new ps_DB( ) ;
		
		if( ! $this->validate_update( $d ) ) {
			return False ;
		}
		if( ! empty( $d["start_date"] ) ) {
			$day = substr( $d["start_date"], 8, 2 ) ;
			$month = substr( $d["start_date"], 5, 2 ) ;
			$year = substr( $d["start_date"], 0, 4 ) ;
			$d["start_date"] = mktime( 0, 0, 0, $month, $day, $year ) ;
		} else {
			$d["start_date"] = "" ;
		}
		if( ! empty( $d["end_date"] ) ) {
			$day = substr( $d["end_date"], 8, 2 ) ;
			$month = substr( $d["end_date"], 5, 2 ) ;
			$year = substr( $d["end_date"], 0, 4 ) ;
			$d["end_date"] = mktime( 0, 0, 0, $month, $day, $year ) ;
		} else {
			$d["end_date"] = "" ;
		}

		$fields = array('(amount' => vmRequest::getFloat('amount'), 
								'is_percent' => vmRequest::getInt('is_percent'), 
								'start_date' => $d["start_date"], 
								'end_date' => $d["end_date"]
								);
		$db->buildQuery('UPDATE', '#__{vm}_product_discount', $fields, 'WHERE discount_id=' .(int)$d["discount_id"] );
		$db->query() ;
		
		$GLOBALS['vmLogger']->info( 'The Product Discount has been updated.');
		
		return True ;
	}
	
	/**
	 * Controller for Deleting Records.
	 */
	function delete( &$d ) {
		
		$record_id = $d["discount_id"] ;
		
		if( is_array( $record_id ) ) {
			foreach( $record_id as $record ) {
				if( ! $this->delete_record( $record, $d ) )
					return false ;
			}
			return true ;
		} else {
			return $this->delete_record( $record_id, $d ) ;
		}
	}
	/**
	 * Deletes one Record.
	 */
	function delete_record( $record_id, &$d ) {
		global $db ;
		
		if( ! $this->validate_delete( $record_id ) ) {
			return False ;
		}
		$q = 'DELETE FROM #__{vm}_product_discount WHERE discount_id='.(int)$record_id;
		$db->query( $q ) ;
		$q = 'UPDATE #__{vm}_product SET product_discount_id=0 WHERE product_discount_id='.(int)$record_id;
		$db->query( $q ) ;
		
		return True ;
	}

	/**
	 * Builds a select list of all discounts.
	 *
	 * @param int $discount_id
	 * @return boolean
	 */
	function discount_list( $discount_id = 0 ) {
		global $VM_LANG, $option ;
		$db = new ps_DB( ) ;
		$html = "" ;
		$db->query( "SELECT * FROM #__{vm}_product_discount" ) ;
		
		if( $db->num_rows() > 0 ) {
			$html = "<select name=\"product_discount_id\" class=\"inputbox\" onchange=\"updateDiscountedPrice();\">\n" ;
			$html .= "<option id=\"*1\" value=\"0\">" . $VM_LANG->_('PHPSHOP_INFO_MSG_VAT_ZERO_LBL') . "</option>\n" ;
			while( $db->next_record() ) {
				if( $db->f( "is_percent" ) ) {
					$id = "*" . (100 - $db->f( "amount" )) / 100 ;
				} else
					$id = "-" . $db->f( "amount" ) ;
				$selected = $db->f( "discount_id" ) == $discount_id ? "selected=\"selected\"" : "" ;
				$html .= "<option id=\"$id\" value=\"" . $db->f( "discount_id" ) . "\" $selected>" . $db->f( "amount" ) ;
				$html .= $db->f( "is_percent" ) == "1" ? "%" : $_SESSION['vendor_currency'] ;
				$html .= "</option>\n" ;
			}
			$html .= "<option value=\"override\">Override</option>\n" ;
			$html .= "</select>\n" ;
		} else {
			$html = "<input type=\"hidden\" name=\"product_discount_id\" value=\"0\" />\n
      <a href=\"" . $_SERVER['PHP_SELF'] . "?option=$option&page=product.product_discount_form\" target=\"_blank\">" . $VM_LANG->_('PHPSHOP_PRODUCT_DISCOUNT_ADDDISCOUNT_TIP') . "</a>" ;
		}
		return $html ;
	}
}

?>