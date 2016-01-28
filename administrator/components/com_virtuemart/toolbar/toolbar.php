<?php
/**
 * @package     Joomla.Platform
 * @subpackage  HTML
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

//Register the session storage class with the loader
//JLoader::register('vButton', dirname(__FILE__) . '/toolbar/button.php');
if(!class_exists( 'vButton' )) require(VMPATH_ADMIN.DS.'toolbar'.DS.'button.php');

/**
 * ToolBar handler
 *
 * @package     Joomla.Platform
 * @subpackage  HTML
 * @since       11.1
 */
class vToolBar extends vObject
{
	/**
	 * Toolbar name
	 *
	 * @var    string
	 */
	protected $_name = array();

	/**
	 * Toolbar array
	 *
	 * @var    array
	 */
	protected $_bar = array();

	/**
	 * Loaded buttons
	 *
	 * @var    array
	 */
	protected $_buttons = array();

	/**
	 * Directories, where button types can be stored.
	 *
	 * @var    array
	 */
	protected $_buttonPath = array();

	/**
	 * Constructor
	 *
	 * @param   string  $name  The toolbar name.
	 *
	 * @since   11.1
	 */
	public function __construct($name = 'toolbar')
	{
		$this->_name = $name;

		// Set base path to find buttons.
		$this->_buttonPath[] = dirname(__FILE__) .DS. 'button';

	}

	/**
	 * Stores the singleton instances of various toolbar.
	 *
	 * @var vToolBar
	 * @since 11.3
	 */
	protected static $instances = array();

	/**
	 * Returns the global vToolBar object, only creating it if it
	 * doesn't already exist.
	 *
	 * @param   string  $name  The name of the toolbar.
	 *
	 * @return  vToolBar  The vToolBar object.
	 *
	 * @since   11.1
	 */
	public static function getInstance($name = 'toolbar')
	{
		if (empty(self::$instances[$name])) {
			//The toolbar is implemented as module in the joomla BE, which cannot clean deactivated
			if(JVM_VERSION>0){
				self::$instances[$name] = JToolBar::getInstance($name);
			} else {
				self::$instances[$name] = new vToolBar($name);
			}

		}

		return self::$instances[$name];
	}

	/**
	 * Set a value
	 *
	 * @return  string  The set value.
	 *
	 * @since   11.1
	 */
	public function appendButton()
	{
		// Push button onto the end of the toolbar array.
		$btn = func_get_args();
		array_push($this->_bar, $btn);
		//vmdebug('my bar in save',$this->_bar, $btn);
		return true;
	}

	/**
	 * Get the list of toolbar links.
	 *
	 * @return  array
	 *
	 * @since   11.1
	 */
	public function getItems()
	{
		return $this->_bar;
	}

	/**
	 * Get the name of the toolbar.
	 *
	 * @return  string
	 *
	 * @since   11.1
	 */
	public function getName()
	{
		return $this->_name;
	}

	/**
	 * Get a value.
	 *
	 * @return  string
	 *
	 * @since   11.1
	 */
	public function prependButton()
	{
		// Insert button into the front of the toolbar array.
		$btn = func_get_args();
		array_unshift($this->_bar, $btn);
		return true;
	}

	/**
	 * Render a tool bar.
	 *
	 * @return  string  HTML for the toolbar.
	 *
	 * @since   11.1
	 */
	public function render()
	{
		$html = array();

		// Start toolbar div.
		$html[] = '<div class="toolbar-list" id="' . $this->_name . '">';
		$html[] = '<ul>';

		// Render each button in the toolbar.
		foreach ($this->_bar as $button)
		{
			$html[] = $this->renderButton($button);
		}

		// End toolbar div.
		$html[] = '</ul>';
		$html[] = '<div class="clr"></div>';
		$html[] = '</div>';

		return implode("\n", $html);
	}

	/**
	 * Render a button.
	 *
	 * @param   object  &$node  A toolbar node.
	 *
	 * @return  string
	 *
	 * @since   11.1
	 */
	public function renderButton(&$node)
	{
		// Get the button type.
		$type = $node[0];

		$button = $this->loadButtonType($type);

		// Check for error.
		if ($button === false)
		{
			return vmText::sprintf('JLIB_HTML_BUTTON_NOT_DEFINED', $type);
		}
		return $button->render($node);
	}

	/**
	 * Loads a button type.
	 *
	 * @param   string   $type  Button Type
	 * @param   boolean  $new   False by default
	 *
	 * @return  object
	 *
	 * @since   11.1
	 */
	public function loadButtonType($type, $new = false)
	{
		$signature = md5($type);
		if (isset($this->_buttons[$signature]) && $new === false)
		{
			return $this->_buttons[$signature];
		}

		if (!class_exists('vButton'))
		{
			vmError('JLIB_HTML_BUTTON_BASE_CLASS');
			return false;
		}

		$buttonClass = 'vButton' . $type;
		if (!class_exists($buttonClass))
		{
			if (isset($this->_buttonPath))
			{
				$dirs = $this->_buttonPath;
			}
			else
			{
				$dirs = array();
			}

			//$file = JFilterInput::getInstance()->clean(str_replace('_', DIRECTORY_SEPARATOR, strtolower($type)) . '.php', 'path');
			$file = vRequest::filterPath(str_replace('_', DIRECTORY_SEPARATOR, strtolower($type)) . '.php');

			if(!class_exists('vPath')) require(VMPATH_ADMIN .DS. 'vmf' .DS. 'filesystem' .DS. 'vpath.php');
			if ($buttonFile = vPath::find($dirs, $file))
			{
				include_once $buttonFile;
			}
			else
			{
				vmdebug('loadButtonType',$dirs,$file);
				vmError(vmText::sprintf('JLIB_HTML_BUTTON_NO_LOAD', $buttonClass, $buttonFile));
				return false;
			}
		}

		if (!class_exists($buttonClass))
		{
			//return	JError::raiseError('SOME_ERROR_CODE', "Module file $buttonFile does not contain class $buttonClass.");
			return false;
		}
		$this->_buttons[$signature] = new $buttonClass($this);

		return $this->_buttons[$signature];
	}

	/**
	 * Add a directory where vToolBar should search for button types in LIFO order.
	 *
	 * You may either pass a string or an array of directories.
	 *
	 * vToolBar will be searching for an element type in the same order you
	 * added them. If the parameter type cannot be found in the custom folders,
	 * it will look in libraries/joomla/html/toolbar/button.
	 *
	 * @param   mixed  $path  Directory or directories to search.
	 *
	 * @return  void
	 *
	 * @since   11.1
	 * @see vToolBar
	 */
	public function addButtonPath($path)
	{
		// Just force path to array.
		settype($path, 'array');

		// Loop through the path directories.
		foreach ($path as $dir)
		{
			// No surrounding spaces allowed!
			$dir = trim($dir);

			// Add trailing separators as needed.
			if (substr($dir, -1) != DIRECTORY_SEPARATOR)
			{
				// Directory
				$dir .= DIRECTORY_SEPARATOR;
			}

			// Add to the top of the search dirs.
			array_unshift($this->_buttonPath, $dir);
		}

	}
}
