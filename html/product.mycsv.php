<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
*
* @version $Id$
* @package VirtueMart
* @subpackage html
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
mm_showMyFileName( __FILE__ );

vmCommonHTML::loadScriptaculous();

$csv_lines_to_import = vmGet( $_REQUEST, 'csv_lines_to_import', 300 );
	
if( empty($vars['do_import'])) {
	echo '<h2>'.$VM_LANG->_VM_CSV_UPLOAD_SIMULATION_RESULTS_LBL.'</h2>';
}
echo '<br />
<table class="adminform">';
if( empty( $vars['csv_import_finished'])) {
	
	$vars['csv_start_at'] = @$vars['csv_start_at'] + @$vars['csv_lines_processed'] + 1;
	echo '<tr>
	<td style="padding-left:100px;">
		<br />
		<form method="post" action="'. $_SERVER['PHP_SELF'] .'" name="adminForm" onsubmit="doImport( this );return false;">';
	foreach ( $_POST as $postvar => $value ) {
		if( $postvar != 'csv_start_at' && $postvar != 'csv_lines_to_import') {
			echo "<input type=\"hidden\" name=\"$postvar\" value=\"".htmlspecialchars(stripslashes($value),ENT_QUOTES)."\" />\n";
		}
	}
	if( !isset($vars['total_lines'])) {
		echo "<input type=\"hidden\" name=\"total_lines\" value=\"".$vars['csv_log']['total_lines']."\" />\n";
	}
	echo "<label for=\"csv_start_at\">".$VM_LANG->_VM_CSV_UPLOAD_START_AT.": </label>
			<input class=\"inputbox\" type=\"text\" id=\"csv_start_at\" name=\"csv_start_at\" value=\"0\" size=\"6\" />
			<br /><br />";
	echo "<label for=\"csv_lines_to_import\">".$VM_LANG->_VM_CSV_UPLOAD_LINES_TO_PROCESS.": </label>
			<input class=\"inputbox\" type=\"text\" id=\"csv_lines_to_import\" name=\"csv_lines_to_import\" value=\"$csv_lines_to_import\" size=\"6\" />
			<br /><br /><img id=\"indicator\" style=\"display:none;\" src=\"".VM_THEMEURL."images/indicator.gif\" alt=\"Indicator\" align=\"absmiddle\" />&nbsp;&nbsp;";
	
	echo "<input class=\"button\" type=\"submit\" name=\"submit\" value=\"".$VM_LANG->_VM_CSV_UPLOAD_IMPORTNOW."\" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n";
	echo "<input class=\"button\" type=\"button\" name=\"cancel\" value=\"".$VM_LANG->_CMN_CANCEL."\" onclick=\"document.location='".$sess->url($_SERVER['PHP_SELF']."?page=product.csv_upload")."';\" />\n";
	echo '<input type="hidden" name="do_import" value="1" />';
	echo '</form><br /><br />
	</td>
		<td><div id="importmsg"></div><br />
			<div id="msgcontrol"></div>
			<div style="height: 500px;overflow:auto;display:none;" id="importstats"></div>
		</td>
	</tr>';
}
echo '<tr><td width="50%">
';	

if( !empty( $vars['error_log'] ) && is_array($vars['error_log'])) {
	echo '<fieldset><legend>Error Log</legend>';
	echo '<ul>';
	foreach( $vars['error_log'] as $line => $message) {
		echo "<li><img src=\"$mosConfig_live_site/administrator/images/publish_x.png\" hspace=\"5\" alt=\"failure\" />$message</li>\n";
	}
	echo '</ul>';
	echo '</fieldset>';
}
else {
	echo '<h3><img src="'.$mosConfig_live_site.'/administrator/images/tick.png" hspace="5" alt="ok" />'.$VM_LANG->_VM_CSV_UPLOAD_NO_ERRORS.'</h3>';
}

echo '<td valign="top" width="50%" rowspan="2">
		<fieldset><legend>'.$VM_LANG->_VM_CSV_UPLOAD_DETAILS_ANALYSIS.'</legend>';
if( empty( $vars['do_import'])) {
	echo '<strong>'.$VM_LANG->_VM_CSV_UPLOAD_TOTAL_LINES.': '.$vars['csv_log']['total_lines'].'</strong><br/><br />';
}
echo '<strong>'.$VM_LANG->_VM_CSV_UPLOAD_FIRST_LINE.':</strong>
<div style="width:400px;overflow:auto;" class="quote">
<pre>'.htmlspecialchars($vars['csv_log']['first_line_raw']).'</pre>
</div>';

echo '<strong>'.$VM_LANG->_VM_CSV_UPLOAD_FIELD_EXPLANATION.' :</strong>';
$i = 0;
echo '<ol>';
foreach( $vars['csv_log']['csv_fields'] as $field => $details ) {
	echo '<li><strong>'.$field.':</strong> '.htmlspecialchars(@$vars['csv_log']['first_line_array'][$i])."</li>\n";
	$i++;
}
echo '</ol>';

echo '</fieldset></td>
</tr>
<tr><td width="50%">';

echo '<fieldset><legend>'.$VM_LANG->_VM_PRODUCT_IMPORT_LOG.'</legend>';
echo '<div style="height:500px;overflow:auto;">';
foreach( $vars['product_log'] as $line => $product) {
	echo '<strong>Line '.$line.', '.ucfirst( $product['action'] ).':</strong> '.$product['product_name'].'&nbsp;&nbsp;&nbsp;';
	$tip = '';
	foreach( $product as $field => $value) {
		
		$tip .= '<strong>'.ucwords(str_replace( '_', ' ', $field)).': </strong>';
		if( is_array( $value )) {
			$tip .= '<pre stye="display:inline:;">'.print_r( $value, true ).'</pre>';
		}
		else {
			
			$tip .= $value.'<br />';
		}
		
	}
	echo vmHelpToolTip( $tip );
	echo "<br />\n";
}
echo "</div></fieldset>\n";	
echo '</td></tr></table>';

?>
<script type="text/javascript">
function doImport( form ) {
	
	$('indicator').show();
	var options = {
		postBody: Form.Methods.serialize( form ) + '&ajax_request=1',
		method: 'post',
		//onSuccess: function(o) { alert(o.responseText);},
		evalScripts: true
	}
	new Ajax.Updater( 'importmsg', 'index2.php', options );
	
}
</script>
<br />
<br />