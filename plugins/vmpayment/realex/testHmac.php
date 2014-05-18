<?php

myprint("getSha1Hash TESTING");
$string="2147483647.seanmacdomhnalltest.66c60118.00.Enrolled";
$hash=getSha1Hash("secret","20140219133250","seanmacdomhnalltest","66c60118", "00", "Enrolled");

myprint("getSha1Hash",$hash);


$hash=getSha1Hash("secret","20140219133250","seanmacdomhnalltest","66c60118", "00", "Enrolled", "");

myprint("getSha1Hash",$hash);

$hash=getSha1Hash("secret","20140219133250","seanmacdomhnalltest","66c60118", "00", "Enrolled", "","");

myprint("getSha1Hash",$hash);

function myprint($str1, $str2="") {
	echo "<br />";
	echo $str1.":".$str2;
}
  function getSha1Hash ($secret, $args = null) {
	if (empty($secret)) {
		vmError('no secret value for getSha1Hash', 'no secret value for getSha1Hash');
	}
	$args = func_get_args();
	array_shift($args);
	$tmp = $args;
	myprint("tmp",$tmp);
	$temp2 = implode('.', $args);
	myprint("temp2", $temp2);
	$hash = sha1(implode('.', $args));
	$temp3 = "{$hash}.{$secret}";
	myprint("tmp", $temp3);
	$hash = sha1("{$hash}.{$secret}");
	myprint("temp3",$hash);
	return $hash;
}

