<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
* @version $Id: htmlTools.class.php,v 1.2 2005/09/25 18:49:29 soeren_nb Exp $
* @package virtuemart
* @subpackage classes
*
* @copyright (C) 2004-2005 Soeren Eberhardt
*
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
*
* www.mambo-phpshop.net
*/

/**
* This is the class for creating administration lists
*
* Usage:
* require_once( CLASSPATH . "pageNavigation.class.php" );
* require_once( CLASSPATH . "htmlTools.class.php" );
* // Create the Page Navigation
* $pageNav = new vmPageNav( $num_rows, $limitstart, $limit );
* 
* // Create the List Object with page navigation
* $listObj = new listFactory( $pageNav );
* 
* // print out the search field and a list heading
* $listObj->writeSearchHeader($PHPSHOP_LANG->_PHPSHOP_PRODUCT_LIST_LBL, IMAGEURL."ps_image/product_code.png", $modulename, "product_list");
* 
* // start the list table
* $listObj->startTable();
* 
* // these are the columns in the table
* $columns = Array(  "#" => "width=\"20\"", 
* 					"<input type=\"checkbox\" name=\"toggle\" value=\"\" onclick=\"checkAll(".$num_rows.")\" />" => "width=\"20\"",* 
* 					$PHPSHOP_LANG->_PHPSHOP_PRODUCT_LIST_NAME => '',
* 					$PHPSHOP_LANG->_PHPSHOP_PRODUCT_LIST_SKU => '',
* 					_E_REMOVE => "width=\"5%\""
* 				);
* $listObj->writeTableHeader( $columns );
* 	
* 	###BEGIN LOOPING THROUGH RECORDS ##########
* 	
* 	$listObj->newRow();
* 	
* 	// The row number
* 	$listObj->addCell( $pageNav->rowNumber( $i ) );
* 	
* 	// The Checkbox
* 	$listObj->addCell( mosHTML::idBox( $i, $db->f("product_id"), false, "product_id" ) );
* 	...
* 	###FINISH THE RECENT LOOP########
* 	$listObj->addCell( $ps_html->deleteButton( "product_id", $db->f("product_id"), "productDelete", $keyword, $limitstart ) );
* 
* 	$i++;
* 			
* 	####
* $listObj->writeTable();
* $listObj->endTable();
* $listObj->writeFooter( $keyword );
*
* @package VirtueMart
* @subpackage Classes
* @author soeren
*/
class listFactory {

	/** @var int the number of rows in the table */
	var $columnCount = 0;
	/** @var string css classes for alternating rows (row0 and row1 ) */
	var $alternateColors = "row0";
	/** @var int The column number */
	var $x = -1;
	/** @var int The row number */
	var $y = -1;
	/** @var array The table cells */
	var $cells = Array();
	/** @var vmPageNavigation The Page Navigation Object */
	var $pageNav;
	
	function listFactory( $pageNav=null ) {
	
		$this->pageNav = $pageNav;
	}
	
	/**
	* Writes the start of the button bar table
	*/
	function startTable() {
		?>
		<script type="text/javascript"><!--
		function MM_swapImgRestore() { //v3.0
			var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
		}
		//--></script>
		<table class="adminlist">
		<tr>
		<?php
	}
	/**
	* writes the table header cells
	* Array $columnNames["Product Name"] = "class=\"small\" id=\"bla\"
	*/
	function writeTableHeader( $columnNames ) {
		if( !is_array( $columnNames ))
			return false;
		else {
			$this->columnCount = count( $columnNames );
			foreach( $columnNames as $name => $attributes ) {
				$name = html_entity_decode( $name );
				echo "<th $attributes>$name</th>\n";
			}
			echo "</tr>\n";
		}
	}
	
	function newRow() {
		$this->y++;
		$this->x = 0;
	}
	
	function addCell( $data, $attributes="" ) {
	
		$this->cells[$this->y][$this->x]["data"] = $data;
		$this->cells[$this->y][$this->x]["attributes"] = $attributes;
		
		$this->x++;
	}
	
