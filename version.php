<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
*
* @version $Id: version.php,v 1.14 2005/11/12 15:55:01 soeren_nb Exp $
* @package VirtueMart
* @subpackage core
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

/** Version information */
class vmVersion {
	/** @var string Product */
	var $PRODUCT = 'VirtueMart';
	/** @var int Release Number */
	var $RELEASE = '1.0.0';
	/** @var string Development Status */
	var $DEV_STATUS = 'final';
	/** @var string Codename */
	// Big Walter Hornton was an US-american blues musician
	var $CODENAME = 'Big Walter Horton';
	/** @var string Date */
	var $RELDATE = '23/11/2005';
	/** @var string Time */
	var $RELTIME = '20:53';
	/** @var string Timezone */
	var $RELTZ = 'GMT';
	/** @var string Copyright Text */
	var $COPYRIGHT = 'Copyright (C) 2005 Soeren Eberhardt. All rights reserved.'; 
	/** @var string URL */
	var $URL = '<a href="http://virtuemart.net">VirtueMart</a> is a Free Component for Mambo released under the GNU/GPL License.';
}
$VMVERSION =& new vmVersion();

$shortversion = $VMVERSION->PRODUCT . " " . $VMVERSION->RELEASE . " " . $VMVERSION->DEV_STATUS. " ";
	
$myVersion = $shortversion . " [".$VMVERSION->CODENAME ."] <br />" . $VMVERSION->RELDATE . " "
	. $VMVERSION->RELTIME . " " . $VMVERSION->RELTZ;
	

?>