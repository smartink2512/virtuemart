<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* This Class provides some utility functions
* to easily create drop-down lists
*
* @version $Id: ps_html.php,v 1.6 2005/09/30 10:14:30 codename-matrix Exp $
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

class ps_html {
  var $classname = "ps_html";

  /**************************************************************************
  ** name: dropdown_display()
  ** created by: gday
  ** description:  Print an HTML dropdown box named $name using $arr to
  **               load the drop down.  If $value is in $arr, then $value
  **               will be the selected option in the dropdown.
  ** parameters: $name - name of the HTML dropdown element
  **             $value - Drop down item to make selected
  **             $arr - array used to build the HTML drop down element
  ** returns: prints HTML drop down element to standard output
  ***************************************************************************/
   function dropdown_display($name, $value, $arr, $size=1, $multiple="", $extra="") {

      if( !empty( $arr ) ) {
        echo "<select class=\"inputbox\" name=\"$name\" size=\"$size\" $multiple $extra>\n";
        
        while (list($key, $val) = each($arr)) {
           $selected = "";
           if( is_array( $value )) {
              if( in_array( $key, $value ))
                $selected = "selected=\"selected\"";
           }
           else {
             if(strcmp($value, $key) == 0) {
                $selected = "selected=\"selected\"";
             }
           }
           echo "<option value=\"$key\" $selected>$val\n";
           echo "</option>";
        }
  
        echo "</select>\n";
      }
      return True;
   }


  /****************************************************************************
   *    function:  list_user_title
   *  created by: pablo
   * description: Lists some titles.
   ****************************************************************************/
  function list_user_title($t, $extra="") {
     global $VM_LANG;
     
     $title = array($VM_LANG->_PHPSHOP_REGISTRATION_FORM_MR, 
                          $VM_LANG->_PHPSHOP_REGISTRATION_FORM_MRS, 
                          $VM_LANG->_PHPSHOP_REGISTRATION_FORM_DR, 
                          $VM_LANG->_PHPSHOP_REGISTRATION_FORM_PROF);
     echo "<select class=\"inputbox\" name=\"title\" $extra>\n";
     echo "<option value=\"\">".$VM_LANG->_PHPSHOP_REGISTRATION_FORM_NONE."</option>\n";
     for ($i=0;$i<count($title);$i++) {
        echo "<option value=\"" . $title[$i]."\"";
        if ($title[$i] == $t)
           echo " selected=\"selected\" ";
        echo ">" . $title[$i] . "</option>\n";
     }
     echo "</select>\n";
  
  }



  /**************************************************************************
  ** name: list_month($list_name)
  ** created by: pfmartin
  ** description:  Print an HTML dropdown box for the credit cards 
  ** parameters: $name - name of the HTML dropdown element
  **             $value - Drop down item to make selected
  **             $arr - array used to build the HTML drop down element
  ** returns: prints HTML drop down element to standard output
  ***************************************************************************/
   function list_month($list_name, $selected_item="") {
      global $VM_LANG;
       $list = array("Month",
                    "01" => _JAN,
                    "02" => _FEB,
                    "03" => _MAR,
                    "04" => _APR,
                    "05" => _MAY,
                    "06" => _JUN,
                    "07" => _JUL,
                    "08" => _AUG,
                    "09" => _SEP,
                    "10" => _OCT,
                    "11" => _NOV,
                    "12" => _DEC);
       $this->dropdown_display($list_name, $selected_item, $list);
       return 1;
   }


  /**************************************************************************
  ** name: list_year($list_name)
  ** created by: pfmartin
  ** description:  Print an HTML dropdown box for the credit cards
  ** parameters: $name - name of the HTML dropdown element
  **             $value - Drop down item to make selected
  **             $arr - array used to build the HTML drop down element
  ** returns: prints HTML drop down element to standard output
  ***************************************************************************/
   function list_year($list_name,$selected_item="") {
       $current = date("Y");
       for ($i=$current; $i<$current+7; $i++)
            $list[$i] = $i;
       $this->dropdown_display($list_name, $selected_item, $list);
       return 1;
   }

