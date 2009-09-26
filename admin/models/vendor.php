<?php
/**
* @package		JMart
* @license		GNU/GPL, see LICENSE.php
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.model');


/**
* Model for JMart Vendors
*
* @package		JMart
*/
class JMartModelVendor extends JModel
{
    /**
    * Vendor Id
    *
    * @var $_id;
    */
    var $_id;
    
    /**
    * Vendor detail record
    *
    * @var object;
    */
    var $_vendor;    
    
    
    /**
    * Constructor for the Vendor model.
    */
    function __construct()
    {
        parent::__construct();
        
        $cid = JRequest::getVar('cid', false, 'DEFAULT', 'array');
        if ($cid) {
            $id = $cid[0];
        }
        else {
            $id = JRequest::getInt('id', 1);
        }
        
        $this->setId($id);
    }
    
    
    /**
    * Resets the Vendor ID and data
    */        
    function setId($id=1) 
    {
        $this->_id = $id;
        $this->_vendor = null;
    }
    
    
    /**
	* Retrieve the vendor details from the database.
	* 
	* @return object Vendor details
	*/
	function getVendor($vendId=1) 
	{
        if (!$this->_vendor) {
        	//The DB should get with the ps_vendor.php
        	//and the functions in this class must be rewritten OR I port the ps_vendor class in this class
        	// by Max Milbers
            $db =& $this->getDBO();
            $query = 'SELECT * FROM `#__jmart_vendor` ';
            $query .=  'WHERE `vendor_id`=' . $vendId;
            $db->setQuery($query);
            
            $this->_vendor = $db->loadObject();
        }

        return $this->_vendor;   
	}



}
?>