<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
* mambo-phpShop Admin File
*
* @version $Id: admin.phpshop.php,v 1.13 2005/05/25 19:04:48 soeren_nb Exp $
* @package mambo-phpShop
*
* @copyright (C) 2004-2005 Soeren Eberhardt
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
*
* www.mambo-phpshop.net
*/

defined( '_PSHOP_ADMIN' ) or define( '_PSHOP_ADMIN', '1' );

$no_menu = mosGetParam( $_REQUEST, 'no_menu', 0 );
global $PHPSHOP_LANG;
/*** INSTALLER SECTION ***/
if (isset($_REQUEST['install_type']) && file_exists( $mosConfig_absolute_path.'/administrator/components/com_phpshop/install.php' )) {
  
  include( $mosConfig_absolute_path.'/administrator/components/com_phpshop/install.php' );
  
  /** can be update and newinstall **/
  $install_type = mosgetparam( $_REQUEST, 'install_type', 'newinstall' );
  
  /** true or false **/
  $install_sample_data = mosgetparam( $_GET, 'install_sample_data', false );
  
  installphpShop( $install_type, $install_sample_data );
  $error = "";
  $page = "store.index";

  $installfile = dirname( __FILE__ ) . "/install.php";
  if( !@unlink( $installfile ) ) {
    echo "<br /><span class=\"message\">Something went wrong when trying to delete the file <strong>install.php</strong>!<br />";
    echo "You'll have to delete the file manually before being able to use mambo-phpShop!</span>";
  }
}
elseif (file_exists( $mosConfig_absolute_path.'/administrator/components/com_phpshop/install.php' )) {
  include( $mosConfig_absolute_path.'/administrator/components/com_phpshop/install.phpshop.php' );
  com_install();
  exit();
}
/*** END INSTALLER ***/


/* Load the phpshop main parse code */
require_once( $mosConfig_absolute_path.'/components/com_phpshop/phpshop_parser.php' );

$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit );
$limitstart = $mainframe->getUserStateFromRequest( "view{$page}limitstart", 'limitstart', 0 );
	
if (defined('_DONT_VIEW_PAGE') && !isset($install_type) ) {
    echo "<script type=\"text/javascript\">alert('$error. Your permissions: ".$_SESSION['auth']['perms']."')</script>\n";  
}


// renew Page-Information
$my_page= explode ( '.', $page );
$modulename = $my_page[0];
$pagename = $my_page[1];

$_SESSION['last_page'] = $page;

if( $no_menu != 1 ) {
  include(ADMINPATH.'header.php');
}
// Include the Stylesheet
echo '<link href="../components/'.$option.'/css/shop.css" type="text/css" rel="stylesheet" media="screen, projection" />';
echo '<script type="text/javascript" src="../components/'.$option.'/js/functions.js"></script>';

// Load PAGE
include( PAGEPATH.$modulename.".".$pagename.".php" );

if( DEBUG == '1' ) {
  // Load PAGE
  include( PAGEPATH."shop.debug.php" );
}
?>