  /**************************************************************************
  ** name: list_states($list_name)
  ** created by: pfmartin
  ** description:  Print an HTML dropdown box for US states
  ** parameters: $name - name of the HTML dropdown element
  **             $value - Drop down item to make selected
  **             $arr - array used to build the HTML drop down element
  ** returns: prints HTML drop down element to standard output
  ***************************************************************************/
   function list_states($list_name,$selected_item="", $country_id="", $extra="") {
      global $VM_LANG;
      
      $db =& new ps_DB;
      $q = "SELECT country_name, state_name, state_3_code , state_2_code FROM #__{vm}_state, #__{vm}_country "; 
      $q .= "WHERE #__{vm}_state.country_id = #__{vm}_country.country_id ";
      if( !empty( $country_id ))
        $q .= " AND country_id='$country_id' ";
      $q .= "ORDER BY country_name, state_name";
      $db->query( $q );
      $list = Array();
      $list["0"] = $VM_LANG->_PHPSHOP_SELECT;
      $list["NONE"] = "not listed";
      $country = "";
      
      while( $db->next_record() ) {
        if( $country != $db->f("country_name")) {
          $list[] = "------- ".$db->f("country_name")." -------";
          $country = $db->f("country_name");
        }
        $list[$db->f("state_2_code")] = $db->f("state_name");
      }
      
      $this->dropdown_display($list_name, $selected_item, $list,"","",$extra);
      return 1;
   }
   
