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

jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.file');
JFormHelper::loadFieldClass('list');

class JFormFieldGetcertificate extends JFormFieldList {

	protected $type = 'Getcertificate';

	protected function getOptions() {

		$lang = JFactory::getLanguage();
		$lang->load('com_virtuemart', JPATH_ADMINISTRATOR);

		$filter = (string)$this->element['filter'];
		$exclude = (string)$this->element['exclude'];
		$stripExt = (string)$this->element['stripext'];
		$hideNone = (string)$this->element['hide_none'];
		$hideDefault = (string)$this->element['hide_default'];
		$class = $this->element['class'] ? ' class="' . (string)$this->element['class'] . '"' : '';

		// Get the path in which to search for file options.
		$folder = (string)$this->element['directory'];
		$safePath = VmConfig::get('forSale_path', '');

		$certificatePath = $safePath . $folder;

		// Is the path a folder?
		if (!is_dir($certificatePath)) {
			return '<span ' . $class . '>' . JText::sprintf('VMPAYMENT_PAYPAL_CERTIFICATE_FOLDER_NOT_EXIST', $certificatePath) . '</span>';
		}
		$path = str_replace('/', DS, $certificatePath);
		// Get a list of files in the search path with the given filter.
		$files = JFolder::files($path, $filter);

		// Build the options list from the list of files.
		if (is_array($files)) {
			foreach ($files as $file) {
				// Check to see if the file is in the exclude mask.
				if ($exclude) {
					if (preg_match(chr(1) . $exclude . chr(1), $file)) {
						continue;
					}
				}

				// If the extension is to be stripped, do it.
				if ($stripExt) {
					$file = JFile::stripExt($file);
				}
				$options[] = JHtml::_('select.option', $file, $file);
			}
		}

		// Merge any additional options in the XML definition.
		$options = array_merge(parent::getOptions(), $options);

		return $options;
	}


	/**
	 * Method to get the field input markup.
	 *
	 * @return  string  The field input markup.
	 *
	 * @since   11.1
	 */
	protected function getInput() {
		// TODO: Implement getInput() method.
	}
}