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
jimport('joomla.application.component.controller');
if (!class_exists('ShopFunctions')) require(JPATH_VM_ADMINISTRATOR.DS.'helpers'.DS.'shopfunctions.php');

class VmController extends JControllerLegacy{

	protected $_cidName = 0;
	protected $_cname = 0;

	/**
	 * Sets automatically the shortcut for the language and the redirect path
	 *
	 * @author Max Milbers
	 */
	public function __construct($cidName='cid', $config=array()) {
		parent::__construct($config);

		 $this->_cidName = $cidName;

		$this->registerTask( 'add',  'edit' );
		$this->registerTask('apply','save');

		//VirtuemartController
		$this->_cname = strtolower(substr(get_class( $this ), 20));
		$this->mainLangKey = JText::_('COM_VIRTUEMART_'.strtoupper($this->_cname));
		$this->redirectPath = 'index.php?option=com_virtuemart&view='.$this->_cname;
		$task = explode ('.',VmRequest::getCmd( 'task'));
		if ($task[0] == 'toggle') {
			$val = (isset($task[2])) ? $task[2] : NULL;
			$this->toggle($task[1],$val);
		}

	}

	/**
	* Typical view method for MVC based architecture
	*
	* This function is provide as a default implementation, in most cases
	* you will need to override it in your own controllers.
	*
	* For the virtuemart core, we removed the "Get/Create the model"
	*
	* @param   boolean  $cachable   If true, the view output will be cached
	* @param   array    $urlparams  An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	*
	* @return  JController  A JController object to support chaining.
	* @since   11.1
	*/
	public function display($cachable = false, $urlparams = false)
	{
		$document	= JFactory::getDocument();
		$viewType	= $document->getType();
		if(JVM_VERSION > 1){
			$viewName	= VmRequest::getCmd('view', $this->default_view);
			$viewLayout	= VmRequest::getCmd('layout', 'default');

			$view = $this->getView($viewName, $viewType, '', array('base_path' => $this->basePath));
		} else {
			$viewName	= VmRequest::getCmd('view', '');
			$viewLayout	= VmRequest::getCmd('layout', 'default');

			$view = $this->getView($viewName, $viewType, '', array('base_path' => $this->_basePath));
		}

		// Set the layout
		$view->setLayout($viewLayout);

		$view->assignRef('document', $document);

		$conf = JFactory::getConfig();

		// Display the view
		if ($cachable && $viewType != 'feed' && $conf->get('caching') >= 1) {
			$option	= VmRequest::getCmd('option');
			$cache	= JFactory::getCache($option, 'view');

			if (is_array($urlparams)) {
				$app = JFactory::getApplication();

				$registeredurlparams = $app->get('registeredurlparams');

				if (empty($registeredurlparams)) {
					$registeredurlparams = new stdClass;
				}

				foreach ($urlparams as $key => $value)
				{
					// Add your safe url parameters with variable type as value {@see JFilterInput::clean()}.
					$registeredurlparams->$key = $value;
				}

				$app->set('registeredurlparams', $registeredurlparams);
			}

			$cache->get($view, 'display');

		}
		else {
			$view->display();
		}

		return $this;
	}


	/**
	 * Generic edit task
	 *
	 * @author Max Milbers
	 */
	function edit($layout='edit'){

		VmRequest::setVar('controller', $this->_cname);
		VmRequest::setVar('view', $this->_cname);
		VmRequest::setVar('layout', $layout);
// 		VmRequest::setVar('hidemenu', 1);

		if(empty($view)){
			$this->addViewPath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_virtuemart' . DS . 'views');
			$document = JFactory::getDocument();
			$viewType = $document->getType();
			$view = $this->getView($this->_cname, $viewType);
		}

		$view->setLayout($layout);

		$this->display();
	}

	/**
	 * Generic save task
	 *
	 * @author Max Milbers
	 * @param post $data sometimes we just want to override the data to process
	 */
	function save($data = 0){

		JSession::checkToken() or jexit( 'Invalid Token save' );

		if($data===0)$data = VmRequest::get('post');

		$model = VmModel::getModel($this->_cname);
		$id = $model->store($data);

		$errors = $model->getErrors();
		if(empty($errors)) {
			$msg = JText::sprintf('COM_VIRTUEMART_STRING_SAVED',$this->mainLangKey);
			$type = 'save';
		}
		else $type = 'error';
		foreach($errors as $error){
			$msg = ($error).'<br />';
		}

		$redir = $this->redirectPath;
		//vmInfo($msg);
		if(VmRequest::getCmd('task') == 'apply'){

			$redir .= '&task=edit&'.$this->_cidName.'[]='.$id;
		} //else $this->display();

		$this->setRedirect($redir, $msg,$type);
	}

