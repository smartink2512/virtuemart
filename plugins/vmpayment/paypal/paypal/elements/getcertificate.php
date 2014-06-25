<?php
defined('_JEXEC') or die();
/**
 *
 * @package    VirtueMart
 * @subpackage Plugins  - Elements
 * @author Valérie Isaksen
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2011 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id:$
 */

if (JVM_VERSION < 3) {
	class JElementGetcertificate extends JElement {

		/**
		 * Element name
		 *
		 * @access    protected
		 * @var        string
		 */
		var $_name = 'Getcertificate';


		function fetchElement($name, $value, &$node, $control_name) {

			jimport('joomla.filesystem.folder');
			jimport('joomla.filesystem.file');
			$lang = JFactory::getLanguage();
			$lang->load('com_virtuemart', JPATH_ADMINISTRATOR);
			// path to images directory
			$folder = $node->attributes('directory');
			$safePath = VmConfig::get('forSale_path', '');

			$certificatePath = $safePath . $folder;
			$certificatePath = JPath::clean($certificatePath);
			$class = ($node->attributes('class') ? 'class="' . $node->attributes('class') . '"' : '');

			// Is the path a folder?
			if (!is_dir($certificatePath)) {
				return '<span ' . $class . '>' . vmText::sprintf('VMPAYMENT_PAYPAL_CERTIFICATE_FOLDER_NOT_EXIST', $certificatePath) . '</span>';
			}

			$path = str_replace('/', DS, $certificatePath);
			$filter = $node->attributes('filter');
			$exclude = array($node->attributes('exclude'), '.svn', 'CVS', '.DS_Store', '__MACOSX', 'index.html');
			$pattern = implode("|", $exclude);
			$stripExt = $node->attributes('stripext');

			$files = JFolder::files($path, $filter, FALSE, FALSE, $exclude);

			$options = array();

			if (is_array($files)) {
				foreach ($files as $file) {
					if ($exclude) {
						if (preg_match(chr(1) . $pattern . chr(1), $file)) {
							continue;
						}
					}
					if ($stripExt) {
						$file = JFile::stripExt($file);
					}
					$options[] = JHTML::_('select.option', $file, $file);
				}
			}
			$class .= ' size="5" data-placeholder="' . vmText::_('COM_VIRTUEMART_DRDOWN_SELECT_SOME_OPTIONS') . '"';
			return JHTML::_('select.genericlist', $options, '' . $control_name . '[' . $name . ']', $class, 'value', 'text', $value, $control_name . $name);
		}

	}
} else {
	JFormHelper::loadFieldClass('filelist');
	class JFormFieldGetcertificate extends JFormFieldFileList {

		/**
		 * Element name
		 *
		 * @access    protected
		 * @var        string
		 */
		protected $type = 'Getcertificate';

		/*
		protected function getInput() {

			$options = array();

			$folder =$this->directory;
			$safePath = VmConfig::get('forSale_path', '');

			$certificatePath = $safePath . $folder;
			$certificatePath = JPath::clean($certificatePath);

			// Is the path a folder?
			if (!is_dir($certificatePath)) {
				return '<span>' . vmText::sprintf('VMPAYMENT_PAYPAL_CERTIFICATE_FOLDER_NOT_EXIST', $certificatePath) . '</span>';
			}
			$path = str_replace('/', DS, $certificatePath);

			// Prepend some default options based on field attributes.
			if (!$this->hideNone)
			{
				$options[] = JHtml::_('select.option', '-1', JText::alt('JOPTION_DO_NOT_USE', preg_replace('/[^a-zA-Z0-9_\-]/', '_', $this->fieldname)));
			}

			if (!$this->hideDefault)
			{
				$options[] = JHtml::_('select.option', '', JText::alt('JOPTION_USE_DEFAULT', preg_replace('/[^a-zA-Z0-9_\-]/', '_', $this->fieldname)));
			}

			// Get a list of files in the search path with the given filter.
			$files = JFolder::files($path, $this->filter);

			// Build the options list from the list of files.
			if (is_array($files))
			{
				foreach ($files as $file)
				{
					// Check to see if the file is in the exclude mask.
					if ($this->exclude)
					{
						if (preg_match(chr(1) . $this->exclude . chr(1), $file))
						{
							continue;
						}
					}

					// If the extension is to be stripped, do it.
					if ($this->stripExt)
					{
						$file = JFile::stripExt($file);
					}

					$options[] = JHtml::_('select.option', $file, $file);
				}
			}

			// Merge any additional options in the XML definition.
			//$options = array_merge(parent::getOptions(), $options);

			return $options;

		}
		*/
		protected function getOptions()
		{
			$options = array();
			$folder =$this->directory;
			$safePath = VmConfig::get('forSale_path', '');

			$certificatePath = $safePath . $folder;
			$certificatePath = JPath::clean($certificatePath);

			// Is the path a folder?
			if (!is_dir($certificatePath)) {
				return '<span>' . vmText::sprintf('VMPAYMENT_PAYPAL_CERTIFICATE_FOLDER_NOT_EXIST', $certificatePath) . '</span>';
			}
			$path = str_replace('/', DS, $certificatePath);


			// Prepend some default options based on field attributes.
			if (!$this->hideNone)
			{
				$options[] = JHtml::_('select.option', '-1', JText::alt('JOPTION_DO_NOT_USE', preg_replace('/[^a-zA-Z0-9_\-]/', '_', $this->fieldname)));
			}

			if (!$this->hideDefault)
			{
				$options[] = JHtml::_('select.option', '', JText::alt('JOPTION_USE_DEFAULT', preg_replace('/[^a-zA-Z0-9_\-]/', '_', $this->fieldname)));
			}

			// Get a list of files in the search path with the given filter.
			$files = JFolder::files($path, $this->filter);

			// Build the options list from the list of files.
			if (is_array($files))
			{
				foreach ($files as $file)
				{
					// Check to see if the file is in the exclude mask.
					if ($this->exclude)
					{
						if (preg_match(chr(1) . $this->exclude . chr(1), $file))
						{
							continue;
						}
					}

					// If the extension is to be stripped, do it.
					if ($this->stripExt)
					{
						$file = JFile::stripExt($file);
					}

					$options[] = JHtml::_('select.option', $file, $file);
				}
			}

			return $options;
		}
	}

}