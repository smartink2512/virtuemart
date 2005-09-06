<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
* @version $Id: currency_convert.php,v 1.3 2005/05/29 14:31:55 soeren_nb Exp $
* @package mambo-phpShop
* @copyright (C) 2004 Werner Knudsen
*
* Modification for mambo-phpshop:
* 	@copyright (C) 2004-2005 Soeren Eberhardt
*
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
* www.mambo-phpshop.net
*
* Currency Converter Live Module 
*/


function convertECB ($amountA, $currA, $currB) {
	global $mosConfig_cachepath, $mosConfig_live_site;
	/* variables:
	* $amountA 	- amount to convert
	* $currA 	- currency to covert from
	* $currB	- currency to convert to
	* $do_date	- if set, check only date
	*/

	setlocale(LC_TIME, "en-GB");
	$now = time() + 3600; // Time in ECB (Germany) is GMT + 1 hour (3600 seconds)
	if (date("I")) {
		$now += 3600; // Adjust for daylight saving time
	}
	$weekday_now_local = gmdate('w', $now); // week day, important: week starts with sunday (= 0) !!
	$date_now_local = gmdate('Ymd', $now);
	$time_now_local = gmdate('Hi', $now);
	$time_ecb_update = '1415';
	if( empty($mosConfig_cachepath) )
	  $store_path = $mosConfig_cachepath;
	else
	  $store_path = $mosConfig_absolute_path."/media";
	  
	$archivefile_name = $store_path.'/daily.xml';
	$ecb_filename = 'http://www.ecb.int/stats/eurofxref/eurofxref-daily.xml';
	$val = '';
	$archive = 'yes';

	if(file_exists($archivefile_name)) {
	  // timestamp for the Filename
	  $file_datestamp = date('Ymd',filemtime ($archivefile_name)); 
	  $curr_filename = $archivefile_name;
	  $archive = '';
	}
	else 
	  $curr_filename = $ecb_filename;
	  
	if( !is_writable( $store_path )) {
	  $archive = '';
	  if( DEBUG == "1" )
		echo "<span class=\"message\">Die Datei $archivefile_name can't be created. The directory $store_path is not writable</span>";
	}
	
	$handle = @fopen($curr_filename, 'r');
	if ($handle) {
		$contents = '';
		$contentfile = '';
		do {
			$data = @fread($handle, 4096);
				if (strlen($data) == 0) {
       				break;
   				}
   			$contents .= $data; // with this syntax only text will be translated, whole text with htmlspecialchars($data)
   			$contentfile .= $data; // file to write later if necessary
		} while (true);
		@fclose($handle);

		// if archivefile does not exist
		if($archive == 'yes') {
			// now write new file
			$fp = @fopen($archivefile_name,'wb');
			@fwrite($fp,$contentfile);
			@fclose($fp);
			@chmod($archivefile_name,0644);
		}

		$contents = str_replace ("<Cube currency='USD'", " <Cube currency='EUR' rate='1'/> <Cube currency='USD'", $contents);
		
		/* XML Parsing */
		require_once( CLASSPATH. 'domit/xml_domit_lite_include.php' );
		$xmlDoc =& new DOMIT_Lite_Document();
		$xmlDoc->parseXML( $contents, false, true );
		
		$currency_list = $xmlDoc->getElementsByTagName( "Cube" );
		// Loop through the Currency List
		for ($i = 0; $i < $currency_list->getLength(); $i++) {
			$currNode =& $currency_list->item($i);
			$currency[$currNode->getAttribute("currency")] = $currNode->getAttribute("rate");
			unset( $currNode );
		}
		$valA = $currency[$currA];
		$valB = $currency[$currB];
		
		if ($valA) {
			$val = $amountA * $valB / $valA;
		} 
		else {
			$val = 0;
		}
	}
	return $val;
} // end function convertecb

?>
