<?php
/**
 * Configuration helper class
 *
 * This class provides some functions that are used throughout the VirtueMart shop to access confgiuration values.
 *
 * @package	VirtueMart
 * @subpackage Helpers
 * @author Max Milbers
 * @copyright Copyright (c) 2004-2008 Soeren Eberhardt-Biermann, 2009-2013 VirtueMart Team. All rights reserved.
 */
defined('_JEXEC') or die('Restricted access');

/**
 *
 * We need this extra paths to have always the correct path undependent by loaded application, module or plugin
 * Plugin, module developers must always include this config at start of their application
 *   $vmConfig = VmConfig::loadConfig(); // load the config and create an instance
 *  $vmConfig -> jQuery(); // for use of jQuery
 *  Then always use the defined paths below to ensure future stability
 */
defined('DS') or define('DS', DIRECTORY_SEPARATOR);
define( 'JPATH_VM_SITE', JPATH_ROOT.DS.'components'.DS.'com_virtuemart' );
defined('JPATH_VM_ADMINISTRATOR') or define('JPATH_VM_ADMINISTRATOR', JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_virtuemart');
// define( 'JPATH_VM_ADMINISTRATOR', JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_virtuemart' );
define( 'JPATH_VM_PLUGINS', JPATH_VM_ADMINISTRATOR.DS.'plugins' );
define( 'JPATH_VM_MODULES', JPATH_ROOT.DS.'modules' );

if(version_compare(JVERSION,'3.0.0','ge')) {
	defined('JVM_VERSION') or define ('JVM_VERSION', 3);
}
if(version_compare(JVERSION,'1.7.0','ge')) {
	defined('JPATH_VM_LIBRARIES') or define ('JPATH_VM_LIBRARIES', JPATH_PLATFORM);
	defined('JVM_VERSION') or define ('JVM_VERSION', 2);
}
else {
	if (version_compare (JVERSION, '1.6.0', 'ge')) {
		defined ('JPATH_VM_LIBRARIES') or define ('JPATH_VM_LIBRARIES', JPATH_LIBRARIES);
		defined ('JVM_VERSION') or define ('JVM_VERSION', 2);
	}
	else {
		defined ('JPATH_VM_LIBRARIES') or define ('JPATH_VM_LIBRARIES', JPATH_LIBRARIES);
		defined ('JVM_VERSION') or define ('JVM_VERSION', 1);
	}
}

//This number is for obstruction, similar to the prefix jos_ of joomla it should be avoided
//to use the standard 7, choose something else between 1 and 99, it is added to the ordernumber as counter
// and must not be lowered.
defined('VM_ORDER_OFFSET') or define('VM_ORDER_OFFSET',3);

require(JPATH_VM_ADMINISTRATOR.DS.'version.php');

if(!class_exists('JTable')){
	require(JPATH_VM_LIBRARIES.DS.'joomla'.DS.'database'.DS.'table.php');
}
JTable::addIncludePath(JPATH_VM_ADMINISTRATOR.DS.'tables');

if (!class_exists ('VmModel')) {
	require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'vmmodel.php');
}

if(!class_exists('vRequest')) require(JPATH_VM_ADMINISTRATOR.DS.'helpers'.DS.'vrequest.php');
if(!class_exists('vmText')) require(JPATH_VM_ADMINISTRATOR.DS.'helpers'.DS.'vmtext.php');
if(!class_exists('vmJsApi')) require(JPATH_VM_ADMINISTRATOR.DS.'helpers'.DS.'vmjsapi.php');
/**
 * Where type can be one of
 * 'warning' - yellow
 * 'notice' - blue
 * 'error' - red
 * 'message' (or empty) - green
 * This function shows an info message, the messages gets translated with vmText::,
 * you can overload the function, so that automatically sprintf is taken, when needed.
 * So this works vmInfo('COM_VIRTUEMART_MEDIA_NO_PATH_TYPE',$type,$link )
 * and also vmInfo('COM_VIRTUEMART_MEDIA_NO_PATH_TYPE');
 *
 * @author Max Milbers
 * @param string $publicdescr
 * @param string $value
 */

