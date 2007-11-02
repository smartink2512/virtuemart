<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
*
* @version $Id$
* @package VirtueMart
* @subpackage classes
* @copyright Copyright (C) 2004-2007 Soeren Eberhardt. All rights reserved.
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
 * The ask class is used to validate email details and send product_ask
 * details to the store admin
 * * methods:
 *       mail_question()
*************************************************************************/

/**
 * This class is used to validate email details and send 
 * product questions and recommendations
 *
 */
class ps_communication {

	function validate( &$d ) {
		global $vmLogger, $VM_LANG, $mosConfig_db, $mosConfig_sitename;

		if (empty($d['sender_name']) ) {
			$vmLogger->err( $VM_LANG->_CONTACT_FORM_NC );
			return false;
		}

		if (empty($d['sender_mail']) || empty($d['recipient_mail'])) {
			$vmLogger->err( $VM_LANG->_EMAIL_ERR_NOINFO );
			return false;
		}

		$validate = mosGetParam( $_POST, vmCreateHash( $mosConfig_db ), 0 );

		// probably a spoofing attack
		if (!$validate) {
			mosErrorAlert( 'Hash not valid - '.$VM_LANG->_NOT_AUTH );
		}

		if (!$_SERVER['REQUEST_METHOD'] == 'POST' ) {
			mosErrorAlert( $VM_LANG->_NOT_AUTH );
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
					mosErrorAlert( $VM_LANG->_NOT_AUTH );
				}
			}
		}

		// Made it past spammer test, free up some memory
		// and continue rest of script:
		unset($k, $v, $v2, $badStrings);

		$default 	= $mosConfig_sitename.' '. $VM_LANG->_ENQUIRY;
		$email 		= mosGetParam( $_POST, 'email', 		'' );
		$text 		= mosGetParam( $_POST, 'text', 			'' );
		$name 		= mosGetParam( $_POST, 'name', 			'' );
		$subject 	= mosGetParam( $_POST, 'subject', 		$default );
		
	    $sender_name = mosgetparam( $_REQUEST, 'sender_name', null);
	    $sender_mail = mosgetparam( $_REQUEST, 'sender_mail', null);
	    $recipient_mail = mosgetparam( $_REQUEST, 'recipient_mail', null);
	    $message = mosgetparam( $_REQUEST, 'recommend_message', null);

		// Get Session Cookie `value`
		$sessioncookie 		= mosGetParam( $_COOKIE, 'virtuemart', null );

		if ( strlen($sessioncookie) < 16 || $sessioncookie == '-') {
			mosErrorAlert( $VM_LANG->_NOT_AUTH );
		}

		// test to ensure that only one email address is entered
		$check = explode( '@', $email );
		if ( strpos( $email, ';' ) || strpos( $email, ',' ) || strpos( $email, ' ' ) || count( $check ) > 2 ) {
			mosErrorAlert( 'You cannot enter more than one email address' );
		}

		if ( (!$email&&!$sender_mail) || (!$text&&!$message)  ) {
			mosErrorAlert( $VM_LANG->_CONTACT_FORM_NC );
		}
		if( !empty( $email )) {
			if( ps_communication::is_email( $email ) == false ) {
				mosErrorAlert( $VM_LANG->_REGWARN_MAIL );
			}
		}
		if( !empty($sender_mail)) {
			if( !ps_communication::is_email( $sender_mail ) || !ps_communication::is_email( $recipient_mail ) ) {
				mosErrorAlert( $VM_LANG->_EMAIL_ERR_NOINFO );
			}
		}
		return true;
	}

	/**
	 
 	*/    
	function mail_question(&$d) {
		global $database, $vmLogger, $mosConfig_sitename,  $mosConfig_mailfrom, $mosConfig_fromname, $mosConfig_db, $Itemid, $_SESSION;
		global $VM_LANG,$mosConfig_live_site,$mosConfig_lang, $sess;

		$db = new ps_DB;
		$product_id = $d["product_id"];
		$q="SELECT * FROM #__{vm}_product WHERE product_id='$product_id'";
		$db->query($q);
		if ( !$db->next_record() ) {
			mosErrorAlert( $VM_LANG->_NOT_AUTH );
		}
		if ($db->f("product_sku") <> @$d["product_sku"] ) {
			mosErrorAlert( $VM_LANG->_NOT_AUTH );
		}
		
		$Itemid = $sess->getShopItemid();
		$flypage = mosgetparam($_REQUEST, "flypage", null);
		// product url
		$product_url = $mosConfig_live_site."/index.php?option=com_virtuemart&page=shop.product_details&flypage=$flypage&product_id=$product_id&Itemid=$Itemid";
		
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
		$subject_msg = $d["text"];
		
		$shopper_subject = sprintf( $VM_LANG->_VM_ENQUIRY_SHOPPER_EMAIL_SUBJECT, $dbv->f("vendor_name"));
				
		$shopper_msg = str_replace( '{vendor_name}', $dbv->f("vendor_name"), $VM_LANG->_VM_ENQUIRY_SHOPPER_EMAIL_MESSAGE );
		$shopper_msg = str_replace( '{product_name}', $db->f("product_name"), $shopper_msg );
		$shopper_msg = str_replace( '{product_sku}', $db->f("product_sku"), $shopper_msg );
		$shopper_msg = str_replace( '{product_url}', $product_url, $shopper_msg );
		
		$shopper_msg = vmHtmlEntityDecode( $shopper_msg );
		
		//
		
		$vendor_subject = sprintf( $VM_LANG->_VM_ENQUIRY_VENDOR_EMAIL_SUBJECT, $dbv->f("vendor_name"), $db->f("product_name"));
		
		$vendor_msg = str_replace( '{shopper_name}', $shopper_name, $VM_LANG->_VM_ENQUIRY_VENDOR_EMAIL_MESSAGE );
		$vendor_msg = str_replace( '{shopper_message}', $subject_msg, $vendor_msg );
		$vendor_msg = str_replace( '{shopper_email}', $shopper_email, $vendor_msg );
		$vendor_msg = str_replace( '{product_name}', $db->f("product_name"), $vendor_msg );
		$vendor_msg = str_replace( '{product_sku}', $db->f("product_sku"), $vendor_msg );
		$vendor_msg = str_replace( '{product_url}', $product_url, $vendor_msg );
		
		$vendor_msg = vmHtmlEntityDecode( $vendor_msg );
		//END: set up text mail
		/////////////////////////////////////
		// Send text email
		//
		if (ORDER_MAIL_HTML == '0') {
			// Mail receipt to the shopper
			vmMail( $vendor_mail, $dbv->f("vendor_name"), $shopper_email, $shopper_subject, $shopper_msg, "" );

			// Mail receipt to the vendor
			vmMail($shopper_email, $shopper_name, $vendor_mail, $vendor_subject, $vendor_msg, "" );


		}
		////////////////////////////
		// set up the HTML email
		//
		elseif (ORDER_MAIL_HTML == '1') {
			// Mail receipt to the vendor
			// open the HTML file and read it into $html
			if (file_exists(VM_THEMEPATH."templates/order_emails/enquiry_".$mosConfig_lang.".html")) {
				$html_file = VM_THEMEPATH."templates/order_emails/enquiry_".$mosConfig_lang.".html";
			}
			elseif(file_exists(VM_THEMEPATH."templates/order_emails/enquiry_english.html")) {
				$html_file = VM_THEMEPATH."templates/order_emails/enquiry_english.html";
			} else {
				$vmLogger->err( 'Enquiry template file not found!' );
				return false;
			}

			$vhtml = file_get_contents($html_file);

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

		return true;



	}
  function showRecommendForm( $product_id ) {
    global $VM_LANG, $mosConfig_sitename, $sess, $mosConfig_db,$my;
    
    $sender_name = vmGet( $d, 'sender_name', null);
    $sender_mail = vmGet( $d, 'sender_mail', null);
    $recipient_mail = vmGet( $d, 'recipient_mail', null);
    $message = shopMakeHtmlSafe( vmGet( $d, 'recommend_message'));
    
    echo '
    <form action="index2.php" method="post">
    
    <table border="0" cellspacing="2" cellpadding="1" width="80%">
      <tr>
        <td>'.$VM_LANG->_EMAIL_FRIEND_ADDR.'</td>
        <td><input type="text" name="recipient_mail" size="50" value="'.(!empty($recipient_mail)?$recipient_mail:'').'" /></td>
      </tr>
      <tr>
        <td>'.$VM_LANG->_EMAIL_YOUR_NAME.'</td>
        <td><input type="text" name="sender_name" size="50" value="'.(!empty($sender_name)?$sender_name:$my->name).'" /></td>
      </tr>
      <tr>
        <td>'.$VM_LANG->_EMAIL_YOUR_MAIL.'</td>
        <td><input type="text" name="sender_mail" size="50" value="'.(!empty($sender_mail)?$sender_mail:$my->email).'" /></td>
      </tr>
      <tr>
        <td colspan="2">'.$VM_LANG->_VM_RECOMMEND_FORM_MESSAGE.'</td>
      </tr>
      <tr>
        <td colspan="2">
          <textarea name="recommend_message" style="width: 100%; height: 200px">';
     
    if (!empty($message)) {
        echo str_replace( array('\r', '\n' ), array("\r", "\n" ), $message );
    }
    else {
        $msg = sprintf($VM_LANG->_VM_RECOMMEND_MESSAGE, $mosConfig_sitename, $sess->url( URL.'index.php?page=shop.product_details&product_id='.$product_id, true ));
        echo shopMakeHtmlSafe(stripslashes( str_replace( 'index2.php', 'index.php', $msg )));
    }

    echo '</textarea>
        </td>
      </tr>
    </table>
    
    <input type="hidden" name="option" value="com_virtuemart" />
    <input type="hidden" name="page" value="shop.recommend" />
    <input type="hidden" name="product_id" value="'.$product_id.'" />
    <input type="hidden" name="'.vmCreateHash( $mosConfig_db ).'" value="1" />
    <input type="hidden" name="Itemid" value="'.$sess->getShopItemid().'" />
    <input type="hidden" name="func" value="recommendProduct" />
    <input class="button" type="submit" name="submit" value="'.$VM_LANG->_PHPSHOP_SUBMIT.'" />
    <input class="button" type="button" onclick="window.close();" value="'.$VM_LANG->_CMN_CANCEL.'" />
    </form>
    ';
  }
  
  function sendRecommendation( &$d ) {
    global $vmLogger, $VM_LANG, $vendor_store_name;
    
    if (!$this->validate( $d )) {
        return false;
    }
    $subject = sprintf( $VM_LANG->_VM_RECOMMEND_SUBJECT, $vendor_store_name );
    $msg = vmGetUnEscaped(str_replace( array('\r', '\n' ), array("\r", "\n" ), $d['recommend_message'] ));
    $send = vmMail($d['sender_mail'], 
                   $d['sender_name'],
                   $d['recipient_mail'],
                   $subject,
                   $msg, ''
                  );
    
    if ($send) {
        $vmLogger->info( $VM_LANG->_VM_RECOMMEND_DONE );
    }
    else {
        $vmLogger->warning( $VM_LANG->_VM_RECOMMEND_FAILED );
        return false;
    }
    
    unset($_REQUEST['sender_name']);
    unset($_REQUEST['sender_mail']);
    unset($_REQUEST['recipient_mail']);
    unset($_REQUEST['recommend_message']);
    
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