<?php
/**
*
* Description
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

/**
* Class Description
*
* @package VirtueMart
* @author RolandD
*/
class VirtueMartControllerCategory extends JControllerLegacy {

    /**
    * Method Description
    *
    * @access public
    * @author RolandD
    */
    public function __construct() {
     	 parent::__construct();

     	 $this->registerTask('browse','category');
   	}

	/**
	* Function Description
	*
	* @author RolandD
	* @author George
	* @access public
	*/
	public function display($cachable = false, $urlparams = false)  {

		if (VmRequest::getvar('search')) {
			$view = $this->getView('category', 'html');
			$view->display();
		} else {
			// Display it all
			$document = JFactory::getDocument();
			$viewType = $document->getType();
			$viewName = VmRequest::getCmd('view', $this->default_view);
			$viewLayout = VmRequest::getCmd('layout', 'default');

			$view = $this->getView($viewName, $viewType, '', array('layout' => $viewLayout));

			$view->assignRef('document', $document);

			$view->display();
		}
		if($categoryId = VmRequest::getInt('virtuemart_category_id',0)){
			shopFunctionsF::setLastVisitedCategoryId($categoryId);
		}
		return $this;
	}
}
// pure php no closing tag
