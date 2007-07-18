<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
* This file contains the mainframe class for VirtueMart
*
* @version $Id$
* @package VirtueMart
* @subpackage classes
* @copyright Copyright (C) 2007 Soeren Eberhardt. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/

class vmMainFrame {
	/**
	 * Array of linked scripts
	 * @var		array
	 * @access   private
	 */
	var $_scripts = array();

	/**
	 * Array of scripts placed in the header
	 * @var  array
	 * @access   private
	 */
	var $_script = array();
	/**
	 * Array of scripts meant as a response for an ajax call
	 * @var  array
	 * @access   private
	 */
	var $_response_scripts = array();
	 /**
	 * Array of linked style sheets
	 * @var	 array
	 * @access  private
	 */
	var $_styleSheets = array();

	/**
	 * Array of included style declarations
	 * @var	 array
	 * @access  private
	 */
	var $_style = array();
	
	function vmMainFrame() {
		
	}
	
	 /**
	 * Adds a linked script to the page
	 *
	 * @param	string  $url		URL to the linked script
	 * @param	string  $type		Type of script. Defaults to 'text/javascript'
	 * @access   public
	 */
	function addScript($url, $type="text/javascript") {
		if( vmIsJoomla(1.0) && strstr($_SERVER['PHP_SELF'],'index3.php')) {
			echo vmCommonHTML::scriptTag($url);
			return;
		}
		if( isset($this->_scripts[$url])) return;
		$this->_scripts[$url] = $type;
	}

	/**
	 * Adds a script to the page
	 *
	 * @access   public
	 * @param	string  $content   Script
	 * @param	string  $type		Scripting mime (defaults to 'text/javascript')
	 * @return   void
	 */
	function addScriptDeclaration($content, $type = 'text/javascript') {
		if( vmIsJoomla(1.0) && strstr($_SERVER['PHP_SELF'],'index3.php')) {
			echo vmCommonHTML::scriptTag('', $content);
			return;
		}
		$this->_script[][strtolower($type)] =& $content;
	}

	/**
	 * Adds a linked stylesheet to the page
	 *
	 * @param	string  $url	URL to the linked style sheet
	 * @param	string  $type   Mime encoding type
	 * @param	string  $media  Media type that this stylesheet applies to
	 * @access   public
	 */
	function addStyleSheet($url, $type = 'text/css', $media = null, $attribs = array())
	{
		if( vmIsJoomla(1.0) && strstr($_SERVER['PHP_SELF'],'index3.php')) {
			echo vmCommonHTML::linkTag($url, $type, 'stylesheet', $media );
			return;
		}
		if( isset($this->_styleSheets[$url])) return;
		$this->_styleSheets[$url]['url']		= $url;
		$this->_styleSheets[$url]['mime']		= $type;
		$this->_styleSheets[$url]['media']		= $media;
		$this->_styleSheets[$url]['attribs']	= $attribs;
	}

	 /**
	 * Adds a stylesheet declaration to the page
	 *
	 * @param	string  $content   Style declarations
	 * @param	string  $type		Type of stylesheet (defaults to 'text/css')
	 * @access   public
	 * @return   void
	 */
	function addStyleDeclaration($content, $type = 'text/css') {
		if( vmIsJoomla(1.0) && strstr($_SERVER['PHP_SELF'],'index3.php')) {
			echo '<style type="'.$type.'">'.$content.'</style>';
			return;
		}
		$this->_style[][strtolower($type)] = $content;
	}
	
	function addResponseScript($content) {
		$this->_response_scripts[] = $content;
	}
	
	function scriptRedirect($location) {
		$this->addResponseScript('document.location=\''.$location.'\'');
	}
	
