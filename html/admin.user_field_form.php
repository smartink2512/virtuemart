<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
*
* @version $Id$
* @package VirtueMart
* @subpackage html
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
mm_showMyFileName( __FILE__ );

require_once( CLASSPATH . 'ps_userfield.php' );

$fieldid = mosgetparam($_REQUEST, 'fieldid', 0);
$option = empty($option)?mosgetparam( $_REQUEST, 'option', 'com_virtuemart'):$option;

//First create the object and let it print a form heading
$formObj = &new formFactory( $VM_LANG->_VM_USERFIELD_FORM_LBL );
//Then Start the form
$formObj->startForm();

$lists = array();
$types = array();

$types[] = mosHTML::makeOption( 'text', 'Text Field' );
$types[] = mosHTML::makeOption( 'checkbox', 'Check Box (Single)' );
$types[] = mosHTML::makeOption( 'multicheckbox', 'Check Box (Muliple)' );
$types[] = mosHTML::makeOption( 'date', 'Date' );
$types[] = mosHTML::makeOption( 'select', 'Drop Down (Single Select)' );
$types[] = mosHTML::makeOption( 'multiselect', 'Drop Down (Multi-Select)' );
$types[] = mosHTML::makeOption( 'emailaddress', 'Email Address' );	
//$types[] = mosHTML::makeOption( 'password', 'Password Field' );
$types[] = mosHTML::makeOption( 'editorta', 'Editor Text Area' );
$types[] = mosHTML::makeOption( 'textarea', 'Text Area' );
$types[] = mosHTML::makeOption( 'radio', 'Radio Button' );
$types[] = mosHTML::makeOption( 'webaddress', 'Web Address' );
$types[] = mosHTML::makeOption( 'delimiter', 'Fieldset delimiter' );

$webaddrtypes = array();

$webaddrtypes[] = mosHTML::makeOption( '0', 'URL only' );
$webaddrtypes[] = mosHTML::makeOption( '2', 'Hypertext and URL' );

$db->query( "SELECT `fieldtitle`, `fieldvalue` "
	. "\n FROM `#__{vm}_userfield_values`"
	. "\n WHERE `fieldid`=$fieldid"
	. "\n ORDER BY ordering" );
$fieldvalues = $db->loadObjectList();

if (!empty($fieldid)) {
    $q = "SELECT * FROM #__{vm}_userfield WHERE fieldid=$fieldid"; 
    $db->query($q);  
    $db->next_record();
}

$lists['webaddresstypes'] = mosHTML::selectList( $webaddrtypes, 'webaddresstypes', 'class="inputbox" size="1"', 'value', 'text', $db->f('rows') );
	
$lists['type'] = mosHTML::selectList( $types, 'type', 'class="inputbox" size="1" onchange="selType(this.options[this.selectedIndex].value);"', 'value', 'text', $db->f('type') );

$lists['required'] = mosHTML::yesnoSelectList( 'required', 'class="inputbox" size="1"', $db->sf('required') );

$lists['published'] = mosHTML::yesnoSelectList( 'published', 'class="inputbox" size="1"', $db->sf('published') );

$lists['readonly'] = mosHTML::yesnoSelectList( 'readonly', 'class="inputbox" size="1"', $db->sf('readonly') );

$lists['account'] = mosHTML::yesnoSelectList( 'account', 'class="inputbox" size="1"', $db->sf('account') );

$lists['registration'] = mosHTML::yesnoSelectList( 'registration', 'class="inputbox" size="1"', $db->sf('registration') );

