<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
*
* @version $Id: ps_session.php,v 1.5 2005/10/10 18:49:06 soeren_nb Exp $
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

/****************************************************************************
* CLASS DESCRIPTION
*                   
* ps_session
*
* The class is the former session class for virtuemart
*
*************************************************************************/
class ps_session {

    var $component_name = "option=com_virtuemart";    
    /**
     * Initialize the Session environment for VirtueMart
     *
     */
    function ps_session() {
    	$this->initSession();
    }
    /**
     * Initiate the Session
     *
     */
    function initSession() {
    	if( empty($_SESSION)) {
			//Session not yet started!";
			session_name( 'virtuemart' );
			session_start();
			if( !empty($_SESSION) && !empty($_COOKIE['virtuemart'])) {
				echo DEBUG ? '<div style="border: green 2px solid;padding: 3px;margin: 2px;"><strong>Shop Debug:</strong> A Session called <i>phpShop</i> was successfully started!</div>' : '';
			}
		}
		else
		echo DEBUG ? '<div style="border: orange 2px dotted;padding: 3px;margin: 2px;"><strong>Shop Debug:</strong> A Session had already been started...you seem to be using SMF, phpBB or another Sesson based Software.</div>' : '';
		if( empty($_COOKIE['virtuemart'] )) {
			setCookie( 'virtuemart', md5(uniqid('virtuemart')), 0, "/" );
			echo DEBUG ? '<div style="border: red 2px dotted;padding: 3px;margin: 2px;"><strong>Shop Debug:</strong> A phpShop Cookie had to be set (there was none - does your Browser keep the Cookie?) although a Session already has been started! If you see this message on each page load, your browser doesn\'t accept Cookies from this site.</div>' : '';
		}
    }
    
    /**
     * Gets the Itemid for the com_virtuemart Component
     * and stores it in a global Variable
     *
     * @return int Itemid
     */
    function getShopItemid() {
       
        if( empty( $_REQUEST['shopItemid'] )) { 
            $db = new ps_DB;
            $db->query( "SELECT id FROM #__menu WHERE link='index.php?option=com_virtuemart' AND published='1'");
            if( $db->next_record() )
                $_REQUEST['shopItemid'] = $db->f("id");
            else
                $_REQUEST['shopItemid'] = 1;
        }

        return $_REQUEST['shopItemid'];

    }
    
