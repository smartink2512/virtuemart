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
 * Utility class for JavaScript behaviors
 *
 * @since  1.5
 */
abstract class vHtmlBehavior
{
	/**
	 * Array containing information for loaded files
	 *
	 * @var    array
	 * @since  2.5
	 */
	protected static $loaded = array();


	/**
	 * Method to load core.js into the document head.
	 *
	 * Core.js defines the 'Joomla' namespace and contains functions which are used across extensions
	 *
	 * @return  void
	 *
	 * @since   3.3
	 */
	public static function core() {

		// Only load once
		if (isset(static::$loaded[__METHOD__]))
		{
			return;
		}

		//vHtml::_('script', 'system/core.js', false, true);
		static::$loaded[__METHOD__] = true;

		return;
	}

	/**
	 * Add unobtrusive JavaScript support for form validation.
	 *
	 * To enable form validation the form tag must have class="form-validate".
	 * Each field that needs to be validated needs to have class="validate".
	 * Additional handlers can be added to the handler for username, password,
	 * numeric and email. To use these add class="validate-email" and so on.
	 *
	 * @return  void
	 *
	 * @since   3.4
	 */
	public static function formvalidator()
	{
		// Only load once
		if (isset(static::$loaded[__METHOD__]))
		{
			return;
		}

		// Include core
		static::core();

		// Add validate.js language strings
		vmText::script('JLIB_FORM_FIELD_INVALID');

		vHtml::_('script', 'validate.js', false, true);
		static::$loaded[__METHOD__] = true;
	}


