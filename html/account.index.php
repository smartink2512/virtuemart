<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
*
* @version $Id$
* @package VirtueMart
* @subpackage html
* @copyright Copyright (C) 2004-2007 soeren - All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/
mm_showMyFileName( __FILE__ );

require_once(CLASSPATH.'ps_order.php');
$ps_order = new ps_order;

/* Set Dynamic Page Title when applicable */
$mainframe->setPageTitle( $VM_LANG->_PHPSHOP_ACCOUNT_TITLE );

// Set the CMS pathway
$pathway = array();
$pathway[] = $vm_mainframe->vmPathwayItem( $VM_LANG->_PHPSHOP_ACCOUNT_TITLE );
$vm_mainframe->vmAppendPathway( $pathway );

$tpl = new $GLOBALS['VM_THEMECLASS']();

$tpl->set( 'ps_order', $ps_order );

echo $tpl->fetch( 'pages/account.index.tpl.php' );
?>