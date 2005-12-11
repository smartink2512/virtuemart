<?php
/**
* mambo-phphop Product Scroller Module
* NOTE: THIS MODULE REQUIRES AN INSTALLED MAMBO-PHPSHOP COMPONENT!
*
* @version $Id: mod_productscroller.php,v 1.6 2005/11/07 20:22:28 soeren_nb Exp $
* @package VirtueMart
* @subpackage modules
* 
* @copyright (C) 2005 Soeren Eberhardt
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*
* VirtueMart is Free Software.
* VirtueMart comes with absolute no warranty.
*
* www.virtuemart.net
*/
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

global $my;

/* Load the virtuemart main parse code */
require_once( $mosConfig_absolute_path.'/components/com_virtuemart/virtuemart_parser.php' );

/**
* This class sets all Parameters.
* Must first call the MOS function, something like: 
* $params = mosParseParams( $module->params );
* and send the $params variable to this class (productScroller)
* @param $params the results from mosParseParams( $module->params );
* @example $scroller = new productScroller($params);
*/
class productScroller {
	/**
  * @var $NumberOfProducts
  */
	var $NumberOfProducts = 5;
	/**
  * // scroll, alternate, slide
  * @var $ScrollBehavior
  */
	var $ScrollBehavior = 'scroll';
	/**
  * @var $PS_DIRECTION
  */
	var $ScrollDirection = 'up';
	/**
  * @var $ScrollHeight
  */
	var $ScrollHeight = '125';
	/**
  * @var $ScrollWidth
  */
	var $ScrollWidth = '150';
	/**
  * @var $ScrollAmount
  */
	var $ScrollAmount = '2';
	/**
  * @var $ScrollDelay
  */
	var $ScrollDelay = '80';
	/**
  * @var $ScrollAlign
  */
	var $ScrollAlign = 'center';
	/**
  * // newest [asc], oldest [desc], random [rand]
  * @var $SortMethod
  */
	var $ScrollSortMethod = 'random';
	/**
  * @var $ScrollTitles
  */
	var $ScrollTitles = 'yes';
	/**
  * @var $ScrollSpaceChar
  */
	var $ScrollSpaceChar = '&nbsp;';
	/**
  * @var $ScrollSpaceCharTimes
  */
	var $ScrollSpaceCharTimes = 5;
	/**
  * @var $ScrollLineChar
  */
	var $ScrollLineChar = '<br />';
	/**
  * @var $ScrollLineCharTimes
  */
	var $ScrollLineCharTimes = 2;
	/**
  * @var $ScrollSection
  */
	var $ScrollSection = 0;

	// CSS override -----------------------
	/**
  * @var $ScrollCSSOverride
  */
	var $ScrollCSSOverride = 'no';
	/**
  * @var $ScrollTextAlign
  */
	var $ScrollTextAlign = 'left';
	/**
  * @var $ScrollTextWeight
  */
	var $ScrollTextWeight = 'normal';
	/**
  * @var $ScrollTextSize
  */
	var $ScrollTextSize = '10';
	/**
  * @var $ScrollTextColor
  */
	var $ScrollTextColor = '#000000';
	/**
  * @var $ScrollBGColor
  */
	var $ScrollBGColor = 'transparent';
	/**
  * @var $ScrollMargin
  */
	var $ScrollMargin = '2';

	/**
  * sort variables used by the returnSortType() function
  */
	var $sort_asc  = 'newest';
	var $sort_desc = 'oldest';
	var $sort_rand = 'random';
	var $params;
	/**
* set mammeters
*/ 
	function productScroller (&$params) {

		$this->params = $params;
		// standard mammeters
		$this->show_product_name              =  $params->get('show_product_name', "yes");
		$this->show_addtocart              =  $params->get('show_addtocart', "yes");
		$this->show_price              =  $params->get('show_price', "yes");
		$this->NumberOfProducts              =  $params->get('NumberOfProducts', $this->NumberOfProducts);
		$this->ScrollSection     =  $params->get('ScrollSection', $this->ScrollSection);
		$this->ScrollBehavior           =  $params->get('ScrollBehavior', $this->ScrollBehavior);
		$this->ScrollDirection          =  $params->get('ScrollDirection', $this->ScrollDirection);
		$this->ScrollHeight             =  $params->get('ScrollHeight', $this->ScrollHeight);
		$this->ScrollWidth              =  $params->get('ScrollWidth', $this->ScrollWidth);
		$this->ScrollAmount             =  $params->get('ScrollAmount', $this->ScrollAmount);
		$this->ScrollDelay              =  $params->get('ScrollDelay', $this->ScrollDelay);
		$this->ScrollAlign              =  $params->get('ScrollAlign', $this->ScrollAlign);
		$this->ScrollSortMethod        =  $params->get('ScrollSortMethod', $this->ScrollSortMethod);
		$this->ScrollTitles             =  $params->get('ScrollTitles', $this->ScrollTitles);
		$this->ScrollSpaceChar         =  $params->get('ScrollSpaceChar', $this->ScrollSpaceChar);
		$this->ScrollSpaceCharTimes   =  $params->get('ScrollSpaceCharTimes', $this->ScrollSpaceCharTimes);
		$this->ScrollLineChar          =  $params->get('ScrollLineChar', $this->ScrollLineChar);
		$this->ScrollLineCharTimes    =  $params->get('ScrollLineCharTimes', $this->ScrollLineCharTimes);
		// customization mammeters
		$this->ScrollCSSOverride       =  $params->get('ScrollCSSOverride', $this->ScrollCSSOverride);
		$this->ScrollTextAlign          =  $params->get('ScrollTextAlign', $this->ScrollTextAlign);
		$this->ScrollTextWeight         =  $params->get('ScrollTextWeight', $this->ScrollTextWeight);
		$this->ScrollTextSize           =  $params->get('ScrollTextSize', $this->ScrollTextSize);
		$this->ScrollTextColor          =  $params->get('ScrollTextColor', $this->ScrollTextColor);
		$this->ScrollBGColor           =  $params->get('ScrollBGColor', $this->ScrollBGColor);
		$this->ScrollMargin             =  $params->get('ScrollMargin', $this->ScrollMargin);
	}