function vmInfo($publicdescr,$value=NULL){

	$app = JFactory::getApplication();

	$msg = '';
	$type = 'notice';//'info';
	if(VmConfig::$maxMessageCount<VmConfig::$maxMessage){
		$lang = JFactory::getLanguage();
		if($value!==NULL){

			$args = func_get_args();
			if (count($args) > 0) {
				$args[0] = $lang->_($args[0]);
				$msg = call_user_func_array('sprintf', $args);
			}
		}	else {
			// 		$app ->enqueueMessage('Info: '.vmText::_($publicdescr));
			//$publicdescr = $lang->_($publicdescr);
			$msg = vmText::_($publicdescr);
			// 		debug_print_backtrace();
		}
	}
	else {
		if (VmConfig::$maxMessageCount == VmConfig::$maxMessage) {
			$msg = 'Max messages reached';
			$type = 'warning';
		} else {
			return false;
		}
	}

	if(!empty($msg)){
		VmConfig::$maxMessageCount++;
		$app ->enqueueMessage($msg,$type);
	} else {
		vmTrace('vmInfo Message empty '.$msg);
	}

	return $msg;
}

/**
 * Informations for the vendors or the administrators of the store, but not for developers like vmdebug
 * @param      $publicdescr
 * @param null $value
 */
function vmAdminInfo($publicdescr,$value=NULL){

	if(VmConfig::$echoAdmin){

		$app = JFactory::getApplication();

		if(VmConfig::$maxMessageCount<VmConfig::$maxMessage){
			$lang = JFactory::getLanguage();
			if($value!==NULL){

				$args = func_get_args();
				if (count($args) > 0) {
					$args[0] = $lang->_($args[0]);
					VmConfig::$maxMessageCount++;
					$app ->enqueueMessage(call_user_func_array('sprintf', $args),'info');
				}
			}	else {
				VmConfig::$maxMessageCount++;
				// 		$app ->enqueueMessage('Info: '.vmText::_($publicdescr));
				$publicdescr = $lang->_($publicdescr);
				$app ->enqueueMessage('Info: '.vmText::_($publicdescr),'info');
				// 		debug_print_backtrace();
			}
		}
		else {
			if (VmConfig::$maxMessageCount == VmConfig::$maxMessage) {
				$app->enqueueMessage ('Max messages reached', 'info');
			}else {
				return false;
			}
		}
	}

}

function vmWarn($publicdescr,$value=NULL){


	$app = JFactory::getApplication();
	$msg = '';
	if(VmConfig::$maxMessageCount<VmConfig::$maxMessage){
		$lang = JFactory::getLanguage();
		if($value!==NULL){

			$args = func_get_args();
			if (count($args) > 0) {
				$args[0] = $lang->_($args[0]);
				$msg = call_user_func_array('sprintf', $args);

			}
		}	else {
			// 		$app ->enqueueMessage('Info: '.vmText::_($publicdescr));
			$msg = $lang->_($publicdescr);
			//$app ->enqueueMessage('Info: '.$publicdescr,'warning');
			// 		debug_print_backtrace();
		}
	}
	else {
		if (VmConfig::$maxMessageCount == VmConfig::$maxMessage) {
			$msg = 'Max messages reached';
		} else {
			return false;
		}
	}

	if(!empty($msg)){
		VmConfig::$maxMessageCount++;
		$app ->enqueueMessage($msg,'warning');
		return $msg;
	} else {
		vmTrace('vmWarn Message empty');
		return false;
	}

}

/**
 * Shows an error message, sensible information should be only in the first one, the second one is for non BE users
 * @author Max Milbers
 */
function vmError($descr,$publicdescr=''){

	$msg = '';
	$lang = JFactory::getLanguage();
	$descr = $lang->_($descr);
	$adminmsg =  'vmError: '.$descr;
	if (empty($descr)) {
		vmTrace ('vmError message empty');
		return;
	}
	logInfo($adminmsg,'error');
	if(VmConfig::$maxMessageCount< (VmConfig::$maxMessage+5)){

		if(VmConfig::$echoAdmin){
			$msg = $adminmsg;
		} else {
			if(!empty($publicdescr)){
				$msg = $lang->_($publicdescr);
			}
		}
	}
	else {
		if (VmConfig::$maxMessageCount == (VmConfig::$maxMessage+5)) {
			$msg = 'Max messages reached';
		} else {
			return false;
		}
	}

	if(!empty($msg)){
		VmConfig::$maxMessageCount++;
		$app = JFactory::getApplication();
		$app ->enqueueMessage($msg,'error');
		return $msg;
	}

	return $msg;

}

