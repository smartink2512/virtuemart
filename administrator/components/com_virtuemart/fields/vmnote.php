<?php
defined('_JEXEC') or die('Restricted access');

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
 * @version $Id$
 */
jimport('joomla.form.formfield');
class JFormFieldVmNote extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 *
	 * @since  11.1
	 */
	protected $type = 'VmNote';

	/**
	 * Method to get the field label markup.
	 *
	 * @return  string  The field label markup.
	 *
	 * @since   11.1
	 */
	protected function getLabel()
	{
		if (empty($this->element['label']))
		{
			return '';
		}

		$title = $this->element['label'] ? (string) $this->element['label'] : ($this->element['title'] ? (string) $this->element['title'] : '');
		$class = $this->element['class'] ? ' class="' . trim((string) $this->element['class']) . '"' : '';

		return '<span ' . $class . '>' . vmText::_($title).'</span>';
	}

	/**
	 * Method to get the field input markup.
	 *
	 * @return  string  The field input markup.
	 *
	 * @since   11.1
	 */
	protected function getInput()
	{
		if (empty($this->element['description']))
		{
			return '';
		}

		$description = (string) $this->element['description'];
		$class = $this->element['class'] ? ' class="' . trim((string) $this->element['class']) . '"' : '';

		$html = !empty($description) ? vmText::_($description) : '';

		return '<span ' . $class . '>' . $html.'</span>';
	}
}
