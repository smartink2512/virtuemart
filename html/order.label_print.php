<?php
defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');
/*
 * @version $Id: order.label_print.php 431 2006-10-17 21:55:46 +0200 (Di, 17 Okt 2006) soeren_nb $
 * @package VirtueMart
 * @subpackage html
 */
mm_showMyFileName(__FILE__);

$order_id = mosgetparam($_REQUEST, 'order_id', null);
if (!is_numeric($order_id))
	die('Please provide a valid, numeric, Order ID');

$db =& new ps_DB;

$q = "SELECT shipper_class FROM #__{vm}_shipping_label ";
$q .= "WHERE order_id='" . $order_id . "'";
$db->query($q);
if (!$db->next_record())
	die('Order record not found in shipping label database.');

include_once(CLASSPATH . "shipping/" . $db->f("shipper_class") . ".php");
eval("\$ship_class =& new " . $db->f("shipper_class") . "();");
if (!is_callable(array($ship_class, 'generate_label')))
	die('Class ' . $ship_class . ' cannot generate labels, why are we here?');

$ship_class->generate_label($order_id);
$dim = $ship_class->get_label_dimensions($order_id);
$dim_arr = explode("x", $dim);
$dim_x = $dim_arr[0];
$dim_y = $dim_arr[1];

$image_type = $ship_class->get_label_image_type($order_id);

$image_url = $sess->url($_SERVER['PHP_SELF'] .
    "?page=order.label_image&order_id=" .
    $order_id .  "&no_menu=1&no_html=1");
$image_url = stristr($image_url, "index2.php") ?
    str_replace("index2.php", "index3.php", $image_url) :
    str_replace("index.php", "index2.php", $image_url);

echo "<html>\n";
echo "<head><title>Print Label</title></head>\n";
echo "<body>\n";
echo '<object data="' . $image_url . '", type="' . $image_type . '", height="' .
    $dim_y . '", width="' . $dim_x . '" />' . "\n";
echo "</body>\n";
echo "</html>\n";
?>