/**
 * A debug dumper for VM, it is only shown to backend users.
 *
 * @author Max Milbers
 * @param unknown_type $descr
 * @param unknown_type $values
 */
function vmdebug($debugdescr,$debugvalues=NULL){

	if(VMConfig::showDebug()  ){


		$app = JFactory::getApplication();

		if(VmConfig::$maxMessageCount<VmConfig::$maxMessage){
			if($debugvalues!==NULL){
				// 			$debugdescr .=' <pre>'.print_r($debugvalues,1).'<br />'.print_r(get_class_methods($debugvalues),1).'</pre>';

				$args = func_get_args();
				if (count($args) > 1) {
					// 				foreach($args as $debugvalue){
					for($i=1;$i<count($args);$i++){
						if(isset($args[$i])){
							$debugdescr .=' Var'.$i.': <pre>'.print_r($args[$i],1).'<br />'.print_r(get_class_methods($args[$i]),1).'</pre>';
						}
					}

				}
			}

			if(VmConfig::$echoDebug){
				VmConfig::$maxMessageCount++;
				echo $debugdescr;
			} else if(VmConfig::$logDebug){
				logInfo($debugdescr,'vmdebug');
			}else {
				VmConfig::$maxMessageCount++;
				$app = JFactory::getApplication();
				$app ->enqueueMessage('<span class="vmdebug" >vmdebug '.$debugdescr.'</span>');
			}

		}
		else {
			if (VmConfig::$maxMessageCount == VmConfig::$maxMessage) {
				$app->enqueueMessage ('Max messages reached', 'info');
			}
		}

	}

}

function vmTrace($notice,$force=FALSE){

	if($force || (VMConfig::showDebug() ) ){
		//$app = JFactory::getApplication();
		//
		ob_start();
		echo '<pre>';
		debug_print_backtrace();
		echo '</pre>';
		$body = ob_get_contents();
		ob_end_clean();
		if(VmConfig::$echoDebug){
			echo $notice.' <pre>'.$body.'</pre>';
		} else if(VmConfig::$logDebug){
			logInfo($body,$notice);
		} else {
			$app = JFactory::getApplication();
			$app ->enqueueMessage($notice.' '.$body.' ');
		}

	}

}

function vmRam($notice,$value=NULL){
	vmdebug($notice.' used Ram '.round(memory_get_usage(TRUE)/(1024*1024),2).'M ',$value);
}

function vmRamPeak($notice,$value=NULL){
	vmdebug($notice.' memory peak '.round(memory_get_peak_usage(TRUE)/(1024*1024),2).'M ',$value);
}


function vmSetStartTime($name='current'){

	VmConfig::$_starttime[$name] = microtime(TRUE);

}

function vmTime($descr,$name='current'){

	if (empty($descr)) {
		$descr = $name;
	}
	$starttime = VmConfig::$_starttime ;
	if(empty($starttime[$name])){
		vmdebug('vmTime: '.$descr.' starting '.microtime(TRUE));
		VmConfig::$_starttime[$name] = microtime(TRUE);
	}
	else {
		if ($name == 'current') {
			vmdebug ('vmTime: ' . $descr . ' time consumed ' . (microtime (TRUE) - $starttime[$name]));
			VmConfig::$_starttime[$name] = microtime (TRUE);
		}
		else {
			if (empty($descr)) {
				$descr = $name;
			}
			$tmp = 'vmTime: ' . $descr . ': ' . (microtime (TRUE) - $starttime[$name]);
			vmdebug ($tmp);
		}
		}


	}

/**
 * logInfo
 * to help debugging Payment notification for example
 */
