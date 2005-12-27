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

class ps_userfield extends vmAbstractObject {
	
	var $_key = 'fieldid';
	
	function validateOnSave( &$d ) {
		global $vmLogger;
		/*
		if( !$this->validate($d)) {
			return false;
		}*/
		switch($d['type']) {
			case 'date':
				$d['cType']='DATE';
				break;
			case 'editorta':
			case 'textarea':
			case 'multiselect':
			case 'multicheckbox':
				$d['cType']='MEDIUMTEXT';
				break;	
			case 'checkbox':
				$d['cType']='TINYINT';
				break;			
			default:
				$d['cType']='VARCHAR(255)';
				break;
		}
		$db = new ps_DB();
		
		$sql="SELECT COUNT(*) as num_rows FROM `#__{vm}_userfield` WHERE name='".$d['name']."'";
		if( !empty($d['fieldid'])) {
			$sql .= ' AND fieldid != '.intval($d['fieldid']);
		}
		$db->query($sql); $db->next_record();
		if($db->f('num_rows')) {
			$vmLogger->err( "The field name ".$d['name']." is already in use!" );
			return false;
		}

		return true;
	}
	
	function saveField( &$d ) {
		global $my, $mosConfig_live_site;
		
		$db = new ps_DB();
		$d = $GLOBALS['vmInputFilter']->process( $d );
		
		if ($d['type'] == 'webaddress') {
			$d['rows'] = $d['webaddresstypes'];
			if ( !(($d['rows'] == 0) || ($d['rows'] == 2)) ) {
				$d['rows'] = 0;
			}
		}

		$d['name'] = str_replace(" ", "", strtolower($d['name']));

		if( !$this->validateOnSave($d)) {
			return false;
		}

		if( !empty($d['fieldid']) ) {
			// existing record
			$q = 'UPDATE `#__{vm}_userfield` SET
					`name` = \''.$d['name'].'\', 
					`title` = \''.$d['title'].'\', 
					`description` = \''.$d['description'].'\', 
					`type` = \''.$d['type'].'\', 
					`maxlength` = \''.$d['maxlength'].'\', 
					`size` = \''.$d['size'].'\', 
					`required` = \''.$d['required'].'\', 
					`ordering` = \''.$d['ordering'].'\', 
					`cols` = \''.$d['cols'].'\', 
					`rows` = \''.$d['rows'].'\', 
					`value` = \''.@$d['value'].'\', 
					`default` = \''.@$d['default'].'\', 
					`published` = \''.$d['published'].'\', 
					`registration` = \''.$d['registration'].'\', 
					`account` = \''.@$d['account'].'\', 
					`readonly` = \''.$d['readonly'].'\', 
					`calculated` = \''.@$d['calculated'].'\', 
					`params` = \''.@$d['params'].'\'
					 WHERE `fieldid` ='. intval($d['fieldid']);
			$db->query( $q );
			if( $d['type'] != 'delimiter') {
				$this->changeColumn( $d['name'], $d['cType'], 'update');
			}

		} else {
			// add a new record			
			$sql="SELECT MAX(ordering) as max FROM #__{vm}_userfield";
			$db->query($sql); $db->next_record();
			$d['ordering'] = $db->f('max')+1;
			
			$q = 'INSERT INTO `#__{vm}_userfield` 
					(`name`,`title`,`description`,`type`,`maxlength`,`size`,`required`,
					`ordering`,`cols`,`rows`,`value`,`default`,`published`,`registration`,
					`account`,`readonly`,`calculated`,`sys`,`vendor_id`, `params`) 
					VALUES(
					\''.$d['name'].'\', \''.$d['title'].'\', \''.$d['description'].'\', 
					\''.$d['type'].'\', \''.$d['maxlength'].'\', \''.$d['size'].'\', \''.$d['required'].'\', 
					\''.$d['ordering'].'\', \''.$d['cols'].'\', \''.$d['rows'].'\', \''.$d['value'].'\', 
					\''.$d['default'].'\', \''.$d['published'].'\', \''.$d['registration'].'\', \''.$d[''].'\', 
					\''.$d['account'].'\', \''.$d['readonly'].'\', \''.$d['calculated'].'\', \''.$_SESSION['ps_vendor_id'].'\', \''.$d['params'].'\'
					)';
			$db->query( $q );
			if( $d['type'] != 'delimiter') {
				$this->changeColumn( $d['name'], $d['cType'], 'add');
			}
		}
			
		$fieldValues = array();
		$fieldNames = array();
		$fieldNames = $_POST['vNames'];
		$fieldValues = $_POST['vValues'];
		$j=1;
		if( !empty( $d['fieldid'] )) {
			$db->query( "DELETE FROM #__{vm}_userfield_values"
			. " WHERE fieldid='".$d['fieldid']."'" );
		} else {
			$db->query( "SELECT MAX(fieldid) as max FROM `#__{vm}_userfield`" );
			$maxID=$db->loadResult();
			$d['fieldid']=$maxID;
		}
		$n=count( $fieldNames );
		for($i=0; $i < $n; $i++) {
			if(trim($fieldNames[$i])!=null || trim($fieldNames[$i])!='') {
				$db->query( "INSERT INTO #__{vm}_userfield_values (fieldid,fieldtitle,fieldvalue, ordering)"
				. " VALUES('".$d['fieldid']."','".htmlspecialchars($fieldNames[$i])."','".htmlspecialchars($fieldValues[$i])."',$j)" );
				$j++;
			}
		}
		return true;
	}
	/**
	 * Add, change or drop fields from the VirtueMart user tables
	 * Currently these are: #__{vm}_user_info, #__{vm}_order_user_info
	 * @param string $column
	 * @param string $type The column type is determined in the validateOnSave function
	 * @param string $action Can be: add, update or delete
	 */
	function changeColumn( $column, $type, $action) {
		global $vmLogger;
		
		switch( $action ) {
			case 'add': $action = 'ADD'; break;
			case 'update': 
			case 'change': 
				$action = 'CHANGE'; break;
			case 'delete': $action = 'DROP'; break;
			default: $action = 'ADD'; break;
		}
		$db = new ps_DB();
		// The general shopper information table
		$special = '';
		if( $action=='CHANGE') {
			$special = "`$column`";
		}
		$sql="ALTER TABLE `#__{vm}_user_info` $action `$column` $special $type";
		$db->query($sql);
		// The table where the shopper information at the time of an order is stored
		$sql="ALTER TABLE `#__{vm}_order_user_info` $action `$column` $type";
		$db->query($sql);
		
	}
	/**
	 * Remove a user field from the system
	 *
	 * @param int $cid
	 * @return boolean The result of the delete action
	 */
	function deleteField( &$d ) {
		global $db;
		if( !is_array( @$d['fieldid'] )) {
			$d['fieldid'] = array( $d['fieldid']);
		}
		if ( count( @$d['fieldid'] ) < 1) {
			echo "<script type=\"text/javascript\"> alert('Select an item to delete'); window.history.go(-1);</script>\n";
			exit;
		}

		foreach ($d['fieldid'] as $id) {
			$db->query('SELECT fieldid, name, title, ordering,sys FROM `#__{vm}_userfield` WHERE fieldid ='.intval($id));
			$db->next_record();
			
			if($db->f('sys')==1) {
				$vmLogger->err($db->f('title') ." cannot be deleted because it is a system field. \n");
				return false;
			}
			else {
				if( $db->f('type') != 'delimiter') {
					$this->changeColumn( $db->f('name'), '', 'delete');
				}
				
				$db->query('DELETE FROM `#__{vm}_userfield` WHERE fieldid='.$id );
				
				$db->query( 'UPDATE `#__{vm}_userfield` SET ordering = ordering-1 WHERE ordering > '.intval($db->f('ordering')));
				
			}
		}
		
		return true;
	}
	
