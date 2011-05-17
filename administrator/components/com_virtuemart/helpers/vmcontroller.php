<?php
/**
 * abstract controller class containing get,store,delete,publish and pagination
 *
 *
 * This class provides the functions for the calculatoins
 *
 * @package	VirtueMart
 * @subpackage Helpers
 * @author Max Milbers
 * @copyright Copyright (c) 2011 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
 *
 * http://virtuemart.net
 */

class VmController extends JController{

	protected $_cidName;

	/**
	 * Sets automatically the shortcut for the language and the redirect path
	 *
	 * @author Max Milbers
	 */
	public function __construct($cidName='cid') {
		parent::__construct();

		 $this->_cidName = $cidName;

		$this->registerTask( 'add',  'edit' );
		$this->registerTask('apply','save');

		//VirtuemartController
		$this->name = strtolower(substr(get_class( $this ), 20));
		$this->mainLangKey = jText::_('COM_VIRTUEMART_CONTROLLER_'.$this->name);
		$this->redirectPath = 'index.php?option=com_virtuemart&view='.$this->name;

	}

	function save()
	{
		$model =& $this->getModel($this->name);

		$data = JRequest::get('post');
		if (($_id = $model->store($data)) === false) {
			$msg = JText::_($model->getError());
		} else {
			$msg = JText::sprintf('COM_VIRTUEMART_STRING_SAVED',$this->mainLangKey);
		}

		$redir = $this->redirectPath;
		if(JRequest::getCmd('task') == 'apply'){
			$redir .= '&task=edit&'.$this->_cidName.'[]='.$_id;
		}

		$this->setRedirect($redir, $msg);
	}

	/**
	 * Handle the remove task
	 *
	 * @author Max Milbers
	 */
	function remove(){
		$data = JRequest::get( 'post' );
		$model = $this->getModel($this->name);
		if (!$model->delete()) {
			$msg = JText::sprintf('COM_VIRTUEMART_STRING_COULD_NOT_BE_DELETED',$this->mainLangKey);
		} else {
			$msg = JText::sprintf('COM_VIRTUEMART_STRING_DELETED',$this->mainLangKey);
		}
		$this->setRedirect($this->redirectPath, $msg);
//		$pname = $model->getIdName();
//		$this->setRedirect( $this->redirectPath.'&'.$pname.'='.$data[$pname], $msg);
	}

	/**
	 * Handle the cancel task
	 *
	 * @author Max Milbers
	 */
	public function cancel(){
		$msg = JText::sprintf(COM_VIRTUEMART_STRING_CANCELLED,$this->mainLangKey); //'COM_VIRTUEMART_OPERATION_CANCELED'
		$this->setRedirect($this->redirectPath, $msg);
	}

	/**
	 * Handle the publish task
	 *
	 * @author Jseros, Max Milbers
	 */
	public function publish(){
		// Check token
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$model = $this->getModel($this->name);
		if (!$model->publish(true)) {
			$msg = JText::sprintf('COM_VIRTUEMART_STRING_PUBLISHED_ERROR',$this->mainLangKey);
		} else{
			$msg = JText::sprintf('COM_VIRTUEMART_STRING_PUBLISHED_SUCCESS',$this->mainLangKey);
		}

		$this->setRedirect( $this->redirectPath, $msg);
	}


	/**
	 * Handle the publish task
	 *
	 * @author Max Milbers, Jseros
	 */
	function unpublish(){
		// Check token
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$model = $this->getModel($this->name);
		if (!$model->publish(false)) {
			$msg = JText::sprintf('COM_VIRTUEMART_STRING_UNPUBLISHED_ERROR',$this->mainLangKey);
		} else{
			$msg = JText::sprintf('COM_VIRTUEMART_STRING_UNPUBLISHED_SUCCESS',$this->mainLangKey);
		}

		$this->setRedirect( $this->redirectPath, $msg);
	}

}