	/**
	 * Generic remove task
	 *
	 * @author Max Milbers
	 */
	function remove(){

		JSession::checkToken() or jexit( 'Invalid Token remove' );

		$ids = VmRequest::getVar($this->_cidName, VmRequest::getVar('cid',array(),'', 'ARRAY'), '', 'ARRAY');
		jimport( 'joomla.utilities.arrayhelper' );
		JArrayHelper::toInteger($ids);

		if(count($ids) < 1) {
			$msg = JText::_('COM_VIRTUEMART_SELECT_ITEM_TO_DELETE');
			$type = 'notice';
		} else {
			$model = VmModel::getModel($this->_cname);
			$ret = $model->remove($ids);
			$errors = $model->getErrors();
			$msg = JText::sprintf('COM_VIRTUEMART_STRING_DELETED',$this->mainLangKey);
			if(!empty($errors) or $ret==false) {
				$msg = JText::sprintf('COM_VIRTUEMART_STRING_COULD_NOT_BE_DELETED',$this->mainLangKey);
						$type = 'error';
			}
			else $type = 'remove';
			foreach($errors as $error){
				$msg .= '<br />'.($error);
			}
		}

		$this->setRedirect($this->redirectPath, $msg,$type);

	}

	/**
	 * Generic cancel task
	 *
	 * @author Max Milbers
	 */
	public function cancel(){
		$msg = JText::sprintf('COM_VIRTUEMART_STRING_CANCELLED',$this->mainLangKey); //'COM_VIRTUEMART_OPERATION_CANCELED'
		$this->setRedirect($this->redirectPath, $msg,'cancel');
	}

	/**
	 * Handle the toggle task
	 *
	 * @author Max Milbers , Patrick Kohl
	 */

	public function toggle($field,$val=null){

		JSession::checkToken() or jexit( 'Invalid Token' );

		$model = VmModel::getModel($this->_cname);
		if (!$model->toggle($field,$val,$this->_cidName)) {
			$msg = JText::sprintf('COM_VIRTUEMART_STRING_TOGGLE_ERROR',$this->mainLangKey);
		} else{
			$msg = JText::sprintf('COM_VIRTUEMART_STRING_TOGGLE_SUCCESS',$this->mainLangKey);
		}

		$this->setRedirect( $this->redirectPath, $msg);
	}

	/**
	 * Handle the publish task
	 *
	 * @author Jseros, Max Milbers
	 */
	public function publish($cidname=0,$table=0,$redirect = 0){

		JSession::checkToken() or jexit( 'Invalid Token' );

		$model = VmModel::getModel($this->_cname);

		if($cidname === 0) $cidname = $this->_cidName;

		if (!$model->toggle('published', 1, $cidname, $table)) {
			$msg = JText::sprintf('COM_VIRTUEMART_STRING_PUBLISHED_ERROR',$this->mainLangKey);
		} else{
			$msg = JText::sprintf('COM_VIRTUEMART_STRING_PUBLISHED_SUCCESS',$this->mainLangKey);
		}

		if($redirect === 0) $redirect = $this->redirectPath;

		$this->setRedirect( $redirect , $msg);
	}


	/**
	 * Handle the publish task
	 *
	 * @author Max Milbers, Jseros
	 */
	function unpublish($cidname=0,$table=0,$redirect = 0){

		JSession::checkToken() or jexit( 'Invalid Token' );

		$model = VmModel::getModel($this->_cname);

		if($cidname === 0) $cidname = $this->_cidName;

		if (!$model->toggle('published', 0, $cidname, $table)) {
			$msg = JText::sprintf('COM_VIRTUEMART_STRING_UNPUBLISHED_ERROR',$this->mainLangKey);
		} else{
			$msg = JText::sprintf('COM_VIRTUEMART_STRING_UNPUBLISHED_SUCCESS',$this->mainLangKey);
		}

		if($redirect === 0) $redirect = $this->redirectPath;

		$this->setRedirect( $redirect, $msg);
	}

	function orderup() {

		JSession::checkToken() or jexit( 'Invalid Token' );

		$model = VmModel::getModel($this->_cname);
		$model->move(-1);
		$msg = JText::sprintf('COM_VIRTUEMART_STRING_ORDER_UP_SUCCESS',$this->mainLangKey);
		$this->setRedirect( $this->redirectPath, $msg);
	}

	function orderdown() {

		JSession::checkToken() or jexit( 'Invalid Token' );

		$model = VmModel::getModel($this->_cname);
		$model->move(1);
		$msg = JText::sprintf('COM_VIRTUEMART_STRING_ORDER_DOWN_SUCCESS',$this->mainLangKey);
		$this->setRedirect( $this->redirectPath, $msg);
	}

	function saveorder() {

		JSession::checkToken() or jexit( 'Invalid Token' );

		$cid 	= VmRequest::getVar( $this->_cidName, VmRequest::getVar('cid',array(0)), 'post', 'array' );
		$order 	= VmRequest::getVar( 'order', array(), 'post', 'array' );
		JArrayHelper::toInteger($cid);
		JArrayHelper::toInteger($order);

		$model = VmModel::getModel($this->_cname);
		if (!$model->saveorder($cid, $order)) $msg = 'error';
		else $msg = JText::sprintf('COM_VIRTUEMART_STRING_SAVE_ORDER_SUCCESS',$this->mainLangKey);
		$this->setRedirect( $this->redirectPath, $msg);
	}

	/**
	 * This function just overwrites the standard joomla function, using our standard class VmModel
	 * for this
	 * @see JController::getModel()
	 */
	function getModel($name = '', $prefix = '', $config = array()){
		if(!class_exists('ShopFunctions'))require(JPATH_VM_ADMINISTRATOR.DS.'helpers'.DS.'shopfunctions.php');

		if(empty($name)) $name = false;
		return VmModel::getModel($name);
	}

}