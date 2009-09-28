<?php
/**
 * Country table
 *
 * @package	JMart
 * @subpackage Country
 * @author Rick Glunt 
 * @copyright Copyright (c) 2009 JMart Team. All rights reserved.
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

/**
 * Country table class
 * The class is is used to manage the countries in the shop.
 *
 * @author Rick Glunt
 * @package		JMart
 */
class TableCountry extends JTable
{
	/** @var int Primary key */
	var $country_id				= 0;
	/** @var integer Zone id */
	var $zone_id           		= 0;
	/** @var string Country name */
	var $country_name           = '';	
	/** @var char 3 character country code */
	var $country_3_code         = '';				
    /** @var char 2 character country code */
	var $country_2_code         = '';
    /** @var int Published or unpublished */
	var $published 		        = 0;	


	/**
	 * @author Rick Glunt
	 * @param $db A database connector object
	 */
	function __construct(&$db)
	{
		parent::__construct('#__jmart_country', 'country_id', $db);
	}


	/**
	 * Validates the country record fields.
	 *
	 * @author Rick Glunt
	 * @return boolean True if the table buffer is contains valid data, false otherwise.
	 */
	function check() 
	{
        if (!$this->country_name) {
			$this->setError(JText::_('Country records must contain a contry name.'));
			return false;
		}
		if (!$this->country_2_code) {
			$this->setError(JText::_('Country records must contain a 2 symbol code.'));
			return false;
		}
		if (!$this->country_3_code) {
			$this->setError(JText::_('Country records must contain a 3 symbol code.'));
			return false;
		}

		if (($this->country_name) && ($this->country_id == 0)) {
		    $db =& JFactory::getDBO();
		    
			$q = 'SELECT count(*) FROM `#__jmart_country` ';
			$q .= 'WHERE `country_name`="' .  $this->country_name . '"';
            $db->setQuery($q);        
		    $rowCount = $db->loadResult();		
			if ($rowCount > 0) {
				$this->setError(JText::_('The given country name already exists.'));
				return false;
			}
		}
		
		return true;
	}
	
	
	

}
?>