	/** 
	* Writes a table row with data
	* Array 
	* $row[0]["data"] = "Cell Value";
	* $row[0]["attributes"] = "align=\"center\"";
	*/
	function writeTable() {
		if( !is_array( $this->cells ))
			return false;
		
		else {
			foreach( $this->cells as $row ) {
				echo "<tr class=\"".$this->alternateColors."\">\n";
				foreach( $row as $cell ) {
					$value = $cell["data"];
					$attributes = $cell["attributes"];
					echo "<td  $attributes>$value</td>\n";
				}
				echo "</tr>\n";
				$this->alternateColors = ($this->alternateColors == "row1") ? "row0" : "row1";
			}
		}
	}
	
	function endTable() {
		echo "</table>\n";
	}
	
	/**
	* This creates a header above the list table, containing a search box
	* @param The Label for the list (will be used as list heading!)
	* @param The core module name (e.g. "product")
	* @param The page name (e.g. "product_list" )
	* @param Additional varaibles to include as hidden input fields
	*/
	function writeSearchHeader( $title, $image="", $modulename, $pagename) {
	
		global $sess, $keyword, $PHP_SELF, $PHPSHOP_LANG, $option;
	  
		if( !empty( $keyword ))
			$keyword = urldecode( $keyword );
		else
			$keyword = "";
		$category_id = mosGetParam( $_REQUEST, 'category_id', null);
		$search_date = mosGetParam( $_REQUEST, 'search_date', null);
		$show = mosGetParam( $_REQUEST, "show", "" );
		
		$header = "<form name=\"adminForm\" action=\"$PHP_SELF\" method=\"post\">
					<input type=\"hidden\" name=\"option\" value=\"$option\" />
					<input type=\"hidden\" name=\"page\" value=\"". $modulename . "." . $pagename . "\" />
					<input type=\"hidden\" name=\"task\" value=\"\" />\n
					<input type=\"hidden\" name=\"func\" value=\"\" />\n
					<input type=\"hidden\" name=\"boxchecked\" />\n";
		$header .= "<h2 class=\"adminListHeader\" style=\"background-image:url($image);\">$title</h2>\n";
		if( !empty( $pagename )) 
			$header .= "<div align=\"right\"><br/>
			<input class=\"inputbox\" type=\"text\" size=\"25\" name=\"keyword\" value=\"$keyword\" />
			<input class=\"button\" type=\"submit\" name=\"search\" value=\"".$PHPSHOP_LANG->_PHPSHOP_SEARCH_TITLE."\" />
			</div>";
		$header .= "<br style=\"clear:both;\" />";
		
		if ( !empty($search_date) ) // Changed search by date
			$header .= "<input type=\"hidden\" name=\"search_date\" value=\"$search_date\" />\n";
		
		if( !empty($show) ) {
			$header .= "<input type=\"hidden\" name=\"show\" value=\"$show\" />\n";
		}
		
		echo $header;
	}

	/**
	* This creates a list footer (page navigation)
	* @param The core module name (e.g. "product")
	* @param The page name (e.g. "product_list" )
	* @param The Keyword from a search by keyword
	* @param Additional varaibles to include as hidden input fields
	*/
	function writeFooter($keyword, $extra="") {
		
		if( $this->pageNav != null )
			$footer = $this->pageNav->getListFooter();
		else
			$footer = "";
			
		if(!empty( $extra )) {
			$extrafields = explode("&", $extra);
			array_shift($extrafields);
			foreach( $extrafields as $key => $value) {
				$field = explode("=", $value);
				$footer .= "<input type=\"hidden\" name=\"".$field[0]."\" value=\"".@$field[1]."\" />\n";
			}
		}
		$footer .= "</form>";
		
		echo $footer;
	}
}
/**
* This is the class for creating regular forms used in VirtueMart
*
* Usage: 
* //First create the object and let it print a form heading
* $formObj = &new formFactory( "My Form" );
* //Then Start the form
* $formObj->startForm();
* // Add necessary hidden fields
* $formObj->hiddenField( 'country_id', $country_id );
* 
* // Write your form with mixed tags and text fields
* // and finally close the form:
* $formObj->finishForm( $funcname, $modulename.'.country_list', $option );
*
* @package virtuemart
* @subpackage Core
* @author soeren
*/
class formFactory {
	/**
	* Constructor 
	* Prints  the Form Heading if provided
	*/
	function formFactory( $title = '' ) {
		if( $title != "" ) {
			echo "<div class=\"sectionname\">$title</div>";
		}
	}
	/** 
	* Writes the form start tag
	*/
	function startForm( $formname = 'adminForm', $extra = "" ) {
		echo '<form method="post" action="'. $_SERVER['PHP_SELF'] .'" name="'.$formname.'" '.$extra.'>';
	}
	
