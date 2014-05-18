<?php
$_POST = array(

	'M' => '2032',
	'R' => 'c2c401252',
	'T' => '7627416',
	'A' => 'XXXXXX',
	'B' => '0',
	'P' => 'CARTE',
	'C' => 'CB',
	'S' => '4120523',
	'E' => '00000',
	'D' => '1603',
	'I' => 'FRA',
	'N' => '111122',
	'J' => '44',
	'H' => '5B434C778490889697170E225029F56AFF19CA47',
	'W' => '25022014',
	'K' => 'LZdHU7M3UGN4ezdhzhcV2ZgIn+Ek1Wq3GCzzGhP19SrBbSXyFE/k5MbeV503Hi2nKnr4iVh5jv7kd3KiHTmlkhuW3ERhHqTAHPTcoB+NVqURIwZ+AtX88sqRdVXQFkxe7ksDxcnwsS0NhSrgmG6BoNLxi5Gv7bV7dVFbmHRh8Fo=',
);
testVerif($_POST);

echo '<br />TESTING FROM pluginresponsereceived';
$_POST =array (
	'option' => 'com_virtuemart',
	'view' => 'pluginresponse',
	'task' => 'pluginresponsereceived',
	'pm' => '3',
	'Itemid' => '103',
	'M' => '11400',
	'R' => 'd66b010',
	'T' => '7584174',
	'A' => 'XXXXXX',
	'B' => '0',
	'P' => 'CARTE',
	'C' => 'CB',
	'S' => '4111874',
	'E' => '00000',
	'D' => '1502',
	'I' => 'FRA',
	'N' => '111122',
	'J' => '44',
	'W' => '19022014',
	'K' => 'cqZXB9L4tdaj88XVxLl1E4S+wpJteN3BoDz9UDrT0dkjp97Fkqugkg3KeITnOZXeKanfLRLXbyTDKLjP+uOxUoHP2bkN6pdapEau2hr7hnRc/ZNYlAhIflsL1FjATvyH0OGqp4TJLcj4X5jxGcVItvkR4Chl6P5qlCEaMRmDZgw=',
);

testVerif($_POST);
echo "<br /><br />LAST POST FROM JOOMFROG";
$_POST =array (
	'M' => '11400',
	'R' => 'd66b010',
	'T' => '7584174',
	'A' => 'XXXXXX',
	'B' => '0',
	'P' => 'CARTE',
	'C' => 'CB',
	'S' => '4111874',
	'E' => '00000',
	'D' => '1502',
	'I' => 'FRA',
	'N' => '111122',
	'J' => '44',
	'W' => '19022014',
	'K' => '2/GF6ojJoefpN7fb+/ZbEPRmPktR7AYetNIgELGgQxTZt/Wik83TDx6oKZuGbRQxKBhY5dbguTVslfMGEFOyWh5nbHsi6p86QtSKYDdLjIugNix5N5uCfhPzPL6oqxSjwrIhasebWgyavZjPD6cxuh1zxQf5+kI/X0g9cXR6fTM=',
);

testVerif($_POST);
testHmac($_POST);


$query='option=com_virtuemart&view=pluginresponse&task=pluginresponsereceived&pm=2&Itemid=103&M=28489&R=280b03&T=7583208&A=XXXXXX&B=0&P=3DSECURE&C=CB&S=4111435&E=00000&D=1603&I=FRA&N=111122&J=44&H=5B434C778490889697170E225029F56AFF19CA47&G=N&O=U&W=19022014';
$query='option=com_virtuemart&view=pluginresponse&task=pluginresponsereceived&pm=3&Itemid=103&M=11400&R=d66b010&T=7584174&A=XXXXXX&B=0&P=CARTE&C=CB&S=4111874&E=00000&D=1502&I=FRA&N=111122&J=44&W=19022014&K=cqZXB9L4tdaj88XVxLl1E4S%2BwpJteN3BoDz9UDrT0dkjp97Fkqugkg3KeITnOZXeKanfLRLXbyTDKLjP%2BuOxUoHP2bkN6pdapEau2hr7hnRc%2FZNYlAhIflsL1FjATvyH0OGqp4TJLcj4X5jxGcVItvkR4Chl6P5qlCEaMRmDZgw%3D';
testVerifQuery($query );

$query='M=11400&R=d66b010&T=7584174&A=XXXXXX&B=0&P=CARTE&C=CB&S=4111874&E=00000&D=1502&I=FRA&N=111122&J=44&W=19022014&K=cqZXB9L4tdaj88XVxLl1E4S%2BwpJteN3BoDz9UDrT0dkjp97Fkqugkg3KeITnOZXeKanfLRLXbyTDKLjP%2BuOxUoHP2bkN6pdapEau2hr7hnRc%2FZNYlAhIflsL1FjATvyH0OGqp4TJLcj4X5jxGcVItvkR4Chl6P5qlCEaMRmDZgw%3D';
testVerifQuery($query );
function testHmac($post) {
	$query="";
	foreach ($post as $key=>$value) {
		if ($key!='K') {
			$query .= $key."=".$value.'&';
		}
	}
	$query=substr($query, 0, -1);
	$keyTest = '0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF';
	$binKey = pack("H*", $keyTest);
	echo "<h1>testHmac </h1>" . $query . " <br />";
	$hmac = strtoupper(hash_hmac('sha512', $query, $binKey));
	echo " <br />" . $hmac . "  ";
	if ($hmac==$post['K']) {
		echo " <br />PPPPPPPPAREIL";
	} else {
		echo " <br />PAS OK";
	}
	$signature = urlencode( base64_encode( $post['K'] ));
	if ($hmac==$signature) {
		echo " <br />PPPPPPPPAREIL";
	} else {
		echo " <br />PAS OK";
	}

	$signature = base64_encode( $signature );
	if ($hmac==$signature) {
		echo " <br />PPPPPPPPAREIL";
	} else {
		echo " <br />PAS OK";
	}
}