?>
	<table cellpadding="4" cellspacing="0" border="0" width="100%">
		<tr>
			<td class="sectionname"><img src="<?php echo $mosConfig_live_site.'/administrator/images/addusers.png' ?>" align="middle"><?php echo $db->f('fieldid') ? 'Edit' : 'Add';?> Field</td>
		</tr>
	</table>

	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="adminForm">
	
	<table class="adminform">
		<tr class="row0">
			<td width="20%">Type:</td>
			<td width="20%"><?php echo $lists['type']; ?></td>
			<td>&nbsp;</td>
		</tr>
		<tr class="row1">
			<td width="20%">Table Field Name:</td>
			<td align=left  width="20%"><input onchange="prep4SQL(this);" type="text" name="name" mosReq=1 mosLabel="Name" class="inputbox" value="<?php $db->sp('name'); ?>" <?php if($db->f('sys')) echo 'readonly="readonly"' ?> /></td>
			<td>&nbsp;</td>
		</tr>
		<tr class="row0">
			<td width="20%">Title (Field Label):</td>
			<td width="20%" align=left><input type="text" name="title" mosReq=1 mosLabel="Title" class="inputbox" value="<?php $db->sp('title'); ?>" /></td>
			<td>&nbsp;</td>
		</tr>
		<tr class="row1">
			<td width="20%">Description, field-tip: text or HTML:</td>
			<td width="20%" align=left><textarea name="description" cols=50 rows=6 maxlength='255' mosReq=0 mosLabel="Description" class="inputbox"><?php $db->sp('description'); ?></textarea></td>
			<td>&nbsp;</td>
		</tr>
		<tr class="row0">
			<td width="20%">Required?:</td>
			<td width="20%"><?php echo $lists['required']; ?></td>
			<td>&nbsp;</td>
		</tr>
		<tr class="row1">
			<td width="20%">Show on Account?:</td>
			<td width="20%"><?php echo $lists['account']; ?></td>
			<td>&nbsp;</td>
		</tr>
		<tr class="row0">
			<td width="20%">User Read Only?:</td>
			<td width="20%"><?php echo $lists['readonly']; ?></td>
			<td>&nbsp;</td>
		</tr>
		<tr class="row1">
			<td width="20%">Show at Registration?:</td>
			<td width="20%"><?php echo $lists['registration']; ?></td>
			<td>&nbsp;</td>
		</tr>
		<tr class="row0">
			<td width="20%">Published:</td>
			<td width="20%"><?php echo $lists['published']; ?></td>
			<td>&nbsp;</td>
		</tr>
		<tr class="row1">
			<td width="20%">Size:</td>
			<td width="20%"><input type="text" name="size" mosLabel="Size" class="inputbox" value="<?php echo $db->f('size'); ?>" /></td>
			<td>&nbsp;</td>
		</tr>
		</table>
		<div id=page1  class="pagetext">
		
		</div>
		<div id=divText  class="pagetext">
		<table class="adminform">
		<tr class="row0">
			<td width="20%">Max Length:</td>
			<td width="20%"><input type="text" name="maxlength" mosLabel="Max Length" class="inputbox" value="<?php echo $db->f('maxlength'); ?>" /></td>
			<td>&nbsp;</td>
		</tr>
		</table>
		</div>
		<div id=divColsRows  class="pagetext">
		<table class="adminform">
		<tr class="row0">
			<td width="20%">Cols:</td>
			<td width="20%"><input type="text" name="cols" mosLabel="Cols" class="inputbox" value="<?php echo $db->f('cols'); ?>" /></td>
			<td>&nbsp;</td>
		</tr>
		<tr class="row1">
			<td width="20%">Rows:</td>
			<td width="20%"><input type="text" name="rows"  mosLabel="Rows" class="inputbox" value="<?php echo $db->f('rows'); ?>" /></td>
			<td>&nbsp;</td>
		</tr>
		</table>
		</div>
		<div id=divWeb  class="pagetext">
		<table cellpadding="4" cellspacing="1" border="0" width="100%" class="adminform">
		<tr>
			<td width="20%">Type:</td>
			<td width="20%"><?php echo $lists['webaddresstypes']; ?></td>
			<td>&nbsp;</td>
		</tr>
		</table>
		</div>
		<div id=divValues style="text-align:left;">
		Use the table below to add new values.<br />
		<input type=button onclick="insertRow();" value="Add a Value" />
		<table align=left id="divFieldValues" cellpadding="4" cellspacing="1" border="0" width="100%" class="adminform" >
		<thead>
			<th class="title" width="20%">Title</th>
			<th class="title" width="80%">Value</th>
		</thead>
		<tbody id="fieldValuesBody">
		<tr>
			<td></td>
		</tr>
	<?php	
		//echo "count:".count( $fieldvalues );
		//print_r (array_values($fieldvalues));
		$n=count( $fieldvalues );
		for ($i=0; $i < $n; $i++) {
			//print "count:".$i;
			$fieldvalue = $fieldvalues[$i];
			if ($i==0) $req =1;
			else $req = 0;
			echo "<tr>\n<td width=\"20%\"><input type=\"text\" value=\"".stripslashes(@$fieldvalue->fieldtitle)."\" name=\"vNames[".$i."]\" /></td>\n";
			echo "\n<td width=\"80%\"><input type=\"text\" value=\"".stripslashes(@$fieldvalue->fieldvalue)."\" name=\"vValues[".$i."]\" /></td></tr>\n";
		}
		if(count( $fieldvalues )< 1) {
			echo "<tr>\n<td width=\"20%\"><input type=\"text\" value=\"\" name=\"vNames[0]\" /></td>\n";
			echo "\n<td width=\"80%\"><input type=\"text\" value=\"\" name=\"vValues[0]\" /></td></tr>\n";
			$i=0;
		}
	?>
		</tbody>
		</table>
		</div>
  <table class="adminform">
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>

  </table>
 <?php