	/**
* Display Product Data
*/ 
	function displayScroller (&$rows) {
		global $mosConfig_absolute_path;

		$database = new ps_DB();
		require_once( CLASSPATH."ps_product.php" );
		$ps_product = new ps_product;

		$cnt=0;
		if($this->ScrollCSSOverride=='yes') {
			$txt_size = $this->ScrollTextSize . 'px';
			$margin = $this->ScrollMargin . 'px';
			//$height=($height-intval($margin+0));
			//$width=($width-intval($margin+30));
			echo $this->params->get( 'pretext', "");
			echo " <div style=\"text-align:".$this->ScrollAlign.";background-color: ".$this->ScrollBGColor."; width:".$this->ScrollWidth.";
                       margin-top: $margin; margin-right: $margin; margin-bottom: $margin; margin-left: $margin;\" >
               <marquee behavior=\"".$this->ScrollBehavior."\" 
                        direction=\"".$this->ScrollDirection."\"  
                        height=\"".$this->ScrollHeight."\"
                        width=\"".$this->ScrollWidth."\"
                        scrollamount=\"".$this->ScrollAmount."\"
                        scrolldelay=\"".$this->ScrollDelay."\"
                        truespeed=\"true\" onmouseover=\"this.stop()\" onmouseout=\"this.start()\"
                        style=\"text-align: ".$this->ScrollTextAlign."; color: ".$this->ScrollTextColor."; font-weight: ".$this->ScrollTextWeight."; font-size: $txt_size\;\" >"; 
		}
		else {

			echo " <div style=\"width:".$this->ScrollWidth.";text-align:".$this->ScrollAlign.";\">
               <marquee behavior=\"".$this->ScrollBehavior."\" 
                        direction=\"".$this->ScrollDirection."\"  
                        height=\"".$this->ScrollHeight."\"
                        width=\"".$this->ScrollWidth."\"
                        scrollamount=\"".$this->ScrollAmount."\"
                        scrolldelay=\"".$this->ScrollDelay."\"
                        truespeed=\"true\" onmouseover=\"this.stop()\" onmouseout=\"this.start()\">"; 
		}
		$show_addtocart = ( $this->show_addtocart == "yes" ) ? true : false;
		$show_price = ( $this->show_price == "yes" ) ? true : false;

		foreach($rows as $row) {
			$ps_product->show_snapshot( $row->product_sku, $show_price, $show_addtocart );

			if (($this->ScrollDirection=='left') || ($this->ScrollDirection=='right')) {
				for($i=0;$i<$this->ScrollSpaceCharTimes;$i++) {
					echo $this->ScrollSpaceChar;
				}
			} else {
				for($i=0;$i<$this->ScrollLineCharTimes;$i++) {
					echo $this->ScrollLineChar;
				}
			}
		}
		echo "    </marquee>
            </div>";
	} // end displayScroller

	/**
* Returns a converted mammeter value to an actual DB query element
*/ 
	function returnSortType($type) {
		$change_type='';
		switch($type) {
			case strncmp($type,$this->sort_asc,3): $change_type='ASC'; break;
			case strncmp($type,$this->sort_desc,3): $change_type='DESC'; break;
			default: $change_type='ASC'; break;
		}
		return $change_type;
	} // end returnSortType

} // end class productScroller

// start of Product Scroller Script
$params =& new mosParameters( $module->params );
$scroller =& new productScroller($params);


/**
* Load Products
**/ 
$rows = getProductSKU( $scroller->NumberOfProducts, $scroller->ScrollSortMethod, 0, $scroller->returnSortType($scroller->ScrollSortMethod)  );

/**
* Display Product Scroller
**/ 
$scroller->displayScroller($rows);

/**
* Helper DB function
*/
function getProductSKU( $limit=0, $how=null, $category_id=0, $order='asc' ) {
	global $my, $mosConfig_offset;
	
	$database = new ps_DB();
	
	if($limit>0) {
		$limit = "LIMIT $limit";
	} else {
		$limit = "";
	}

	$query = "SELECT p.product_sku FROM #__{vm}_product AS p";

	if( $category_id != 0 )
	$query .= "\nJOIN #__{vm}_product_category_xref as pc ON p.product_id=pc.product_id AND pc.category_id='$category_id'";

	$query .= "\n WHERE p.product_publish = 'Y' AND product_parent_id=0 ";
	if( CHECK_STOCK && PSHOP_SHOW_OUT_OF_STOCK_PRODUCTS != "1") {
		$query .= " AND product_in_stock > 0 ";
	}
	switch( $how ) {
		case 'random':
		$query .= "\n ORDER BY RAND() $limit";
		break;
		default:
		$query .= "\n ORDER BY cdate $order $limit";
		break;
	}
	$database->query( $query );

	$rows = $database->record;
	return $rows;
}

?>