function testCalculate($query, $urlenc=true) {
	$keyFile='/Applications/MAMP/htdocs/VM2/VM2024/logs/paybox/pubkey-3.pem';
	$key =  loadKey($keyFile);
	if( $key ) {
		openssl_sign( $query, $signature, $key );   // generation de la signature
		openssl_free_key( $key );                           // liberation ressource (confidentialite cle prive)
	}
	else {
		$status = openssl_error_string();
		echo "ERORORO".$status;
	}                  // diagnostic erreur
	echo "<br />CALCULATED:".$signature;
	if( isset($urlenc ))
		$signature = urlencode( base64_encode( $signature ));
	else
		$signature = base64_encode( $signature );

	echo "<br />CALCULATED:".$signature;
}
function testVerif($post) {
	$query="";
	foreach ($post as $key=>$value) {
		if ($key=='K') {
			$k=$value;
			break;
		}
		$query .= $key."=".$value.'&';
	}

	$qrystr=substr($query, 0, -1);
	echo '<h1>testVerif </h1>QueryString'.$qrystr;
	echo '<br />testVerif K:'.$k;

	$keyFile='/Applications/MAMP/htdocs/VM2/VM2024/logs/paybox/pubkey-3.pem';
	$result = pbxVerSign ( $keyFile, $qrystr, $k);
	echo '<br />RESULT :'.$result;
	if ($result == 1) {
		echo "<br />Signature valide";
	} elseif ($result == 0) {
		echo "<br />Signature erronée";
	} else {
		echo "<br />Erreur de vérification de la signature";
	}
}
function testVerifQuery($query ) {
	echo "<h1>testVerifQuery</h1>";


	$keyFile='/Applications/MAMP/htdocs/VM2/VM2024/logs/paybox/pubkey-3.pem';
	$key = LoadKey( $keyFile );
	                          $data="";
	                          $sig="";// chargement de la cle
	$url=false;
	GetSignedData( $query, $data, $sig, $url );            // separation et recuperation signature et donnees
	$result= openssl_verify( $data, $sig, $key );
	if ($result == 1) {
		echo "<br />openssl_verify Signature valide Signature valide Signature valide";
	} elseif ($result == 0) {
		echo "<br />openssl_verify Signature erronee";
	} else {
		echo "<br />openssl_verify Erreur de verification de la signature";
	}

	$url=true;
	GetSignedData( $query, $data, $sig, $url );            // separation et recuperation signature et donnees
	$result= openssl_verify( $data, $sig, $key );
	if ($result == 1) {
		echo "<br />openssl_verify TRUE Signature valide";
	} elseif ($result == 0) {
		echo "<br />openssl_verify TRUE Signature erronee";
	} else {
		echo "<br />openssl_verify TRUE Erreur de vérification de la signature";
	}
}


function GetSignedData( $qrystr, &$data, &$sig, $url=false ) {    // renvoi les donnes signees et la signature

	$pos = strrpos( $qrystr, '&' );                         // cherche dernier separateur
	$data = substr( $qrystr, 0, $pos );                     // et voila les donnees signees
	$pos= strpos( $qrystr, '=', $pos ) + 1;                 // cherche debut valeur signature
	$sig = substr( $qrystr, $pos );

	// et voila la signature
	if( $url ) $sig = urldecode( $sig );                    // decodage signature url
	$sig = base64_decode( $sig );                           // decodage signature base 64


}


// verification signature Paybox
 function pbxVerSign ($keyFile, $qrystr, $sig) {
	 $key =  loadKey($keyFile); // chargement de la cle

	 $url=false;
	 $sig = urldecode( $sig );// separation et recuperation signature et donnees
	 $sig = base64_decode( $sig );
	 echo "<br />pbxVerSign:".$sig;
	 $openSsl = openssl_verify($qrystr, $sig, $key);
	openssl_free_key($key);
	// verification : 1 si valide, 0 si invalide, -1 si erreur
	return $openSsl;
}
/**
 * @param        $keyfile
 * @param bool   $pub
 * @param string $pass
 * @return bool|resource
 */
  function loadKey ($keyfile, $pub = TRUE, $pass = '') {


	$fp = $filedata = $key = FALSE; // initialisation variables
	$fsize = filesize($keyfile); // taille du fichier
	if (!$fsize) {
		vmError('Key File'.$keyfile. 'not found');
		return FALSE;
	}
	$fp = fopen($keyfile, 'r'); // ouverture fichier
	if (!$fp) {
		vmError('Cannot open Key File'.$keyfile);
		return FALSE;
	}
	$filedata = fread($fp, $fsize);
	fclose($fp);
	if (!$filedata) {
		vmError('Empty Key File'.$keyfile);
		return FALSE;
	}
	if ($pub) {
		$key = openssl_pkey_get_public($filedata);
	} // recuperation de la cle publique
	else // ou recuperation de la cle privee
	{
		$key = openssl_pkey_get_private(array($filedata, $pass));
	}
	return $key; // renvoi cle ( ou erreur )
}
