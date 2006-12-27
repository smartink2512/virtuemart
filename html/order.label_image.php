<?php
defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');
/*
 * @version $Id: order.label_image.php 431 2006-10-17 21:55:46 +0200 (Di, 17 Okt 2006) soeren_nb $
 * @package VirtueMart
 * @subpackage html
 */
mm_showMyFileName(__FILE__);

$order_id = mosgetparam($_REQUEST, 'order_id', null);
if (!is_numeric($order_id))
	die('Please provide a valid, numeric, Order ID, not "' . $order_id . '"');

$db =& new ps_DB;

$q = "SELECT shipper_class, label_is_generated, label_image ";
$q .= "FROM #__{vm}_shipping_label ";
$q .= "WHERE order_id='" . $order_id . "'";
$db->query($q);
if (!$db->next_record())
	die('Order record not found in shipping label database.');

if (!$db->f('label_is_generated'))
	die('Label was never generated');

include_once(CLASSPATH . "shipping/" . $db->f("shipper_class") . ".php");
eval("\$ship_class =& new " . $db->f("shipper_class") . "();");
if (!is_callable(array($ship_class, 'get_label_image')))
	die('Class ' . $ship_class . ' cannot get label images, why are we here?');

echo $ship_class->get_label_image($order_id);
?>