    /**
     * This is a solution for  the Shared SSL problem
     * We have to copy some cookies from the Main Mambo site domain into
     * the shared SSL domain (only when necessary!)
     *
     */
    function prepare_SSL_Session() {
        global $my;
        
        $ssl_redirect = mosGetParam( $_GET, "ssl_redirect", 0 );
        $martID = mosGetParam( $_GET, 'martID', null );
        $ssl_domain = "";
        
        /**
        * This is the first part of the Function:
        * We check if the function must be called at all
        * Usually this is only called once: Before we go to the checkout.
        * The variable ssl_redirect=1 is appended to the URL, just for this function knows
        * is must be active! This has nothing to do with SSL / Shared SSL or whatever
        */
        if( $ssl_redirect == 1 ) {
            // check_Shared_SSL compares the usual domain name
            // and the https Domain Name. If both do not match, we move on
            // else we leave this function.
            if( $this->check_Shared_SSL( $ssl_domain ) && $_SERVER['SERVER_PORT'] != 443) {
                
                if( !empty($my->id)) {
                    // User is already logged in
                    // We need to transfer the usercookie if present
                    $martID = @base64_encode( $_COOKIE['virtuemart']."|".$_COOKIE['sessioncookie']."|".$_COOKIE['usercookie']['password']."|".$_COOKIE['usercookie']['username'] );
                    
                }
                else {
                    // User is not logged in, but has Cart Contents
                    $martID = base64_encode( $_COOKIE['virtuemart']."|".$_COOKIE['sessioncookie'] );
                }
                // Redirect and send the Cookie Values within the variable martID
                mosRedirect( $this->url(SECUREURL . "index.php?page=checkout.index&martID=$martID") );
            }
            // do nothing but redirect
            else
                mosRedirect( $this->url(SECUREURL . "index.php?page=checkout.index") );
        }
        /**
        * This is part two of the function
        * If the redirect (see 4/5 lines above) was successful
        * and the Store uses Shared SSL, we have the variable martID
        * So let's copy the Cookie Values on the new domain and start the old session
        * othwerwise: do nothing.
        */
        if( !empty( $martID ) )
            if( $this->check_Shared_SSL( $ssl_domain ) ) {
            
            // We now need to copy the Mambo Cookies (which are only
            // valid for the "normal" Domain) to the SSL Domain
            if( $martID ) {
                $cookievals = base64_decode( $martID );
                
                $id_array = explode( "|", $cookievals );
                
                $virtuemartcookie = $id_array[0];
                $sessioncookie = $id_array[1];
                $usercookie["password"] = @$id_array[2];
                $usercookie["username"] = @$id_array[3];
                
                /** Mambo sets a Visitor Cookie (on each new page load) with a new Session Value
                * This Cookie is useless, since the customer is no visitor at this point -
                * so we can delete it. But Deleting Cookies is not trivial...we just set the
                * Session Cookie again with an empty value. This erases the Cookie.
                */
                setcookie( "sessioncookie", "", time() - 43200, "/" );
                // Set the "old" new Cookies now
                setcookie( "sessioncookie", $sessioncookie, time() + 43200, "/", dirname($ssl_domain), true );
                // Get sure the cookie is set
                $_COOKIE['sessioncookie'] = $sessioncookie;
                
                // Also log the user in when he was already logged in at the other domain
                if(!empty($usercookie["password"]) && !empty($usercookie["username"])) {
                    $lifetime = time() + 365*24*60*60;
                    setcookie( "usercookie[username]", $usercookie["username"], $lifetime, "/" );
                    setcookie( "usercookie[password]", $usercookie["password"], $lifetime, "/" );
                }
                /** Start the new Session.
                * This is important:
                * When session_start() has been called before this won't work!!
                * This will probably not work when phpBB or Simple Machines Forum are loaded with the Site, 
                * as those scripts start their own Sessions before VirtueMart can!!
                */
                session_id( $virtuemartcookie );
                session_name( 'virtuemart' );
                session_start();
                
                // Prevent the martID from being displayed in the URL
                if( !empty( $_GET['martID'] ))
                    mosRedirect( $this->url(SECUREURL . "index.php?page=checkout.index") );
                
            }
            
        }
    }
    
    function check_Shared_SSL( &$ssl_domain ) {
        
        if( URL == SECUREURL ) {
          $ssl_domain = str_replace("http://", "", URL );
          $ssl_redirect = false;
          return $ssl_redirect;
        }
        // Extract the Domain Names without the Protocol
        $domain = str_replace("http://", "", URL );
        $ssl_domain = str_replace("https://", "", SECUREURL );
        // If SSL and normal Domain do not match,
        // we assume that you use Shared SSL
        
        if( $ssl_domain != $domain ) {
          $ssl_redirect = true;
        }
        else {
         $ssl_redirect = false;
        }
        
        return $ssl_redirect;
    }
    