	function hiddenField( $name, $value ) {
		echo ' <input type="hidden" name="'.$name.'" value="'.$value.'" />
		';
	}
	/**
	* Writes necessary hidden input fields
	* and closes the form
	*/
	function finishForm( $func, $page, $option='com_phpshop' ) {
	
		$html = '
		<input type="hidden" name="func" value="'.$func.'" />
        <input type="hidden" name="page" value="'.$page.'" />
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="option" value="'.$option.'" />
		</form>
		';
		
		echo $html;
	}
}

/**
* Tab Creation handler
* @package VirtueMart
* @subpackage core
* @author Phil Taylor
* @author Soeren Eberhardt
* Modified to use Panel-in-Panel functionality
*/
class mShopTabs {
	/** @var int Use cookies */
	var $useCookies = 0;
    
    /** @var string Panel ID */
    var $panel_id;
    
	/**
	* Constructor
	* Includes files needed for displaying tabs and sets cookie options
	* @param int useCookies, if set to 1 cookie will hold last used tab between page refreshes
	* @param int show_js, if set to 1 the Javascript Link and Stylesheet will not be printed
	*/
	function mShopTabs($useCookies, $show_js, $panel_id) {
		global $mosConfig_live_site;
        if( $show_js == 1 ) {
            echo "<link id=\"tab-style-sheet\" type=\"text/css\" rel=\"stylesheet\" href=\"" . $mosConfig_live_site. "/components/com_phpshop/js/tabs/mm_tabpane.css\" />";
            echo "<script type=\"text/javascript\" src=\"". $mosConfig_live_site. "/components/com_phpshop/js/tabs/mm_tabpane.js\"></script>";
        }
        $this->useCookies = $useCookies;
        $this->panel_id = $panel_id;
	}

	/**
	* creates a tab pane and creates JS obj
	* @param string The Tab Pane Name
	*/
	function startPane($id){
		echo "<div class=\"tab-page\" id=\"".$id."\">";
		echo "<script type=\"text/javascript\">\n";
		echo "   var tabPane1".$this->panel_id." = new WebFXTabPane( document.getElementById( \"".$id."\" ), ".$this->useCookies." )\n";
		echo "</script>\n";
	}

	/**
	* Ends Tab Pane
	*/
	function endPane() {
		echo "</div>";
	}

	/*
	* Creates a tab with title text and starts that tabs page
	* @param tabText - This is what is displayed on the tab
	* @param paneid - This is the parent pane to build this tab on
	*/
	function startTab( $tabText, $paneid ) {
		echo "<div class=\"tab-page\" id=\"".$paneid."\">";
		echo "<h2 class=\"tab\">".$tabText."</h2>";
		echo "<script type=\"text/javascript\">\n";
		echo "  tabPane1".$this->panel_id.".addTabPage( document.getElementById( \"".$paneid."\" ) );";
		echo "</script>";
	}

	/*
	* Ends a tab page
	*/
	function endTab() {
		echo "</div>";
	}
}

class vmCommonHTML {

