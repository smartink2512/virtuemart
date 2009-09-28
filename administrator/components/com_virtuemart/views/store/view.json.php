<?php
/**
 * Store View
 *
 * @package	JMart
 * @subpackage Store
 * @author Rick Glunt
 * @copyright Copyright (c) 2009 JMart Team. All rights reserved.
 */

jimport( 'joomla.application.component.view');

/**
 * HTML View class for maintaining the store
 *
 * @package	JMart
 * @subpackage Store
 * @author RolandD
 */
class JmartViewStore extends JView {
	
	function display($tpl = null) {
		$country_model = $this->getModel('country');
		$countries = $country_model->getCountries(false, true);
		echo json_encode($countries);
	}
}
?>
