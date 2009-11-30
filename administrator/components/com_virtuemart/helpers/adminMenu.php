<?php
/**
 * Administrator menu helper class
 *
 * This class was derived from the show_image_in_imgtag.php and imageTools.class.php files in VM.  It provides some
 * image functions that are used throughout the VirtueMart shop.
 *
 * @package	VirtueMart
 * @subpackage Helpers
 * @author RickG
 * @copyright Copyright (c) 2004-2008 Soeren Eberhardt-Biermann, 2009 VirtueMart Team. All rights reserved.
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

/**
 * Administration ribbon menu helper
 *
 * @package		VirtueMart
 * @subpackage Helpers
 * @author RickG 
 */
class AdminMenuHelper
{
	 /**
      * Start the administrator area table
      *
      * The entire administrator area with contained in a table which include the admin ribbon menu
      * in the left column and the content in the right column.  This function sets up the table and
      * displayes the admin menu in the left column.
      */
	function startAdminArea()
	{	
	    $document = JFactory::getDocument();
	    $document->addStyleSheet(JURI::base().'components/com_virtuemart/assets/css/admin_menu.css');
		$document->addStyleSheet(JURI::base().'components/com_virtuemart/assets/css/admin_styles.css');	    
        $document->addStyleSheet(JURI::base().'components/com_virtuemart/assets/css/toolbar_images.css');
		$document->addStyleSheet(JURI::base().'components/com_virtuemart/assets/css/menu_images.css'); 		 		
		?>	
		<table style="width:100%; table-layout:fixed;">
    	<tr>
        <td style="vertical-align:top;">            
            <?php AdminMenuHelper::showAdminMenu(); ?>
        </td>
        <td id="vmPage" style="width:78%;vertical-align:top;">
		<?php 
	}
	
	
    /**
     * Close out the adminstrator area table.
     * @author RickG, Max Milbers
     */	
	function endAdminArea()
	{	
		if (VmConfig::getVar('debug') == '1') {
			include(PAGEPATH."shop.debug.php");
		}
		?>
	    	</td>
    	</tr>
		</table>
		<?php 
	}	
	
		
	
