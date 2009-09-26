<?php
/**
 * State table
 *
 * @package	JMart
 * @subpackage Country
 * @author Rick Glunt 
 * @copyright Copyright (c) 2009 JMart Team. All rights reserved.
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

/**
 * State table class
 * The class is is used to manage the states in a country
 *
 * @author Rick Glunt
 * @package		JMart
 */
class TableState extends JTable
{
	/** @var int Primary key */
	var $state_id				= 0;
	/** @var integer Country id */
	var $country_id           	= 0;
	/** @var string State name */
	var $state_name           	= '';	
	/** @var char 3 character state code */
	var $state_3_code         	= '';				
    /** @var char 2 character state code */
	var $state_2_code         	= '';
	/** @var int Published or unpublished */
	var $published         		= 0;


	/**
	 * @author Rick Glunt
	 * @param $db A database connector object
	 */
	function __construct(&$db)
	{
		parent::__construct('#__jmart_state', 'state_id', $db);
	}


	/**
	 * Validates the state record fields.
	 *
	 * @author Rick Glunt
	 * @return boolean True if the table buffer is contains valid data, false otherwise.
	 */
	function check() 
	{
        if (!$this->state_name) {
			$this->setError(JText::_('State records must contain a contry name.'));
			return false;
		}
		if (!$this->state_2_code) {
			$this->setError(JText::_('State records must contain a 2 symbol code.'));
			return false;
		}
		if (!$this->state_3_code) {
			$this->setError(JText::_('State records must contain a 3 symbol code.'));
			return false;
		}

		if (($this->state_name) && ($this->state_id == 0)) {
		    $db =& JFactory::getDBO();
		    
			$q = 'SELECT count(*) FROM `#__jmart_state` ';
			$q .= 'WHERE `state_name`="' .  $this->state_name . '"';
            $db->setQuery($q);        
		    $rowCount = $db->loadResult();		
			if ($rowCount > 0) {
				$this->setError(JText::_('The given satte name already exists.'));
				return false;
			}
		}
		
		return true;
	}
	
	
	

}
?>
