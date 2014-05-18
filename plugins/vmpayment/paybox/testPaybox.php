<?php
 function generateHMAC ($msg, $payboxKey) {
	$binKey = pack("H*", $payboxKey);
	$hmac = strtoupper(hash_hmac('sha512', $msg, $binKey));
	return $hmac;
}

function debug ($subject, $title = '') {

	$debug = '<div style="display:block; margin-bottom:5px; border:1px solid red; padding:5px; text-align:left; font-size:10px;white-space:nowrap; overflow:scroll;">';
	$debug .= ($title) ? '<br /><strong>' . $title . ':</strong><br />' : '';
	//$debug .= '<pre>';
	if (is_array($subject)) {
		$debug .= str_replace("=>", "&#8658;", str_replace("Array", "<font color=\"red\"><b>Array</b></font>", nl2br(str_replace(" ", " &nbsp; ", print_r($subject, true)))));
	} else {
		//$debug .= str_replace("=>", "&#8658;", str_replace("Array", "<font color=\"red\"><b>Array</b></font>", (str_replace(" ", " &nbsp; ", print_r($subject, true)))));
		$debug .= str_replace("=>", "&#8658;", str_replace("Array", "<font color=\"red\"><b>Array</b></font>", print_r($subject, true)));

	}

	//$debug .= '</pre>';
	$debug .= '</div>';
		echo $debug;

}
function stringifyArray ($array) {
	$string = '';
	foreach ($array as $key => $value) {
		$string .= $key . "=" . $value . '&';
	}
	return substr($string, 0, -1);
}

// Get the date at ISO-8601 format
$dateTime = date("c");

$site=1999888;
$rang=32;
$identifiant=1686319;
$montant = 30000;
$ref = time();
$email = "user1@xxx.net";
$lastAmount=500;
$periodicity=30;
$recurring=3;
$firstAmount = round($montant/$recurring);
$lastAmount = $montant - ($firstAmount * ($recurring-1));
// Get the date at ISO-8601 format
$dateTime = date("c");
$dateTime = "2014-02-19T11:06:32+01:00";
$retour = 'M:M;R:R;T:T;A:A;B:B;P:P;C:C;S:S;Y:Y;E:E;D:D;I:I;N:N;J:J;H:H;G:G;O:O;F:F;W:W;Z:Z';
// Create the string to be hashed, without URLencoding
$msg = "PBX_SITE=1999888" . "&PBX_RANG=32" . "&PBX_IDENTIFIANT=1686319" . "&PBX_TOTAL=" . $montant . "&PBX_DEVISE=978"  . "&PBX_PORTEUR=" . $email . "&PBX_RETOUR=" . $retour . //m:M;r:R;t:T;a:A;t:P;c:C;s:S;y:Y;e:E;d:D;ip:I;n:N;j:J;h:H;g:G;o:O;f:F;w:W;z:Z;".
	"&PBX_HASH=SHA512" . "&PBX_TIME=" . $dateTime;
$pbx_cmd=  $ref."PBX_2MONT0000000550PBX_NBPAIE10PBX_FREQ03PBX_QUAND31";


//$msg .="&PBX_3DS=N";

$vars = array(
	'PBX_SITE' => $site,
	'PBX_RANG' => $rang,
	'PBX_IDENTIFIANT' => $identifiant,
	'PBX_TOTAL' => $montant,
	'PBX_DEVISE' => 978,
	'PBX_CMD' => $pbx_cmd,
	//'PBX_CMD' => $ref,
	'PBX_EFFECTUE' => 'http://88.186.104.215/VM2/VM2024/plugins/vmpayment/paybox/testPaybox.php',
	'PBX_REPONDRE_A' => 'http://88.186.104.215/VM2/VM2024/plugins/vmpayment/paybox/testPaybox.php',
	'PBX_PORTEUR' => $email,
	'PBX_RETOUR' => $retour,
	'PBX_RUF1'  =>  'POST' ,
	'PBX_3DS'  =>  'N' ,
	'PBX_HASH' => 'SHA512',
	'PBX_TIME' =>date('c'),

);
$keyTest = '0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF';

$msg = array();
foreach($vars as $k => $v) {
	$msg[] = $k . '=' . $v;
}
$msg = implode('&', $msg);

$binKey = pack('H*', $keyTest);
$vars['PBX_HMAC'] = strtoupper(hash_hmac('sha512', $msg, $binKey));
/*
$msg=stringifyArray($vars);
echo $msg;
echo "<br />";
*/
$keyTest = '0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF';
//$vars['PBX_HMAC'] = generateHMAC ($msg, $payboxKey);

$url = 'https://preprod-tpeweb.paybox.com/php/';

?>

<?php debug($vars,'') ; ?>

<form   name="paybox_form" action="<?php echo $url;?>" method="post">
	<?php
	foreach($vars as $key => $value) {
		echo '<input type="hidden" name="'.$key.'" value="'.$value.'" />'."\r\n";
	}
	?>
	<input type="submit" value="Send">
</form>





<?php echo "testing<pre>" ;
var_export($_GET);



