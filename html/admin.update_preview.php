<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
/**
*
* @version $Id: template.class.php 1095 2007-12-19 20:19:16Z soeren_nb $
* @package VirtueMart
* @subpackage html
* @copyright Copyright (C) 2008 soeren - All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*
*/
if( vmget($_SESSION,'vm_updatepackage') == null) {
	$vmLogger->info( 'The Update Package could not be downloaded.');
	return;
}

require_once( CLASSPATH.'update.class.php');

$packageContents = vmUpdate::getPatchContents(vmget($_SESSION,'vm_updatepackage'));
if( $packageContents === false ) {
	$vmLogger->flush(); // An Error should be logged before
	return;
}
vmCommonHTML::loadMooTools();

$formObj = new formFactory('VirtueMart Update Preview');
$formObj->startForm();

$vm_mainframe->addStyleDeclaration(".writable { color:green;}\n.unwritable { color:red;font-weight:bold; }");

vmUpdate::stepBar(2);
?>
<a name="warning"></a>
<div class="shop_warning">
	<span style="font-style: italic;">General Warning</span><br />
	Installing an Update for VirtueMart using a Patch Package can cause damage on your site 
if you have already modified some files of the VirtueMart component. The Patching Process will overwrite all the files listed below - it won't
just apply smaller changes (diff), but replace the existing file with the new one. If you have modified VirtueMart files on your own, 
this can lead to inconsistent files and missing class/function dependencies.
</div>
<div class="shop_info">
	<span style="font-style: italic;">Patch Details</span><br />
	<ul>
		<li>Description: <?php echo $packageContents['description'] ?></li>
		<li>Release Date: <?php echo $packageContents['releasedate'] ?></li>
	</ul>
</div>
<table class="adminlist">
	<thead>
	  <tr>
	    <th class="title">Files to be updated</th>
	    <th class="title">Status</th>
	  </tr>
	  </thead>
	  <tbody>
  <?php
$valid = true;
foreach( $packageContents['fileArr'] as $file ) {
  	if( file_exists($mosConfig_absolute_path.'/'.$file)) {
  		$is_writable = is_writable($mosConfig_absolute_path.'/'.$file );
  	} else {
  		$is_writable = is_writable($mosConfig_absolute_path.'/'.dirname($file) );
  	}
  	if( !$is_writable ) {
  		$valid = false;
  	}
  	echo '<tr><td>'.$file.'</td>';
  	$class = $is_writable ? 'writable' : 'unwritable';
  	$msg = $is_writable ? 'Writable' : 'File/Directory not writable';
  	echo '<td class="'.$class.'">'.$msg."</td></tr>\n";
  	
} ?>
  </tbody>
</table>

<?php
if( !empty($packageContents['queryArr'])) {
	echo '<table class="adminlist"><thead><tr><th class="title">Queries to be executed on the Database:</th></tr></thead>';
	echo '<tbody>';
	foreach($packageContents['queryArr'] as $query) {
		echo '<tr><td><pre>'.$query. "</pre></td></tr>";
	}
	echo '</tbody></table>';
}
if( $valid ) {
	echo '<div align="center">
	<input type="checkbox" name="confirm_update" id="confirm_update">
		<label for="confirm_update">I have read the <a href="#warning">Warning</a> and I\'m sure to apply the Patch Package to my VirtueMart Installation now.</label>
		<br /><br />
	<input class="vmicon vmicon32 vmicon-32-apply" type="submit" onclick="return checkConfirm()" value="Apply Patch now" name="submitbutton"></div>';
} else {
	echo '<div class="shop_error">Not all files/directories which need to be updated are writable. Please correct the permissions first.';
}
$formObj->finishForm('applypatchpackage', 'admin.update_result');
 ?>
 <script type="text/javascript">
 function checkConfirm() {
 	if( document.adminForm.confirm_update.checked ) {
 		return true;
 	}
 	alert( "Please mark the checkbox before you apply the Patch.");
 	return false;
 }
 </script>