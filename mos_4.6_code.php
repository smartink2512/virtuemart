<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
* Abstract lanuages/translation handler class
*/
class mosAbstractLanguage {
/** @var boolean If true, highlights string not found */
	var $_debug = false;
/**
* Translator function, mimics the php gettext (alias _) function
*/
	function _( $string ) {
	    $key = str_replace( ' ', '_', strtoupper( trim( $string ) ) );
	    if (@$this->$key) {
	        return $this->$key;
		} else {
		    return $string;
		}
	}
/**
* Merges the class vars of another class
* @param string The name of the class to merge
* @return boolean True if successful, false is failed
*/
	function merge( $classname ) {
	    if (class_exists( $classname )) {
	        foreach (get_class_vars( $classname ) as $k=>$v) {
	            if (is_string( $v )) {
	                if ($k[0] != '_') {
	                    $this->$k = $v;
					}
				}
			}
		} else {
		    return false;
		}
	}
}

if( !function_exists( "mosCreateMail" ) ) {
  /**
  * Function to create a mail object for futher use (uses phpMailer)
  * @param string From e-mail address
  * @param string From name
  * @param string E-mail subject
  * @param string Message body
  * @return object Mail object
  */
  function mosCreateMail($from='', $fromname='', $subject, $body) {
	  global $mosConfig_absolute_path, $vendor_name, $vendor_mail;
	  
	  $mosConfig_mailer = CFG_MAILER;
	  $mosConfig_smtphost = CFG_SMTPHOST;
	  $mosConfig_smtpauth = CFG_SMTPAUTH;
	  $mosConfig_smtpuser = CFG_SMTPUSER;
	  $mosConfig_smtppass = CFG_SMTPPASS;

	  require_once( CLASSPATH . 'phpmailer/class.phpmailer.php');
    
      $mail = new mShop_PHPMailer();
      $mail->PluginDir = CLASSPATH . "phpmailer/";
      $mail->SetLanguage("en", CLASSPATH . "phpmailer/language/");
	  $mail->CharSet = substr_replace(_ISO, '', 0, 8);
	  $mail->IsMail();
	  $mail->From = $from ? $from : $vendor_mail;
	  $mail->FromName = $fromname ? $fromname : $vendor_name;
	  $mail->Mailer = $mosConfig_mailer;
  
	  // Add smtp values if needed
	  if ( $mosConfig_mailer == 'smtp' ) {
		  $mail->SMTPAuth = $mosConfig_smtpauth;
		  $mail->Username = $mosConfig_smtpuser;
		  $mail->Password = $mosConfig_smtppass;
		  $mail->Host = $mosConfig_smtphost;
	  }
	  $mail->Subject = $subject;
	  $mail->Body = $body;
  
	  return $mail;
  }
  
  /**
  * Mail function (uses phpMailer)
  * @param string From e-mail address
  * @param string From name
  * @param string/array Recipient e-mail address(es)
  * @param string E-mail subject
  * @param string Message body
  */
  function mosMail($from, $fromname, $recipient, $subject, $body) {
	  global $mosConfig_debug;
	  $mail = mosCreateMail($from, $fromname, $subject, $body);
  
	  if( is_array($recipient) ) {
		  foreach ($recipient as $to) {
			  $mail->AddAddress($to);
		  }
	  } else {
		  $mail->AddAddress($recipient);
	  }
	  $mailssend = $mail->Send();
  
	  if( $mosConfig_debug ) {
		  //$mosDebug->message( "Mails send: $mailssend");
	  }
	  if( $mail->error_count > 0 ) {
		  //$mosDebug->message( "The mail message $fromname <$from> about $subject to $recipient <b>failed</b><br /><pre>$body</pre>", false );
		  //$mosDebug->message( "Mailer Error: " . $mail->ErrorInfo . "" );
	  }
	  return $mailssend;
  }
}

if( !class_exists( "mosCommonHTML" )) {
	class mosCommonHTML {
	  /*
	  * Loads all necessary files for JS Overlib tooltips
	  */
	  function loadOverlib() {
		  global  $mosConfig_live_site;
		  ?>
		  <script language="Javascript" type="text/javascript" src="<?php echo $mosConfig_live_site;?>/includes/js/overlib_mini.js"></script>
		  <div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
		  <?php
	  }
	}
}
?>
