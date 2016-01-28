<?php
/**
 * Part of the Joomla Framework Registry Package
 *
 * @copyright  Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Joomla\Registry;

/**
 * Abstract Format for Registry
 *
 * @since  1.0
 */
abstract class AbstractRegistryFormat
{
	/**
	 * @var    array  Format instances container.
	 * @since  1.0
	 */
	protected static $instances = array();

	/**
	 * Converts an object into a formatted string.
	 *
	 * @param   object  $object   Data Source Object.
	 * @param   array   $options  An array of options for the formatter.
	 *
	 * @return  string  Formatted string.
	 *
	 * @since   1.0
	 */
	abstract public function objectToString($object, $options = null);

	/**
	 * Converts a formatted string into an object.
	 *
	 * @param   string  $data     Formatted string
	 * @param   array   $options  An array of options for the formatter.
	 *
	 * @return  object  Data Object
	 *
	 * @since   1.0
	 */
	abstract public function stringToObject($data, array $options = array());
}