function logInfo ($text, $type = 'message') {

	if(!class_exists('JFile')) require(JPATH_VM_LIBRARIES.DS.'joomla'.DS.'filesystem'.DS.'file.php');

	$config = JFactory::getConfig();
	$log_path = $config->get('log_path', JPATH_ROOT . "/log" );
	$file = $log_path . "/" . VmConfig::$logFileName . VmConfig::LOGFILEEXT;

	if (!is_dir($log_path)) {
		jimport('joomla.filesystem.folder');
		if (!JFolder::create($log_path)) {
			if (VmConfig::$echoAdmin){
				$msg = 'Could not create path ' . $log_path . ' to store log information. Check your folder ' . $log_path . ' permissions.';
				$app = JFactory::getApplication();
				$app->enqueueMessage($msg, 'error');
			}
			return;
		}
	}
	if (!is_writable($log_path)) {
		if (VmConfig::$echoAdmin){
			$msg = 'Path ' . $log_path . ' to store log information is not writable. Check your folder ' . $log_path . ' permissions.';
			$app = JFactory::getApplication();
			$app->enqueueMessage($msg, 'error');
		}
		return;
	}
	$head = false;
	if (!JFile::exists($file)) {
		// blank line to prevent information disclose: https://bugs.php.net/bug.php?id=60677
		// from Joomla log file
		$head = "#\n";
		$head .= '#<?php die("Forbidden."); ?>'."\n";

	}

	// Initialise variables.
	if(!class_exists('JClientHelper')) require(JPATH_VM_LIBRARIES.DS.'joomla'.DS.'client'.DS.'helper.php');
	$FTPOptions = JClientHelper::getCredentials('ftp');

	if ($FTPOptions['enabled'] == 0){
		static $fp;

		$fp = fopen ($file, 'a');

		if ($fp) {
			if ($head) {
				fwrite ($fp,  $head);
			}

			fwrite ($fp, "\n" . JFactory::getDate()->format ('%Y-%m-%d %H:%M:%S'));
			fwrite ($fp,  " ".strtoupper($type) . ' ' . $text);
			fclose ($fp);
		} else {
			if (VmConfig::$echoAdmin){
				$msg = 'Could not write in file  ' . $file . ' to store log information. Check your file ' . $file . ' permissions.';
				$app = JFactory::getApplication();
				$app->enqueueMessage($msg, 'error');
			}
		}
	} else {
		//For logging we do not support FTP. For loggin without file permissions using FTP, we need to load the file,..
		//append the text and replace the file. This cannot be fast per FTP and therefore we disable it.
	}

	return;

}

/**
* The time how long the config in the session is valid.
* While configuring the store, you should lower the time to 10 seconds.
* Later in a big store it maybe useful to rise this time up to 1 hr.
* That would mean that changing something in the config can take up to 1 hour until this change is effecting the shoppers.
*/

/**
 * We use this Class STATIC not dynamically !
 */
class VmConfig {

	// instance of class
	private static $_jpConfig = NULL;
	private static $_debug = NULL;
	public static $_starttime = array();
	public static $loaded = FALSE;

	public static $maxMessageCount = 0;
	public static $maxMessage = 100;
	public static $echoDebug = FALSE;
	public static $logDebug = FALSE;
	public static $logFileName = 'com_virtuemart';
	public static $echoAdmin = FALSE;
	const LOGFILEEXT = '.log.php';

	public static $_virtuemart_vendor_id = null;
	public static $vmlang = false;
	public static $vmlangTag = '';
	public static $langs = array();
	public static $langCount = 0;
	var $_params = array();
	var $_raw = array();
	public static $installed = false;


	private function __construct() {

		if(function_exists('mb_ereg_replace')){
			mb_regex_encoding('UTF-8');
			mb_internal_encoding('UTF-8');
		}
		self::echoAdmin();
		ini_set('precision', 15);	//We need at least 20 for correct precision if json is using a bigInt ids
		//But 15 has the best precision, using higher precision adds fantasy numbers to the end, but creates also errors in rounding
		ini_set('serialize_precision',16);
	}

	static function getStartTime(){
		return self::$_starttime;
	}

	static function setStartTime($name,$value){
		self::$_starttime[$name] = $value;
	}

	static function echoAdmin(){

		if(self::$echoAdmin===FALSE){
			$user = JFactory::getUser();
			if($user->authorise('core.admin','com_virtuemart') or $user->authorise('core.manage','com_virtuemart')){
				self::$echoAdmin = true;
			} else {
				self::$echoAdmin = false;
			}
		}

	}

