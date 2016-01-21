<?php


abstract class vView extends vBasicModel implements vIView {

	protected $layout = 'default';



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

	/*public function addLayoutPath($p){
		$this->addIncludePath($p, 'view');
	}*/
	protected $paths;

	public function addLayoutPath($view,$path) {

		if (empty($path)){
			vmError('empty path in addIncludePath','empty path in addIncludePath');
			return false;
		}

		if (!isset(self::$_paths['layout'][$view])){
			self::$_paths['layout'][$view] = array();
		}

		$path = vRequest::filterPath($path);
		if (!in_array($path, self::$_paths['layout'][$view])) {
			array_unshift(self::$_paths['layout'][$view], $path);
		}

		return self::$_paths['layout'][$view];
	}

	public function layoutLoader($type){

		$filename = $type . '.php';
		$name = strtolower(substr(get_class($this),14));
		foreach(self::$_paths['layout'][$name] as $p) {
			if(file_exists( $p.DS.$filename )) {
				//vmdebug('layoutLoader my layout '.$filename.' selected path. '.$p,self::$_paths['layout']);
				return $p.DS.$filename;
			}
		}
		VmConfig::$echoDebug = 1;
		vmdebug('layoutLoader couldnt find path for '.$filename,self::$_paths['layout']);
		return false;
	}

	public function renderLayout($lyt = null){

		$this->_output = null;

		// Clean the file name
		$lyt = isset($tpl) ? preg_replace('/[^A-Z0-9_\.-]/i', '', $lyt) : $lyt;
		$file = $this->layout . (isset($lyt) ? '_' . $lyt : $lyt);
		$file = preg_replace('/[^A-Z0-9_\.-]/i', '', $file);

		$this->_layoutPath = $this->layoutLoader($file);

		//vmdebug('my layout '.$file,$this->_layoutPath);
		if ($this->_layoutPath != false)
		{
			// Unset so as not to introduce into template scope
			unset($lyt);
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
			vmdebug( 'renderLayout My path $file '.$file,self::$_paths['layout']); die;
			throw new Exception(vmText::sprintf('JLIB_APPLICATION_ERROR_LAYOUTFILE_NOT_FOUND', $file), 500);
		}
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
	public function loadTemplate($lyt = null) {

		// Load the language file for the template
		$template = vFactory::getApplication()->getTemplate();
		$lang = vFactory::getLanguage();
		$lang->load('tpl_' . $template, VMPATH_BASE, null, false, true)
		|| $lang->load('tpl_' . $template, VMPATH_THEMES . "/$template", null, false, true);

		return $this->renderLayout($lyt);
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
