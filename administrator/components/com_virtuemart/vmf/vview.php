<?php


abstract class vView extends vBasicModel implements vIView {

	protected $layout = 'default';

	protected $paths;

	protected $_output = null;

	protected $_template = null;

	protected $_path = array('template' => array(), 'helper' => array());

	protected $_layoutExt = 'php';

	/**
	 * Method to escape output.
	 *
	 * @param   string  $output  The output to escape.
	 *
	 * @return  string  The escaped output.
	 *
	 * @see     JView::escape()
	 * @since   12.1
	 */
	public function escape($output)
	{
		// Escape the output.
		return htmlspecialchars($output, ENT_COMPAT, 'UTF-8');
	}

	/**
	 * Method to get the view layout.
	 *
	 * @return  string  The layout name.
	 *
	 * @since   12.1
	 */
	public function getLayout() {
		return $this->layout;
	}

	public function layoutLoader($type, $prefix){

		$filename = $type . '.php';
		foreach(self::$_paths[$prefix] as $p) {
			if(file_exists( $p.DS.$filename )) {
				return $p.DS.$filename;
			}
		}

		return false;
	}

	/**
	 * Load a template file -- first look in the templates folder for an override
	 *
	 * @param   string  $tpl  The name of the template source file; automatically searches the template paths and compiles as needed.
	 *
	 * @return  string  The output of the the template script.
	 *
	 * @since   3.2
	 * @throws  Exception
	 */
	public function loadTemplate($tpl = null) {

		//VmConfig::$echoDebug = 1;
		// Clear prior output
		$this->_output = null;
		$template = vFactory::getApplication()->getTemplate();

		// Load the language file for the template
		$lang = vFactory::getLanguage();
		$lang->load('tpl_' . $template, VMPATH_BASE, null, false, true)
		|| $lang->load('tpl_' . $template, VMPATH_THEMES . "/$template", null, false, true);

		$name = strtolower(substr(get_class($this),14));
		$this->addIncludePath(VMPATH_COMPONENT . DS . 'views' .DS. $name .DS. 'tmpl','view');
		$this->addIncludePath(VMPATH_BASE . DS . 'templates' . DS . $template . DS . 'html' . DS . 'com_virtumart' .DS. $name,'view');

		//return $this->render($tpl);

		// Clean the file name
		$tpl = isset($tpl) ? preg_replace('/[^A-Z0-9_\.-]/i', '', $tpl) : $tpl;
		$file = $this->layout . (isset($tpl) ? '_' . $tpl : $tpl);
		$file = preg_replace('/[^A-Z0-9_\.-]/i', '', $file);

		$this->_layoutPath = $this->layoutLoader($file,'view');

		vmdebug('my layout '.$file,$this->layout);
		if ($this->_layoutPath != false)
		{
			// Unset so as not to introduce into template scope
			unset($tpl);
			unset($file);

			// Never allow a 'this' property
			if (isset($this->this)) {
				unset($this->this);
			}

			// Start capturing output into a buffer
			ob_start();

			// Include the requested template filename in the local scope
			// (this will execute the view logic).
			include $this->_layoutPath;

			// Done with the requested template; get the buffer and
			// clear it.
			$this->_output = ob_get_contents();
			ob_end_clean();

			return $this->_output;
		} else {
			VmConfig::$echoDebug = 1;
			vmdebug( 'My path $file '.$file,self::$_paths); die;
			throw new Exception(JText::sprintf('JLIB_APPLICATION_ERROR_LAYOUTFILE_NOT_FOUND', $file), 500);
		}
	}

	/**
	 * Method to set the view layout.
	 *
	 * @param   string  $layout  The layout name.
	 *
	 * @return  JViewHtml  Method supports chaining.
	 *
	 * @since   12.1
	 */
	public function setLayout($layout) {
		$previous = $this->layout;
		if(!empty($layout)){
			$this->layout = $layout;
		}

		return $previous;
	}



}