	/**
	 * This allows us to print the user fields on
	 * the various sections of the shop
	 *
	 * @param array $rowFields An array returned from ps_database::loadObjectlist
	 * @param array $skipFields A one-dimensional array holding the names of fields that should NOT be displayed
	 * @param ps_DB $db A ps_DB object holding ovalues for the fields
	 */
	function listUserFields( $rowFields, $skipFields=array(), $db = null ) {
		global $mm_action_url, $ps_html, $VM_LANG, $my, $default, 
			$vendor_country_3_code, $mosConfig_live_site, $page;
		
		$dbf = new ps_DB();
		
		if( $db === null ) {
			$db = new ps_DB();
		}
		$default['country'] = $vendor_country_3_code;
		
		$missing = mosGetParam( $_REQUEST, "missing", "" );
		$missing_style = "color:red; font-weight:bold;";	
		
		$label_div_style = 'float:left;width:30%;text-align:right;vertical-align:bottom;font-weight: bold;padding-right: 5px;';
		$field_div_style = 'float:left;width:60%;';
		/**
		 * This section will be changed in future releases of VirtueMart,
		 * when we have a registration form manager
		 */
		$required_fields = Array(); 
		foreach( $rowFields as $field ) {
			if( $field->required == 1 ) {
				$required_fields[$field->name] = $field->name;
			}
			$allfields[$field->name] = $field->name;
		}
		foreach( $skipFields as $skip ) {			
			unset($required_fields[$skip]); 
		}
		
		// Form validation function
		vmCommonHTML::printJS_formvalidation( $required_fields );
		?>
		<script type="text/javascript" src="includes/js/mambojavascript.js"></script>
		
		<form action="<?php echo $mm_action_url ?>index.php" method="post" name="adminForm">
			
		<div style="width:90%;">
			<div style="padding:5px;text-align:center;"><strong>(* = <?php echo _CMN_REQUIRED ?>)</strong></div>
		   <?php
	   $delimiter = 0;
	   foreach( $rowFields as $field) {
	   		$default[$field->name] = $field->default;
	   		
	   		if( in_array( $field->name, $skipFields )) {
	   			continue;
	   		}
	   		// Title handling.
	   		$key = $field->title;
	   		if( isset( $VM_LANG->$key )) {
	   			$field->title = $VM_LANG->$key;
	   		}
	   		elseif( substr( $field->title, 0, 1) == '_') {
	   			eval( "\$field->title = ".$field->title.";");
	   		}
	   		if( $field->name == 'agreed') {
	   					$field->title = '<script type="text/javascript">//<![CDATA[
				document.write(\'<label for="agreed_field"><a href="javascript:void window.open(\\\''. $mosConfig_live_site .'/index2.php?option=com_virtuemart&page=shop.tos&pop=1\\\', \\\'win2\\\', \\\'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no\\\');">\');
				document.write(\''.htmlspecialchars( $VM_LANG->_PHPSHOP_I_AGREE_TO_TOS, ENT_QUOTES ) .'</a></label>\');
				//]]></script>
				<noscript><label for="agreed_field"><a target="_blank" href="'. $mosConfig_live_site .'/index.php?option=com_virtuemart&page=shop.tos" title="'. $VM_LANG->_PHPSHOP_I_AGREE_TO_TOS .'">
				'. $VM_LANG->_PHPSHOP_I_AGREE_TO_TOS .'</a></label></noscript>';
	   		}
	   		// a delimiter marks the beginning of a new fieldset and
	   		// the end of a previous fieldset
	   		if( $field->type == 'delimiter') {
	   			if( $delimiter > 0) {
	   				echo "</fieldset>\n";
	   			}
	   			if( VM_SILENT_REGISTRATION == '1' && $field->title == $VM_LANG->_PHPSHOP_ORDER_PRINT_CUST_INFO_LBL && $page == 'checkout.index' ) {
	   				continue;
	   			}
	   			echo '<fieldset>
				     <legend class="sectiontableheader">'.$field->title.'</legend>
				     ';
	   			$delimiter++;
	   			continue;
	   		}
	   		
	   		echo '<div id="'.$field->name.'_div" style="'.$label_div_style;
	   		if (stristr($missing,$field->name)) {
	   			echo $missing_style;
	   		}
	   		echo '">';
	        echo '<label for="'.$field->name.'_field">'.$field->title.'</label>';
	        if( in_array( $field->name, $required_fields)) {
	        	echo '<strong>* </strong>';
	        }
	      	echo ' </div>
	      <div style="'.$field_div_style.'">'."\n";
	      	
	      	/**
	      	 * This is the most important part of this file
	      	 * Here we print the field & its contents!
	      	 */
	   		switch( $field->name ) {
	   			case 'title':
	   				$ps_html->list_user_title($db->sf('title'), "id=\"user_title\"");
	   				break;
	   			
	   			case 'country':
	   				if( in_array('state', $allfields ) ) {
	   					$onchange = "onchange=\"changeStateList();\"";
	   				}
	   				else {
	   					$onchange = "";
	   				}
	   				$ps_html->list_country("country", $db->sf('country'), "id=\"country_field\" $onchange");
	   				break;
	   			
	   			case 'state':
	   				echo $ps_html->dynamic_state_lists( "country", "state", $db->sf('country'), $db->sf('state') );
				    echo "<noscript>\n";
				    $ps_html->list_states("state", $db->sf('state'), "", "id=\"state\"");
				    echo "</noscript>\n";
	   				break;
				case 'agreed':
					echo '<input type="checkbox" id="agreed_field" name="agreed" value="1" class="inputbox" />';
					break;
				case 'password':
				case 'password2':
					echo '<input type="password" id="'.$field->name.'_field" name="'.$field->name.'" size="30" class="inputbox" />'."\n";
		   			break;
		   		
	   			default:
	   				
	   				switch( $field->type ) {
	   					case 'date':
	   					case 'emailaddress':
	   					case 'webaddress':
	   					case 'text':
	   						
	   						$maxlength = $field->maxlength ? 'maxlength="'.$field->maxlength.'"' : '';
					        echo '<input type="text" id="'.$field->name.'_field" name="'.$field->name.'" size="'.$field->size.'" value="'. $db->sf($field->name) .'" class="inputbox" '.$maxlength.' />'."\n";
				   			break;
						case 'textarea':
							echo '<textarea name="'.$field->name.'" id="'.$field->name.'_field" cols="'.$field->cols.'" rows="'.$field->rows.'">'.$db->sf($field->name).'</textarea>';
							break;
						case 'editorta':
							editorArea( $field->name, $db->sf($field->name), $field->name, '300', '150', $field->cols, $field->rows );			
							break;
						case 'checkbox':
							echo '<input type="checkbox" name="'.$field->name.'" id="'.$field->name.'_field" value="1" />';
							break;
							
						// Begin of a fallthrough
						case 'multicheckbox':
						case 'select':
						case 'multiselect':
						case 'radio':
							$k = $db->f($field->name);
							$dbf->setQuery( "SELECT fieldtitle,fieldvalue FROM #__{vm}_userfield_values"
							. "\n WHERE fieldid = ".$field->fieldid
							. "\n ORDER BY ordering" );
							$Values = $dbf->loadObjectList();
							$multi="";
							$rowFieldValues['lst_'.$field->name] = '';
							if($field->type=='multiselect') $multi="multiple='multiple'";		
							if(count($Values) > 0) {
								if($field->type=='radio') {
									$rowFieldValues['lst_'.$field->name] = vmCommonHTML::radioListTable( $Values, $field->name, 
										'class="inputbox" size="1" ', 
										'fieldvalue', 'fieldtitle', $k, $field->cols, $field->rows, $field->size, $field->required);
								} else {
									$ks=explode("|*|",$k);
									$k = array();
									foreach($ks as $kv) {
										$k[]->fieldvalue=$kv;
									}
									if($field->type=='multicheckbox') {
										$rowFieldValues['lst_'.$field->name] = vmCommonHTML::checkboxListTable( $Values, $field->name."[]", 
											'class="inputbox" size="'.$field->size.'" '.$multi, 
											'fieldvalue', 'fieldtitle', $k, $field->cols, $field->rows, $field->size, $field->required);
									} else {
										$rowFieldValues['lst_'.$field->name] = vmCommonHTML::selectList( $Values, $field->name."[]", 
											'class="inputbox" size="'.$field->size.'" '.$multi, 
											'fieldvalue', 'fieldtitle', $k);
									}
								}
							}
							// no break! still a fallthrough
							echo $rowFieldValues['lst_'.$field->name];
							break;
	   				}
	   				break;
	   		}
	   		if( $field->description != '') {
	   			echo mm_ToolTip( $field->description );
	   		}
	   		echo '</div>
				      <br/><br/>';
	   }
	   echo '</fieldset>';
	}
	
	function prepareFieldDataSave($fieldType,$fieldName,$value=null) {
		global $ueConfig,$_POST;
		$sqlFormat = "Y-m-d";
		switch($fieldType) {
			case 'date': 
				$value=dateConverter(vmGetUnEscaped($value),$ueConfig['date_format'],$sqlFormat);
				break;
			case 'webaddress':
				if (isset($_POST[$fieldName."Text"]) && ($_POST[$fieldName."Text"])) {
					$oValuesArr=array();
					$oValuesArr[0]=htmlspecialchars(str_replace(array('mailto:','http://','https://'),'',
									vmGetUnEscaped($value)));
					$oValuesArr[1]=htmlspecialchars(str_replace(array('mailto:','http://','https://'),'',
									vmGetUnEscaped((isset($_POST[$fieldName."Text"]) ? $_POST[$fieldName."Text"] : ""))));
					$value = implode("|*|",$oValuesArr);
				} else {
					$value= htmlspecialchars(str_replace(array('mailto:','http://','https://'),'',vmGetUnEscaped($value)));
				}
				break;
			case 'emailaddress': 
				$value=htmlspecialchars(str_replace(array('mailto:','http://','https://'),'',vmGetUnEscaped($value)));
				break;
			case 'editorta': 
				$value=vmGetUnEscaped($value);
				break;
			case 'multiselect':
			case 'multicheckbox':
			case 'select':
				if( is_array( $value )) { $value = implode("|*|",$value); }
				$value = htmlspecialchars( vmGetUnEscaped( $value ) );
				break;
			case 'delimiter':
				break;
			default:
				$value=htmlspecialchars(vmGetUnEscaped($value));
				break;
		}
		return $value;
		
	}
	/**
	 * This function allows you to get an object list of user fields
	 *
	 * @param string $section The section the fields belong to (e.g. 'registration' or 'account')
	 * @param boolean $required_only
	 * @param mixed $sys When left empty, doesn't filter by sys
	 * @return array
	 */
	function getUserFields( $section = 'registration', $required_only=false, $sys = '' ) {
		$db = new ps_DB();
		
		$q = "SELECT f.* FROM `#__{vm}_userfield` f"
			. "\n WHERE f.published=1 AND f.`$section`=1 AND f.type != 'delimiter' ";
		if( $required_only ) {
			$q .= " AND f.required=1";
		}
		if( $sys !== '') {
			if( $sys == '1') { $q .= " AND f.sys=1"; }
			elseif( $sys == '0') { $q .= " AND f.sys=0"; }
		}
		$q .= " OR ( FIND_IN_SET( f.name, '".implode(',', ps_userfield::getSkipFields())."') = 0 AND f.published=1 )";
		$q .= "\n ORDER BY f.ordering";
		
		$db->setQuery( $q );
		$userFields = $db->loadObjectList();
		
		return $userFields;
	}
	/**
	 * Returns an array of fieldnames which are NOT used for VirtueMart tables
	 *
	 * @return array Field names which are to be skipped by VirtueMart db functions
	 */
	function getSkipFields() {
		$skipFields = array( 'username', 'password', 'password2', 'agreed' );
		return $skipFields;
	}
}
?>