  /**************************************************************************
  ** name: url()
  ** created by:
  ** description:
  ** parameters:
  ** returns: an URL concatenated with "option=com_virtuemart"
  ***************************************************************************/  
  function url($text) {
    
    $Itemid = "&Itemid=".$this->getShopItemid();

    switch ($text) {
        case SECUREURL:
            $text =  SECUREURL.$_SERVER['PHP_SELF']."?".$this->component_name.$Itemid;
            break;
        case URL:
            $text =  URL.$_SERVER['PHP_SELF']."?".$this->component_name.$Itemid;
            break;
        default:
            $limiter = strpos($text, '?');
            
            $appendix = "";
            // now append "&option=com_virtuemart&Itemid=XX"
            if (!strstr($text, "option="))
               $appendix .= "&" . $this->component_name;
            $appendix .= $Itemid;
            
            if (!defined( '_PSHOP_ADMIN' )) {
                
                // be sure that we have the correct PHP_SELF in front of the url
                if( stristr( $_SERVER['PHP_SELF'], "index2.php" ))
                    $prep = "index2.php";
                else
                    $prep = "index.php";
                if( stristr( $text, "index2.php" ))
                    $prep = "index2.php";
                    
                $appendix = $prep.substr($text, $limiter, strlen($text)-1).$appendix;
                $appendix = sefRelToAbs( str_replace( $prep.'&', $prep.'?', $appendix ) );
                if( !stristr( $appendix, URL ) )
                    $appendix = URL . $appendix;
            } 
            elseif( $_SERVER['SERVER_PORT'] == 443 ) {
                $appendix = SECUREURL."administrator/index2.php".substr($text, $limiter, strlen($text)-1).$appendix;
            }
            else
                $appendix = URL."administrator/index2.php".substr($text, $limiter, strlen($text)-1).$appendix;
                
            if ( stristr($text, SECUREURL)) {
            	$appendix = str_replace(URL, SECUREURL, $appendix);
            }
            
            $text = $appendix;

            break;
    }
    /**
    ** This has to be redone, because it doesn't work with mosRedirect

    if (!defined( '_PSHOP_ADMIN' ) && $pshop_mode != "admin") {
        $text = str_replace( "&", "&amp;", $text );
        $text = str_replace( "&amp;amp;", "&amp;", $text );
    } 
    */
    return $text;
  }
  
   /**************************************************************************
  ** name: url()
  ** created by:
  ** description:
  ** parameters:
  ** returns: echoes an URL concatenated with the string "option=com_virtuemart"
  ***************************************************************************/  
  
  function purl($text) {
  
    $Itemid = "&Itemid=".$this->getShopItemid();

    switch ($text) {
        case SECUREURL:
            $text =  SECUREURL.$_SERVER['PHP_SELF']."?".$this->component_name.$Itemid;
            break;
        case URL:
            $text =  URL.$_SERVER['PHP_SELF']."?".$this->component_name.$Itemid;
            break;
        default:
            $limiter = strpos($text, '?');
            
            $appendix = "";
            // now append "&option=com_virtuemart&Itemid=XX"
            if (!strstr($text, "option="))
               $appendix .= "&" . $this->component_name;
            $appendix .= $Itemid;
            
            if (!defined( '_PSHOP_ADMIN' )) {
                // be sure that we have the correct PHP_SELF in front of the url
                if( stristr( $_SERVER['PHP_SELF'], "index2.php" ))
                    $prep = "index2.php";
                else
                    $prep = "index.php";
                if( stristr( $text, "index2.php" ))
                    $prep = "index2.php";
                $appendix = $prep.substr($text, $limiter, strlen($text)-1).$appendix;
                $appendix = sefRelToAbs ( $appendix );
                if( !stristr( $appendix, URL ) )
                    $appendix = URL . $appendix;
            } 
            elseif( $_SERVER['SERVER_PORT'] == 443 ) {
                $appendix = SECUREURL."administrator/index2.php".substr($text, $limiter, strlen($text)-1).$appendix;
            }
            else
                $appendix = URL."administrator/index2.php".substr($text, $limiter, strlen($text)-1).$appendix;
                
            if ( stristr($text, SECUREURL))
                $appendix = str_replace(URL, SECUREURL, $appendix);
                
            $text = $appendix;

            break;
    }
    /**
    ** This has to be redone, because it doesn't work with mosRedirect
    if (!defined( '_PSHOP_ADMIN' ) && $pshop_mode != "admin") {
        $text = str_replace( "&", "&amp;", $text );
        $text = str_replace( "&amp;amp;", "&amp;", $text );
    }
    */
    echo $text;
  }

  
/**************************************************************************
  ** name: hidden_session()
  ** created by:
  ** description:
  ** parameters:
  ** returns: nothing
  ***************************************************************************/  
  
  function hidden_session() {
    return true;
  }


} // end of class session
?>
