<?php

// Get the date at ISO-8601 format
$dateTime = date("c");


$montant = 30000;
$ref = '40d301224';
$email = "user1@alatak.net";
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
$msg = "PBX_SITE=1999888" . "&PBX_RANG=32" . "&PBX_IDENTIFIANT=1686319" . "&PBX_TOTAL=" . $firstAmount . "&PBX_DEVISE=978" . "&PBX_CMD=" . $ref . "&PBX_PORTEUR=" . $email . "&PBX_RETOUR=" . $retour . //m:M;r:R;t:T;a:A;t:P;c:C;s:S;y:Y;e:E;d:D;ip:I;n:N;j:J;h:H;g:G;o:O;f:F;w:W;z:Z;".
	"&PBX_HASH=SHA512" . "&PBX_TIME=" . $dateTime;
//$msg.="&PBX_2MONT=500&PBX_NBPAIE=03&PBX_FREQ=02&PBX_QUAND=10&PBX_DELAIS=001";

$msg .="&PBX_3DS=N";

for($i=1;$i<$recurring;$i++)
{
	$pbx_amount[$i]=$lastAmount;
	$pbx_date[$i]=date('d/m/Y',mktime(0,0,0,date('m'),date('d')+($i*$periodicity),date('Y')));
	$msg .= "&PBX_2MONT".$i."=".$pbx_amount[$i];
	$msg .= "&PBX_DATE".$i."=".$pbx_date[$i];

}

$keyTest = '0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF';
$binKey = pack("H*", $keyTest);
echo "  " . $msg . "<br />";
$hmac = strtoupper(hash_hmac('sha512', $msg, $binKey));
$url = 'https://preprod-tpeweb.paybox.com/php/';
echo " <br />" . $hmac . "  ";
?>

<?php echo "ok" ?>
<form method="POST" action="<? echo $url; ?>">
	<input type="hidden" name="PBX_SITE" value="1999888">
	<input type="hidden" name="PBX_RANG" value="32">
	<input type="hidden" name="PBX_IDENTIFIANT" value="1686319">
	<input type="hidden" name="PBX_TOTAL" value="<? echo $firstAmount; ?>">
	<input type="hidden" name="PBX_DEVISE" value="978">
	<input type="hidden" name="PBX_CMD" value="<? echo $ref; ?>">
	<input type="hidden" name="PBX_PORTEUR" value="<? echo $email; ?>">
	<input type="hidden" name="PBX_RETOUR" value="<? echo $retour; ?>">
	<input type="hidden" name="PBX_HASH" value="SHA512">
	<input type="hidden" name="PBX_TIME" value="<? echo $dateTime; ?>">
	<input type="hidden" name="PBX_TIME" value="<? echo $dateTime; ?>">
	<input type="hidden" name="PBX_2MONT1" value="<? echo $pbx_amount[1]; ?>">
	<input type="hidden" name="PBX_DATE1" value="<? echo $pbx_date[1]; ?>">
	<input type="hidden" name="PBX_2MONT2" value="<? echo $pbx_amount[2]; ?>">
	<input type="hidden" name="PBX_DATE2" value="<? echo $pbx_date[2]; ?>">
	<!--input type="hidden" name="PBX_2MONT" value="<? echo 500; ?>">
	<input type="hidden" name="PBX_NBPAIE" value="<? echo "03"; ?>">
	<input type="hidden" name="PBX_FREQ" value="<? echo "02"; ?>">
	<input type="hidden" name="PBX_QUAND" value="<? echo "10"; ?>">
	<input type="hidden" name="PBX_DELAIS" value="<? echo "001"; ?>" -->

	<input type="hidden" name="PBX_HMAC" value="<? echo $hmac; ?>"> <input type="submit" value="Send">
</form>



<?php echo "testing" ?>

<form action="https://preprod-tpeweb.paybox.com/php/" method="post" name="vm_paybox_form" target="paybox">
	<input type="hidden" name="PBX_SITE" value="1999888">
	<input type="hidden" name="PBX_RANG" value="32">
	<input type="hidden" name="PBX_IDENTIFIANT" value="1686319">
	<input type="hidden" name="PBX_TOTAL" value="13343">
	<input type="hidden" name="PBX_DEVISE" value="978">
	<input type="hidden" name="PBX_CMD" value="40d301224">
	<input type="hidden" name="PBX_PORTEUR" value="user1@alatak.net">
	<input type="hidden" name="PBX_RETOUR" value="M:M;R:R;T:T;A:A;B:B;P:P;C:C;S:S;Y:Y;E:E;D:D;I:I;N:N;J:J;H:H;G:G;O:O;F:F;W:W;Z:Z;">
	<input type="hidden" name="PBX_HASH" value="SHA512">
	<input type="hidden" name="PBX_TIME" value="2014-02-19T10:34:30+01:00">
	<input type="hidden" name="PBX_HMAC" value="C75C1AA3034501BBC15441C626BE498D5451F0B5F3BD3960A96F19C51FD9C8FE5EADE8CC18D0584F6C3A1BB319F74DDFC49E28E3B179C903C43A39AB285AB453">

		<input type="submit" value="The method is in debug mode. Click here to be redirected to Paybox">
</form>

