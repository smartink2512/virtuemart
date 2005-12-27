<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
* This file contains functions and classes for common html tasks
*
* @version $Id: htmlTools.class.php,v 1.18 2005/11/12 08:32:07 soeren_nb Exp $
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

	/** @var int the number of rows in the table */
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
		}
		//--></script>
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
			$i = 0;
			foreach( $this->cells as $row ) {
				echo "<tr class=\"".$this->alternateColors[$i]."\">\n";
				foreach( $row as $cell ) {
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
	
		global $sess, $keyword, $VM_LANG, $option;
	  
		if( !empty( $keyword )) {
			$keyword = urldecode( $keyword );
		}
		else {
			$keyword = "";
		}
		$category_id = mosGetParam( $_REQUEST, 'category_id', null);
		$search_date = mosGetParam( $_REQUEST, 'search_date', null);
		$show = mosGetParam( $_REQUEST, "show", "" );
		
		$header = "<form name=\"adminForm\" action=\"".$_SERVER['PHP_SELF']."\" method=\"post\">
					<input type=\"hidden\" name=\"option\" value=\"$option\" />
					<input type=\"hidden\" name=\"page\" value=\"". $modulename . "." . $pagename . "\" />
					<input type=\"hidden\" name=\"task\" value=\"\" />\n
					<input type=\"hidden\" name=\"func\" value=\"\" />\n
					<input type=\"hidden\" name=\"boxchecked\" />\n";
		if( defined( "_PSHOP_ADMIN") || @$_REQUEST['pshop_mode'] == "admin"  )
            $header .= "<input type=\"hidden\" name=\"pshop_mode\" value=\"admin\" />\n";
        if( $title != "" ) {
        	$style = ($image != '') ? 'style="background-image:url('.$image.');"' : '';
        	$header .= "<h2 class=\"adminListHeader\" $style>$title</h2>\n";
        }
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
	function finishForm( $func, $page, $option='com_virtuemart' ) {
	
		$html = '
		<input type="hidden" name="func" value="'.$func.'" />
        <input type="hidden" name="page" value="'.$page.'" />
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="option" value="'.$option.'" />';
        if( defined( "_PSHOP_ADMIN") || @$_REQUEST['pshop_mode'] == "admin"  )
          $html .= '<input type="hidden" name="pshop_admin" value="admin" />';
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

class vmCommonHTML extends mosHTML {

	/**
	* Writes a "Save Ordering" Button
	* @param int the number of rows
	*/
	function getSaveOrderButton( $num_rows, $funcname='reorder') {
		global $mosConfig_live_site;
		$n = $num_rows-1;
		return '<a href="javascript: document.adminForm.func.value = \''.$funcname.'\'; saveorder( '.$n.' );">
				<img src="'.$mosConfig_live_site.'/administrator/images/filesave.png" border="0" width="16" height="16" alt="Save Order" /></a>';
	}
	function getOrderingField( $ordering ) {

		return '<input type="text" name="order[]" size="5" value="'. $ordering .'" class="text_area" style="text-align: center" />';

	}
	
	function getYesNoIcon( $condition, $pos_alt = "Published", $neg_alt = "Unpublished" ) {
		global $mosConfig_live_site;
		if( $condition==true || strtoupper( $condition ) == "Y" ) {
			return '<img src="'.$mosConfig_live_site.'/administrator/images/tick.png" border="0" alt="'.$pos_alt.'" />';
		}
		else {
			return '<img src="'.$mosConfig_live_site.'/administrator/images/publish_x.png" border="0" alt="'.$neg_alt.'" />';
		}
	}
	/*
	* Loads all necessary files for JS Overlib tooltips
	*/
	function loadOverlib() {
		global  $mosConfig_live_site;
		if( !defined( "_OVERLIB_LOADED" )) {
			?>
			<script language="Javascript" type="text/javascript" src="<?php echo $mosConfig_live_site;?>/includes/js/overlib_mini.js"></script>
			<div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
			<?php
			define ( "_OVERLIB_LOADED", "1" );
		}
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
	 * Prints a JS function to validate all fields
	 * given in the array $required_fields
	 * Does only test if non-empty (or if no options are selected)
	 * Includes a check for a valid email-address
	 *
	 * @param array $required_fields The list of form elements that are to be validated
	 * @param string $formname The name for the form element
	 * @param string $div_id_postfix The ID postfix to identify the label for the field
	 */
	function printJS_formvalidation( $required_fields, $formname = 'adminForm', $functioname='submitregistration', $div_id_postfix = '_div' ) {
		global $VM_LANG, $page;
		echo '
		<script language="javascript" type="text/javascript">//<![CDATA[
		function '.$functioname.'() {
			var form = document.'.$formname.';
			var r = new RegExp("[\<|\>|\"|\'|\%|\;|\(|\)|\&|\+|\-]", "i");
			var isvalid = true;
			var required_fields = new Array(\'';
		
		$field_list = implode( "','", $required_fields );
		$field_list = str_replace( "'email',", '', $field_list );
		$field_list = str_replace( "'username',", '', $field_list );
		$field_list = str_replace( "'password',", '', $field_list );
		$field_list = str_replace( "'password2',", '', $field_list );
		echo $field_list;
		echo '\');
		for (var i=0; i < required_fields.length; i++) {
			formelement = eval( \'form.\' + required_fields[i] );
			';
		echo "
			if( !formelement ) { 
				formelement = document.getElementById( required_fields[i]+'_field0' );
				var loopIds = true;
			}
			if( !formelement ) { continue; }
			if (formelement.type == 'radio' || formelement.type == 'checkbox') {
				if( loopIds ) {
					var rOptions = new Array();
					for(var j=0; j<30; j++ ) {
						rOptions[j] = document.getElementById( required_fields[i] + '_field' + j );
						if( !rOptions[j] ) { break; }
					}
				} else {
					var rOptions = form[formelement.getAttribute('name')];
				}
				var rChecked = 0;
				if(rOptions.length > 1) {
					for (var r=0; r < rOptions.length; r++) {
						if( !rOptions[r] ) { continue; }
						if (rOptions[r].checked) {	rChecked=1; }
					}
				} else {
					if (formelement.checked) {
						rChecked=1;
					}
				}
				if(rChecked==0) {
					document.getElementById(required_fields[i]+'$div_id_postfix').style.color = 'red';
					isvalid = false;
				} 
				else if (document.getElementById(required_fields[i]+'$div_id_postfix').style.color.slice(0,3)=='red') {
					document.getElementById(required_fields[i]+'$div_id_postfix').style.color = '';
				}				
			}
			else if( formelement.options ) {
				if(formelement.selectedIndex.value == '') {
					document.getElementById(required_fields[i]+'$div_id_postfix').style.color = 'red';
					isvalid = false;
				} 
				else if (document.getElementById(required_fields[i]+'$div_id_postfix').style.color.slice(0,3)=='red') {
					document.getElementById(required_fields[i]+'$div_id_postfix').style.color = '';
				}
			}
			else {
				if (formelement.value == '') {
					document.getElementById(required_fields[i]+'$div_id_postfix').style.color = 'red';
					isvalid = false;
				}
				else if (document.getElementById(required_fields[i]+'$div_id_postfix').style.color.slice(0,3)=='red') {
					document.getElementById(required_fields[i]+'$div_id_postfix').style.color = '';
				}
			}
		}
		";
			
		// We have skipped email in the first loop above!
		// Now let's handle email address validation
		if( in_array( 'email', $required_fields)) {
		
			echo '
			if( !(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(form.email.value))) {
				alert( \''. html_entity_decode( _REGWARN_MAIL ).'\');
				return false;
			}';

		}
		if( in_array( 'username', $required_fields )) {
			
			echo '
			if (r.exec(form.username.value) || form.username.value.length < 3) {
				alert( "'. html_entity_decode( sprintf(_VALID_AZ09, _PROMPT_UNAME, 2)) .'" );
				return false;
			}';
		}
		if( in_array( 'password', $required_fields )) {
			if( $page != 'checkout.index') {
				echo '
			if (form.password.value.length < 6) {
				alert( "'. html_entity_decode( _REGWARN_PASS ).'" );
				return false;
			} else if (form.password2.value == "") {
				alert( "'.html_entity_decode( _REGWARN_VPASS1).'" );
				return false;
			} else if (r.exec(form.password.value)) {
				alert( "'. html_entity_decode(sprintf( _VALID_AZ09, _REGISTER_PASS, 6 )) .'" );
				return false;
			}';
			}
			echo '
			if ((form.password.value != "") && (form.password.value != form.password2.value)){
				alert( "'. html_entity_decode(_REGWARN_VPASS2).'" );
				return false;
			}';
		}
		if( in_array( 'agreed', $required_fields )) {
			echo '
			if (!form.agreed.checked) {
				alert( "'. $VM_LANG->_PHPSHOP_AGREE_TO_TOS .'" );
				return false;
			}';
		}
		// Finish the validation function
		echo '
			if( !isvalid) {
				alert("'.addslashes( html_entity_decode(_CONTACT_FORM_NC) ).'" );
			}
			return isvalid;
		}
		//]]>
		</script>';
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
				$cols = ($cells-($cells % $rows)) / $rows;	// int div
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
	} // end class vmCommonHTML, thanks folks!
}

/**
* Utility function to provide ToolTips
* @param string ToolTip text
* @param string Box title
* @returns HTML code for ToolTip
*/
function mm_ToolTip( $tooltip, $title='Tip!', $image = "{mosConfig_live_site}/images/M_images/con_info.png", $width='', $text='', $href='#', $link=false ) {
	global $mosConfig_live_site;
	
	defined( 'vmToolTipCalled') or define('vmToolTipCalled', 1);
	
	if( function_exists('mysql_real_escape_string')) {
		$tooltip = htmlentities( mysql_real_escape_string($tooltip), ENT_QUOTES);
	}
	else {
		$tooltip = htmlentities( mysql_escape_string($tooltip), ENT_QUOTES);
	}
	
	if ( !empty($width) ) {
		$width = 'this.T_WIDTH=\''.$width .'\';';
	}
	if ( $title ) {
		$title = 'this.T_TITLE=\''.$title .'\';';
	}
	$image = str_replace( "{mosConfig_live_site}", $mosConfig_live_site, $image);
	$text 	= '<img src="'. $image .'" align="middle" border="0" />&nbsp;'.$text;
	
	$style = 'style="text-decoration: none; color: #333;"';
	if ( $href ) {
		$style = '';
	}
	if ( $link ) {
		$tip = "<a href=\"". $href ."\" onmouseover=\"return escape( '$tooltip' );\" ". $style .">". $text ."</a>";
	} else {
		$tip = "<span onmouseover=\"$width $title return escape( '$tooltip' );\" ". $style .">". $text ."</span>";
	}

	return $tip;
}

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
			htmlentities( $tip, ENT_QUOTES )))));
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
	
	$string = htmlspecialchars( $string, $quote_style );
	return $string;
}

function mm_showMyFileName( $filename ) {
    
    if (DEBUG == '1' ) {
        echo mm_ToolTip( '<div class=\'inputbox\'>Begin of File: '. $filename.'</div>');
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
*/
function vmPopupLink( $link, $text, $popupWidth=640, $popupHeight=480, $target='_blank', $title='' ) {
	
	$jslink = "<a href=\"javascript:void window.open('$link', 'win2', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=$popupWidth,height=$popupHeight,directories=no,location=no');\" title=\"$title\">$text</a>";
	$noscriptlink = "<a href=\"$link\" target=\"$target\" title=\"$title\">$text</a>";
	return mm_writeWithJS( $jslink, $noscriptlink );
}

?>