	function render() {
		global $mainframe, $mosConfig_gzip, $mosConfig_live_site;
		
		foreach ( $this->_script as $script ) {
			$mainframe->addCustomHeadTag('<script type="'.key($script).'">'.current($script).'</script>');
		}
		foreach ( $this->_style as $style ) {
			$style = $style[0];
			$mainframe->addCustomHeadTag('<style type="'.key($style).'">'.current($style).'</style>');
		}
		
		// Gather all the linked Scripts into ONE link
		$i = 0;
		$appendix = '';
		foreach( $this->_scripts as $src => $type ) {
			$urlpos = strpos( $src, '?' );			
			$url_params = '';
			
			if( $urlpos ) {
				$url_params = '&amp;'.substr( $src, $urlpos );
				$src = substr( $src, 0, $urlpos);
			}
			if( stristr( $src, VM_COMPONENT_NAME ) && !stristr( $src, '.php' )) {
				$base_source = str_replace( $GLOBALS['real_mosConfig_live_site'], '', $src );
				$base_source = str_replace( $GLOBALS['mosConfig_live_site'], '', $base_source );
				$base_source = str_replace( '/components/'.VM_COMPONENT_NAME, '', $base_source);
				$base_source = str_replace( 'components/'.VM_COMPONENT_NAME, '', $base_source);
				$appendix .= '&amp;subdir['.$i.']='.dirname( $base_source ) . '&amp;file['.$i.']=' . basename( $src );
				$i++;
			} else {
				
				$mainframe->addCustomHeadTag('<script type="'.$type.'" src="'.$src.'"></script>');
			}
		}
		if( $i> 0 ) {
			$src = $mosConfig_live_site.'/components/'.VM_COMPONENT_NAME.'/fetchscript.php?gzip='.$mosConfig_gzip;
			$src .= $appendix;
			
			$mainframe->addCustomHeadTag( '<script src="'.$src.@$url_params.'" type="text/javascript"></script>' );
		}

		// Gather all the linked Stylesheets into ONE link
		$i = 0;
		$appendix = '';			
		$url_params = '';
		foreach( $this->_styleSheets as $stylesheet ) {
			$urlpos = strpos( $stylesheet['url'], '?' );			
			
			if( $urlpos ) {
				$url_params .= '&amp;'.substr( $stylesheet['url'], $urlpos );
				$stylesheet['url'] = substr( $stylesheet['url'], 0, $urlpos);
			}
			if( stristr( $stylesheet['url'], VM_COMPONENT_NAME ) && !stristr( $stylesheet['url'], '.php' ) && $stylesheet['media'] == null ) {
				$base_source = str_replace( $GLOBALS['real_mosConfig_live_site'], '', $stylesheet['url'] );
				$base_source = str_replace( $GLOBALS['mosConfig_live_site'], '', $base_source );
				$base_source = str_replace( '/components/'.VM_COMPONENT_NAME, '', $base_source);
				$base_source = str_replace( 'components/'.VM_COMPONENT_NAME, '', $base_source);
				$appendix .= '&amp;subdir['.$i.']='.dirname( $base_source ) . '&amp;file['.$i.']=' . basename( $stylesheet['url'] );
				$i++;
			} else {
				$mainframe->addCustomHeadTag('<link type="'.$stylesheet['mime'].'" href="'.$stylesheet['url'].'" rel="stylesheet"'.$stylesheet['media']?' media="'.$stylesheet['media'].'"':''.' />');
			}
		}
		if( $i> 0 ) {
			$src = $mosConfig_live_site.'/components/com_virtuemart/fetchscript.php?gzip='.$mosConfig_gzip;
			$src .= $appendix;
			$mainframe->addCustomHeadTag( '<link href="'.$src.@$url_params.'" type="text/css" rel="stylesheet" />' );
		}
	}
	
	function close( $exit=false ) {
		global $mosConfig_live_site, $mainframe;
		if( !$exit ) {
			if( defined( 'vmToolTipCalled')) {
				echo vmCommonHTML::scriptTag( $mosConfig_live_site.'/components/'.VM_COMPONENT_NAME.'/js/wz_tooltip.js' );
			}
			if( defined( '_LITEBOX_LOADED')) {
				echo vmCommonHTML::scriptTag( '', 'var prev_onload = document.body.onload; 
													window.onload = function() { if( prev_onload ) prev_onload(); initLightbox(); }' );
			}
			$this->render();
		} else {
			session_write_close();
			if( !empty( $this->_response_scripts )) {
				echo vmCommonHTML::scriptTag('', implode("\n", $this->_response_scripts ));
			}
			if( is_callable( array( $mainframe, 'close' ) ) ) {				
				$mainframe->close();
			} else {
				exit;
			}
		}
	}
}