<?php
/**
*
* Review controller
*
* @package	VirtueMart
* @subpackage
* @author RolandD
* @link http://www.virtuemart.net
* @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id$
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

// Load the controller framework
jimport('joomla.application.component.controller');

if(!class_exists('VmController'))require(JPATH_VM_ADMINISTRATOR.DS.'helpers'.DS.'vmcontroller.php');


/**
 * Review Controller
 *
 * @package    VirtueMart
 * @author RolandD
 */
class VirtuemartControllerRatings extends VmController {

	/**
	 * Method to display the view
	 *
	 * @access	public
	 */
	function __construct() {
		parent::__construct();

//		$this->setMainLangKey('RATING');
		/* Redirects */
		$this->registerTask('unpublish','publish');
		$this->registerTask('add','edit');
		$this->registerTask('cancel','ratings');
	}

	/**
	 * Shows the product list screen
	 */
	public function Ratings() {
		/* Create the view object */
		$view = $this->getView('ratings', 'html');

		/* Default model */
		$view->setModel( $this->getModel( 'ratings', 'VirtueMartModel' ), true );

		/* Set the layout */

		/* Now display the view. */
		$view->display();
	}


}
// pure php no closing tag
