<?php
/**
 * @package     Joomla.Platform
 * @subpackage  Form
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

/**
 * vForm's helper class.
 * Provides a storage for filesystem's paths where vForm's entities reside and methods for creating those entities.
 * Also stores objects with entities' prototypes for further reusing.
 *
 * @since  11.1
 */
class vFormHelper extends vBasicModel{

	/**
	 * Static array of vForm's entity objects for re-use.
	 * Prototypes for all fields and rules are here.
	 *
	 * Array's structure:
	 * <code>
	 * entities:
	 * {ENTITY_NAME}:
	 * {KEY}: {OBJECT}
	 * </code>
	 */
	protected static $entities = array();


	/**
	 * Method to load a form field object given a type.
	 *
	 */
	public static function loadFieldType($type, $new = true)
	{
		return self::loadType('field', $type, $new);
	}

	/**
	 * Method to load a form rule object given a type.
	 *
	 */
	public static function loadRuleType($type, $new = true)
	{
		return self::loadType('rule', $type, $new);
	}

	/**
	 * Method to load a form entity object given a type.
	 * Each type is loaded only once and then used as a prototype for other objects of same type.
	 * Please, use this method only with those entities which support types (forms don't support them).
	 *
	 * @param   string   $entity  The entity.
	 * @param   string   $type    The entity type.
	 * @param   boolean  $new     Flag to toggle whether we should get a new instance of the object.
	 *
	 * @return  mixed  Entity object on success, false otherwise.
	 *
	 * @since   11.1
	 */
	protected static function loadType($entity, $type, $new = true)
	{
		// Reference to an array with current entity's type instances
		$types = &self::$entities[$entity];

		$key = md5($type);

		// Return an entity object if it already exists and we don't need a new one.
		if (isset($types[$key]) && $new === false)
		{
			return $types[$key];
		}
		//VmConfig::$echoDebug=true;
		//vmdebug('Try to load ',$entity, $type);
		$class = self::loadClass($entity, $type);

		if ($class === false) {
			return false;
		}

		// Instantiate a new type object.
		$types[$key] = new $class;

		return $types[$key];
	}

	/**
	 * Attempt to import the vFormField class file if it isn't already imported.
	 * You can use this method outside of vForm for loading a field for inheritance or composition.
	 *
	 * @param   string  $type  Type of a field whose class should be loaded.
	 * @return  mixed  Class name on success or false otherwise.
	 */
	public static function loadFieldClass($type)
	{
		return self::loadClass('field', $type);
	}

	/**
	 * Attempt to import the vFormRule class file if it isn't already imported.
	 */
	public static function loadRuleClass($type) {
		return self::loadClass('rule', $type);
	}

	/**
	 * Load a class for one of the form's entities of a particular type.
	 *
	 * @param   string  $entity  One of the form entities (field or rule).
	 * @param   string  $type    Type of an entity.
	 *
	 * @return  mixed  Class name on success or false otherwise.
	 */
	protected static function loadClass($entity, $type) {

		$prefix = 'v';

		if (strpos($type, '.'))
		{
			list($prefix, $type) = explode('.', $type);
		}

		//$class = vString::ucfirst($prefix, '_') . 'Form' . vString::ucfirst($entity, '_') . vString::ucfirst($type, '_');
		$class = $prefix . 'Form' . ucfirst($entity) . ucfirst($type);

		if (class_exists($class))
		{
			return $class;
		} else {
			$prefix = 'J';
			$classJ = ucfirst($prefix) . 'Form' . ucfirst($entity) . ucfirst($type);
			if (class_exists($classJ)) {
				return $classJ;
			}
		}

		// Get the field search path array.
		$paths = self::addPath($entity);

		// If the type is complex, add the base type to the paths.
		if ($pos = strpos($type, '_'))
		{
			// Add the complex type prefix to the paths.
			for ($i = 0, $n = count($paths); $i < $n; $i++)
			{
				// Derive the new path.
				$path = $paths[$i] . '/' . strtolower(substr($type, 0, $pos));

				// If the path does not exist, add it.
				if (!in_array($path, $paths))
				{
					$paths[] = $path;
				}
			}
			// Break off the end of the complex type.
			$type = substr($type, $pos + 1);
		}

		// Try to find the class file.
		$type = strtolower($type) . '.php';

		if(!class_exists('vPath')) require(VMPATH_ADMIN .'/vmf/filesystem/vpath.php');
		foreach ($paths as $path)
		{
			$file = vPath::find($path, $type);
			if (!$file) {
				continue;
			}

			require $file;

			if (class_exists($class)) {
				return $class;
			} else if(class_exists($classJ)){
				return $classJ;
			}
		}
		VmConfig::$echoDebug=1;
		vmdebug('joomla loadClass',$entity, $type,$paths,$class);
		// Check for all if the class exists.
		return class_exists($class) ? $class : false;
	}

	/**
	 * Method to add a path to the list of field include paths.
	 * @param   mixed  $new  A path or array of paths to add.
	 * @return  array  The list of paths that have been added.
	 */
	public static function addFieldPath($new = null)
	{
		return self::addPath('field', $new);
	}

	/**
	 * For form include paths
	 */
	public static function addFormPath($new = null)
	{
		return self::addPath('form', $new);
	}

	/**
	 * For rule include paths.
	 */
	public static function addRulePath($new = null)
	{
		return self::addPath('rule', $new);
	}

	/**
	 * Method to add a path to the list of include paths for one of the form's entities.
	 * Currently supported entities: field, rule and form. You are free to support your own in a subclass.
	 *
	 * @param   string  $entity  Form's entity name for which paths will be added.
	 * @param   mixed   $new     A path or array of paths to add.
	 *
	 * @return  array  The list of paths that have been added.
	 */
	protected static function addPath($entity, $new = null) {

		// Reference to an array with paths for current entity
		//self::$_paths['fields'][$entity];

		// Add the default entity's search path if not set.
		if (empty(self::$_paths['fields'][$entity])) {
			// While we support limited number of entities (form, field and rule)
			// we can do this simple pluralisation:
			$entity_pl = $entity . 's';
			self::$_paths['fields'][$entity][] = VMPATH_ADMIN .'/'. $entity_pl;
			self::$_paths['fields'][$entity][] = VMPATH_LIBS .'/joomla/form/' .$entity_pl;
		}

		// Force the new path(s) to an array.
		settype($new, 'array');

		// Add the new paths to the stack if not already there.
		foreach ($new as $path)
		{
			if (!in_array($path, self::$_paths['fields'][$entity]))
			{
				array_unshift(self::$_paths['fields'][$entity], trim($path));
			}
		}

		return self::$_paths['fields'][$entity];
	}

}