	/**
	 * Add unobtrusive JavaScript support for a hover tooltips.
	 *
	 * Add a title attribute to any element in the form
	 * title="title::text"
	 *
	 * Uses the core Tips class in MooTools.
	 *
	 * @param   string  $selector  The class selector for the tooltip.
	 * @param   array   $params    An array of options for the tooltip.
	 *                             Options for the tooltip can be:
	 *                             - maxTitleChars  integer   The maximum number of characters in the tooltip title (defaults to 50).
	 *                             - offsets        object    The distance of your tooltip from the mouse (defaults to {'x': 16, 'y': 16}).
	 *                             - showDelay      integer   The millisecond delay the show event is fired (defaults to 100).
	 *                             - hideDelay      integer   The millisecond delay the hide hide is fired (defaults to 100).
	 *                             - className      string    The className your tooltip container will get.
	 *                             - fixed          boolean   If set to true, the toolTip will not follow the mouse.
	 *                             - onShow         function  The default function for the show event, passes the tip element
	 *                               and the currently hovered element.
	 *                             - onHide         function  The default function for the hide event, passes the currently
	 *                               hovered element.
	 *
	 * @return  void
	 *
	 * @since   1.5
	 */
	public static function tooltip($selector = '.hasTip', $params = array())
	{
		$sig = md5(serialize(array($selector, $params)));

		if (isset(static::$loaded[__METHOD__][$sig]))
		{
			return;
		}

		// Include MooTools framework
		//static::framework(true);

		// Setup options object
		$opt['maxTitleChars'] = (isset($params['maxTitleChars']) && ($params['maxTitleChars'])) ? (int) $params['maxTitleChars'] : 50;

		// Offsets needs an array in the format: array('x'=>20, 'y'=>30)
		$opt['offset']    = (isset($params['offset']) && (is_array($params['offset']))) ? $params['offset'] : null;
		$opt['showDelay'] = (isset($params['showDelay'])) ? (int) $params['showDelay'] : null;
		$opt['hideDelay'] = (isset($params['hideDelay'])) ? (int) $params['hideDelay'] : null;
		$opt['className'] = (isset($params['className'])) ? $params['className'] : null;
		$opt['fixed']     = (isset($params['fixed']) && ($params['fixed'])) ? true : false;
		$opt['onShow']    = (isset($params['onShow'])) ? '\\' . $params['onShow'] : null;
		$opt['onHide']    = (isset($params['onHide'])) ? '\\' . $params['onHide'] : null;

		$options = vHtml::getJSObject($opt);

		// Include jQuery

		vHtml::_('jquery.framework');

		// Attach tooltips to document
		vFactory::getDocument()->addScriptDeclaration(
			"jQuery(function($) {
			 $('$selector').each(function() {
				var title = $(this).attr('title');
				if (title) {
					var parts = title.split('::', 2);
					var mtelement = document.id(this);
					mtelement.store('tip:title', parts[0]);
					mtelement.store('tip:text', parts[1]);
				}
			});
			var JTooltips = new Tips($('$selector').get(), $options);
		});"
		);

		// Set static array
		static::$loaded[__METHOD__][$sig] = true;

		return;
	}

	/**
	 * Add unobtrusive JavaScript support for modal links.
	 *
	 * @param   string  $selector  The selector for which a modal behaviour is to be applied.
	 * @param   array   $params    An array of parameters for the modal behaviour.
	 *                             Options for the modal behaviour can be:
	 *                            - ajaxOptions
	 *                            - size
	 *                            - shadow
	 *                            - overlay
	 *                            - onOpen
	 *                            - onClose
	 *                            - onUpdate
	 *                            - onResize
	 *                            - onShow
	 *                            - onHide
	 *
	 * @return  void
	 *
	 * @since   1.5
	 */
	public static function modal($selector = 'a.modal', $params = array())
	{
		$document = vFactory::getDocument();

		// Load the necessary files if they haven't yet been loaded
		if (!isset(static::$loaded[__METHOD__]))
		{
			// Include MooTools framework
			//static::framework(true);

			// Load the JavaScript and css
			vHtml::_('script', 'system/modal.js', true, true);
			vHtml::_('stylesheet', 'system/modal.css', array(), true);
		}

		$sig = md5(serialize(array($selector, $params)));

		if (isset(static::$loaded[__METHOD__][$sig]))
		{
			return;
		}

		// Setup options object
		$opt['ajaxOptions']   = (isset($params['ajaxOptions']) && (is_array($params['ajaxOptions']))) ? $params['ajaxOptions'] : null;
		$opt['handler']       = (isset($params['handler'])) ? $params['handler'] : null;
		$opt['parseSecure']   = (isset($params['parseSecure'])) ? (bool) $params['parseSecure'] : null;
		$opt['closable']      = (isset($params['closable'])) ? (bool) $params['closable'] : null;
		$opt['closeBtn']      = (isset($params['closeBtn'])) ? (bool) $params['closeBtn'] : null;
		$opt['iframePreload'] = (isset($params['iframePreload'])) ? (bool) $params['iframePreload'] : null;
		$opt['iframeOptions'] = (isset($params['iframeOptions']) && (is_array($params['iframeOptions']))) ? $params['iframeOptions'] : null;
		$opt['size']          = (isset($params['size']) && (is_array($params['size']))) ? $params['size'] : null;
		$opt['shadow']        = (isset($params['shadow'])) ? $params['shadow'] : null;
		$opt['overlay']       = (isset($params['overlay'])) ? $params['overlay'] : null;
		$opt['onOpen']        = (isset($params['onOpen'])) ? $params['onOpen'] : null;
		$opt['onClose']       = (isset($params['onClose'])) ? $params['onClose'] : null;
		$opt['onUpdate']      = (isset($params['onUpdate'])) ? $params['onUpdate'] : null;
		$opt['onResize']      = (isset($params['onResize'])) ? $params['onResize'] : null;
		$opt['onMove']        = (isset($params['onMove'])) ? $params['onMove'] : null;
		$opt['onShow']        = (isset($params['onShow'])) ? $params['onShow'] : null;
		$opt['onHide']        = (isset($params['onHide'])) ? $params['onHide'] : null;

		// Include jQuery
		vHtml::_('jquery.framework');

		if (isset($params['fullScreen']) && (bool) $params['fullScreen'])
		{
			$opt['size']      = array('x' => '\\jQuery(window).width() - 80', 'y' => '\\jQuery(window).height() - 80');
		}

		$options = vHtml::getJSObject($opt);

		// Attach modal behavior to document
		$document
			->addScriptDeclaration(
			"
		jQuery(function($) {
			SqueezeBox.initialize(" . $options . ");
			SqueezeBox.assign($('" . $selector . "').get(), {
				parse: 'rel'
			});
		});
		function jModalClose() {
			SqueezeBox.close();
		}"
		);

		// Set static array
		static::$loaded[__METHOD__][$sig] = true;

		return;
	}


	/**
	 * Add unobtrusive JavaScript support for a calendar control.
	 *
	 * @return  void
	 *
	 * @since   1.5
	 */
	public static function calendar()
	{
		// Only load once
		if (isset(static::$loaded[__METHOD__]))
		{
			return;
		}

		$document = vFactory::getDocument();
		$tag = vFactory::getLanguage()->getTag();

		vHtml::_('stylesheet', 'system/calendar-jos.css', array(' title' => vmText::_('JLIB_HTML_BEHAVIOR_GREEN'), ' media' => 'all'), true);
		vHtml::_('script', $tag . '/calendar.js', false, true);
		vHtml::_('script', $tag . '/calendar-setup.js', false, true);

		$translation = static::calendartranslation();

		if ($translation)
		{
			$document->addScriptDeclaration($translation);
		}

		static::$loaded[__METHOD__] = true;
	}

	/**
	 * Add unobtrusive JavaScript support for a color picker.
	 *
	 * @return  void
	 *
	 * @since   1.7
	 */
	public static function colorpicker()
	{
		// Only load once
		if (isset(static::$loaded[__METHOD__]))
		{
			return;
		}

		// Include jQuery
		vHtml::_('jquery.framework');

		vHtml::_('script', 'jui/jquery.minicolors.min.js', false, true);
		vHtml::_('stylesheet', 'jui/jquery.minicolors.css', false, true);
		vFactory::getDocument()->addScriptDeclaration("
				jQuery(document).ready(function (){
					jQuery('.minicolors').each(function() {
						jQuery(this).minicolors({
							control: jQuery(this).attr('data-control') || 'hue',
							position: jQuery(this).attr('data-position') || 'right',
							theme: 'bootstrap'
						});
					});
				});
			"
		);

		static::$loaded[__METHOD__] = true;
	}

	/**
	 * Add unobtrusive JavaScript support for a simple color picker.
	 *
	 * @return  void
	 *
	 * @since   3.1
	 */
	public static function simplecolorpicker()
	{
		// Only load once
		if (isset(static::$loaded[__METHOD__]))
		{
			return;
		}

		// Include jQuery
		vHtml::_('jquery.framework');

		vHtml::_('script', 'jui/jquery.simplecolors.min.js', false, true);
		vHtml::_('stylesheet', 'jui/jquery.simplecolors.css', false, true);
		vFactory::getDocument()->addScriptDeclaration("
				jQuery(document).ready(function (){
					jQuery('select.simplecolors').simplecolors();
				});
			"
		);

		static::$loaded[__METHOD__] = true;
	}

	/**
	 * Highlight some words via Javascript.
	 *
	 * @param   array   $terms      Array of words that should be highlighted.
	 * @param   string  $start      ID of the element that marks the begin of the section in which words
	 *                              should be highlighted. Note this element will be removed from the DOM.
	 * @param   string  $end        ID of the element that end this section.
	 *                              Note this element will be removed from the DOM.
	 * @param   string  $className  Class name of the element highlights are wrapped in.
	 * @param   string  $tag        Tag that will be used to wrap the highlighted words.
	 *
	 * @return  void
	 *
	 * @since   2.5
	 */
	public static function highlighter(array $terms, $start = 'highlighter-start', $end = 'highlighter-end', $className = 'highlight', $tag = 'span')
	{
		$sig = md5(serialize(array($terms, $start, $end)));

		if (isset(static::$loaded[__METHOD__][$sig]))
		{
			return;
		}

		// Include core
		static::core();

		// Include jQuery
		vHtml::_('jquery.framework');

		vHtml::_('script', 'system/highlighter.js', false, true);

		$terms = str_replace('"', '\"', $terms);

		$document = vFactory::getDocument();
		$document->addScriptDeclaration("
			jQuery(function ($) {
				var start = document.getElementById('" . $start . "');
				var end = document.getElementById('" . $end . "');
				if (!start || !end || !Joomla.Highlighter) {
					return true;
				}
				highlighter = new Joomla.Highlighter({
					startElement: start,
					endElement: end,
					className: '" . $className . "',
					onlyWords: false,
					tag: '" . $tag . "'
				}).highlight([\"" . implode('","', $terms) . "\"]);
				$(start).remove();
				$(end).remove();
			});
		");

		static::$loaded[__METHOD__][$sig] = true;

		return;
	}

	/**
	 * Break us out of any containing iframes
	 *
	 * @return  void
	 *
	 * @since   1.5
	 */
	public static function noframes()
	{
		// Only load once
		if (isset(static::$loaded[__METHOD__]))
		{
			return;
		}

		// Include core
		static::core();

		// Include jQuery
		vHtml::_('jquery.framework');

		$js = "jQuery(function () {if (top == self) {document.documentElement.style.display = 'block'; }" .
			" else {top.location = self.location; }});";
		$document = vFactory::getDocument();
		$document->addStyleDeclaration('html { display:none }');
		$document->addScriptDeclaration($js);

		vFactory::getApplication()->setHeader('X-Frame-Options', 'SAMEORIGIN');

		static::$loaded[__METHOD__] = true;
	}

	/**
	 * Internal method to translate the JavaScript Calendar
	 *
	 * @return  string  JavaScript that translates the object
	 *
	 * @since   1.5
	 */
	protected static function calendartranslation()
	{
		static $jsscript = 0;

		// Guard clause, avoids unnecessary nesting
		if ($jsscript)
		{
			return false;
		}

		$jsscript = 1;

		// To keep the code simple here, run strings through vmText::_() using array_map()
		$callback = array('vmText','_');
		$weekdays_full = array_map(
			$callback, array(
				'SUNDAY', 'MONDAY', 'TUESDAY', 'WEDNESDAY', 'THURSDAY', 'FRIDAY', 'SATURDAY', 'SUNDAY'
			)
		);
		$weekdays_short = array_map(
			$callback,
			array(
				'SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN'
			)
		);
		$months_long = array_map(
			$callback, array(
				'JANUARY', 'FEBRUARY', 'MARCH', 'APRIL', 'MAY', 'JUNE',
				'JULY', 'AUGUST', 'SEPTEMBER', 'OCTOBER', 'NOVEMBER', 'DECEMBER'
			)
		);
		$months_short = array_map(
			$callback, array(
				'JANUARY_SHORT', 'FEBRUARY_SHORT', 'MARCH_SHORT', 'APRIL_SHORT', 'MAY_SHORT', 'JUNE_SHORT',
				'JULY_SHORT', 'AUGUST_SHORT', 'SEPTEMBER_SHORT', 'OCTOBER_SHORT', 'NOVEMBER_SHORT', 'DECEMBER_SHORT'
			)
		);

		// This will become an object in Javascript but define it first in PHP for readability
		$today = " " . vmText::_('JLIB_HTML_BEHAVIOR_TODAY') . " ";
		$text = array(
			'INFO'           => vmText::_('JLIB_HTML_BEHAVIOR_ABOUT_THE_CALENDAR'),
			'ABOUT'          => "DHTML Date/Time Selector\n"
				. "(c) dynarch.com 2002-2005 / Author: Mihai Bazon\n"
				. "For latest version visit: http://www.dynarch.com/projects/calendar/\n"
				. "Distributed under GNU LGPL.  See http://gnu.org/licenses/lgpl.html for details."
				. "\n\n"
				. vmText::_('JLIB_HTML_BEHAVIOR_DATE_SELECTION')
				. vmText::_('JLIB_HTML_BEHAVIOR_YEAR_SELECT')
				. vmText::_('JLIB_HTML_BEHAVIOR_MONTH_SELECT')
				. vmText::_('JLIB_HTML_BEHAVIOR_HOLD_MOUSE'),
			'ABOUT_TIME'      => "\n\n"
				. "Time selection:\n"
				. "- Click on any of the time parts to increase it\n"
				. "- or Shift-click to decrease it\n"
				. "- or click and drag for faster selection.",
			'PREV_YEAR'       => vmText::_('JLIB_HTML_BEHAVIOR_PREV_YEAR_HOLD_FOR_MENU'),
			'PREV_MONTH'      => vmText::_('JLIB_HTML_BEHAVIOR_PREV_MONTH_HOLD_FOR_MENU'),
			'GO_TODAY'        => vmText::_('JLIB_HTML_BEHAVIOR_GO_TODAY'),
			'NEXT_MONTH'      => vmText::_('JLIB_HTML_BEHAVIOR_NEXT_MONTH_HOLD_FOR_MENU'),
			'SEL_DATE'        => vmText::_('JLIB_HTML_BEHAVIOR_SELECT_DATE'),
			'DRAG_TO_MOVE'    => vmText::_('JLIB_HTML_BEHAVIOR_DRAG_TO_MOVE'),
			'PART_TODAY'      => $today,
			'DAY_FIRST'       => vmText::_('JLIB_HTML_BEHAVIOR_DISPLAY_S_FIRST'),
			'WEEKEND'         => vFactory::getLanguage()->getWeekEnd(),
			'CLOSE'           => vmText::_('JLIB_HTML_BEHAVIOR_CLOSE'),
			'TODAY'           => vmText::_('JLIB_HTML_BEHAVIOR_TODAY'),
			'TIME_PART'       => vmText::_('JLIB_HTML_BEHAVIOR_SHIFT_CLICK_OR_DRAG_TO_CHANGE_VALUE'),
			'DEF_DATE_FORMAT' => "%Y-%m-%d",
			'TT_DATE_FORMAT'  => vmText::_('JLIB_HTML_BEHAVIOR_TT_DATE_FORMAT'),
			'WK'              => vmText::_('JLIB_HTML_BEHAVIOR_WK'),
			'TIME'            => vmText::_('JLIB_HTML_BEHAVIOR_TIME')
		);

		return 'Calendar._DN = ' . json_encode($weekdays_full) . ';'
			. ' Calendar._SDN = ' . json_encode($weekdays_short) . ';'
			. ' Calendar._FD = 0;'
			. ' Calendar._MN = ' . json_encode($months_long) . ';'
			. ' Calendar._SMN = ' . json_encode($months_short) . ';'
			. ' Calendar._TT = ' . json_encode($text) . ';';
	}

	/**
	 * Add unobtrusive JavaScript support to keep a tab state.
	 *
	 * Note that keeping tab state only works for inner tabs if in accordance with the following example
	 * parent tab = permissions
	 * child tab = permission-<identifier>
	 *
	 * Each tab header "a" tag also should have a unique href attribute
	 *
	 * @return  void
	 *
	 * @since   3.2
	 */
	public static function tabstate()
	{
		if (isset(self::$loaded[__METHOD__]))
		{
			return;
		}
		// Include jQuery
		vHtml::_('jquery.framework');
		vHtml::_('script', 'system/tabs-state.js', false, true);
		self::$loaded[__METHOD__] = true;
	}
}
