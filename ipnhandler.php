<?php
$headers = getallheaders();
$body = file_get_contents('php://input');
$fp = fopen('/Applications/MAMP/htdocs/VM2/VM2024/AMAZON-ipnhandler.php', 'a');
fwrite($fp, $headers . PHP_EOL);
fwrite($fp, $body . PHP_EOL);
fclose($fp);