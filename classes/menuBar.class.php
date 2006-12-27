<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
*
* @version $Id: menuBar.class.php 577 2006-12-15 21:27:06Z soeren_nb $
* @package VirtueMart
* @subpackage classes
* @copyright Copyright (C) 2004-2005 Soeren Eberhardt. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/
if( !class_exists( "mosMenuBar")) {
	require_once( $mosConfig_absolute_path."/administrator/includes/menubar.html.php" );
}

if( !class_exists('jtoolbar')) {
	class JToolBar {
		function &getInstance($text) {
			$tb = new JToolBar();
			return $tb;
		}
		function appendButton( $type, $html ) {
			echo $html;
		}
	}
}

class vmMenuBar extends mosMenuBar {

	/**
	* Writes the common 'new' icon for the button bar
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	function addNew( $task='new', $page, $alt='', $formName="adminForm" ) {
		global $VM_LANG;
		if( $alt == '') {
			$alt = $VM_LANG->_CMN_NEW;
		}
		$bar =& JToolBar::getInstance('JComponent');
		
		$bar->appendButton('Custom', '<td>
			<a class="toolbar" href="javascript:vm_submitButton(\''.$task.'\',\''.$formName.'\',\''.$page.'\');">'
			. '<div class="vmicon-32-'. $task.'" type="Standard"></div>'
			. $alt
		.'</a>
		</td>');

	}
	/**
	* Writes a save button for a given option
	* Save operation leads to a save and then close action
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	function save( $task='save', $alt='' ) {
		global $VM_LANG;
		if( $alt == '') {
			$alt = $VM_LANG->_CMN_SAVE;
		}
		$bar =& JToolBar::getInstance('JComponent');
		
		$bar->appendButton('Custom', '<td class="button">
		<a class="toolbar" href="javascript:submitbutton(\''. $task.'\');">
		<div class="vmicon-32-'. $task.'" type="Standard"></div>'
		. $alt .'
		</a>
		</td>' );
		
	}
	
	/**
	* Writes a save button for a given option
	* Save operation leads to a save and then close action
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	function apply( $task='apply', $alt='' ) {
		global $page, $VM_LANG;
		if( $alt == '') {
			$alt = $VM_LANG->_E_APPLY;
		}
		$bar =& JToolBar::getInstance('JComponent');
		
		$bar->appendButton('Custom', "<td>
		<a class=\"toolbar\" href=\"javascript:vm_submitButton('$task', 'adminForm', '$page');\">
		<div class=\"vmicon-32-$task\" type=\"Standard\"></div>
		$alt</a>
		</td>" );
		
	}
	/**
	* Writes a common 'publish' button for a list of records
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	function publishList( $func, $task='publish', $alt='Publish' ) {
		global $VM_LANG;

		$bar =& JToolBar::getInstance('JComponent');
		
     	$bar->appendButton( 'Custom', '<td>
		<a class="toolbar" href="javascript:if (document.adminForm.boxchecked.value == 0){ alert(\'Please make a selection from the list to publish\'); } else {vm_submitListFunc(\''. $task. '\', \'adminForm\', \''. $func .'\');}" >
		<div class="vmicon-32-'. $task.'" type="Standard"></div>'
		 . $alt .'
		</a>
		</td>' );
     	
	}
	/**
	* Writes a common 'unpublish' button for a list of records
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	function unpublishList( $func, $task='unpublish', $alt='Unpublish' ) {

		$bar =& JToolBar::getInstance('JComponent');
		
     	$bar->appendButton( 'Custom', '<td>
		<a class="toolbar" href="javascript:if (document.adminForm.boxchecked.value == 0){ alert(\'Please make a selection from the list to unpublish\'); } else {vm_submitListFunc(\''. $task. '\', \'adminForm\', \''. $func .'\');}" >
		<div class="vmicon-32-'. $task.'" type="Standard"></div>'
		 . $alt .'
		</a>
		</td>' );
	}
	/**
	* Writes a common 'delete' button for a list of records
	* @param string  Postscript for the 'are you sure' message
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	function deleteList( $func, $task='remove', $alt='' ) {
		global $VM_LANG;
		if( $alt == '') {
			$alt = $VM_LANG->_E_REMOVE;
		}
		$bar =& JToolBar::getInstance('JComponent');
		
		$bar->appendButton( 'Custom', '<td><a class="toolbar" href="javascript:if (document.adminForm.boxchecked.value == 0){ alert(\'Please make a selection from the list to delete\'); } else if (confirm(\'Are you sure you want to delete selected items?\')){ vm_submitListFunc(\''. $task.'\', \'adminForm\', \''. $func.'\' );}">
			<div class="vmicon-32-'. $task.'" type="Standard"></div>'
			. $alt .'
		</a></td>' );
		
	}
	
	/**
	* Writes a cancel button and invokes a cancel operation (eg a checkin)
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	function cancel( $task='cancel', $alt='' ) {
		global $page, $VM_LANG;
		if( $alt == '') {
			$alt = $VM_LANG->_CMN_CANCEL;
		}
		$no_menu = mosGetParam( $_REQUEST, 'no_menu' );
		$bar =& JToolBar::getInstance('JComponent');
		
		if ($page == "store.store_form") { $my_page = "store.index"; }
		elseif ($page == "admin.user_address_form") { $my_page = "admin.user_list"; }
		elseif ($page == "admin.show_cfg") { $my_page = "store.index"; }
		else { $my_page = str_replace('form','list',$page); }
		
		
		if( $no_menu ) {
			$js = "vm_windowClose();";
		}
		else {
			$js = "vm_submitButton('$task', 'adminForm', '$my_page');";
		}
		$bar->appendButton( 'Custom', "<td>
			<a class=\"toolbar\" href=\"javascript:$js\" >
			 <div class=\"vmicon-32-$task\" type=\"Standard\"></div>
			$alt</a>
		</td>" );
		
	}
	
	/**
	* Writes a custom option and task button for the button bar
	* @param string The task to perform (picked up by the switch($task) blocks
	* @param string The image to display (FULL URL!)
	* @param string The image to display when moused over
	* @param string The alt text for the icon image
	* @param boolean True if required to check that a standard list item is checked
	*/
	function custom( $task='', $page, $icon='', $iconOver='', $alt='', $listSelect=true, $formName="adminForm", $func = "" ) {
		$bar =& JToolBar::getInstance('JComponent');
		if ($listSelect) {
			if( empty( $func ))
				$href = "javascript:if (document.adminForm.boxchecked.value == 0){ alert('Please make a selection from the list to $alt');}else{vm_submitButton('$task','$formName', '$page')}";
			else
				$href = "javascript:if (document.adminForm.boxchecked.value == 0){ alert('Please make a selection from the list to $alt');}else{vm_submitListFunc('$task','$formName', '$func')}";
                } else {
                        $href = "javascript:vm_submitButton('$task','$formName', '$page')";
                }
                if( empty( $task )) {
                        $image_name = uniqid( "img_" );
                }
                else {
                        $image_name  = $task;
                }
                if ($icon && $iconOver) {
					$bar->appendButton('Custom', "<td>
						<a class=\"toolbar\" href=\"$href\" onmouseout=\"MM_swapImgRestore();\"  onmouseover=\"MM_swapImage('$image_name','','$iconOver',1);\">
						<img name=\"$image_name\" src=\"$icon\" alt=\"$alt\" border=\"0\" align=\"middle\" />
						&nbsp;<br/>$alt</a>
						</td>" );
			
		} 
		else {
			// The button is just a link then!
			$bar->appendButton('Custom', "<td><a class=\"toolbar\" href=\"$href\">&nbsp;$alt</a></td>" );
		}
	}
		/**
	* Writes a link for the button bar
	* @param string The task to perform (picked up by the switch($task) blocks
	* @param string The image to display (FULL URL!)
	* @param string The image to display when moused over
	* @param string The alt text for the icon image
	* @param boolean True if required to check that a standard list item is checked
	*/
	function customHref( $href='', $icon='', $iconOver='', $alt='' ) {
		$bar =& JToolBar::getInstance('JComponent');
		if ($icon && $iconOver) {
			$bar->appendButton('Custom', "<td>
			<a class=\"toolbar\" href=\"$href\" onmouseout=\"MM_swapImgRestore();\"  onmouseover=\"MM_swapImage('$alt','','$iconOver',1);\">
			<img name=\"$alt\" src=\"$icon\" alt=\"$alt\" border=\"0\" align=\"middle\" />
			&nbsp;<br/>$alt</a></td>" );
			
		}
		else {
			$bar->appendButton('Custom', "<td><a class=\"toolbar\" href=\"$href\">&nbsp;$alt</a></td>" );
		}
	}
}