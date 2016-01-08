<?php

defined('JPATH_PLATFORM') or die;

defined('DS') or define('DS', DIRECTORY_SEPARATOR);


class vFactory {

	static $_db = 0;
	static $_apps = array();
	static $_session = false;
	static $_document = false;
	static $_lang = false;
	static $_cache = false;
	static $_dates = false;
	static $_config = false;
	static $mailer = false;

	public static function getConfig($file = null, $type = 'PHP', $namespace = '') {

		if (!self::$_config) {
			if(defined('JPATH_PLATFORM') ){
				if (!class_exists( 'VmConfig' ))
					require(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_virtuemart'.DS.'helpers'.DS.'config.php');
				if(!class_exists('jBridge'))
					require(VMPATH_ADMIN. DS. 'vmf' .DS. 'jbridge.php');
				self::$_config = JBridge::getConfig();
			} else {
				if(!class_exists('wpBridge'))
					require(VMPATH_ADMIN. DS. 'vmf' .DS. 'wpbridge.php');
				self::$_config = wpBridge::getConfig();
			}
		}

		return self::$_config;
	}


	static function getDbo(){

		if(!self::$_db){
			$conf = self::getConfig();

			$host = $conf->get('host');
			$user = $conf->get('user');
			$password = $conf->get('password');
			$database = $conf->get('db');
			$prefix = $conf->get('dbprefix');
			$driver = $conf->get('dbtype');
			$debug = $conf->get('debug');

			$options = array('driver' => $driver, 'host' => $host, 'user' => $user, 'password' => $password, 'database' => $database, 'prefix' => $prefix);

			try {
				if(!class_exists('vDatabaseDriverMysqli'))
					require(VMPATH_ADMIN. DS. 'vmf' .DS. 'db' .DS. 'driver' .DS. 'mysqli.php');
				self::$_db = vDatabaseDriverMysqli::getInstance($options);
			}
			catch (RuntimeException $e) {
				if (!headers_sent()) {
					header('HTTP/1.1 500 Internal Server Error');
				}

				jexit('Database Error: ' . $e->getMessage());
			}

			self::$_db->setDebug($debug);
		}
		return self::$_db;
	}

	static function getApplication($id='site'){
		if(!isset(self::$_apps[$id])){
			if(JVM_VERSION===0){
				if(!class_exists('wpBridge'))
					require(VMPATH_ADMIN. DS. 'vmf' .DS. 'wpbridge.php');
				self::$_apps[$id] = wpBridge::getInstance();
				//self::$_apps[$id] = vBasicModel::getInstance('vApp');
			} else {
				//JApplicationCms
				self::$_apps[$id] = JFactory::getApplication($id);
				//if(!class_exists('JApplicationCms')) require(VMPATH_ROOT.DS.'libraries'.DS.'cms'.DS.'application'.DS.'cms.php');
				//self::$_apps[$id] = JApplicationCms::getInstance($id);
			}

		}
		return self::$_apps[$id];
	}

	public static function getUser($id = null) {

		$instance = self::getSession()->get('user');

		if (is_null($id))
		{
			if (!($instance instanceof JUser))
			{
				$instance = JUser::getInstance();
			}
		}
		// Check if we have a string as the id or if the numeric id is the current instance
		elseif (is_string($id) || $instance->id !== $id)
		{
			$instance = JUser::getInstance($id);
		}

		return $instance;
	}

	/**
	 * Return the {@link JDate} object
	 *
	 * @param   mixed  $time      The initial time for the JDate object
	 * @param   mixed  $tzOffset  The timezone offset.
	 *
	 * @return  JDate object
	 *
	 * @see     JDate
	 * @since   11.1
	 */
	public static function getDate($time = 'now', $tzOffset = null)
	{
		static $classname;
		static $mainLocale;

		$language = self::getLanguage();
		$locale = $language->getTag();

		if (!isset($classname) || $locale != $mainLocale)
		{
			// Store the locale for future reference
			$mainLocale = $locale;

			if ($mainLocale !== false)
			{
				$classname = str_replace('-', '_', $mainLocale) . 'Date';

				if (!class_exists($classname))
				{
					// The class does not exist, default to JDate
					$classname = 'JDate';
				}
			}
			else
			{
				// No tag, so default to JDate
				$classname = 'JDate';
			}
		}

		$key = $time . '-' . ($tzOffset instanceof DateTimeZone ? $tzOffset->getName() : (string) $tzOffset);

		if (!isset(self::$_dates[$classname][$key]))
		{
			self::$_dates[$classname][$key] = new $classname($time, $tzOffset);
		}

		$date = clone self::$_dates[$classname][$key];

		return $date;
	}


	public static function getSession(array $options = array()) {

		if (!self::$_session) {
			self::$_session = JFactory::getSession();
		}

		return self::$_session;
	}

	public static function getDocument(){

		if (!self::$_document) {
			self::$_document = JFactory::getDocument();
		}

		return self::$_document;
	}

	public static function getLanguage() {

		if (!self::$_lang) {
			$conf = self::getConfig();
			$locale = $conf->get('language');
			$debug = $conf->get('debug_lang');

			if(!class_exists('vLanguage')) require(VMPATH_ADMIN. DS. 'vmf' .DS. 'language' .DS. 'vlanguage.php');
			self::$_lang = vLanguage::getInstance($locale, $debug);
		}

		return self::$_lang;
	}

	/**
	 * Get a cache object
	 *
	 * Returns the global {@link JCache} object
	 *
	 * @param   string  $group    The cache group name
	 * @param   string  $handler  The handler to use
	 * @param   string  $storage  The storage method
	 *
	 * @return  JCacheController object
	 *
	 * @see     JCache
	 * @since   11.1
	 */
	public static function getCache($group = '', $handler = 'callback', $storage = null)
	{
		$hash = md5($group . $handler . $storage);

		if (isset(self::$_cache[$hash]))
		{
			return self::$_cache[$hash];
		}

		$handler = ($handler == 'function') ? 'callback' : $handler;

		$options = array('defaultgroup' => $group);

		if (isset($storage))
		{
			$options['storage'] = $storage;
		}

		$cache = JCache::getInstance($handler, $options);

		self::$_cache[$hash] = $cache;

		return self::$_cache[$hash];
	}



	/**
	 * Get a mailer object.
	 *
	 * Returns the global {@link JMail} object, only creating it if it doesn't already exist.
	 *
	 * @return  JMail object
	 *
	 * @see     JMail
	 * @since   11.1
	 */
	public static function getMailer()
	{
		if (!self::$mailer)
		{
			self::$mailer = self::createMailer();
		}

		$copy = clone self::$mailer;

		return $copy;
	}

	/**
	 * Create a mailer object
	 *
	 * @return  JMail object
	 *
	 * @see     JMail
	 * @since   11.1
	 */
	protected static function createMailer()
	{
		$conf = self::getConfig();

		$smtpauth = ($conf->get('smtpauth') == 0) ? null : 1;
		$smtpuser = $conf->get('smtpuser');
		$smtppass = $conf->get('smtppass');
		$smtphost = $conf->get('smtphost');
		$smtpsecure = $conf->get('smtpsecure');
		$smtpport = $conf->get('smtpport');
		$mailfrom = $conf->get('mailfrom');
		$fromname = $conf->get('fromname');
		$mailer = $conf->get('mailer');

		// Create a JMail object
		$mail = JMail::getInstance();

		// Set default sender without Reply-to
		$mail->SetFrom(JMailHelper::cleanLine($mailfrom), JMailHelper::cleanLine($fromname), 0);

		// Default mailer is to use PHP's mail function
		switch ($mailer)
		{
			case 'smtp':
				$mail->useSMTP($smtpauth, $smtphost, $smtpuser, $smtppass, $smtpsecure, $smtpport);
				break;

			case 'sendmail':
				$mail->IsSendmail();
				break;

			default:
				$mail->IsMail();
				break;
		}

		return $mail;
	}

	/**
	 * Get an editor object.
	 *
	 * @param   string  $editor  The editor to load, depends on the editor plugins that are installed
	 *
	 * @return  JEditor instance of JEditor
	 *
	 * @since   11.1
	 * @throws  BadMethodCallException
	 * @deprecated 12.3 (Platform) & 4.0 (CMS) - Use JEditor directly
	 */
	public static function getEditor($editor = null)
	{
		JLog::add(__METHOD__ . ' is deprecated. Use JEditor directly.', JLog::WARNING, 'deprecated');

		if (!class_exists('JEditor')) {
			jimport('joomla.html.editor');
			if (!class_exists('JEditor')) {
				throw new BadMethodCallException( 'JEditor not found' );
			}
		}

		// Get the editor configuration setting
		if (is_null($editor))
		{
			$conf = self::getConfig();
			$editor = $conf->get('editor');
		}

		return JEditor::getInstance($editor);
	}

	public static function getURI($uri = 'SERVER') {
		jimport('joomla.environment.uri');
		return JURI::getInstance($uri);
	}
}
