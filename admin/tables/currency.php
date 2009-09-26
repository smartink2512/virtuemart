<?php
/**
 * Currency table
 *
 * @package	JMart
 * @subpackage Currency
 * @author Rick Glunt 
 * @copyright Copyright (c) 2009 JMart Team. All rights reserved.
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

/**
 * Currency table class
 * The class is is used to manage the currencies in the shop.
 *
 * @author Rick Glunt
 * @package		JMart
 */
class TableCurrency extends JTable
{
	/** @var int Primary key */
	var $currency_id				= 0;
	/** @var string Currency name*/
	var $currency_name           	= '';	
	/** @var char Currency code */
	var $currency_code         		= '';				


	/**
	 * @author Rick Glunt
	 * @param $db A database connector object
	 */
	function __construct(&$db)
	{
		parent::__construct('#__jmart_currency', 'currency_id', $db);
	}


	/**
	 * Validates the currency record fields.
	 *
	 * @author Rick Glunt
	 * @return boolean True if the table buffer is contains valid data, false otherwise.
	 */
	function check() 
	{
        if (!$this->currency_name) {
			$this->setError(JText::_('Currency records must contain a currency name.'));
			return false;
		}
		if (!$this->currency_code) {
			$this->setError(JText::_('Currency records must contain a currency code.'));
			return false;
		}

		if (($this->currency_name) && ($this->currency_id == 0)) {
		    $db =& JFactory::getDBO();
		    
			$q = 'SELECT count(*) FROM `#__jmart_currency` ';
			$q .= 'WHERE `currency_name`="' .  $this->currency_name . '"';
            $db->setQuery($q);        
		    $rowCount = $db->loadResult();		
			if ($rowCount > 0) {
				$this->setError(JText::_('The given currency name already exists.'));
				return false;
			}
		}
		
		return true;
	}
	
	
	

}
?>