	static function showDebug(){

		if(self::$_debug===NULL){
			$debug = VmConfig::get('debug_enable','none');
			//$debug = 'all';	//this is only needed, when you want to debug THIS file
			// 1 show debug only to admins
			if($debug === 'admin' ){
				if(VmConfig::$echoAdmin){
					self::$_debug = TRUE;
				} else {
					self::$_debug = FALSE;
				}
			}
			// 2 show debug to anyone
			else {
				if ($debug === 'all') {
					self::$_debug = TRUE;
				}
				// else dont show debug
				else {
					self::$_debug = FALSE;
				}
			}
		}

		if(self::$_debug){
			ini_set('display_errors', '1');
		} else {
			ini_set('display_errors', '0');
			if(version_compare(phpversion(),'5.4.0','<' )){
				error_reporting( E_ALL & ~E_STRICT );
			} else {
				error_reporting( E_ALL ^ E_STRICT );
			}
		}

		return self::$_debug;
	}

/**
	 * Ensures a certain Memory limit for php (if server supports it)
	 * @author Max Milbers
	 * @param int $minMemory
	 */
	static function ensureMemoryLimit($minMemory=0){

		if($minMemory === 0) $minMemory = VmConfig::get('minMemory','128M');
		$memory_limit = VmConfig::getMemoryLimit();

		if($memory_limit<$minMemory)  @ini_set( 'memory_limit', $minMemory.'M' );
	}

	/**
	 * Returns the PHP memory limit of the server in MB, regardless the used unit
	 * @author Max Milbers
	 * @return float|int PHP memory limit in MB
	 */
	static function getMemoryLimit(){

		$iniValue = ini_get('memory_limit');

		if($iniValue<=0) return 2048;	//We assume 2048MB as unlimited setting
		$iniValue = strtoupper($iniValue);
		if(strpos($iniValue,'M')!==FALSE){
			$memory_limit = (int) substr($iniValue,0,-1);
		} else if(strpos($iniValue,'K')!==FALSE){
			$memory_limit = (int) substr($iniValue,0,-1) / 1024.0;
		} else if(strpos($iniValue,'G')!==FALSE){
			$memory_limit = (int) substr($iniValue,0,-1) * 1024.0;
		} else {
			$memory_limit = (int) $iniValue / 1048576.0;
		}
		return $memory_limit;
	}

	static function ensureExecutionTime($minTime=0){

		if($minTime === 0) $minTime = (int) VmConfig::get('minTime',120);
		$max_execution_time = self::getExecutionTime();
		if((int)$max_execution_time<$minTime) {
			@ini_set( 'max_execution_time', $minTime );
		}
	}

	static function getExecutionTime(){
		$max_execution_time = (int) ini_get('max_execution_time');
		if(empty($max_execution_time)){
			$max_execution_time = (int) VmConfig::get('minTime',120);
		}
		return $max_execution_time;
	}

	/**
	 * loads a language file, the trick for us is that always the config option enableEnglish is tested
	 * and the path are already set and the correct order is used
	 * We use first the english language, then the default
	 *
	 * @author Max Milbers
	 * @static
	 * @param $name
	 * @return bool
	 */
	static public function loadJLang($name,$site=false){

		$jlang =JFactory::getLanguage();
		$tag = $jlang->getTag();

		$path = $basePath = JPATH_VM_ADMINISTRATOR;
		if($site){
			$path = $basePath = JPATH_VM_SITE;
		}

		if(VmConfig::get('enableEnglish', true) and $tag!='en-GB'){
			$testpath = $basePath.DS.'language'.DS.'en-GB'.DS.'en-GB.'.$name.'.ini';
			if(!file_exists($testpath)){
				$path = JPATH_ADMINISTRATOR;
				if($site){
					$path = JPATH_SITE;
				}
			}
			$jlang->load($name, $path, 'en-GB');
		}

		$testpath = $basePath.DS.'language'.DS.$tag.DS.$tag.'.'.$name.'.ini';
		if(!file_exists($testpath)){
			$path = JPATH_ADMINISTRATOR;
			if($site){
				$path = JPATH_SITE;
			}
		}

		$jlang->load($name, $path,$tag,true);

		return $jlang;
	}

