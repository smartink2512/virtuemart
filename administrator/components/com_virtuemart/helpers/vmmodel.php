<?php
/**
 * abstract model class containing some standards
 *  get,store,delete,publish and pagination
 *
 * @package	VirtueMart
 * @subpackage Helpers
 * @author Max Milbers
 * @copyright Copyright (c) 2011 - 2014 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
 *
 * http://virtuemart.net
 */

defined('_JEXEC') or die();

define('USE_SQL_CALC_FOUND_ROWS' , true);

if(!class_exists('vModel')) require(VMPATH_ADMIN .DS. 'vmf' .DS. 'vmodel.php');

class VmModel extends vModel{

	//Ensures our model has its own cache
	protected $_cache = array();
	/**
	 *
	 * @author Max Milbers
	 */
	static function getModel($name=false){

		if (!$name){
			$name = vRequest::getCmd('view','');
		}
		$name = strtolower($name);
		self::addIncludePath(VMPATH_ADMIN.DS.'models','VirtueMartModel');
		$conf = array();
		return self::getInstance($name,'VirtueMartModel',$conf,true);
	}
}