	/**
	* Writes a "Save Ordering" Button
	* @param int the number of rows
	*/
	function getSaveOrderButton( $num_rows, $funcname='reorder') {
		
		$n = $num_rows-1;
		return '<a href="javascript: document.adminForm.func.value = \''.$funcname.'\'; saveorder( '.$n.' );">
				<img src="images/filesave.png" border="0" width="16" height="16" alt="Save Order" /></a>';
	}
	function getOrderingField( $ordering ) {

		return '<input type="text" name="order[]" size="5" value="'. $ordering .'" class="text_area" style="text-align: center" />';

	}
	
	function getYesNoIcon( $condition, $pos_alt = "Published", $neg_alt = "Unpublished" ) {
		global $mosConfig_live_site;
		if( $condition===true || strtoupper( $condition ) == "Y" )
			return '<img src="'.$mosConfig_live_site.'/administrator/images/tick.png" border="0" alt="'.$pos_alt.'" />';
		else
			return '<img src="'.$mosConfig_live_site.'/administrator/images/publish_x.png" border="0" alt="'.$neg_alt.'" />';
	}
}


if ( !function_exists( "mosToolTip" ) ) {
    /**
    * Utility function to provide ToolTips
    * @param string ToolTip text
    * @param string Box title
    * @returns HTML code for ToolTip
    */
    function mosToolTip($tooltip, $title='Mambo ToolTip') {
        global $mosConfig_live_site;
        $tip = "<a href=\"#\" onmouseover=\"return overlib('" . $tooltip . "', CAPTION, '$title', BELOW, RIGHT);\" onmouseout=\"return nd();\"><img src=\"" . $mosConfig_live_site . "/images/M_images/con_info.png\" width=\"16\" height=\"16\" border=\"0\" alt=\"info\" /></a>";
        return $tip;
    }
}
function mm_ToolTip($tooltip, $title='Tip!', $icon = "{mosConfig_live_site}/images/M_images/con_info.png" ) {
    global $mosConfig_live_site;
    if( !defined( "_OVERLIB_LOADED" )) {
        mosCommonHTML::loadOverlib();
        define ( "_OVERLIB_LOADED", "1" );
    }
    $varname = "html_".uniqid("l");
    $tip = "<script type=\"text/javascript\">//<![CDATA[
    var $varname = '$tooltip';
    //]]></script>\n";
    $tip .= "<a href=\"#\" onmouseover=\"return overlib($varname, CAPTION, '$title', ABOVE, VAUTO );\" onmouseout=\"return nd();\">";
    if( stristr( $icon, "{mosConfig_live_site}" ))
        $tip .= "<img alt=\"ToolTip\" src=\"".str_replace( "{mosConfig_live_site}", $mosConfig_live_site, $icon)."\" border=\"0\" width=\"16\" height=\"16\" />";
    else {
        // assume it's Text
        $tip .= $icon;
    }
    $tip .= "</a>";
    return $tip;
}

// borrowed from mambo.php
function shopMakeHtmlSafe( $string, $quote_style=ENT_QUOTES, $exclude_keys='' ) {
	
	$string = htmlentities( $string, $quote_style );
	return $string;
}

function mm_showMyFileName( $filename ) {
    
    if (DEBUG == '1' ) {
        if( !defined( "_OVERLIB_LOADED" )) {
			mosCommonHTML::loadOverlib();
            define ( "_OVERLIB_LOADED", "1" );
        }
        echo mm_ToolTip(addslashes("<div class='inputbox'>Begin of File: $filename</div>"));
    }
}
/**
* Wraps HTML Code or simple Text into Javascript
* and uses the noscript Tag to support browsers with JavaScript disabled
**/
function mm_writeWithJS( $textToWrap, $noscriptText ) {
    $text = "";
    if( !empty( $textToWrap )) {
        $text = "<script type=\"text/javascript\">//<![CDATA[
            document.write('".str_replace("\\\"", "\"", addslashes( $textToWrap ))."');
            //]]></script>\n";
    }
    if( !empty( $noscriptText )) {
        $text .= "<noscript>
            $noscriptText
            </noscript>\n";
    }
    return $text;
}

?>