	/**
	 * @static
	 * @author Valerie Isaksen
	 * @param $name
	 */
	static public function loadModJLang($name){

		$jlang =JFactory::getLanguage();
		$tag = $jlang->getTag();

		$path = $basePath = JPATH_VM_MODULES.DS.$name;

		if(VmConfig::get('enableEnglish', true) and $tag!='en-GB'){
			$testpath = $basePath.DS.'language'.DS.'en-GB'.DS.'en-GB.'.$name.'.ini';
			if(!file_exists($testpath)){
				$path = JPATH_ADMINISTRATOR;
			}
			$jlang->load($name, $path, 'en-GB');
		}

		$testpath = $basePath.DS.'language'.DS.$tag.DS.$tag.'.'.$name.'.ini';
		if(!file_exists($testpath)){
			$path = JPATH_ADMINISTRATOR;
		}

		$jlang->load($name, $path,$tag,true);

		return $jlang;
	}


	/**
	 * Loads the configuration and works as singleton therefore called static. The call using the program cache
	 * is 10 times faster then taking from the session. The session is still approx. 30 times faster then using the file.
	 * The db is 10 times slower then the session.
	 *
	 * Performance:
	 *
	 * Fastest is
	 * Program Cache: 1.5974044799805E-5
	 * Session Cache: 0.00016094612121582
	 *
	 * First config db load: 0.00052118301391602
	 * Parsed and in session: 0.001554012298584
	 *
	 * After install from file: 0.0040450096130371
	 * Parsed and in session: 0.0051419734954834
	 *
	 *
	 * Functions tests if already loaded in program cache, session cache, database and at last the file.
	 *
	 * Load the configuration values from the database into a session variable.
	 * This step is done to prevent accessing the database for every configuration variable lookup.
	 *
	 * @author Max Milbers
	 * @param $force boolean Forces the function to load the config from the db
	 */
	static public function loadConfig($force = FALSE,$fresh = FALSE) {

		if($fresh){
			self::$_jpConfig = new VmConfig();
			return self::$_jpConfig;
		}
		vmSetStartTime('loadConfig');
		if(!$force){
			if(!empty(self::$_jpConfig) && !empty(self::$_jpConfig->_params)){
				//vmTime('time to load config','loadConfig');
				return self::$_jpConfig;
			}
		}

		self::$_jpConfig = new VmConfig();

		if(!class_exists('VirtueMartModelConfig')) require(JPATH_VM_ADMINISTRATOR .'/models/config.php');
		$configTable  = VirtueMartModelConfig::checkConfigTableExists();

		$app = JFactory::getApplication();
		$db = JFactory::getDBO();

		self::$installed = true;
		$install = vRequest::getInt('install',false);
		$redirected = vRequest::getInt('redirected',false);
		$link='';

		if(empty($configTable) ){
			self::$installed = false;
			$jlang =JFactory::getLanguage();
			$selectedLang = $jlang->getTag();

			if(empty($selectedLang)){
				$selectedLang = $jlang->setLanguage($selectedLang);
			}

			$q = 'SELECT `element` FROM `#__extensions` WHERE type = "language" and enabled = "1"';
			$db->setQuery($q);
			$knownLangs = $db->loadColumn();
			//vmdebug('Selected language '.$selectedLang.' $knownLangs ',$knownLangs);
			if($app->isAdmin() and !in_array($selectedLang,$knownLangs)){
				$link = 'index.php?option=com_installer&view=languages';
				$msg = 'Install your selected language <b>'.$selectedLang.'</b> first in <a href="'.$link.'">joomla language manager</a>, just select then the component VirtueMart under menu "component", to proceed with the installation ';
				$app->enqueueMessage($msg);
			}

			self::$installed = VirtueMartModelConfig::checkVirtuemartInstalled();
			if(!self::$installed){
				if(!$redirected and !$install){
					$link = 'index.php?option=com_virtuemart&view=updatesmigration&redirected=1';
					$msg = '';
					if($app->isSite()){
						$link = JURI::root(true).'/administrator/'.$link;
					} else {
						$msg = 'Install Virtuemart first, click on the menu component and select VirtueMart';
					}
				}
			}
		} else {
			$query = ' SELECT `config` FROM `#__virtuemart_configs` WHERE `virtuemart_config_id` = "1";';
			$db->setQuery($query);
			self::$_jpConfig->_raw = $db->loadResult();
			//vmTime('time to load config','loadConfig');
		}

		if(empty(self::$_jpConfig->_raw)){
			$_value = VirtueMartModelConfig::readConfigFile();
			if (!$_value) {
				vmError('Serious error, config file could not be filled with data');
				return FALSE;
			}
			$_value = join('|', $_value);
			self::$_jpConfig->_raw = $_value;
			self::$_jpConfig->setParams(self::$_jpConfig->_raw);

			self::$_jpConfig->storeConfig();
		} else {
			self::$_jpConfig->setParams(self::$_jpConfig->_raw);
		}

		self::$_jpConfig->_params['sctime'] = microtime(TRUE);
		self::$_jpConfig->_params['vmlang'] = self::setdbLanguageTag();

		vmTime('time to load config','loadConfig');
		if(!self::$installed){
			$user = JFactory::getUser();
			if($user->authorise('core.admin','com_virtuemart') and ($install or $redirected)){
				VmConfig::$_jpConfig->set('dangeroustools',1);
			}
			if(!empty($link)) $app->redirect($link,$msg);
		}

		return self::$_jpConfig;
	}

