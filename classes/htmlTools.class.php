<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
* This file contains functions and classes for common html tasks
*
* @version $Id$
* @package VirtueMart
* @subpackage classes
* @copyright Copyright (C) 2004-2006 Soeren Eberhardt. All rights reserved.
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
* $listObj->writeSearchHeader($VM_LANG->_PHPSHOP_PRODUCT_LIST_LBL, IMAGEURL."ps_image/product_code.png", $modulename, "product_list");
* 
* // start the list table
* $listObj->startTable();
* 
* // these are the columns in the table
* $columns = Array(  "#" => "width=\"20\"", 
* 					"<input type=\"checkbox\" name=\"toggle\" value=\"\" onclick=\"checkAll(".$num_rows.")\" />" => "width=\"20\"",* 
* 					$VM_LANG->_PHPSHOP_PRODUCT_LIST_NAME => '',
* 					$VM_LANG->_PHPSHOP_PRODUCT_LIST_SKU => '',
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

	/** @var int the number of columns in the table */
	var $columnCount = 0;
	/** @var array css classes for alternating rows (row0 and row1 ) */
	var $alternateColors;
	/** @var int The column number */
	var $x = -1;
	/** @var int The row number */
	var $y = -1;
	/** @var array The table cells */
	var $cells = Array();
	/** @var vmPageNavigation The Page Navigation Object */
	var $pageNav;
	/** @var int The smallest number of results that shows the page navigation */
	var $_resultsToShowPageNav = 6;
	
	function listFactory( $pageNav=null ) {
		if( defined('_PSHOP_ADMIN')) {
			$this->alternateColors = array( 0 => 'row0', 1 => 'row1' );
		}
		else {
			$this->alternateColors = array( 0 => 'sectiontableentry1', 1 => 'sectiontableentry2' );
		}
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
		} //-->
		</script>
		<table class="adminlist" width="100%">
		<?php
	}
	/**
	* writes the table header cells
	* Array $columnNames["Product Name"] = "class=\"small\" id=\"bla\"
	*/
	function writeTableHeader( $columnNames ) {
		if( !is_array( $columnNames ))
			$this->columnCount = intval( $columnNames );
		else {
			$this->columnCount = count( $columnNames );
			echo '<tr>';
			foreach( $columnNames as $name => $attributes ) {
				$name = html_entity_decode( $name );
				echo "<th class=\"title\" $attributes>$name</th>\n";
			}
			echo "</tr>\n";
		}
	}
	
	function newRow( $attributes='' ) {
		$this->y++;
		if( $attributes ) {
			$this->cells[$this->y]["attributes"] = $attributes;
		}
		
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
			$i = 0;
			foreach( $this->cells as $row ) {
				echo "<tr class=\"".$this->alternateColors[$i]."\" ".@$row['attributes'].">\n";
				foreach( $row as $cell ) {
					if( $cell['data'] == 'i' && !isset($cell['data'])) continue;
					$value = $cell["data"];
					$attributes = $cell["attributes"];
					echo "<td  $attributes>$value</td>\n";
				}
				echo "</tr>\n";
				$i == 0 ? $i++ : $i--;
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
	
		global $sess, $keyword, $VM_LANG, $vmDir;
	  
		if( !empty( $keyword )) {
			$keyword = urldecode( $keyword );
		}
		else {
			$keyword = "";
		}
		$category_id = mosGetParam( $_REQUEST, 'category_id', null);
		$no_menu = mosGetParam( $_REQUEST, 'no_menu', 0 );
		$search_date = mosGetParam( $_REQUEST, 'search_date', null);
		$show = mosGetParam( $_REQUEST, "show", "" );
		
		$header = "<form name=\"adminForm\" action=\"".$_SERVER['PHP_SELF']."\" method=\"post\">
					<input type=\"hidden\" name=\"option\" value=\"$vmDir\" />
					<input type=\"hidden\" name=\"page\" value=\"". $modulename . "." . $pagename . "\" />
					<input type=\"hidden\" name=\"task\" value=\"\" />\n
					<input type=\"hidden\" name=\"func\" value=\"\" />\n
					<input type=\"hidden\" name=\"no_menu\" value=\"$no_menu\" />\n
					<input type=\"hidden\" name=\"boxchecked\" />\n";
		if( defined( "_PSHOP_ADMIN") || @$_REQUEST['pshop_mode'] == "admin"  )
            $header .= "<input type=\"hidden\" name=\"pshop_mode\" value=\"admin\" />\n";
        if( $title != "" ) {
        	$style = ($image != '') ? 'style="background-image:url('.$image.');"' : '';
        	$header .= "<h2 class=\"adminListHeader\" $style>$title</h2>\n";
        }
        $header .= '<a name="listheader"></a>';
		if( !empty( $pagename )) 
			$header .= "<div align=\"right\"><br/>
			<input class=\"inputbox\" type=\"text\" size=\"25\" name=\"keyword\" value=\"$keyword\" />
			<input class=\"button\" type=\"submit\" name=\"search\" value=\"".$VM_LANG->_PHPSHOP_SEARCH_TITLE."\" />
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
		$footer= "";
		if( $this->pageNav !== null ) {
			if( $this->_resultsToShowPageNav <= $this->pageNav->total ) {
		
				$footer = $this->pageNav->getListFooter();
			}
		}
		else {
			$footer = "";
		}
			
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
* $formObj->finishForm( $funcname, $modulename.'.country_list', $vmDir );
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
			echo "<div class=\"adminListHeader\">$title</div><br style=\"clear:both;\" />";
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
	function finishForm( $func, $page, $vmDir='com_virtuemart' ) {
		$no_menu = mosGetParam( $_REQUEST, 'no_menu' );
		
		$html = '
		<input type="hidden" name="func" value="'.$func.'" />
        <input type="hidden" name="page" value="'.$page.'" />
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="option" value="'.$vmDir.'" />';
		if( $no_menu ) {
			$html .= '<input type="hidden" name="ajax_request" value="1" />';
			$html .= '<input type="hidden" name="no_menu" value="1" />';
		}
        if( defined( "_PSHOP_ADMIN") || @$_REQUEST['pshop_mode'] == "admin"  ) {
        	$html .= '<input type="hidden" name="pshop_admin" value="admin" />';
        }
        $html .= '
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
            echo "<link id=\"tab-style-sheet\" type=\"text/css\" rel=\"stylesheet\" href=\"" . $mosConfig_live_site. "/components/com_virtuemart/js/tabs/mm_tabpane.css\" />";
            echo "<script type=\"text/javascript\" src=\"". $mosConfig_live_site. "/components/com_virtuemart/js/tabs/mm_tabpane.js\"></script>";
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
	
class vmMooAjax {

	/**
	 * This is used to print out Javascript code for the moo.ajax script
	 *
	 * @param string $url
	 * @param string $updateId
	 * @param string $onComplete A JS function name to be called after the HTTP transport has been finished
	 * @param array $vmDirs
	 * @param string $varName The name of a variable the ajax object is assigned to
	 */
	function writeAjaxUpdater( $url, $updateId, $onComplete, $method='post', $vmDirs=array(), $varName='' ) {
		echo vmMooAjax::getAjaxUpdater($url, $updateId, $onComplete, $method, $vmDirs, $varName);
	}
	
	function getAjaxUpdater( $url, $updateId, $onComplete, $method='post', $vmDirs=array(), $varName='' ) {
		global $mosConfig_live_site;
		
		vmCommonHTML::loadMooAjax();
		
		$path = defined('_PSHOP_ADMIN' ) ? '/administrator/' : '/';
		$vmDirs['method'] = $method;
		$html = '';
		if( $varName ) {
			$html .= 'var '.$varName.' = ';
		}
		if( !strstr( $url, $mosConfig_live_site) && !strstr($url, 'http' )) {
			$url = $mosConfig_live_site.$path.$url;
		}
		$html .= "new ajax('$url', {\n";
		foreach ($vmDirs as $key => $val) {
			if( strstr( $val, '.')) {
				$html .= "$key: $val,\n";
			}
			else {
				$html .= "$key: '$val',\n";
			}
		}
		if( $updateId != '' ) {
			$html .= "update: '$updateId'";
			if( $onComplete ) { $html .= ",\n"; }
		}
		if( $onComplete ) {
			$html .= "onComplete: $onComplete";
		}
		$html .= '
		});';
		
		return $html;
	}
}
/**
 * Heavily modified (why just for PHP5???) version of this class:
 * http://www.phpclasses.org/browse/package/3050.html
 * To easily create mootools effects
 * @author Hasin Hayder
 * @author soeren
 * @since VirtueMart 1.1.0
 */
class mooFxGenerator {
	
	/**
	 * general effect generator function
	 * @static 
	 * @param string $effectType
	 */
	function generate( $effectType, $element='', $eventObjectClass='', $duration=false, $transition=false, $opacity=false, $height=false, $width=false, $unit=false) {
		vmCommonHTML::loadMooFX();
		
		echo "<script type=\"text/javascript\">\n";

		$fxEffectObject = "m_" . (strtotime("now")+mt_rand(0,1000000));
		$fxToggleFunction = "mt_" . (strtotime("now")+mt_rand(0,1000000));
		if( !$effectType == 'fxAccordion') {
			echo "function {$fxToggleFunction}()\n";
			echo "{\n";
			switch( $effectType ) {
				case "fxText":
					echo "	{$fxEffectObject}.increase();\n";
				
				case "fxScroll":
					echo "	{$fxEffectObject}.scrollTo(\"$element\");\n";
				
				default:
					echo "	{$fxEffectObject}.toggle();\n";
			}
			echo "}\n";
		}
		switch( $effectType ) {
			
			case "fxHeight":
				echo "var {$fxEffectObject} = new Fx.Height(\"$element\", {duration: $duration})\n";
				break;
				
			case "fxOpacity":
				echo "var {$fxEffectObject} = new Fx.Opacity(\"$element\", {duration: $duration})\n";
				break;
				
			case "fxText":
				echo "var {$fxEffectObject} = new Fx.Text(\"$element\", {unit:$unit})\n";
				break;
				
			case "fxWidth":
				echo "var {$fxEffectObject} = new Fx.Width(\"$element\", {duration: $duration})\n";
				break;
				
			case "fxScroll":
				$effectString = "";
				if ($transition()) $effectString.=", transition: $transition";
				echo "var {$fxEffectObject} = new Fx.Scroll({duration: $duration{$effectString}})\n";
				break;
				
			case "fxCombo":
				$effectString = "";
				if ($height) $effectString .= ", height: true";
				if ($width) $effectString .= ", width: true";
				if ($opacity) $effectString .= ", opacity: true";
				echo "var {$fxEffectObject} = new Fx.Combo(\"$element\", {duration: $duration{$effectString}})\n";
				break;
				
			case "fxAccordion":
		
				$effectString = "";
				if ($height) $effectString .= ", height: true";
				if ($width) $effectString .= ", width: true";
				if ($opacity) $effectString .= ", opacity: true";
				if ($transition) $effectString .= ", transition: $transition";
	
				echo "m_stretchers = document.getElementsByClassName(\"$eventObjectClass\");\n";
				echo "m_stretched = document.getElementsByClassName(\"$element\");\n";
				echo "var {$fxEffectObject} = new Fx.Accordion(m_stretchers, m_stretched ,{duration: $duration{$effectString}});\n";
				break;
		}

		if( $effectType != "fxAccordion" && $eventObjectClass != '' ) {
			echo "m_$eventObjectClass = $(\"$eventObjectClass\");\n";
			echo "m_$eventObjectClass.onclick={$fxToggleFunction};\n";
		}
		echo "</script>\n";
		
		$return['function'] = $fxToggleFunction;
		$return['object'] = $fxEffectObject;
		return $return;
	}

}

/**
 * This is the class offering functions for common HTML tasks
 *
 */
class vmCommonHTML extends mosHTML {
	/**
	 * function to create a hyperlink
	 *
	 * @param string $link
	 * @param string $text
	 * @param string $target
	 * @param string $title
	 * @param string $attributes
	 * @return string
	 */
	function hyperLink( $link, $text, $target='', $title='', $attributes='' ) {
	
		if( $target ) {
			$target = ' target="'.$target.'"';
		}
		if( $title ) {
			$title = ' title="'.$title.'"';
		}
		if( $attributes ) {
			$attributes = ' ' . $attributes;
		}
		return '<a href="'.$link.'"'.$target.$title.$attributes.'>'.$text.'</a>';
	}
	/**
	 * Function to create an image tag
	 *
	 * @param string $src
	 * @param string $alt
	 * @param int $height
	 * @param int $width
	 * @param string $title
	 * @param int $border
	 * @param string $attributes
	 * @return string
	 */
	function imageTag( $src, $alt='', $align='', $height='', $width='', $title='', $border='0', $attributes='' ) {
		
		$alt = ' alt="'.$alt.'"';
		if( $align ) { $align = ' align="'.$align.'"'; }
		if( $height ) { $height = ' height="'.$height.'"'; }
		if( $width ) { $width = ' width="'.$width.'"'; }
		if( $title ) { $title = ' title="'.$title.'"'; }
		if( $attributes ) {	$attributes = ' ' . $attributes; }
		
		$border = ' border="'.$border.'"';
		
		return '<img src="'.$src.'"'.$alt.$align.$title.$height.$width.$border.$attributes.' />';
	}
	/**
	 * Returns a properly formatted XHTML List
	 *
	 * @param array $listitems
	 * @param string $type Can be ul, ol, ...
	 * @param string $style
	 * @return string
	 */
	function getList( $listitems, $type = 'ul', $style='' ) {
		if( $style ) {
			$style = 'style="'.$style.'"';
		}
		$html  = '<' . $type ." $style>\n";
		foreach( $listitems as $item ) {
			$html .= '<li>' . $item . "</li>\n";
		}
		$html  .= '</' . $type .">\n";
		
		return $html;
	}
	/**
	 * Returns a script tag. The referenced script will be fetched by a 
	 * PHP script called "fetchscript.php"
	 * That allows use gzip compression, so bigger Javascripts don't steal our bandwith
	 *
	 * @param string $src The script src reference
	 * @param string $content A Javascript Text to include in a script tag
	 * @return string
	 */
	function scriptTag( $src='', $content = '' ) {
		global $mosConfig_gzip, $mosConfig_live_site;
		if( $src == '' && $content == '' ) return;
		
		if( $src ) {
			$urlpos = strpos( $src, '?' );			
			$url_params = '';
			
			if( $urlpos ) {
				$url_params = '&amp;'.substr( $src, $urlpos );
				$src = substr( $src, 0, $urlpos);
			}
			if( stristr( $src, 'com_virtuemart' ) && !stristr( $src, '.php' )) {
				$base_source = str_replace( $mosConfig_live_site, '', $src );
				$base_source = str_replace( '/components/com_virtuemart', '', $base_source);
				$base_source = str_replace( 'components/com_virtuemart', '', $base_source);
				$src = $mosConfig_live_site.'/components/com_virtuemart/fetchscript.php?gzip='.$mosConfig_gzip.'&amp;subdir='.dirname( $base_source ) . '&amp;file=' . basename( $src );
			}
			
			return '<script src="'.$src.@$url_params.'" type="text/javascript"></script>'."\n";
		}
		
		if( $content ) {
			return "<script type=\"text/javascript\">\n".$content."\n</script>\n";
		}
		
	}
	/**
	 * Returns a link tag
	 *
	 * @param string $href
	 * @param string $type
	 * @param string $rel
	 * @return string
	 */
	function linkTag( $href, $type='text/css', $rel = 'stylesheet', $media="screen, projection" ) {
		global $mosConfig_gzip, $mosConfig_live_site;
		if( stristr( $href, 'com_virtuemart' )) {
			$base_href = str_replace( $mosConfig_live_site, '', $href );
			$base_href = str_replace( 'components/com_virtuemart/', '', $base_href);
			$href = $mosConfig_live_site.'/components/com_virtuemart/fetchscript.php?gzip='.$mosConfig_gzip.'&amp;subdir='.dirname( $base_href ) . '&amp;file=' . basename( $href );
		}
		return '<link type="'.$type.'" href="'.$href.'" rel="'.$rel.'" media="'.$media.'" />'."\n";
		
	}
	/**
	* Writes a "Save Ordering" Button
	* @param int the number of rows
	*/
	function getSaveOrderButton( $num_rows, $funcname='reorder') {
		global $mosConfig_live_site;
		$n = $num_rows-1;
		$html = '<a href="javascript: document.adminForm.func.value = \''.$funcname.'\'; saveorder( '.$n.' );">
				<img src="'.$mosConfig_live_site.'/administrator/images/filesave.png" border="0" width="16" height="16" alt="Save Order" /></a>';
		$html .= '<a href="javascript: if( confirm( \'Are you sure to sort this list alphabetically? This cannot be undone.\')) { document.adminForm.func.value = \''.$funcname.'\'; document.adminForm.task.value=\'sort_alphabetically\'; document.adminForm.submit(); }">
				<img src="'.IMAGEURL.'/ps_image/sort_a-z.gif" border="0" width="16" height="16" alt="Sort Alphabetically" /></a>';
		
		return $html;
	}
	function getOrderingField( $ordering ) {

		return '<input type="text" name="order[]" size="5" value="'. $ordering .'" class="text_area" style="text-align: center" />';

	}
	
	function getYesNoIcon( $condition, $pos_alt = "Published", $neg_alt = "Unpublished" ) {
		global $mosConfig_live_site;
		if( $condition===true || strtoupper( $condition ) == "Y" || $condition == '1' ) {
			return '<img src="'.$mosConfig_live_site.'/administrator/images/tick.png" border="0" alt="'.$pos_alt.'" />';
		}
		else {
			return '<img src="'.$mosConfig_live_site.'/administrator/images/publish_x.png" border="0" alt="'.$neg_alt.'" />';
		}
	}
	/**
	 * Manipulates an array and fills the $index with selected="selected"
	 * Indexes within $disableArr will be filled with disabled="disabled"
	 *
	 * @param array $arr
	 * @param int $index
	 * @param string $att
	 * @param array $disableArr
	 */
	function setSelectedArray( &$arr, $index, $att='selected', $disableArr=array() ) {
		if( !isset($arr[$index])) {
			return;
		}
		foreach( $arr as $key => $val ) {
			$arr[$key] = '';
			if( $key == $index ) {
				$arr[$key] = $att.'="'.$att.'"';
			}
			elseif( in_array( $key, $disableArr )) {
				$arr[$key] = 'disabled="disabled"';
			}
		}
	}
	
	/**
	 * tests for template/default pathway arrow separator
	 * @author FTW Stroker
	 * @static 
	 * @return string The separator for the pathway breadcrumbs
	 */
	function pathway_separator() {
		global $mainframe, $mosConfig_absolute_path, $mosConfig_live_site;
		$imgPath =  'templates/' . $mainframe->getTemplate() . '/images/arrow.png';
		if (file_exists( "$mosConfig_absolute_path/$imgPath" )){
			$img = '<img src="' . $mosConfig_live_site . '/' . $imgPath . '" border="0" alt="arrow" />';
		} else {
			$imgPath = '/images/M_images/arrow.png';
			if (file_exists( $mosConfig_absolute_path . $imgPath )){
				$img = '<img src="' . $mosConfig_live_site . '/images/M_images/arrow.png" alt="arrow" />';
			} else {
				$img = '&gt;';
			}
		}
		return $img;
	}
	
	/*
	* Loads all necessary files for JS Overlib tooltips
	*/
	function loadOverlib() {
		global  $mosConfig_live_site, $mainframe;
		if( !defined( "_OVERLIB_LOADED" )) {
			$scripttag = '<script language="Javascript" type="text/javascript" src="'.$mosConfig_live_site.'/includes/js/overlib_mini.js"></script>
			<div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>';
			if( defined('_PSHOP_ADMIN')) {
				echo $scripttag;
			}
			else {
				$mainframe->addCustomHeadTag( $scripttag );
			}
			define ( "_OVERLIB_LOADED", "1" );
		}
	}
	/**
	* Loads all necessary script files for Moo.Ajax
	* http://docs.mootools.net/files/Addons/Ajax-js.html
	* @static 
	* @since VirtueMart 1.1.0
	*/
	function loadMooAjax( $print=false ) {
		global $mosConfig_live_site, $vmDir, $mainframe;
		if( !defined( "_MOOAJAX_LOADED" )) {
			$scripttag = vmCommonHTML::scriptTag( $mosConfig_live_site .'/components/'. $vmDir .'/js/mootools/mootools.base.js' );
			$scripttag .= vmCommonHTML::scriptTag( $mosConfig_live_site .'/components/'. $vmDir .'/js/mootools/mootools.dom.js' );
			$scripttag .= vmCommonHTML::scriptTag( $mosConfig_live_site .'/components/'. $vmDir .'/js/mootools/mootools.ajax.js' );
			if( defined('_PSHOP_ADMIN') || $print ) {
				echo $scripttag;
			}
			else {
				$mainframe->addCustomHeadTag( $scripttag );
			}
			define ( "_MOOAJAX_LOADED", "1" );
		}
	}
	/**
	 * Function to include the MooTools Fx JS scripts in the HTML document
	 * http://mootools.net
	 * @static 
	 * @since VirtueMart 1.1.0
	 *
	 */
	function loadMooFX( $print=false ) {
		global $mosConfig_live_site, $vmDir, $mainframe;
		if( !defined( "_MOOTOOLSFX_LOADED" )) {
			$scripttag = '';
		
			$scripttag = vmCommonHTML::scriptTag( $mosConfig_live_site .'/components/'. $vmDir .'/js/mootools/mootools.base.js' );
			$scripttag .= vmCommonHTML::scriptTag( $mosConfig_live_site .'/components/'. $vmDir .'/js/mootools/mootools.fx.js' );
			$scripttag .= vmCommonHTML::scriptTag( $mosConfig_live_site .'/components/'. $vmDir .'/js/mootools/mootools.fxpack.js' );
			$scripttag .= vmCommonHTML::scriptTag( $mosConfig_live_site .'/components/'. $vmDir .'/js/mootools/mootools.fxutils.js' );
			$scripttag .= vmCommonHTML::scriptTag( $mosConfig_live_site .'/components/'. $vmDir .'/js/mootools/mootools.fxtransitions.js' );
			$scripttag .= vmCommonHTML::scriptTag( $mosConfig_live_site .'/components/'. $vmDir .'/js/mootools/mootools.accordion.js' );
			if( defined('_PSHOP_ADMIN') || $print ) {
				echo $scripttag;
			}
			else {
				$mainframe->addCustomHeadTag( $scripttag );
			}
			define ( "_MOOTOOLSFX_LOADED", "1" );
		}
		
	}
	/**
	 * Function to load the javascript and stylsheet files for Litebox,
	 * a Lightbox derivate with mootools and prototype.lite
	 * http://www.doknowevil.net/litebox/
	 *
	 * @param boolean $print
	 */
	function loadLiteBox( $print=false ) {
		global $mosConfig_live_site, $vmDir, $mainframe;
		if( !defined( '_LITEBOX_LOADED' )) {
			
			vmCommonHTML::loadMooFx( $print );
			
			$scripttag = vmCommonHTML::scriptTag( '', 'var liteboxurl = \''.$mosConfig_live_site.'/components/'. $vmDir .'/js/litebox/\';');
			$scripttag .= vmCommonHTML::scriptTag( $mosConfig_live_site .'/components/'. $vmDir .'/js/litebox/litebox.js' );
			$scripttag .= vmCommonHTML::linkTag( $mosConfig_live_site .'/components/'. $vmDir .'/js/litebox/litebox.css' );
					
			if( defined('_PSHOP_ADMIN') || $print ) {
				echo $scripttag;
			}
			else {
				$mainframe->addCustomHeadTag( $scripttag );
			}
			define ( '_LITEBOX_LOADED', '1' );
		}	
	}
	/**
	 * Function to include the Lightbox JS scripts in the HTML document
	 * Type '2' => Source: http://www.huddletogether.com/projects/lightbox2/
	 * Type '_gw' => Source: http://blog.feedmarker.com/2006/02/12/how-to-make-better-modal-windows-with-lightbox/

	 * @static 
	 * @since VirtueMart 1.1.0
	 *
	 */
	function loadLightbox( $type = '2', $print=false ) {
		global $mosConfig_live_site, $vmDir, $mainframe;
		if( !defined( '_LIGHTBOX'.$type.'_LOADED' )) {
			
			vmCommonHTML::loadPrototype( $print );
			
			$scripttag = vmCommonHTML::scriptTag( '', 'var lightboxurl = \''.$mosConfig_live_site.'/components/'. $vmDir .'/js/lightbox'.$type.'/\';');
			$scripttag .= vmCommonHTML::scriptTag( $mosConfig_live_site .'/components/'. $vmDir .'/js/lightbox'.$type.'/lightbox'.$type.'.js' );
			$scripttag .= vmCommonHTML::linkTag( $mosConfig_live_site .'/components/'. $vmDir .'/js/lightbox'.$type.'/lightbox'.$type.'.css' );
			if( $type== '2')  {
				vmCommonHTML::loadScriptaculous( array('effects'), $print );
			}
			if( defined('_PSHOP_ADMIN') || $print ) {
				echo $scripttag;
			}
			else {
				$mainframe->addCustomHeadTag( $scripttag );
			}
			define ( '_LIGHTBOX'.$type.'_LOADED', '1' );
		}	
	}
	/**
	 * Loads a part of the scriptaculous script library
	 * @author http://script.aculo.us/
	 * @license http://wiki.script.aculo.us/scriptaculous/show/License
	 * 
	 * @param array $library The name of the script to load
	 */
	function loadScriptaculous( $library=array( 'effects'), $print=false  ) {
		global $mainframe, $vmDir, $mosConfig_live_site;
		$scripttag = '';
		
		foreach( $library as $script ) {
			if( !defined( '_SCRIPTACULOUS_'.$script.'_LOADED' )) {
				$scripttag .= vmCommonHTML::scriptTag( $mosConfig_live_site .'/components/'. $vmDir .'/js/scriptaculous/'.$script.'.js' );
				define( '_SCRIPTACULOUS_'.$script.'_LOADED', 1 );
			}
		}
		if( (defined('_PSHOP_ADMIN') || $print) &&  $scripttag != '' ) {
			vmCommonHTML::loadPrototype( $print );
			echo $scripttag;
		}
		elseif( $scripttag != '' ) {
			vmCommonHTML::loadPrototype( $print );
			$mainframe->addCustomHeadTag( $scripttag );
		}
	}
	/**
	 * Prototype is a Javascript framework
	 * @author http://prototype.conio.net/
	 *
	 */
	function loadPrototype( $print=false ) {
		global $mainframe, $vmDir, $mosConfig_live_site;
		if( !defined( "_PROTOTYPE_LOADED" )) {
			$scripttag = vmCommonHTML::scriptTag( $mosConfig_live_site .'/components/'. $vmDir .'/js/prototype/prototype.js' );
			if( defined('_PSHOP_ADMIN') || $print) {
				echo $scripttag;
			}
			elseif( $scripttag != '' ) {
				$mainframe->addCustomHeadTag( $scripttag );
			}
			define( '_PROTOTYPE_LOADED', 1 );
		}

	}
	function loadRico( $print=false ) {
		global $mainframe, $vmDir, $mosConfig_live_site;
		if( !defined( "_RICO_LOADED" )) {
			vmCommonHTML::loadPrototype( $print );
			$scripttag = vmCommonHTML::scriptTag( $mosConfig_live_site .'/components/'. $vmDir .'/js/rico.js' );
			if( defined('_PSHOP_ADMIN') || $print) {
				echo $scripttag;
			}
			elseif( $scripttag != '' ) {
				$mainframe->addCustomHeadTag( $scripttag );
			}
			define ( "_RICO_LOADED", "1" );
		}
		
	}
	function loadWindowsJS( $print=false ) {
		global $mainframe, $vmDir, $mosConfig_live_site, $VM_LANG;
		if( !defined( "_WINDOWSJS_LOADED" )) {
			vmCommonHTML::loadPrototype( $print );
			vmCommonHTML::loadScriptaculous( array('effects'), $print );
			$scripttag = vmCommonHTML::scriptTag( '', 'var cart_title = "'.$VM_LANG->_PHPSHOP_CART_TITLE.'";var ok_lbl="'.$VM_LANG->_CMN_CONTINUE.'";var cancel_lbl="'.$VM_LANG->_CMN_CANCEL.'";var notice_lbl="'.$VM_LANG->_PEAR_LOG_NOTICE.'";' );
			$scripttag .= vmCommonHTML::scriptTag( $mosConfig_live_site .'/components/'. $vmDir .'/js/windows/window.js' );
			$scripttag .= vmCommonHTML::linkTag( $mosConfig_live_site .'/components/'. $vmDir .'/js/windows/themes/mac_os_x.css' );
			$scripttag .= vmCommonHTML::linkTag( $mosConfig_live_site .'/components/'. $vmDir .'/js/windows/themes/alphacube.css' );
			$scripttag .= vmCommonHTML::linkTag( $mosConfig_live_site .'/components/'. $vmDir .'/js/windows/themes/default.css' );
			
			if( defined('_PSHOP_ADMIN') || $print) {
				echo $scripttag;
			}
			elseif( $scripttag != '' ) {
				$mainframe->addCustomHeadTag( $scripttag );
			}
			define ( "_WINDOWSJS_LOADED", "1" );
		}		
	}
	/**
	 * Loads the CSS and Javascripts needed to run the Greybox
	 * Source: http://orangoo.com/labs/?page_id=5
	 *
	 */
	function loadGreybox( $print=false ) {
		global $mosConfig_live_site, $vmDir, $mainframe;
		if( !defined( '_GREYBOX_LOADED' )) {

			$scripttag = vmCommonHTML::scriptTag( $mosConfig_live_site .'/components/'. $vmDir .'/js/greybox/AJS.js' );
			$scripttag .= vmCommonHTML::scriptTag( $mosConfig_live_site .'/components/'. $vmDir .'/js/greybox/greybox.js' );
			$scripttag .= vmCommonHTML::linkTag( $mosConfig_live_site .'/components/'. $vmDir .'/js/greybox/greybox.css' );
			$scripttag .= vmCommonHTML::scriptTag( '', 'var GB_IMG_DIR = \''.$mosConfig_live_site .'/components/'. $vmDir .'/js/greybox/\'; GreyBox.preloadGreyBoxImages();' );
			if( defined('_PSHOP_ADMIN') || $print) {
				echo $scripttag;
			}
			else {
				$mainframe->addCustomHeadTag( $scripttag );
			}
			define ( '_GREYBOX_LOADED', '1' );
		}
	}

	/**
	* Loads all necessary script files for Tigra Tree Menu
	* @static 
	* @since VirtueMart 1.1.0
	*/
	function loadTigraTree( $print=false ) {
		global $mosConfig_live_site, $vmDir, $mainframe;
		if( !defined( "_TIGRATREE_LOADED" )) {
			
			$scripttag = vmCommonHTML::scriptTag( $mosConfig_live_site .'/components/'. $vmDir .'/js/tigratree/tree_tpl.js.php' );
			$scripttag .= vmCommonHTML::scriptTag( $mosConfig_live_site .'/components/'. $vmDir .'/js/tigratree/tree.js' );
			
			if( defined('_PSHOP_ADMIN') || $print) {
				echo $scripttag;
			}
			else {
				$mainframe->addCustomHeadTag( $scripttag );
			}
			define ( "_TIGRATREE_LOADED", "1" );
		}
	}
	/**
	 * Function to include the behaviour scripts in the HTML document
	 * Behaviour: http://bennolan.com/behaviour/
	 * @static 
	 * @since VirtueMart 1.1.0
	 *
	 */
	function loadBehaviourJS( $print=false ) {
		global $mosConfig_live_site, $vmDir, $mainframe;
		if( !defined( "_BEHAVIOURJS_LOADED" )) {
			
			vmCommonHTML::loadPrototype( $print );
			$scripttag = vmCommonHTML::scriptTag( $mosConfig_live_site .'/components/'. $vmDir .'/js/prototype/behaviour.js' );

			if( defined('_PSHOP_ADMIN') || $print) {
				echo $scripttag;
			}
			else {
				$mainframe->addCustomHeadTag( $scripttag );
			}
			define ( "_BEHAVIOURJS_LOADED", "1" );
		}		
	}

	/**
	 * Returns a properly formatted image link that opens a LightBox2
	 *
	 * @param string $image_link Can be the image src or a complete image tag
	 * @param string $text The Link Text, e.g. 'Click here!'
	 * @param string $title The Link title, will be used as Image Caption
	 * @param string $image_group The image group name when you want to use the gallery functionality
	 * @return string
	 */
	function getLightboxImageLink( $image_link, $text, $title='', $image_group='', $lite=false ) {
		if( $lite ) {
			vmCommonHTML::loadLitebox();
		} else {
			vmCommonHTML::loadLightbox();
		}
		
		if( $image_group ) {
			$image_group = '['.$image_group.']';
		}
		$link = vmCommonHTML::hyperLink( $image_link, $text, '', $title, 'rel="lightbox'.$image_group.'"' );
		
		return $link;
	}
	
	function getGreyboxPopUpLink( $url, $text, $target='_blank', $title='', $attributes='', $height=500, $width=600, $no_js_url='' ) {
		vmCommonHTML::loadGreybox();
		if( $no_js_url == '') {
			$no_js_url = $url;
		}
		$link = vmCommonHTML::hyperLink( $no_js_url, $text, $target, $title, $attributes.' onclick="try{ if( !parent.GB ) return GB_show(\''.$title.'\', \''.$url.'\', '.$height.', '.$width.');} catch(e) { }"' );
		
		return $link;
	}
	/**
	 * Returns a div element of the class "shop_error" 
	 * containing $msg to print out an error
	 *
	 * @param string $msg
	 * @return string HTML code
	 */
	function getInfoField( $msg ) {
		
		$html = '<div class="shop_info">'.$msg.'</div>';
		return $html;
	}
	/**
	 * Returns a div element to indicate success or failure of a function execution after an ajax call
	 * and a div element with all the log messages
	 *
	 * @param boolean $success
	 * @param Log_Display $vmLogger
	 */
	function getSuccessIndicator( $success, $vmLogger ) {

		echo '<div id="successIndicator" style="display:none;">';
		if( $success) { 
			echo 'Success'; 
		}
		else {
			echo 'Failure';
		}
		echo '</div>';
		$vmLogger->printLog();
	}
	/**
	 * Returns a div element of the class "shop_error" 
	 * containing $msg to print out an error
	 *
	 * @param string $msg
	 * @return string HTML code
	 */
	function getErrorField( $msg ) {
		
		$html = '<div class="shop_error">'.$msg.'</div>';
		return $html;
	}
	/**
	 * Writes a PDF icon
	 *
	 * @param string $link
	 * @param boolean $use_icon
	 */
	function PdfIcon( $link, $use_icon=true ) {
		global $VM_LANG, $mosConfig_live_site;
		if ( PSHOP_PDF_BUTTON_ENABLE == '1' && !mosGetParam( $_REQUEST, 'pop' )  ) {
			$link .= '&amp;pop=1';
			if ( $use_icon ) {
				$text = mosAdminMenus::ImageCheck( 'pdf_button.png', '/images/M_images/', NULL, NULL, $VM_LANG->_CMN_PDF, $VM_LANG->_CMN_PDF );
			} else {
				$text = $VM_LANG->_CMN_PDF .'&nbsp;';
			}
			return vmPopupLink($link, $text, 640, 480, '_blank', $VM_LANG->_CMN_PDF);
		}
	}

	/**
	 * Writes an Email icon
	 *
	 * @param string $link
	 * @param boolean $use_icon
	 */
	function EmailIcon( $product_id, $use_icon=true ) {
		global $VM_LANG, $mosConfig_live_site, $sess;
		if ( @VM_SHOW_EMAILFRIEND == '1' && !mosGetParam( $_REQUEST, 'pop' ) && $product_id > 0  ) {
			$link = $sess->url( 'index2.php?page=shop.recommend&amp;product_id='.$product_id.'&amp;pop=1' );
			if ( $use_icon ) {
				$text = mosAdminMenus::ImageCheck( 'emailButton.png', '/images/M_images/', NULL, NULL, $VM_LANG->_CMN_EMAIL, $VM_LANG->_CMN_EMAIL );
			} else {
				$text = '&nbsp;'. $VM_LANG->_CMN_EMAIL;
			}
			return vmPopupLink($link, $text, 640, 480, '_blank', $VM_LANG->_CMN_EMAIL, 'screenX=100,screenY=200');
		}
	}
	
	function PrintIcon( $link='', $use_icon=true ) {
		global $VM_LANG, $mosConfig_live_site, $mosConfig_absolute_path, $cur_template, $Itemid;
		if ( @VM_SHOW_PRINTICON == '1' ) {
			if( !$link ) {
				$link = 'index2.php?'.$_SERVER['QUERY_STRING'].'&amp;pop=1';
			}
			// checks template image directory for image, if non found default are loaded
			if ( $use_icon ) {
				$text = mosAdminMenus::ImageCheck( 'printButton.png', '/images/M_images/', NULL, NULL, $VM_LANG->_CMN_PRINT, $VM_LANG->_CMN_PRINT );
			} else {
				$text = _ICON_SEP .'&nbsp;'. $VM_LANG->_CMN_PRINT. '&nbsp;'. _ICON_SEP;
			}
			$isPopup = mosGetParam( $_GET, 'pop' );
			if ( $isPopup ) {
				// Print Preview button - used when viewing page
				$html = '<a href="javascript:void(0)" onclick="javascript:window.print(); return false;" title="'. $VM_LANG->_CMN_PRINT.'">
				'. $text .'
				</a>';
				return $html;
			} else {
				// Print Button - used in pop-up window
				return vmPopupLink($link, $text, 640, 480, '_blank', $VM_LANG->_CMN_PRINT);
			}
		}
	}
	/**
	 * this function parses all the text through all content plugins
	 *
	 * @param string $text
	 * @param string $type
	 */
	function ParseContentByPlugins( $text, $type = 'content' ) {
		global $_MAMBOTS;
		if( VM_CONTENT_PLUGINS_ENABLE == '1') {
			$_MAMBOTS->loadBotGroup( $type );
			$row = new stdClass();
			$row->text = $text;
			$params = new mosParameters('');
			
			$_MAMBOTS->trigger( 'onPrepareContent', array( &$row, &$params, 0 ), true );
			$text = $row->text;
		}
		return $text;
		
	}

        /**
         * This class allows us to create fieldsets like in Community builder
         * @author Copyright 2004 - 2005 MamboJoe/JoomlaJoe, Beat and CB team
         *
         * @param array $arr
         * @param string $tag_name
         * @param string $tag_attribs
         * @param string $key
         * @param string $text
         * @param mixed $selected
         * @param mixed $required
         * @return string HTML form code
         */
        // begin class vmCommonHTML extends mosHTML {

        function radioListArr( &$arr, $tag_name, $tag_attribs, $key, $text, $selected, $required=0 ) {
                reset( $arr );
                $html = array();
                $n=count( $arr );
                for ($i=0; $i < $n; $i++ ) {
                        $k = stripslashes($arr[$i]->$key);
                        $t = stripslashes($arr[$i]->$text);
                        $id = isset($arr[$i]->id) ? $arr[$i]->id : null;

                        $extra = '';
                        $extra .= $id ? " id=\"" . $arr[$i]->id . "\"" : '';
                        if (is_array( $selected )) {
                                foreach ($selected as $obj) {
                                        $k2 = stripslashes($obj->$key);
                                        if ($k == $k2) {
                                                $extra .= " checked=\"checked\"";
                                                break;
                                        }
                                }
                        } else {
                                $extra .= ($k == stripslashes($selected) ? "  checked=\"checked\"" : '');
                        }
                        $html[] = "<input type=\"radio\" name=\"$tag_name\" id=\"".$tag_name."_field$i\" $tag_attribs value=\"".$k."\"$extra /> " . "<label for=\"".$tag_name."_field$i\">$t</label>";
                }
                return $html;
        }
        function radioList( $arr, $tag_name, $tag_attribs, $key, $text, $selected, $required=0 ) {
                return "\n\t".implode("\n\t ", vmCommonHTML::radioListArr( $arr, $tag_name, $tag_attribs, $key, $text, $selected, $required ))."\n";
        }
        function radioListTable( $arr, $tag_name, $tag_attribs, $key, $text, $selected, $cols=0, $rows=1, $size=0, $required=0 ) {
                $cellsHtml = vmCommonHTML::radioListArr( $arr, $tag_name, $tag_attribs, $key, $text, $selected, $required );
                return vmCommonHTML::list2Table( $cellsHtml, $cols, $rows, $size );
        }
        function selectList( $arr, $tag_name, $tag_attribs, $key, $text, $selected, $required=0 ) {
                global $VM_LANG;
                reset( $arr );
                $html = "\n<select name=\"$tag_name\" id=\"".str_replace('[]', '', $tag_name)."\" $tag_attribs>";
                if(!$required) $html .= "\n\t<option value=\"\">".$VM_LANG->_PHPSHOP_SELECT."</option>";
                $n=count( $arr );
                for ($i=0; $i < $n; $i++ ) {
                        $k = stripslashes($arr[$i]->$key);
                        $t = stripslashes($arr[$i]->$text);
                        $id = isset($arr[$i]->id) ? $arr[$i]->id : null;

                        $extra = '';
                        $extra .= $id ? " id=\"" . $arr[$i]->id . "\"" : '';
                        if (is_array( $selected )) {
                                foreach ($selected as $obj) {
                                        $k2 = stripslashes($obj->$key);
                                        if ($k == $k2) {
                                                $extra .= " selected=\"selected\"";
                                                break;
                                        }
                                }
                        } else {
                                $extra .= ($k == stripslashes($selected) ? " selected=\"selected\"" : '');
                        }
                        $html .= "\n\t<option value=\"".$k."\"$extra>";
                        $html .= isset($VM_LANG->$t) ? $VM_LANG->$t : $t;
                        $html .= "</option>";
                }
                $html .= "\n</select>\n";
                return $html;
        }
        function checkboxListArr( $arr, $tag_name, $tag_attribs,  $key='value', $text='text',$selected=null, $required=0  ) {
                global $VM_LANG;
                reset( $arr );
                $html = array();
                $n=count( $arr );
                for ($i=0; $i < $n; $i++ ) {
                        $k = $arr[$i]->$key;
                        $t = $arr[$i]->$text;
                        $id = isset($arr[$i]->id) ? $arr[$i]->id : null;

                        $extra = '';
                        $extra .= $id ? " id=\"" . $arr[$i]->id . "\"" : '';
                        if (is_array( $selected )) {
                                foreach ($selected as $obj) {
                                        $k2 = $obj->$key;
                                        if ($k == $k2) {
                                                $extra .= " checked=\"checked\"";
                                                break;
                                        }
                                }
                        } else {
                                $extra .= ($k == $selected ? " checked=\"checked\"" : '');
                        }
                        $tmp = "<input type=\"checkbox\" name=\"$tag_name\" id=\"".str_replace('[]', '', $tag_name)."_field$i\" value=\"".$k."\"$extra $tag_attribs />" . "<label for=\"".str_replace('[]', '', $tag_name)."_field$i\">";
                        $tmp .= isset($VM_LANG->$t) ? $VM_LANG->$t : $t;
                        $tmp .= "</label>";
                        $html[] = $tmp;
                }
                return $html;
        }
        function checkboxList( $arr, $tag_name, $tag_attribs,  $key='value', $text='text',$selected=null, $required=0 ) {
                return "\n\t".implode("\n\t", vmCommonHTML::checkboxListArr( $arr, $tag_name, $tag_attribs,  $key, $text,$selected, $required ))."\n";
        }
        function checkboxListTable( $arr, $tag_name, $tag_attribs,  $key='value', $text='text',$selected=null, $cols=0, $rows=0, $size=0, $required=0 ) {
                $cellsHtml = vmCommonHTML::checkboxListArr( $arr, $tag_name, $tag_attribs,  $key, $text,$selected, $required );
                return vmCommonHTML::list2Table( $cellsHtml, $cols, $rows, $size );
        }
        // private methods:
        function list2Table ( $cellsHtml, $cols, $rows, $size ) {
                $cells = count($cellsHtml);
                if ($size == 0) {
                        $localstyle = ""; //" style='width:100%'";
                } else {
                        $size = (($size-($size % 3)) / 3  ) * 2; // int div  3 * 2 width/heigh ratio
                        $localstyle = " style='width:".$size."em;'";
                }
                $return="";
                if ($cells) {
                        if ($rows) {
                                $return = "\n\t<table class='vmMulti'".$localstyle.">";
                                $cols = ($cells-($cells % $rows)) / $rows;      // int div
                                if ($cells % $rows) $cols++;
                                $lineIdx=0;
                                for ($lineIdx=0 ; $lineIdx < min($rows, $cells) ; $lineIdx++) {
                                        $return .= "\n\t\t<tr>";
                                        for ($i=$lineIdx ; $i < $cells; $i += $rows) {
                                                $return .= "<td>".$cellsHtml[$i]."</td>";
                                        }
                                        $return .= "</tr>\n";
                                }
                                $return .= "\t</table>\n";
                        } else if ($cols) {
                                $return = "\n\t<table class='vmMulti'".$localstyle.">";
                                $idx=0;
                                while ($cells) {
                                        $return .= "\n\t\t<tr>";
                                        for ($i=0, $n=min($cells,$cols); $i < $n; $i++, $cells-- ) {
                                                $return .= "<td>".$cellsHtml[$idx++]."</td>";
                                        }
                                        $return .= "</tr>\n";
                                }
                                $return .= "\t</table>\n";
                        } else {
                                $return = "\n\t".implode("\n\t ", $cellsHtml)."\n";
                        }
                }
                return $return;
	}
	

	// end class vmCommonHTML, thanks folks!
}

/**
 * Utility function to provide ToolTips
 *
 * @param string $tooltip ToolTip text
 * @param string $title The Box title
 * @param string $image
 * @param int $width
 * @param string $text
 * @param string $href
 * @param string $link
 * @return string HTML code for ToolTip
 */
function vmToolTip( $tooltip, $title='Tip!', $image = "{mosConfig_live_site}/images/M_images/con_info.png", $width='', $text='', $href='#', $link=false ) {
	global $mosConfig_live_site, $database;
	
	defined( 'vmToolTipCalled') or define('vmToolTipCalled', 1);
	
	$tooltip = @htmlentities( $database->getEscaped($tooltip), ENT_QUOTES, vmGetCharset() );
	
	if ( !empty($width) ) {
		$width = 'this.T_WIDTH=\''.$width .'\';';
	}
	if ( $title ) {
		$title = 'this.T_TITLE=\''.$title .'\';';
	}
	$image = str_replace( "{mosConfig_live_site}", $mosConfig_live_site, $image);
	if( $image != '' ) {
		$text 	= vmCommonHTML::imageTag( $image, '', 'middle' ). '&nbsp;'.$text;
	}
	
	$style = 'style="text-decoration: none; color: #333;"';
	if ( $href ) {
		$style = '';
	}
	if ( $link ) {
		$tip = vmCommonHTML::hyperLink( $href, $text, '','', "onmouseover=\"return escape( '$tooltip' );\" ". $style );
	} else {
		$tip = "<span onmouseover=\"$width $title return escape( '$tooltip' );\" ". $style .">". $text ."</span>";
	}

	return $tip;
}
/**
 * @deprecated 
 */
function mm_ToolTip( $tooltip, $title='Tip!', $image = "{mosConfig_live_site}/images/M_images/con_info.png", $width='', $text='', $href='#', $link=false ) { return vmToolTip( $tooltip, $title, $image, $width, $text, $href, $link ); }

/**
 * Utility function to provide persistant HelpToolTips
 *
 * @param unknown_type $tip
 * @param unknown_type $linktext
 */
function vmHelpToolTip( $tip, $linktext = ' [?] ' ) {
        global $mosConfig_live_site;

        if( !defined( 'vmHelpToolTipCalled')) {
                echo '<script type="text/javascript" src="'.$mosConfig_live_site.'/components/com_virtuemart/js/helptip/helptip.js"></script>
                        <link type="text/css" rel="stylesheet" href="'.$mosConfig_live_site.'/components/com_virtuemart/js/helptip/helptip.css" />';
                define('vmHelpToolTipCalled', 1);
        }
        $tip = str_replace( "\n", "", 
                        str_replace( "&lt;", "<", 
                        str_replace( "&gt;", ">", 
                        str_replace( "&amp;", "&", 
                        @htmlentities( $tip, ENT_QUOTES )))));
        $varname = 'a'.md5( $tip );
        echo '<script type="text/javascript">//<![CDATA[
        var '.$varname.' = \''.$tip.'\';
        //]]></script>
        ';
        echo '<a class="helpLink" href="?" onclick="showHelpTip(event, '.$varname.'); return false">'.$linktext.'</a>
';
}

// borrowed from mambo.php
function shopMakeHtmlSafe( $string, $quote_style=ENT_QUOTES, $exclude_keys='' ) {
	
	$string = htmlspecialchars( $string, $quote_style, vmGetCharset() );
	return $string;
}

function mm_showMyFileName( $filename ) {
    
    if (DEBUG == '1' ) {
        echo vmToolTip( '<div class=\'inputbox\'>Begin of File: '. $filename.'</div>');
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

/**
 * A function to create a XHTML compliant and JS-disabled-safe pop-up link
 *
 * @param string $link The HREF attribute
 * @param string $text The link text
 * @param int $popupWidth
 * @param int $popupHeight
 * @param string $target The value of the target attribute
 * @param string $title
 * @param string $windowAttributes
 * @return string
 */
function vmPopupLink( $link, $text, $popupWidth=640, $popupHeight=480, $target='_blank', $title='', $windowAttributes='' ) {
	if( $windowAttributes ) {
		$windowAttributes = ','.$windowAttributes;
	}
	$jslink = vmCommonHTML::hyperLink( "javascript:void window.open('$link', '$target', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=$popupWidth,height=$popupHeight,directories=no,location=no".$windowAttributes."');", $text, '', $title );
	$noscriptlink = vmCommonHTML::hyperLink( $link, $text, $target, $title );
	
	return mm_writeWithJS( $jslink, $noscriptlink );
}

?>
