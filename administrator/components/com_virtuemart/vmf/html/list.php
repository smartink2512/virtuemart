<?php
/**
 * @package     Joomla.Libraries
 * @subpackage  HTML
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

/**
 * Utility class for creating different select lists
 *
 * @since  1.5
 */
abstract class vHtmlList
{
	/**
	 * Build the select list to choose an image
	 *
	 * @param   string  $name        The name of the field
	 * @param   string  $active      The selected item
	 * @param   string  $javascript  Alternative javascript
	 * @param   string  $directory   Directory the images are stored in
	 * @param   string  $extensions  Allowed extensions
	 *
	 * @return  array  Image names
	 *
	 * @since   1.5
	 */
	public static function images($name, $active = null, $javascript = null, $directory = null, $extensions = "bmp|gif|jpg|png")
	{
		if (!$directory)
		{
			$directory = '/images/';
		}

		if (!$javascript)
		{
			$javascript = "onchange=\"if (document.forms.adminForm." . $name
				. ".options[selectedIndex].value!='') {document.imagelib.src='..$directory' + document.forms.adminForm." . $name
				. ".options[selectedIndex].value} else {document.imagelib.src='media/system/images/blank.png'}\"";
		}

		$imageFiles = new DirectoryIterator(VMPATH_ROOT . '/' . $directory);
		$images = array(vHtml::_('select.option', '', vmText::_('JOPTION_SELECT_IMAGE')));

		foreach ($imageFiles as $file)
		{
			$fileName = $file->getFilename();

			if (!$file->isFile())
			{
				continue;
			}

			if (preg_match('#(' . $extensions . ')$#', $fileName))
			{
				$images[] = vHtml::_('select.option', $fileName);
			}
		}

		$images = vHtml::_(
			'select.genericlist',
			$images,
			$name,
			array(
				'list.attr' => 'class="inputbox" size="1" ' . $javascript,
				'list.select' => $active
			)
		);

		return $images;
	}

	/**
	 * Returns an array of options
	 *
	 * @param   string   $query  SQL with 'ordering' AS value and 'name field' AS text
	 * @param   integer  $chop   The length of the truncated headline
	 *
	 * @return  array  An array of objects formatted for JHtml list processing
	 *
	 * @since   1.5
	 */
	public static function genericordering($query, $chop = 30)
	{
		$db = vFactory::getDbo();
		$options = array();
		$db->setQuery($query);

		$items = $db->loadObjectList();

		if (empty($items))
		{
			$options[] = vHtml::_('select.option', 1, vmText::_('JOPTION_ORDER_FIRST'));

			return $options;
		}

		$options[] = vHtml::_('select.option', 0, '0 ' . vmText::_('JOPTION_ORDER_FIRST'));
		if(!class_exists('vString')) require(VMPATH_ADMIN .DS. 'vmf' .DS. 'vstring.php');

		for ($i = 0, $n = count($items); $i < $n; $i++)
		{
			$items[$i]->text = vmText::_($items[$i]->text);

			if (vString::strlen($items[$i]->text) > $chop)
			{
				$text = vString::substr($items[$i]->text, 0, $chop) . "...";
			}
			else
			{
				$text = $items[$i]->text;
			}

			$options[] = vHtml::_('select.option', $items[$i]->value, $items[$i]->value . '. ' . $text);
		}

		$options[] = vHtml::_('select.option', $items[$i - 1]->value + 1, ($items[$i - 1]->value + 1) . ' ' . vmText::_('JOPTION_ORDER_LAST'));

		return $options;
	}

	/**
	 * Build the select list for Ordering derived from a query
	 *
	 * @param   integer  $name      The scalar value
	 * @param   string   $query     The query
	 * @param   string   $attribs   HTML tag attributes
	 * @param   string   $selected  The selected item
	 * @param   integer  $neworder  1 if new and first, -1 if new and last, 0  or null if existing item
	 *
	 * @return  string   HTML markup for the select list
	 *
	 * @since   1.6
	 */
	public static function ordering($name, $query, $attribs = null, $selected = null, $neworder = null)
	{
		if (empty($attribs))
		{
			$attribs = 'class="inputbox" size="1"';
		}

		if (empty($neworder))
		{
			$orders = vHtml::_('list.genericordering', $query);
			$html = vHtml::_('select.genericlist', $orders, $name, array('list.attr' => $attribs, 'list.select' => (int) $selected));
		}
		else
		{
			if ($neworder > 0)
			{
				$text = vmText::_('JGLOBAL_NEWITEMSLAST_DESC');
			}
			elseif ($neworder <= 0)
			{
				$text = vmText::_('JGLOBAL_NEWITEMSFIRST_DESC');
			}

			$html = '<input type="hidden" name="' . $name . '" value="' . (int) $selected . '" /><span class="readonly">' . $text . '</span>';
		}

		return $html;
	}

}