	static public function storeConfig(){

		$user = JFactory::getUser();
		if($user->authorise('core.admin','com_virtuemart')){
			$installed = VirtueMartModelConfig::checkVirtuemartInstalled();
			if($installed){

				VirtueMartModelConfig::installVMconfigTable();

				$confData = array();
				$confData['virtuemart_config_id'] = 1;

				$confData['config'] = VmConfig::$_jpConfig->toString();
				$confTable = JTable::getInstance('configs', 'Table', array());

				if (!$confTable->bindChecknStore($confData)) {
					vmError($confTable->getError());
				}
			} else {
				self::$_virtuemart_vendor_id = 1;
			}
		}
	}

	 /*
	 * Set defaut language tag for translatable table
	 *
	 * @author Max Milbers
	 * @return string valid langtag
	 */
	static public function setdbLanguageTag() {

		if (self::$vmlang) {
			return self::$vmlang;
		}

		$langs = (array)self::get('active_languages',array());
		self::$langCount = count($langs);
		$siteLang = vRequest::getString('vmlang',false );

		$params = JComponentHelper::getParams('com_languages');
		$defaultLang = $params->get('site', 'en-GB');//use default joomla

		if( JFactory::getApplication()->isSite()){
			if (!$siteLang) {
				jimport('joomla.language.helper');
				$siteLang = JFactory::getLanguage()->getTag();
				vmdebug('My selected language by JFactory::getLanguage()->getTag() '.$siteLang);
			}
		} else {
			if(!$siteLang){
				$siteLang = $defaultLang;
			}
		}

		if(!in_array($siteLang, $langs)) {
			if(count($langs)===0){
				$siteLang = $defaultLang;
			} else {
				$siteLang = $langs[0];
			}
		}
		self::$vmlangTag = $siteLang;
		self::$vmlang = strtolower(strtr($siteLang,'-','_'));
		vmdebug('$siteLang: '.$siteLang.' self::$_jpConfig->lang '.self::$vmlang);
		defined('VMLANG') or define('VMLANG', self::$vmlang );

		return self::$vmlang;
	}

	/**
	 * Find the configuration value for a given key
	 *
	 * @author Max Milbers
	 * @param string $key Key name to lookup
	 * @return Value for the given key name
	 */
	static function get($key, $default='',$allow_load=FALSE)
	{

		$value = '';
		if ($key) {

			if (empty(self::$_jpConfig->_params) && $allow_load) {
				self::loadConfig();
			}

			if (!empty(self::$_jpConfig->_params)) {
				if(array_key_exists($key,self::$_jpConfig->_params) && isset(self::$_jpConfig->_params[$key])){
					$value = self::$_jpConfig->_params[$key];
				} else {
					$value = $default;
				}

			} else {
				$value = $default;
			}

		} else {
			$app = JFactory::getApplication();
			$app -> enqueueMessage('VmConfig get, empty key given');
		}

		return $value;
	}

	static function set($key, $value){

		if (empty(self::$_jpConfig->_params)) {
			self::loadConfig();
		}

		if($admin = JFactory::getUser()->authorise('core.admin', 'com_virtuemart')){
			if (!empty(self::$_jpConfig->_params)) {
				self::$_jpConfig->_params[$key] = $value;
			}
		}

	}

