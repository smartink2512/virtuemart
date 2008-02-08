<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
/**
* This file contains the mainframe class for VirtueMart
*
* @version $Id$
* @package VirtueMart
* @subpackage classes
* @copyright Copyright (C) 2007 soeren - All rights reserved.
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
		$_SESSION['userstate'] = '';
	}
	/**
	 * Gets a user state.
	 *
	 * @access	public
	 * @param	string	The path of the state.
	 * @return	mixed	The user state.
	 */
	function getUserState( $key ) 	{
		if( isset($_SESSION['userstate'][$key]) && !is_null($_SESSION['userstate'][$key])) {
			return $_SESSION['userstate'][$key];
		}
		return null;
	}

	/**
	* Sets the value of a user state variable.
	*
	* @access	public
	* @param	string	The path of the state.
	* @param	string	The value of the variable.
	* @return	mixed	The previous state, if one existed.
	*/
	function setUserState( $key, $value ) {
		 $_SESSION['userstate'][$key] = $value;
	}

	/**
	 * Gets the value of a user state variable.
	 *
	 * @access	public
	 * @param	string	The key of the user state variable.
	 * @param	string	The name of the variable passed in a request.
	 * @param	string	The default value for the variable if not found. Optional.
	 * @param	string	Filter for the variable, for valid values see {@link JFilterInput::clean()}. Optional.
	 * @return	The request user state.
	 */
	function getUserStateFromRequest( $key, $request, $default = null, $type = 'none' ) {
		$old_state = $this->getUserState( $key );
		$cur_state = (!is_null($old_state)) ? $old_state : $default;
		$new_state = vmRequest::getVar($request, null, 'default', $type);

		// Save the new value only if it was set in this request
		if ($new_state !== null) {
			$this->setUserState($key, $new_state);
		} else {
			$new_state = $cur_state;
		}

		return $new_state;
	}
	 /**
	 * Adds a linked script to the page
	 *
	 * @param	string  $url		URL to the linked script
	 * @param	string  $type		Type of script. Defaults to 'text/javascript'
	 * @access   public
	 */
	function addScript($url, $type="text/javascript") {
		if( vmIsJoomla('1.0') && strstr($_SERVER['PHP_SELF'],'index3.php')) {
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
		if( vmIsJoomla('1.0') && strstr($_SERVER['PHP_SELF'],'index3.php')) {
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
		if( vmIsJoomla('1.0') && (strstr($_SERVER['PHP_SELF'],'index3.php') || strstr($_SERVER['PHP_SELF'],'index2.php')) ) {
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
		if( vmIsJoomla('1.0') && strstr($_SERVER['PHP_SELF'],'index3.php')) {
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
	function errorAlert( $text, $action='window.history.go(-1);', $mode=1 ) {
		global $mainframe, $mosConfig_live_site;
	
		$text = nl2br( $text );
		$text = str_replace( '\'', "\'", $text );
		$text = strip_tags( $text );
	
		switch ( $mode ) {
			case 2:
				echo '<script type="text/javascript">'.$action."</script> \n";
				break;
	
			case 1:
			default:
				echo '<script type="text/javascript">alert(\''.$text.'\');'. $action."</script> \n";
				echo '<noscript>';
				echo "<h2>$text</h2>\n<br /><a href=\"$mosConfig_live_site\">$mosConfig_live_site</a>";
				echo '</noscript>';
				break;
		}
	
		$this->close(true);
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
		if( isset( $_REQUEST['usefetchscript'])) {
			$use_fetchscript = vmRequest::getBool( 'usefetchscript', 1 );
			vmRequest::setVar( 'usefetchscript', $use_fetchscript, 'session' );
		} else {
			$use_fetchscript = vmRequest::getBool( 'usefetchscript', 1, 'session' );
		}
		// Gather all the linked Scripts into ONE link
		$i = 0;
		$appendix = '';
		$otherscripts = array();
		foreach( $this->_scripts as $src => $type ) {
			$urlpos = strpos( $src, '?' );			
			$url_params = '';
			
			if( $urlpos ) {
				$url_params = '&amp;'.substr( $src, $urlpos );
				$src = substr( $src, 0, $urlpos);
			}
			if( stristr( $src, VM_COMPONENT_NAME ) && !stristr( $src, '.php' ) && $use_fetchscript) {
				$base_source = str_replace( $GLOBALS['real_mosConfig_live_site'], '', $src );
				$base_source = str_replace( $GLOBALS['mosConfig_live_site'], '', $base_source );
				$base_source = str_replace( '/components/'.VM_COMPONENT_NAME, '', $base_source);
				$base_source = str_replace( 'components/'.VM_COMPONENT_NAME, '', $base_source);
				$appendix .= '&amp;subdir['.$i.']='.dirname( $base_source ) . '&amp;file['.$i.']=' . basename( $src );
				$i++;
			} else {
				$otherscripts[] = array('type'=>$type, 'src'=>$src);
			}
		}
		if( $i> 0 ) {
			$src = $mosConfig_live_site.'/components/'.VM_COMPONENT_NAME.'/fetchscript.php?gzip='.$mosConfig_gzip;
			$src .= $appendix;
			
			$mainframe->addCustomHeadTag( '<script src="'.$src.@$url_params.'" type="text/javascript"></script>' );
		}
		foreach( $otherscripts as $otherscript ) {
			$mainframe->addCustomHeadTag('<script type="'.$otherscript['type'].'" src="'.$otherscript['src'].'"></script>');
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
			if( stristr( $stylesheet['url'], VM_COMPONENT_NAME ) && !stristr( $stylesheet['url'], '.php' ) && $stylesheet['media'] == null && $use_fetchscript ) {
				$base_source = str_replace( $GLOBALS['real_mosConfig_live_site'], '', $stylesheet['url'] );
				$base_source = str_replace( $GLOBALS['mosConfig_live_site'], '', $base_source );
				$base_source = str_replace( '/components/'.VM_COMPONENT_NAME, '', $base_source);
				$base_source = str_replace( 'components/'.VM_COMPONENT_NAME, '', $base_source);
				$appendix .= '&amp;subdir['.$i.']='.dirname( $base_source ) . '&amp;file['.$i.']=' . basename( $stylesheet['url'] );
				$i++;
			} else {
				$mainframe->addCustomHeadTag('<link type="'.$stylesheet['mime'].'" href="'.$stylesheet['url'].'" rel="stylesheet"'.(!empty($stylesheet['media'])?' media="'.$stylesheet['media'].'"':'').' />');
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
			
			if( !empty( $this->_response_scripts )) {
				echo vmCommonHTML::scriptTag('', implode("\n", $this->_response_scripts ));
			}
			if( is_callable( array( $mainframe, 'close' ) ) ) {				
				$mainframe->close();
			} else {
				session_write_close();
				exit;
			}
		}
	}

	/**
	 * Appends items to the CMS pathway
	 *
	 * @param	string  $pathway_items	Array of pathway objects ($name, $link)
	 * @access   public
	 */
	function vmAppendPathway( $pathway ) {
		global $mainframe;
		
		// Remove the link on the last pathway item
		$pathway[ count($pathway) - 1 ]->link = '';

		if( vmIsJoomla(1.5) ) {
			$cmsPathway =& $mainframe->getPathway();
			foreach( $pathway AS $item) {
				$cmsPathway->addItem( $item->name, basename($item->link) );
			}
		} else {
			$tpl = vmTemplate::getInstance();
			$tpl->set( 'pathway', $pathway );
			$vmPathway = $tpl->fetch( 'common/pathway.tpl.php' );
			$mainframe->appendPathWay( $vmPathway );
		}
	}
	function setPageTitle( $title ) {
		global $mainframe;
		$title = strip_tags(str_replace('&nbsp;',' ', $title));
		$title = trim($title);
		if( defined( '_VM_IS_BACKEND')) {
			echo vmCommonHTML::scriptTag('', "//<![CDATA[
			var vm_page_title=\"".str_replace('"', '\"', $title )."\";
			try{ parent.document.title = vm_page_title; } catch(e) { document.title =vm_page_title; } 
			//]]>
			");
			
		}
		elseif( vmIsJoomla(1.5) ) {
			$document=& JFactory::getDocument();
			$document->setTitle($title);
		} else {
			$mainframe->setPageTitle( $title );
		}
	}

	/**
	 * Returns a pathway item
	 *
	 * @param	string	$name
	 * @param	string	$link
	 * @access   public
	 * @return	object	A pathway item object
	 */
	function vmPathwayItem( $name, $link = '' ) {
		$item = new stdClass();
		$item->name = vmHtmlEntityDecode( $name );
		$item->link = $link;
		
		return $item;
	}
	
}