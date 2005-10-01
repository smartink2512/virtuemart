<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
*
* @version $Id: menuBar.class.php,v 1.5 2005/09/29 20:01:13 soeren_nb Exp $
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
if( !class_exists( "mosMenuBar"))
	require_once( $mosConfig_absolute_path."/administrator/includes/menubar.html.php" );
	
class vmMenuBar extends mosMenuBar {
	
	/**
	* Writes the common 'new' icon for the button bar
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	function addNew( $task='new', $page, $alt='New', $formName="adminForm" ) {
		$image = mosAdminMenus::ImageCheckAdmin( 'new.png', '/administrator/images/', NULL, NULL, $alt, "new" );
		$image2 = mosAdminMenus::ImageCheckAdmin( 'new_f2.png', '/administrator/images/', NULL, NULL, $alt, "new", 0 );
		
		echo '<td>
			<a class="toolbar" href="javascript:vm_submitButton(\''.$task.'\',\''.$formName.'\',\''.$page.'\');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage(\''. $task. '\',\'\',\''. $image2 .'\',1);">'
			. $image.'<br/>'
			. $alt
		.'</a>
		</td>';

	}
	/**
	* Writes a save button for a given option
	* Save operation leads to a save and then close action
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	function save( $task='save', $alt='Save' ) {
		$image = mosAdminMenus::ImageCheckAdmin( 'save.png', '/administrator/images/', NULL, NULL, $alt, $task );
		$image2 = mosAdminMenus::ImageCheckAdmin( 'save_f2.png', '/administrator/images/', NULL, NULL, $alt, $task, 0 );
		?>
		<td>
		<a class="toolbar" href="javascript:submitbutton('<?php echo $task;?>');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('<?php echo $task;?>','','<?php echo $image2; ?>',1);">
		<?php 
		echo $image.'<br/>';
		echo $alt;?>
		</a>
		</td>
		<?php
	}
	/**
	* Writes a common 'publish' button for a list of records
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	function publishList( $func, $task='publish', $alt='Publish' ) {
		$image = mosAdminMenus::ImageCheckAdmin( 'publish.png', '/administrator/images/', NULL, NULL, $alt, $task );
		$image2 = mosAdminMenus::ImageCheckAdmin( 'publish_f2.png', '/administrator/images/', NULL, NULL, $alt, $task, 0 );
		?>
     	<td>
		<a class="toolbar" href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Please make a selection from the list to publish'); } else {vm_submitListFunc('<?php echo $task;?>', 'adminForm', '<?php echo $func;?>');}" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('<?php echo $task;?>','','<?php echo $image2; ?>',1);">
		<?php 
		echo $image.'<br/>';
		echo $alt; ?>
		</a>
		</td>
     	<?php
	}
	/**
	* Writes a common 'unpublish' button for a list of records
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	function unpublishList( $func, $task='unpublish', $alt='Unpublish' ) {
		$image = mosAdminMenus::ImageCheckAdmin( 'unpublish.png', '/administrator/images/', NULL, NULL, $alt, $task );
		$image2 = mosAdminMenus::ImageCheckAdmin( 'unpublish_f2.png', '/administrator/images/', NULL, NULL, $alt, $task, 0 );
		?>
		<td>
		<a class="toolbar" href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Please make a selection from the list to unpublish'); } else {vm_submitListFunc('<?php echo $task;?>', 'adminForm', '<?php echo $func;?>' );}" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('<?php echo $task;?>','','<?php echo $image2; ?>',1);" >
		<?php 
		echo $image .'<br/>';
		echo $alt; ?>
		</a></td>
		<?php
	}
	/**
	* Writes a common 'delete' button for a list of records
	* @param string  Postscript for the 'are you sure' message
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	function deleteList( $func, $task='remove', $alt='Delete' ) {
		$image = mosAdminMenus::ImageCheckAdmin( 'delete.png', '/administrator/images/', NULL, NULL, $alt, $task );
		$image2 = mosAdminMenus::ImageCheckAdmin( 'delete_f2.png', '/administrator/images/', NULL, NULL, $alt, $task, 0 );
		?>
		<td><a class="toolbar" href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Please make a selection from the list to delete'); } else if (confirm('Are you sure you want to delete selected items?')){ vm_submitListFunc('<?php echo $task;?>', 'adminForm', '<?php echo $func;?>' );}" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('<?php echo $task;?>','','<?php echo $image2; ?>',1);">
		<?php 
		echo $image .'<br/>';
		echo $alt; ?>
		</a></td>
		<?php
	}
	
	/**
	* Writes a cancel button and invokes a cancel operation (eg a checkin)
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	function cancel( $task='cancel', $alt='Cancel' ) {
		global $page;

		if ($page == "store.store_form")
			$my_page = "store.index";
		elseif ($page == "admin.user_address_form")
			$my_page = "admin.user_list";
		elseif ($page == "admin.show_cfg")
			$my_page = "store.index";
		else
			$my_page = str_replace('form','list',$page);
		
		$image = mosAdminMenus::ImageCheckAdmin( 'cancel.png', '/administrator/images/', NULL, NULL, $alt, $task, 1 );
		$image2 = mosAdminMenus::ImageCheckAdmin( 'cancel_f2.png', '/administrator/images/', NULL, NULL, $alt, $task, 0 );
		?>
		<td>
			<a class="toolbar" href="javascript:vm_submitButton('<?php echo $task;?>', 'adminForm', '<?php echo $my_page ?>');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('<?php echo $task;?>','','<?php echo $image2; ?>',1);">
			<?php 
			echo $image .'<br />';
			echo $alt;?></a>
		</td>
		<?php
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
		if ($listSelect) {
			if( empty( $func ))
				$href = "javascript:if (document.adminForm.boxchecked.value == 0){ alert('Please make a selection from the list to $alt');}else{vm_submitButton('$task','$formName', '$page')}";
			else
				$href = "javascript:if (document.adminForm.boxchecked.value == 0){ alert('Please make a selection from the list to $alt');}else{vm_submitListFunc('$task','$formName', '$func')}";
		} else {
			$href = "javascript:vm_submitButton('$task','$formName', '$page')";
		}
		if( empty( $task ))
			$image_name = uniqid( "img_" );
		else
			$image_name  = $task;
		if ($icon && $iconOver) {
			?>
			<td>
			<a class="toolbar" href="<?php echo $href;?>" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('<?php echo $image_name;?>','','<?php echo $iconOver;?>',1);">
			<img name="<?php echo $image_name;?>" src="<?php echo $icon;?>" alt="<?php echo $alt;?>" border="0" align="middle" />
			&nbsp;<br/>
			<?php echo $alt; ?></a>
			</td>
			<?php
		} 
		else {
			?>
			<td>
			<a class="toolbar" href="<?php echo $href;?>">
			&nbsp;
			<?php echo $alt; ?></a>
			</td>
			<?php
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
		
		if ($icon && $iconOver) {
			?>
			<td>
			<a class="toolbar" href="<?php echo $href;?>" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('<?php echo $alt;?>','','<?php echo $iconOver;?>',1);">
			<img name="<?php echo $alt;?>" src="<?php echo $icon;?>" alt="<?php echo $alt;?>" border="0" align="middle" />
			&nbsp;<br/>
			<?php echo $alt; ?></a>
			</td>
			<?php
		}
		else {
			?>
			<td>
			<a class="toolbar" href="<?php echo $href;?>">
			&nbsp;
			<?php echo $alt; ?></a>
			</td>
			<?php
		}
	}
}