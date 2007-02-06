<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
*
* @version $Id$
* @package VirtueMart
* @subpackage templates
* @copyright Copyright (C) 2007 Soeren Eberhardt. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/

?>
<table border="0" width="100%" cellpadding="2" cellspacing="0">
	<tr class="sectiontableentry1">
		<td>
		<?php
		$checked = '';
		if( $bt_user_info_id == $value ) {
			$checked = 'checked="checked" ';
		}
		echo '<input type="radio" name="'.$name.'" value="'.$bt_user_info_id.'" '.$checked.'/>'."\n";
	
		?></td>
		<td><?php echo $VM_LANG->_PHPSHOP_ACC_BILL_DEF ?></td>
	</tr>
<?php
$i = 2;
while($db->next_record()) {
	echo '<tr class="sectiontableentry'.$i.'">'."\n";
	echo '<td>'."\n";
	if (!strcmp($value, $db->f("user_info_id"))) {
		echo '<input type="radio" name="'.$name.'" value="' . $db->f("user_info_id") . '" checked="checked" />'."\n";
	}
	else {
		echo '<input type="radio" name="'.$name.'" value="' . $db->f("user_info_id") . '" />'."\n";
	}
	echo '</td>'."\n";
	echo '<td>'."\n";
	echo '<table width="100%" border="0" cellspacing="0" cellpadding="1">'."\n";
	echo '<tr>'."\n";
	echo '<td>'."\n";
	echo '<strong>' . $db->f("address_type_name") . "</strong> ";
	$url = SECUREURL . "index.php?page=account.shipto&user_info_id=" . $db->f('user_info_id')."&next_page=checkout.index";
	echo '(<a href="'.$sess->url($url).'">'.$VM_LANG->_PHPSHOP_UDATE_ADDRESS.'</a>)'."\n";
	echo '<br />'."\n";
	echo $db->f("title") . " ". $db->f("first_name") . " ". $db->f("middle_name") . " ". $db->f("last_name") . "\n";
	echo '<br />'."\n";
	if ($db->f("company")) {
		echo $db->f("company") . "<br />\n";
	}
	echo $db->f("address_1") . "\n";
	if ($db->f("address_2")) {
		echo '<br />'. $db->f("address_2"). "\n";
	}
	echo '<br />'."\n";
	echo $db->f("city");
	echo ', ';
	echo $db->f("state") . " ";
	echo $db->f("zip") . "<br />\n";
	echo $VM_LANG->_PHPSHOP_CHECKOUT_CONF_PHONE.': '. $db->f("phone_1") . "\n";
	echo '<br />'."\n";
	echo $VM_LANG->_PHPSHOP_CHECKOUT_CONF_FAX.': '.$db->f("fax") . "\n";
	echo '</td>
	</tr>
	</table>
	</td>
	</tr>'."\n";
	if($i == 1) $i++;
	elseif($i == 2) $i--;
}

echo '</td>'."\n";
echo '</tr>'."\n";
echo '</table>'."\n";