	/**
	 * For setting params, needs assoc array
	 * @author Max Milbers
	 */
	function setParams($params){

		$config = explode('|', $params);
		$app = JFactory::getApplication();
		foreach($config as $item){
			$item = explode('=',$item);
			if(!empty($item[1])){
				// if($item[0]!=='offline_message' && $item[0]!=='dateformat' ){
				if($item[0]!=='offline_message' ){
					try {
						$value = @unserialize($item[1] );

						if($value===FALSE){
							$app ->enqueueMessage('Exception in loadConfig for unserialize '.$item[0]. ' '.$item[1]);
							//$uri = JFactory::getURI();
							$configlink = JURI::root() . 'administrator/index.php?option=com_virtuemart&view=config';
							$app ->enqueueMessage('To avoid this message, enter your virtuemart <a href="'.$configlink.'">config</a> and just save it one time');
						} else {
							$pair[$item[0]] = $value;
						}
					}catch (Exception $e) {
						vmdebug('Exception in loadConfig for unserialize '. $e->getMessage(),$item);
					}
				} else {
					$pair[$item[0]] = unserialize(base64_decode($item[1]) );
				}

			} else {
				$pair[$item[0]] ='';
			}

		}

		self::$_jpConfig->_params = $pair;

	}


	/**
	 * Writes the params as string and escape them before
	 * @author Max Milbers
	 */
	function toString(){
		$raw = '';

		foreach(self::$_jpConfig->_params as $paramkey => $value){

			//Texts get broken, when serialized, therefore we do a simple encoding,
			//btw we need serialize for storing arrays   note by Max Milbers
//			if($paramkey!=='offline_message' && $paramkey!=='dateformat'){
			if($paramkey!=='offline_message'){
				$raw .= $paramkey.'='.serialize($value).'|';
			} else {
				$raw .= $paramkey.'='.base64_encode(serialize($value)).'|';
			}
		}
		self::$_jpConfig->_raw = substr($raw,0,-1);
		return self::$_jpConfig->_raw;
	}

	/**
	 * Find the currenlty installed version
	 *
	 * @author RickG
	 * @param boolean $includeDevStatus True to include the development status
	 * @return String of the currently installed version
	 */
	static function getInstalledVersion($includeDevStatus=FALSE)
	{
		// Get the installed version from the wmVersion class.

		return vmVersion::$RELEASE;
	}

	/**
	 * Return if the used joomla function is j15
	 * @deprecated use JVM_VERSION instead
	 */
	function isJ15(){
		return (strpos(JVERSION,'1.5') === 0);
	}

	/**
	 * Checks if user is admin or has vendorId=1,
	 * if superadmin, but not a vendor it gives back vendorId=1 (single vendor, but multiuser administrated)
	 *
	 * @author Mattheo Vicini
	 * @author Max Milbers
	 */
	static public function isSuperVendor(){

		if(self::$_virtuemart_vendor_id===null){
			$user = JFactory::getUser();

			if(!empty( $user->id)){
				$q='SELECT `virtuemart_vendor_id` FROM `#__virtuemart_vmusers` `au`
				WHERE `au`.`virtuemart_user_id`="' .$user->id.'" AND `au`.`user_is_vendor` = "1" ';

				$db= JFactory::getDbo();
				$db->setQuery($q);
				$virtuemart_vendor_id = $db->loadResult();

				if ($virtuemart_vendor_id) {
					self::$_virtuemart_vendor_id = $virtuemart_vendor_id;
				} else {
					if($user->authorise('core.admin', 'com_virtuemart') or (self::get('multix','none')=='none' and $user->authorise('core.manage', 'com_virtuemart') ) ){
						self::$_virtuemart_vendor_id = 1;
					}
				}
			} else {
				self::$_virtuemart_vendor_id = 0;
			}

		}
		return self::$_virtuemart_vendor_id;

	}

}


class vmURI{

	static function getCleanUrl ($JURIInstance = 0,$parts = array('scheme', 'user', 'pass', 'host', 'port', 'path', 'query', 'fragment')) {

		if(!class_exists('JFilterInput')) require (JPATH_VM_LIBRARIES.DS.'joomla'.DS.'filter'.DS.'input.php');
		$_filter = JFilterInput::getInstance(array('br', 'i', 'em', 'b', 'strong'), array(), 0, 0, 1);
		if($JURIInstance===0)$JURIInstance = JURI::getInstance();
		return $_filter->clean($JURIInstance->toString($parts));
	}
}


// pure php no closing tag