    function dynamic_state_lists( $country_list_name, $state_list_name, $selected_country_code="", $selected_state_code="" ) {
      global $vendor_country_3_code, $VM_LANG;
	  $db = new ps_DB;
      if( empty( $selected_country_code ))
        $selected_country_code = $vendor_country_3_code;
        
      if( empty( $selected_state_code ))
        $selected_state_code = "originalPos";
      else
        $selected_state_code = "'".$selected_state_code."'";
        
      $db->query( "SELECT #__{vm}_country.country_id,country_3_code 
                              FROM #__{vm}_country" );
      
      if( $db->num_rows() > 0 ) {
		$dbs = new ps_DB;
        // Build the State lists for each Country
        $script = "<script language=\"javascript\" type=\"text/javascript\">//<![CDATA[\n";
        $script .= "<!--\n";
        $script .= "var originalOrder = '1';\n";
        $script .= "var originalPos = '$selected_country_code';\n";
        $script .= "var states = new Array();	// array in the format [key,value,text]\n";
        $i = 0;
      
        while( $db->next_record() ) {
        
            $dbs->query( "SELECT state_name, state_2_code FROM #__{vm}_state WHERE country_id='".$db->f("country_id")."'" );
            
			if( $dbs->num_rows() > 0 ) {
				while( $dbs->next_record() ) {
					  // array in the format [key,value,text]
					  $script .= "states[".$i++."] = new Array( '".addslashes($db->f("country_3_code"))."','".$dbs->f("state_2_code")."','".addslashes($dbs->f("state_name"))."' );\n";
				}
			}
            else
              $script .= "states[".$i++."] = new Array( '".addslashes($db->f("country_3_code"))."','".$VM_LANG->_PHPSHOP_NONE."','".$VM_LANG->_PHPSHOP_NONE."' );\n";
            
            
        }
        $script .= "
        function changeStateList() { 
          var selected_country = null;
          for (var i=0; i<document.adminForm.".$country_list_name.".length; i++)
             if (document.adminForm.".$country_list_name."[i].selected)
                selected_country = document.adminForm.".$country_list_name."[i].value;
          changeDynaList('".$state_list_name."',states,selected_country, originalPos, originalOrder);
          
        }
		writeDynaList( 'class=\"inputbox\" name=\"".$state_list_name."\" size=\"1\" id=\"state\"', states, originalPos, originalPos, $selected_state_code );
		//-->
        //]]></script>";
        
        return $script;
      }
  }
   
  /**************************************************************************
  ** name: list_weight_uom($list_name)
  ** created by: pfmartin
  ** description:  Print an HTML dropdown box for the weight uom's
  ** parameters: $name - name of the HTML dropdown element
  **             $value - Drop down item to make selected
  **             $arr - array used to build the HTML drop down element
  ** returns: prints HTML drop down element to standard output
  ***************************************************************************/
   function list_weight_uom($list_name) {
       global $VM_LANG;
       
       $list = array($VM_LANG->_PHPSHOP_SELECT,
                    "LBS" => "Pounds",
                    "KGS" => "Kilograms",
                    "G" => "Grams");
       $this->dropdown_display($list_name, "", $list);
       return 1;
   }



  /**************************************************************************
  ** name: list_country($list_name)
  ** created by: pfmartin
  ** description:  Print an HTML dropdown box for the countries
  ** parameters: $name - name of the HTML dropdown element
  **             $value - Drop down item to make selected
  **             $arr - array used to build the HTML drop down element
  ** returns: prints HTML drop down element to standard output
  ***************************************************************************/
   function list_country($list_name, $value="", $extra="") {
     global $VM_LANG;
   
     $db = new ps_DB;
     
     $q = "SELECT * from #__{vm}_country ORDER BY country_name ASC";
     $db->query($q);
     echo "<select class=\"inputbox\" name=\"$list_name\" $extra>\n";
     echo "<option value=\"\">".$VM_LANG->_PHPSHOP_SELECT."</option>\n";
     while ($db->next_record()) {
       echo "<option value=\"" . $db->f("country_3_code")."\"";
       if ($value == $db->f("country_3_code")) {
	 echo " selected=\"selected\"";
       }
       echo ">" . $db->f("country_name") . "</option>\n";
     }
     echo "</select>\n";
     return True;
   }
   
  /**************************************************************************
  ** name: list_currency($list_name, $value)
  ** created by: pfmartin
  ** description:  Print an HTML dropdown box for the countries
  ** parameters: $name - name of the HTML dropdown element
  **             $value - Drop down item to make selected
  **             $arr - array used to build the HTML drop down element
  ** returns: prints HTML drop down element to standard output
  ***************************************************************************/
   function list_currency($list_name, $value="") {
     global $VM_LANG;
     $db = new ps_DB;
     
     $q = "SELECT * from #__{vm}_currency ORDER BY currency_name ASC";
     $db->query($q);
     echo "<select class=\"inputbox\" name=\"$list_name\">\n";
     echo "<option value=\"\">".$VM_LANG->_PHPSHOP_SELECT."</option>\n";
     while ($db->next_record()) {
       echo "<option value=" . $db->f("currency_code");
       if ($value == $db->f("currency_code")) {
	 echo " selected=\"selected\"";
       }
       echo ">" . $db->f("currency_name") . "</option>\n";
     }
     echo "</select>\n";
     return True;
   }
   
  /**************************************************************************
  ** name: list_currency_id($list_name, $value)
  ** created by: pfmartin
  ** description:  Print an HTML dropdown box for the countries
  ** parameters: $name - name of the HTML dropdown element
  **             $value - Drop down item to make selected
  **             $arr - array used to build the HTML drop down element
  ** returns: prints HTML drop down element to standard output
  ***************************************************************************/
   function list_currency_id($list_name, $value="") {
     global $VM_LANG;
     $db = new ps_DB;
     
     $q = "SELECT * from #__{vm}_currency ORDER BY currency_name ASC";
     $db->query($q);
     echo "<select class=\"inputbox\" name=\"$list_name\">\n";
     echo "<option value=\"\">".$VM_LANG->_PHPSHOP_SELECT."</option>\n";
     while ($db->next_record()) {
       echo "<option value=" . $db->f("currency_id");
       if ($value == $db->f("currency_id")) {
	 echo " selected=\"selected\"";
       }
       echo ">" . $db->f("currency_name") . "</option>\n";
     }
     echo "</select>\n";
     return True;
   }
   
	/**
	* @param int The row index
	* @param int The record id
	* @param string The name of the form element
	* @param string The name of the checkbox element
	* @return string
	*/
	function idBox( $rowNum, $recId, $frmName="adminForm", $name='cid' ) {

        return '<input type="checkbox" id="cb'.$rowNum.'" name="'.$name.'[]" value="'.$recId.'" onclick="ms_isChecked(this.checked, \''.$frmName.'\');" />';

	}
    
    function list_products($list_name, $values=array(), $product_id, $show_items=false ) {

        $db =& new ps_DB;
        
        $q = "SELECT product_id, product_name FROM #__{vm}_product ";
        if( !$show_items ) {
          $q .= "WHERE product_parent_id='0' AND product_id <> '$product_id'";
        }
        else {
          $q .= "WHERE product_id <> '$product_id'";
        }
        $db->query( $q );
        $products = Array();
        while( $db->next_record() ) {
          $products[$db->f("product_id")] = $db->f("product_name");
        }
        $this->dropdown_display($list_name, $values, $products, $size=20, "multiple=\"multiple\"");
    }


  /****************************************************************************
   *    function:  list_extra_field_4
   *  created by: Zdenek Dvorak
   * description: Lists items of extra_field_4.
   ****************************************************************************/
  function list_extra_field_4($t, $extra="") {
     global $VM_LANG;
     
     $title = array(array('Y',$VM_LANG->_PHPSHOP_SHOPPER_FORM_EXTRA_FIELD_4_1),
                    array('N',$VM_LANG->_PHPSHOP_SHOPPER_FORM_EXTRA_FIELD_4_2));
     
     echo "<select class=\"inputbox\" name=\"extra_field_4\" $extra>\n";
     for ($i=0;$i<count($title);$i++) {
        echo "<option value=\"" . $title[$i][0]."\"";
        if ($title[$i][0] == $t)
           echo " selected=\"selected\" ";
        echo ">" . $title[$i][1] . "</option>\n";
     }
     echo "</select>\n";
  }



	/****************************************************************************
	*    function:  list_extra_field_5
	*  created by: Zdenek Dvorak
	* description: Lists items of extra_field_5.
	****************************************************************************/
	function list_extra_field_5($t, $extra="") {
		global $VM_LANG;
		 
		$title = array(array('A',$VM_LANG->_PHPSHOP_SHOPPER_FORM_EXTRA_FIELD_5_1),
					array('B',$VM_LANG->_PHPSHOP_SHOPPER_FORM_EXTRA_FIELD_5_2),
					array('C',$VM_LANG->_PHPSHOP_SHOPPER_FORM_EXTRA_FIELD_5_3));
		 
		echo "<select class=\"inputbox\" name=\"extra_field_5\" $extra>\n";
		for ($i=0;$i<count($title);$i++) {
			echo "<option value=\"" . $title[$i][0]."\"";
			if ($title[$i][0] == $t)
			   echo " selected=\"selected\" ";
			echo ">" . $title[$i][1] . "</option>\n";
		}
		echo "</select>\n";
	}
  
  
  	/**
	* Writes a select list of integers
	* @param int The start integer
	* @returns string TableCell
	*/
    function writableIndicator( $folder ) {

		echo '<div class="quote">' . $folder . ' :: ';
		echo is_writable( $folder ) 
			? '<span style="font-weight:bold;color:green;">Writeable</span>' 
			: '<span style="font-weight:bold;color:red;">Unwriteable</span>';
		echo '</div>';
	}
  
	function deleteButton( $id_fieldname, $id, $func, $keyword="", $limitstart=0, $extra="" ) {
		global $page, $VM_LANG;
		
		$code = "<a class=\"toolbar\" href=\"index2.php?option=com_virtuemart&page=$page&func=$func&$id_fieldname=$id&keyword=". urlencode($keyword)."&limitstart=$limitstart".$extra."\" onclick=\"return confirm('".$VM_LANG->_PHPSHOP_DELETE_MSG ."');\" onmouseout=\"MM_swapImgRestore();\"  onmouseover=\"MM_swapImage('delete$id','','". IMAGEURL ."ps_image/delete_f2.gif',1);\">";
		$code .= "<img src=\"". IMAGEURL ."ps_image/delete.gif\" alt=\"Delete this record\" name=\"delete$id\" align=\"middle\" border=\"0\" />";
		$code .= "</a>";
		
		return $code;
	}
	
	function writePanelIcon( $image, $link, $text ) {
		echo '<div class="icon" style="float:left;">
			<a href="'.$link.'">
				<div class="iconimage">
					<img src="'.$image.'" alt="'.$text.'" align="middle" name="image" border="0" />
				</div>
			'.$text.'</a>
		</div>';
	
	}
}
 
?>