// Add necessary hidden fields
$formObj->hiddenField( 'fieldid', $fieldid );
$formObj->hiddenField( 'valueCount', $i );
$formObj->hiddenField( 'ordering', $db->f('ordering') );

// Write your form with mixed tags and text fields
// and finally close the form:
$formObj->finishForm( 'userfieldSave', $modulename.'.user_field_list', $option );
?>
<script type="text/javascript">
  function getObject(obj) {
    var strObj;
    if (document.all) {
      strObj = document.all.item(obj);
    } else if (document.getElementById) {
      strObj = document.getElementById(obj);
    }
    return strObj;
  }
  
   function submitbutton(pressbutton) {

       document.adminForm.type.disabled=false;
       submitform(pressbutton);
     
   }

  function insertRow() {
    var oTable = getObject("fieldValuesBody");
    var oRow, oCell ,oCellCont, oInput;
    var i, j;
    i=document.adminForm.valueCount.value;
    i++;
    // Create and insert rows and cells into the first body.
    oRow = document.createElement("TR");
    oTable.appendChild(oRow);

    oCell = document.createElement("TD");
    oInput=document.createElement("INPUT");
    oInput.name="vNames["+i+"]";
    oInput.setAttribute('id',"vNames_"+i);
    oCell.appendChild(oInput);
    oRow.appendChild(oCell);
    
    oCell = document.createElement("TD");
    oInput=document.createElement("INPUT");
    oInput.name="vValues["+i+"]";
    oInput.setAttribute('id',"vValues_"+i);
    oCell.appendChild(oInput);
    
    oRow.appendChild(oCell);
    oInput.focus();

    document.adminForm.valueCount.value=i;
  }

  function disableAll() {
    var elem;
    elem=getObject('divValues');
    elem.style.visibility = 'hidden';
    elem.style.display = 'none';
    elem=getObject('divColsRows');
    elem.style.visibility = 'hidden';
    elem.style.display = 'none';
    elem=getObject('divWeb');
    elem.style.visibility = 'hidden';
    elem.style.display = 'none';
    elem=getObject('divText');
    elem.style.visibility = 'hidden';
    elem.style.display = 'none';
    if (elem=getObject('vNames[0]')) {
      elem.setAttribute('mosReq',0);
    }
  }
  
  function selType(sType) {
    var elem;
    //alert(sType);
    switch (sType) {
      case 'editorta':
      case 'textarea':
        disableAll();
        elem=getObject('divText');
        elem.style.visibility = 'visible';
        elem.style.display = 'block';
        elem=getObject('divColsRows');
        elem.style.visibility = 'visible';
        elem.style.display = 'block';
      break;
      
      case 'emailaddress':
      case 'password':
      case 'text':
        disableAll();
        elem=getObject('divText');
        elem.style.visibility = 'visible';
        elem.style.display = 'block';
      break;
      
      case 'select':
      case 'multiselect':
        disableAll();
        elem=getObject('divValues');
        elem.style.visibility = 'visible';
        elem.style.display = 'block';
        if (elem=getObject('vNames[0]')) {
          elem.setAttribute('mosReq',1);
        }
      break;
      
      case 'radio':
      case 'multicheckbox':
        disableAll();
        elem=getObject('divColsRows');
        elem.style.visibility = 'visible';
        elem.style.display = 'block';
        elem=getObject('divValues');
        elem.style.visibility = 'visible';
        elem.style.display = 'block';
        if (elem=getObject('vNames[0]')) {
          elem.setAttribute('mosReq',1);
        }
      break;

      case 'webaddress':
        disableAll();
        elem=getObject('divWeb');
        elem.style.visibility = 'visible';
        elem.style.display = 'block';
      break;

      case 'delimiter':
      default: 
        disableAll();
    }
  }

  function prep4SQL(o){
	if(o.value!='') {
		o.value=o.value.replace('vm_','');
    		o.value='vm_' + o.value.replace(/[^a-zA-Z]+/g,'');
	}
  }

</script>  
<?php 
	if($fieldid > 0) {
		print "<script type=\"text/javascript\"> document.adminForm.name.readOnly=true; </script>";	
		print "<script type=\"text/javascript\"> document.adminForm.type.disabled=true; </script>";		
	}
	print "<script type=\"text/javascript\"> disableAll(); </script>";
	print "<script type=\"text/javascript\"> selType('".$db->f('type')."'); </script>";	
?>