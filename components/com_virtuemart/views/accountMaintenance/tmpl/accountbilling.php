<?php 
defined('_JEXEC') or die('Restricted access');
?>
<div style="float:left;width:90%;text-align:right;"> 
    <span>
    	<a href="#" onclick="if( submitregistration() ) { document.adminForm.submit(); return false;}">
    		<img border="0" src="administrator/images/save_f2.png" name="submit" alt="<?php echo JText::_('CMN_SAVE') ?>" />
    	</a>
    </span>
    <span style="margin-left:10px;">
    <a href="<?php echo Vmconfig::getVar('secureurl')."index.php?option=com_virtuemart&view=accountmaintenance"; ?>">
    		<img src="administrator/images/back_f2.png" alt="<?php echo JText::_('BACK') ?>" border="0" />
    	</a>
    </span>
</div>
<div style="width:90%;">
<form action="<?php echo JRoute::_('index.php?option=com_virtuemart&view=accountmaintenance'); ?>" method="post" name="adminForm">
<?php
if (!empty($this->fields['required_fields']))  {
	echo '<div style="padding:5px;text-align:center;"><strong>(* = '.JText::_('CMN_REQUIRED').')</strong></div>';
}
$delimiter = 0;
foreach ($this->fields['details'] as $field) {
	// if (!isset($default[$field->name])) {
	// 	$default[$field->name] = $field->default;
	// }
	$readonly = $field->readonly ? ' readonly="readonly"' : '';
	if (in_array($field->name, $this->fields['skipfields'])) {
		continue;
	}
	// Title handling.
	$key = $field->title;
	if( $key[0] == '_') {
		$key = substr($key, 1, strlen($key)-1);
	}
	$field->title = JText::_($key);
	if ($field->name == 'agreed') {
		$field->title = '<script type="text/javascript">//<![CDATA[
		document.write(\'<label for="agreed_field">'. str_replace("'","\\'",JText::_('VM_I_AGREE_TO_TOS')) .'</label><a href="javascript:void window.open(\\\''.JURI::root().'index2.php?option=com_virtuemart&page=shop.tos&pop=1\\\', \\\'win2\\\', \\\'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no\\\');">\');
		document.write(\' ('.JText::_('VM_STORE_FORM_TOS') .')</a>\');
		//]]></script>
		<noscript>
		<label for="agreed_field">'. JText::_('VM_I_AGREE_TO_TOS') .'</label>
		<a target="_blank" href="'.JURI::root().'index.php?option=com_virtuemart&amp;page=shop.tos" title="'. JText::_('VM_I_AGREE_TO_TOS') .'">
		 ('.JText::_('VM_STORE_FORM_TOS').')
		</a></noscript>';
	}
	if( $field->name == 'username' && Vmconfig::getVar('vm_registration_type') == 'OPTIONAL_REGISTRATION' ) {
		echo '<div class="formLabel">
			<input type="checkbox" id="register_account" name="register_account" value="1" class="inputbox" onchange="showFields( this.checked, new Array(\'username\', \'password\', \'password2\') );if( this.checked ) { document.adminForm.remember.value=\'yes\'; } else { document.adminForm.remember.value=\'yes\'; }" checked="checked" />
			</div>
			<div class="formField">
			<label for="register_account">'.JText::_('VM_REGISTER_ACCOUNT').'</label>
			</div>
			';
	} 
	elseif( $field->name == 'username' ) {
		echo '<input type="hidden" id="register_account" name="register_account" value="1" />';
	}
	// a delimiter marks the beginning of a new fieldset and
	// the end of a previous fieldset
	if ($field->type == 'delimiter') {
		if ($delimiter > 0) echo "</fieldset>\n";
		if (Vmconfig::getVar('vm_registration_type') == 'SILENT_REGISTRATION' 
			&& $field->title == JText::_('VM_ORDER_PRINT_CUST_INFO_LBL')) {
	   				continue;
	   	}
		echo '<fieldset><legend class="sectiontableheader">'.$field->title.'</legend>';
		$delimiter++;
		continue;
	}
	echo '<div id="'.$field->name.'_div" class="formLabel ';
	if (stristr($missing,$field->name)) echo 'missing';
	echo '">';
	echo '<label for="'.$field->name.'_field">'.$field->title.'</label>';
	if( isset( $required_fields[$field->name] )) {
		echo '<strong>* </strong>';
	}
	echo ' </div><div class="formField" id="'.$field->name.'_input">'."\n";
   	
	/**
	* This is the most important part of this file
	* Here we print the field & its contents!
	*/
	
	switch ($field->name) {
			case 'title':
				shopFunctions::listUserTitle($this->userinfo->title, 'id="title_field"');
				//$ps_html->list_user_title($db->sf('title'), "id=\"title_field\"");
				break;
			case 'country':
				if( in_array('state', $allfields ) ) {
					$onchange = "onchange=\"changeStateList();\"";
				}
				else {
					$onchange = "";
				}
				echo shopFunctions::renderCountryList($this->userinfo->country);
				break;
						case 'state':
//	   				echo $ps_html->list_states("vendor_state", $db->sf("vendor_state"));
				// echo $ps_html->dynamic_state_lists( "country", "state", $db->sf('country'), $db->sf('state') );
				echo "<noscript>\n";
				// $ps_html->list_states("state", $db->sf('state'), "", "id=\"state_field\"");
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
						echo vmCommonHTML::scriptTag( $mosConfig_live_site .'/includes/js/calendar/calendar.js');
//							if( vmIsJoomla( '1.5', '>=' ) ) {
							// in Joomla 1.5, the name of calendar lang file is changed...
							echo vmCommonHTML::scriptTag( $mosConfig_live_site .'/includes/js/calendar/lang/calendar-en-GB.js');
//							} else {
//								echo vmCommonHTML::scriptTag( $mosConfig_live_site .'/includes/js/calendar/lang/calendar-en.js');
//							}
						echo vmCommonHTML::linkTag( $mosConfig_live_site .'/includes/js/calendar/calendar-mos.css');
					
						$maxlength = $field->maxlength ? 'maxlength="'.$field->maxlength.'"' : '';
						echo '<input type="text" id="'.$field->name.'_field" name="'.$field->name.'" size="'.$field->size.'" value="'. ($db->sf($field->name)?$db->sf($field->name):'') .'" class="inputbox" '.$maxlength . $readonly . ' />'."\n";
						echo '<input name="reset" type="reset" class="button" onclick="return showCalendar(\''.$field->name.'_field\', \'y-mm-dd\');" value="..." />';
						break;
					case 'text':
					case 'emailaddress':
					case 'webaddress':
					case 'euvatid':	   						
						$maxlength = $field->maxlength ? 'maxlength="'.$field->maxlength.'"' : '';
						//echo '<input type="text" id="'.$field->name.'_field" name="'.$field->name.'" size="'.$field->size.'" value="'. ($db->sf($field->name)?$db->sf($field->name):'') .'" class="inputbox" '.$maxlength . $readonly . ' />'."\n";
						break;
						
					case 'textarea':
						echo '<textarea name="'.$field->name.'" id="'.$field->name.'_field" cols="'.$field->cols.'" rows="'.$field->rows.'" '.$readonly.'>'.$db->sf($field->name).'</textarea>';
						break;
						
					case 'editorta':
						editorArea( $field->name, $db->sf($field->name), $field->name, '300', '150', $field->cols, $field->rows );			
						break;
						
					case 'checkbox':
						echo '<input type="checkbox" name="'.$field->name.'" id="'.$field->name.'_field" value="1" '. ($db->sf($field->name) ? 'checked="checked"' : '') .'/>';
						break;
					case 'age_verification':
						$year = vmRequest::getInt('birthday_selector_year', date('Y'));
						if( $db->f($field->name) ) {
							$birthday = $db->f($field->name);
							$date_array = explode('-', $birthday );
							$year = $date_array[0];
							$month = $date_array[1];
							$day = $date_array[2];
						}
						ps_html::list_days('birthday_selector_day', vmRequest::getInt('birthday_selector_day', @$day));
						ps_html::list_month('birthday_selector_month', vmRequest::getInt('birthday_selector_month', @$month));							
						ps_html::list_year('birthday_selector_year', $year, $year-100, $year);
						break;
					case 'captcha':
						if (file_exists($mosConfig_absolute_path.'/administrator/components/com_securityimages/client.php')) {
							include ($mosConfig_absolute_path.'/administrator/components/com_securityimages/client.php');
							// Note that this package name must be used on the validation site too! If both are not equal, validation will fail
							$packageName = 'securityVMRegistrationCheck';
							echo insertSecurityImage($packageName);
							echo getSecurityImageText($packageName);
						}
						break;
					// Begin of a fallthrough
					case 'multicheckbox':
					case 'select':
					case 'multiselect':
					case 'radio':
						$dbf = JFactory::getDBO();
						//$k = $db->f($field->name);
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
	   			echo vmToolTip( $field->description );
	   		}
	   		echo '<br /></div>
				      <br style="clear:both;" />';
	   
		if( $delimiter > 0) {
			echo "</fieldset>\n";
		}
	   echo '</div>';
	   if (Vmconfig::getVar('vm_registration_type') == 'OPTIONAL_REGISTRATION') {
		   	echo '<script type="text/javascript">
		   	//<![CDATA[
		   function showFields( show, fields ) {
		   	if( fields ) {
		   		for (i=0; i<fields.length;i++) {
		   			if( show ) {
		   				document.getElementById( fields[i] + \'_div\' ).style.display = \'\';
		   				document.getElementById( fields[i] + \'_input\' ).style.display = \'\';
		   			} else {
		   				document.getElementById( fields[i] + \'_div\' ).style.display = \'none\';
		   				document.getElementById( fields[i] + \'_input\' ).style.display = \'none\';
		   			}
		   		}
		   	}
		   }
		   try {
		   	showFields( document.getElementById( \'register_account\').checked, new Array(\'username\', \'password\', \'password2\') );
		   } catch(e){}
		   //]]>
		   </script>';
	   }
}
// ps_userfield::listUserFields( $fields, $skip_fields, $db );
?>

<div align="center">	
	<input type="submit" value="<?php echo JText::_('CMN_SAVE') ?>" class="button" onclick="return( submitregistration());" />
</div>
  <input type="hidden" name="option" value="<?php echo $option ?>" />
  <input type="hidden" name="page" value="<?php echo $next_page; ?>" />
  <input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />
  <input type="hidden" name="func" value="shopperupdate" />
  <input type="hidden" name="user_info_id" value="<?php $this->userinfo->user_info_id; ?>" />
  <input type="hidden" name="user_id" value="<?php echo $this->auth["user_id"] ?>" />
  <input type="hidden" name="address_type" value="BT" />
  <noscript>
	  <input type="submit" class="inputbox" value="<?php echo JText::_('CMN_SAVE') ?>" />
  </noscript>
</form>