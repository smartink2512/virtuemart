<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
/*
 * @version $Id$
 * @package VirtueMart
 * @subpackage html
 */
mm_showMyFileName(__FILE__);

$order_id = vmGet($_REQUEST, 'order_id', null);
if (!is_numeric($order_id))
	die('Please provide a valid, numeric, Order ID');

$db =& new ps_DB;

$q = "SELECT shipper_class, label_is_generated, tracking_number ";
$q .= "FROM #__{vm}_shipping_label ";
$q .= "WHERE order_id='" . $order_id . "'";
$db->query($q);
if (!$db->next_record())
	die('Order record not found in shipping label database.');

include_once(CLASSPATH . "shipping/" . $db->f("shipper_class") . ".php");
eval("\$ship_class =& new " . $db->f("shipper_class") . "();");
if (!is_callable(array($ship_class, 'void_label')))
	die('Class ' . $ship_class . ' cannot void labels, why are we here?');

if (!$db->f('label_is_generated'))
	die('Label has not been generated yet.  Why are we here?');

$msg = $ship_class->void_label($order_id);
if ($msg == '') {
	$msg = "Label for waybill " . $db->f('tracking_number');
	$msg .= " has been voided.";
}

echo "<html>\n";
echo "<head><title>Void Label</title></head>\n";
echo "<body>\n";
echo "<p>" . $msg . "\n";
echo "</body>\n";
echo "</html>\n";
?>
