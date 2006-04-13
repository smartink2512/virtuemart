<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
*
* @version $Id$
* @package VirtueMart
* @subpackage classes
* @copyright Copyright (C) 2004-2005 Soeren Eberhardt. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/

/**
 * CLASS DESCRIPTION
 *                   
 * ps_ask
 *
 * The ask class is used to validate email details and send product_ask
 * details to the store admin
 * * methods:
 *       mail_question()
*************************************************************************/

class ps_ask {
	var $classname="ps_ask";
	
	/**
	 
 	*/
    
    
	function mail_question(&$d) {
		global $database, $vmLogger, $mosConfig_sitename,  $mosConfig_mailfrom, $mosConfig_fromname, $mosConfig_db, $Itemid, $_SESSION;
        global $VM_LANG,$mosConfig_live_site,$mosConfig_lang;
        $validate = mosGetParam( $_POST, mosHash( $mosConfig_db ), 0 );
	
	// probably a spoofing attack
	if (!$validate) {
		mosErrorAlert( _NOT_AUTH );
	}
	
		if (!$_SERVER['REQUEST_METHOD'] == 'POST' ) {
		mosErrorAlert( _NOT_AUTH );
	}
	
	// Attempt to defend against header injections:
	$badStrings = array(
			'Content-Type:',
			'MIME-Version:',
			'Content-Transfer-Encoding:',
			'bcc:',
			'cc:'
		);
	
	// Loop through each POST'ed value and test if it contains
	// one of the $badStrings:
	foreach ($_POST as $k => $v){
		foreach ($badStrings as $v2) {
			if (strpos( $v, $v2 ) !== false) {
				mosErrorAlert( _NOT_AUTH );
			}
		}
	}   
	
	// Made it past spammer test, free up some memory
	// and continue rest of script:   
	unset($k, $v, $v2, $badStrings);

    $default 	= $mosConfig_sitename.' '. _ENQUIRY;
		$email 		= mosGetParam( $_POST, 'email', 		'' );
		$text 		= mosGetParam( $_POST, 'text', 			'' );
		$name 		= mosGetParam( $_POST, 'name', 			'' );
		$subject 	= mosGetParam( $_POST, 'subject', 		$default );
		
			$sessionCookieName 	= mosMainFrame::sessionCookieName();		
			// Get Session Cookie `value`
			$sessioncookie 		= mosGetParam( $_COOKIE, $sessionCookieName, null );			
			
			if ( !(strlen($sessioncookie) == 32 || $sessioncookie == '-') ) {
				mosErrorAlert( _NOT_AUTH );
			}
			
		// test to ensure that only one email address is entered
		$check = explode( '@', $email );
		if ( strpos( $email, ';' ) || strpos( $email, ',' ) || strpos( $email, ' ' ) || count( $check ) > 2 ) {
			mosErrorAlert( 'You cannot enter more than one email address' );
		}
		
		if ( !$email || !$text || ( ps_ask::is_email( $email ) == false ) ) {
			mosErrorAlert( _CONTACT_FORM_NC );
		}
	$db = new ps_DB;
    
        $d["set"] = 0;
        $product_id = $d["product_id"];
    $q="SELECT * FROM #__{vm}_product WHERE product_id='$product_id'";
    $db->query($q);
    if ( !$db->next_record() ) {
        mosErrorAlert( _NOT_AUTH );
    }
    if ($db->f("product_sku") <> @$d["product_sku"] ) {
        mosErrorAlert( _NOT_AUTH );
    }
        $lr = "\n";
        $dbv = new ps_DB;
		$qt = "SELECT * from #__{vm}_vendor ";
		/* Need to decide on vendor_id <=> order relationship */
		$qt .= "WHERE vendor_id = '".$_SESSION['ps_vendor_id']."'";
		$dbv->query($qt);
		$dbv->next_record();
        $vendor_mail = $dbv->f("contact_email");
        $shopper_email = $d["email"];
		$shopper_name = $d["name"];
        $shopper_subject = $dbv->f("vendor_name") . " - Confirmation of your enquiry" ;
		$vendor_subject = $dbv->f("vendor_name") . " - Product enquiry - SKU[".$db->f("product_sku")."]" ;
        $subject_msg = $d["text"];
        $shopper_msg = "Confirmation of receipt of your enquiry".$lr.$lr;
        $shopper_msg .= "Thank you for enquiry with ".$dbv->f("vendor_name")." regarding:".$lr.$lr;
        $shopper_msg .= $db->f("product_name")." - Product SKU - ".$db->f("product_sku").$lr.$lr;
    //
        $Itemid = mosgetparam($_REQUEST, "Itemid", null);
        $flypage = mosgetparam($_REQUEST, "flypage", null);
        // product url
        $product_url = $mosConfig_live_site."/index.php?option=com_virtuemart&page=shop.product_details&flypage=$flypage&product_id=$product_id&Itemid=$Itemid";
        $shopper_msg .= "Product link : ".$lr.$product_url.$lr.$lr;
        $shopper_msg .= "We will contact you soon regarding your enquiry.".$lr.$lr;
        $shopper_msg .= "(Please do not reply to this email)";
        $shopper_msg = vmHtmlEntityDecode( $shopper_msg );
        $vendor_msg = "You have received a product enquiry from ".$shopper_name.$lr.$lr;
        $vendor_msg .= "Regarding product : ".$db->f("product_name")." Product SKU : ".$db->f("product_sku").$lr.$lr;
        $vendor_msg .= "Enquiry: ".$subject_msg.$lr.$lr; 
        $vendor_msg .= "URL:".$product_url.$lr.$lr;
        $vendor_msg .= "Mail mailto:".$shopper_email.$lr.$lr;
        $vendor_msg = vmHtmlEntityDecode( $vendor_msg );
		//END: set up text mail
		/////////////////////////////////////
		// Send text email
		//
		if (ORDER_MAIL_HTML == '0') {
        // Mail receipt to the shopper
			vmMail( $vendor_mail, $dbv->f("vendor_name"), $shopper_email, $shopper_subject, $shopper_msg, "" );

			// Mail receipt to the vendor
			vmMail($shopper_email, $shopper_name, $vendor_mail, $vendor_subject,	$vendor_msg, "" );

        
        }
        ////////////////////////////
		// set up the HTML email
		//
		elseif (ORDER_MAIL_HTML == '1') {
        // Mail receipt to the vendor
        // open the HTML file and read it into $html
			if (file_exists(PAGEPATH."templates/order_emails/enquiry_".$mosConfig_lang.".html")) {
				$html_file = fopen(PAGEPATH."templates/order_emails/enquiry_".$mosConfig_lang.".html","r");
			}
			elseif(file_exists(ADMINPATH."enquiry_".$mosConfig_lang.".html")) {
				$html_file = fopen(ADMINPATH."enquiry_".$mosConfig_lang.".html","r");
			}
			else {
				$html_file = fopen(PAGEPATH."templates/order_emails/enquiry_english.html","r");
			}

			$vhtml = "";

			while (!feof($html_file)) {
				$buffer = fgets($html_file, 1024);
				$vhtml .= $buffer;
			}
			fclose ($html_file);
            
            $v_vfi = "<img src=\"cid:product_image\" alt=\"product_image\" border=\"0\" />";
            $vhtml = str_replace('{VendorName}',$dbv->f("vendor_name"),$vhtml);
            $vhtml = str_replace('{subject}',$subject_msg,$vhtml);
            $vhtml = str_replace('{contact_name}',$shopper_name,$vhtml);
            $vhtml = str_replace('{contact_email}',$shopper_email,$vhtml);
            $vhtml = str_replace('{product_name}',$db->f("product_name"),$vhtml);
            $vhtml = str_replace('{product_s_description}',$db->f("product_s_desc"),$vhtml);
            $vhtml = str_replace('{product_url}',$product_url,$vhtml);
            $vhtml = str_replace('{product_sku}',$db->f("product_sku"),$vhtml);
            // Have thumb image
            if ($db->f("product_thumb_image")) {
                $imagefile = pathinfo($db->f("product_thumb_image"));
			    $extension = $imagefile['extension'] == "jpg" ? "jpeg" : "jpeg";

			    $EmbeddedImages[] = array(	'path' => IMAGEPATH."product/".$db->f("product_thumb_image"),
								'name' => "product_image", 
								'filename' => $db->f("product_thumb_image"),
								'encoding' => "base64",
								'mimetype' => "image/".$extension );
                $vhtml = str_replace('{product_thumb}',$v_vfi,$vhtml);
                
                $vendor_email = vmMail( $shopper_email, $shopper_name, $vendor_mail, $vendor_subject, $vhtml, $vendor_msg, true, null, null, $EmbeddedImages);
            }
            else {
                $vhtml = str_replace('{product_thumb}',"",$vhtml);
                
                $vendor_email = vmMail( $shopper_email, $shopper_name, $vendor_mail, $vendor_subject, $vhtml, $vendor_msg, true, null, null, null);
            }            
            //Send sender confirmation email
			
			$sender_mail = vmMail( $vendor_mail, $dbv->f("vendor_name"), $shopper_email, $shopper_subject, $shopper_msg, "" );
            if ( ( !$vendor_email ) || (!$sender_mail) ) {
				$vmLogger->debug( 'Something went wrong while sending the order confirmation email to '.$vendor_mail.' and '.$shopper_email );
				return false;
                }
        }
        //$vmLogger->warning($shopper_email);
        //$vmLogger->warning($shopper_name );       
        //$vmLogger->warning($vendor_mail);
        //$vmLogger->warning($vendor_subject);
        //$vmLogger->warning($vendor_msg);
        //$vmLogger->warning($vhtml);
        //$vmLogger->warning($EmbeddedImages);
        //return false;
   
   
   
        $link = $mosConfig_live_site."/index.php?option=com_virtuemart&page=shop.ask&flypage=".@$_REQUEST['flypage']."&product_id=$product_id&set=0&Itemid=$Itemid";
        mosRedirect( $link, "" );
		return true;
    
    
	
}

function is_email($email){
	$rBool=false;

	if  ( preg_match( "/[\w\.\-]+@\w+[\w\.\-]*?\.\w{1,4}/" , $email ) ){
		$rBool=true;
	}
	return $rBool;
}

}
?>