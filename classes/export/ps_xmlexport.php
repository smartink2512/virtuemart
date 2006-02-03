<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
*
* @version $Id$
* @package VirtueMart
* @subpackage export
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
*
* The ps_xmlexport class, containing the default export processing code
* for payment methods that have no own class
*
*/
class ps_xmlexport {

    var $classname = 'ps_xmlexport';
  
    /**
    * Show all configuration parameters for this export method
    * @returns boolean False when the export method has no configration
    */
    function show_configuration() {
      /* ... */
    }
    
    function has_configuration() {
      // return false if there's no configuration
      return false;
   }
   
  /**
	* Returns the "is_writeable" status of the configuration file
	* @param void
	* @returns boolean True when the configuration file is writeable, false when not
	*/
   function configfile_writeable() {
   		return true;
      return is_writeable( CLASSPATH."export/".$this->classname.".cfg.php" );
   }
   
  /**
	* Returns the "is_readable" status of the configuration file
	* @param void
	* @returns boolean True when the configuration file is writeable, false when not
	*/
   function configfile_readable() {
      return is_readable( CLASSPATH."export/".$this->classname.".cfg.php" );
   }
   
  /**
	* Writes the configuration file for this payment method
	* @param array An array of objects
	* @returns boolean True when writing was successful
	*/
   function write_configuration( &$d ) {
      /* ... */
   }
   
  /**************************************************************************
  ** name: process_payment()
  ** returns: 
  ***************************************************************************/
   function process_export($order_number, $order_total, &$d) {
        return true;
    }
   
}