    /**
    * Display the administrative ribbon menu.
    * @todo The link should be done better
    */
    function showAdminMenu()
    {
        $document	= JFactory::getDocument();
        $moduleId   = JRequest::getInt('module_id', 0);
    	
        $document->addScript(JURI::base().'components/com_virtuemart/assets/js/admin_menu/admin_menu.js');
        $document->addScript(JURI::base().'components/com_virtuemart/assets/js/admin_menu/nifty.js');
        $document->addScript(JURI::base().'components/com_virtuemart/assets/js/admin_menu/fat.js');
        $document->addScript(JURI::base().'components/com_virtuemart/assets/js/admin_menu/functions.js');       
        
        $menuItems = adminMenuHelper::_getAdminMenu($moduleId);
        
        ?>
        <div id="vmMenu">
        <div id="content-box2">
        <div id="content-pad">
            <div class="sidemenu-box">
                <div class="sidemenu-pad">
		            <center>
		            <?php
		            //TODO The link should be done better
		            echo JHTML::_('link', 'http://virtuemart.org', JHTML::_('image', JURI::base().'components/com_virtuemart/assets/images/vm_menulogo.png', 'Virtuemart'), array('target' => '_blank'));
		            ?>
			        <h2><?php echo JText::_('VM_ADMIN')	?></h2>
		            </center>
		            <div class="status-divider">
		            </div>
		            <div class="sidemenu" id="masterdiv2">
		            <?php
		            $modCount = 1;
		            foreach( $menuItems as $item ) { ?> 
			            <h3 class="title-smenu" title="<?php echo JText::_($item['title']); ?> admin" ><?php echo JText::_($item['title']) ?></h3>
			            <div class="section-smenu">
			                <ul><?php 			
			                foreach( $item['items'] as $link ) {
				                if( $link['name'] == '-' ) {?>
					                <li>
					                <hr>
					                </li><?php 
				                }
				                else { 
				                    if (strncmp($link['link'], 'http', 4 ) === 0) {
				                        $url = $link['link'];
				                    }
				                    else {
				                    	if ($link['view']) {			                       				                      
				                        	$url = 'index.php?option=com_virtuemart&view='.$link['view'];
					                    	$url .= $link['task'] ? "&task=".$link['task'] : '';
					                    	// $url .= $link['extra'] ? $link['extra'] : '';
					                    	$url = strncmp($link['view'], 'http', 4 ) === 0 ? $link['view'] : $url;
					                	}
					                    else {
				                        	$url = 'index2.php?option=com_virtuemart&pshop_mode=admin&'.$link['link'];
				                    	}
				                    }
					                ?>
					                <li class="item-smenu vmicon <?php echo $link['icon_class']; ?>">
					                    <a href="<?php echo $url; ?>"><?php echo JText::_($link['name']) ? JText::_($link['name']) : JText::_($link['name']); ?></a>
					                </li><?php 
				                }
			                } ?>
			                </ul>
			            </div>
			            <?php $modCount++;
		            } ?>
		            </div>
	                <div style="text-align:center;">
	                    <h5><?php echo JText::_('VM_YOUR_VERSION') ?></h5>
	                    <?php $release = VmConfig::getVar('version_release'); ?>
	                    <a href="http://virtuemart.org/index2.php?option=com_versions&amp;catid=1&amp;myVersion=<?php echo $release ?>" onclick="javascript:void window.open(this.href, 'win2', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=580,directories=no,location=no'); return false;" title="<?php echo JText::_('VM_VERSIONCHECK_TITLE') ?>" target="_blank">
	                    <?php
	                    	echo 'Virtuemart&nbsp;'. $release . '&nbsp;' . VmConfig::getVar('version_dev_status');
	                    ?>
	                    </a>
	                </div>
                </div>
            </div>
        </div>
        </div>
        </div>
   
        <?php 
        echo '<script type="text/javascript">
	    window.onload=function(){
		    Fat.fade_all();
		    NiftyCheck();
		    Rounded("div.sidemenu-box","all","#fff","#f7f7f7","border #ccc");
		    Rounded("div.element-box","all","#fff","#fff","border #ccc");
		    Rounded("div.toolbar-box","all","#fff","#fbfbfb","border #ccc");
		    Rounded("div.submenu-box","all","#fff","#f2f2f2","border #ccc");
	    }
        </script>';                     
    }     
    
    
    /**
     * Build an array containing all the menu items.
     *
     * @param int $moduleId Id of the module to filter on
     */
    function _getAdminMenu($moduleId=0) 
    {
	    $db		=& JFactory::getDBO();
	    $menuArr = array();
		        
	    $filter[] = "jmmod.module_publish='Y'";
	    $filter[] = "item.published='1'";
	    $filter[] = "jmmod.is_admin='1'";
	    if( !empty($moduleId)) {
			$filter[] = 'vmmod.module_id='.(int)$moduleId; 
		}
					
	    $query = 'SELECT `jmmod`.`module_id`, `module_name`, `module_perms`, `id`, `name`, `link`, `depends`, `icon_class`, `view`, `task`'; 
		$query .= 'FROM `#__vm_module` jmmod ';
		$query .= 'LEFT JOIN `#__vm_menu_admin` item ON `jmmod`.`module_id`=`item`.`module_id` ';
		$query .= 'WHERE  ' . implode(' AND ', $filter ) . ' ';
		$query .= 'ORDER BY `jmmod`.`list_order`, `item`.`ordering`';	
	    $db->setQuery($query);
	    $result = $db->loadObjectList();

		for ($i=0, $n=count( $result ); $i < $n; $i++) {
			$row =& $result[$i];
		    $menuArr[$row->module_name]['title'] = 'VM_'.strtoupper($row->module_name).'_MOD';
			$menuArr[$row->module_name]['items'][] = array('name' => $row->name,
														   'link' => $row->link,
														   'depends' => $row->depends,
														   'icon_class' => $row->icon_class,
														   'view' => $row->view,
														   'task' => $row->task);																											   
		}
		
	    return $menuArr;
    }    
        

}

?>