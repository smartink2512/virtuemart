<?php
/**
*
* Description
*
* @package	VirtueMart
* @subpackage UpdatesMigration
* @author Max Milbers
* @link http://www.virtuemart.net
* @copyright Copyright (c) 2004 - 2011 VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id$
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

if(!VmConfig::get('dangeroustools', false)){
	$uri = vFactory::getURI();
	$link = $uri->root() . 'administrator/index.php?option=com_virtuemart&view=config';
	?>

	<div class="vmquote" style="text-align:left;margin-left:20px;">
	<span style="font-weight:bold;color:green;"> <?php echo vmText::sprintf('COM_VIRTUEMART_SYSTEM_DANGEROUS_TOOL_ENABLED_JS',vmText::_('COM_VIRTUEMART_ADMIN_CFG_DANGEROUS_TOOLS'),$link) ?></span>
	</div>

	<?php
}

?>
<div id="cpanel">
<table  >
    <tr>


	<td align="left" colspan="2" >
             <h3> <?php echo vmText::_('COM_VIRTUEMART_TOOLS_SYNC_MEDIA_FILES'); ?> </h3>
	</td>


    </tr>
    <tr>
<?php /*	<td align="center">
		<?php $link=JROUTE::_('index.php?option=com_virtuemart&view=updatesmigration&task=installSampleData&'.vRequest::getFormToken().'=1'); ?>
	    <div class="icon"><a onclick="javascript:confirmation('<?php echo vmText::_('COM_VIRTUEMART_UPDATE_INSTALLSAMPLE_CONFIRM'); ?>', '<?php echo $link; ?>');">
		<span class="vmicon48 vm_install_48"></span>
	    <br /><?php echo vmText::_('COM_VIRTUEMART_SAMPLE_DATA'); ?>
		</a></div>
	</td>
	<td align="center">
	    <a href="<?php echo JROUTE::_('index.php?option=com_virtuemart&view=updatesmigration&task=userSync&'.vRequest::getFormToken().'=1'); ?>">
		<span class="vmicon48 vm_shoppers_48"></span>
	    </a>
	    <br /><?php echo vmText::_('COM_VIRTUEMART_SYNC_JOOMLA_USERS'); ?>
		</a></div>
	</td>*/ ?>

 	<td align="center" width="25%">
		<?php $link=JROUTE::_('index.php?option=com_virtuemart&view=updatesmigration&task=portMedia&'.vRequest::getFormToken().'=1' ); ?>
	    <div class="icon"><a onclick="javascript:confirmation('<?php echo vmText::sprintf('COM_VIRTUEMART_UPDATE_MIGRATION_STRING_CONFIRM', vmText::_('COM_VIRTUEMART_MEDIA_S')); ?>', '<?php echo $link; ?>');">
			<span class="vmicon48"></span>
			<br /><?php echo vmText::_('COM_VIRTUEMART_TOOLS_SYNC_MEDIA_FILES'); ?>

		</a></div>
	</td>

    <td align="left" width="25%" >
		<?php echo vmText::sprintf('COM_VIRTUEMART_TOOLS_SYNC_MEDIAS_EXPLAIN',VmConfig::get('media_product_path') ,VmConfig::get('media_category_path') , VmConfig::get('media_manufacturer_path')); ?>
    </td>

    </tr>
  <tr>
	  <td align="center" width="25%">
		  <?php $link=JROUTE::_('index.php?option=com_virtuemart&view=updatesmigration&task=resetThumbs&'.vRequest::getFormToken().'=1' ); ?>
		  <div class="icon"><a onclick="javascript:confirmation('<?php echo vmText::_('COM_VIRTUEMART_TOOLS_RESTHUMB_CONF'); ?>', '<?php echo $link; ?>');">
				  <span class="vmicon48 vm_cpanel_48"></span>
				  <br /><?php echo vmText::_('COM_VIRTUEMART_TOOLS_RESTHUMB'); ?>

			  </a></div>
	  </td>

	  <td align="left" width="25%" >

		  <?php echo vmText::_('COM_VIRTUEMART_TOOLS_RESTHUMB_TIP'); ?>
	  </td>
    </tr>

    <tr><td align="left" colspan="4"><?php echo vmText::_('COM_VIRTUEMART_UPDATE_MIGRATION_TOOLS_WARNING'); ?></td></tr>
<tr>
    <td align="center">
		<?php $link=JROUTE::_('index.php?option=com_virtuemart&view=updatesmigration&task=refreshCompleteInstall&'.vRequest::getFormToken().'=1' ); ?>
	    <div class="icon"><a onclick="javascript:confirmation('<?php echo addslashes( vmText::_('COM_VIRTUEMART_DELETES_ALL_VM_TABLES_AND_FRESH_CONFIRM_JS') ); ?>', '<?php echo $link; ?>');">
		<span class="vmicon48"></span>
	    <br />
            <?php echo vmText::_('COM_VIRTUEMART_DELETES_ALL_VM_TABLES_AND_FRESH'); ?>
		</a></div>
	</td>
	   <td align="center">
		<?php $link=JROUTE::_('index.php?option=com_virtuemart&view=updatesmigration&task=refreshCompleteInstallAndSample&'.vRequest::getFormToken().'=1' ); ?>
	    <div class="icon"><a onclick="javascript:confirmation('<?php echo addslashes( vmText::_('COM_VIRTUEMART_DELETES_ALL_VM_TABLES_AND_SAMPLE_CONFIRM_JS') ); ?>', '<?php echo $link; ?>');">
		<span class="vmicon48"></span>
	    <br />
            <?php echo vmText::_('COM_VIRTUEMART_DELETES_ALL_VM_TABLES_AND_SAMPLE'); ?>
		</a></div>
	</td>

	   <td align="center">
		<?php $link=JROUTE::_('index.php?option=com_virtuemart&view=updatesmigration&task=updateDatabase&'.vRequest::getFormToken().'=1' ); ?>
	    <div class="icon"><a onclick="javascript:confirmation('<?php echo addslashes( vmText::_('COM_VIRTUEMART_UPDATEDATABASE_CONFIRM_JS') ); ?>', '<?php echo $link; ?>');">
		<span class="vmicon48"></span>
	    <br />
            <?php echo vmText::_('COM_VIRTUEMART_UPDATEDATABASE'); ?>
		</a></div>
	</td>
	<td align="center">

	</td>
    </tr>
    <tr>
		<td align="center">
			<?php $link=JROUTE::_('index.php?option=com_virtuemart&view=updatesmigration&task=restoreSystemDefaults&'.vRequest::getFormToken().'=1'); ?>
			<div class="icon"><a onclick="javascript:confirmation('<?php echo addslashes( vmText::_('COM_VIRTUEMART_UPDATE_RESTOREDEFAULTS_CONFIRM_JS') ); ?>', '<?php echo $link; ?>');">
			<span class="vmicon48 vm_cpanel_48"></span>
			<br /><?php echo vmText::_('COM_VIRTUEMART_UPDATE_RESTOREDEFAULTS'); ?>
			</a></div>
		</td>
		<td align="center">
			<?php $link=JROUTE::_('index.php?option=com_virtuemart&view=updatesmigration&task=deleteVmData&'.vRequest::getFormToken().'=1' ); ?>
			<div class="icon"><a onclick="javascript:confirmation('<?php echo addslashes( vmText::_('COM_VIRTUEMART_UPDATE_REMOVEDATA_CONFIRM_JS') ); ?>', '<?php echo $link; ?>');">
			<span class="vmicon48"></span>
			<br /> <?php echo vmText::_('COM_VIRTUEMART_UPDATE_REMOVEDATA'); ?>
			</a></div>
		</td>
		<td align="center">
			<?php $link=JROUTE::_('index.php?option=com_virtuemart&view=updatesmigration&task=deleteVmTables&'.vRequest::getFormToken().'=1' ); ?>
			<div class="icon"><a onclick="javascript:confirmation('<?php echo addslashes( vmText::_('COM_VIRTUEMART_UPDATE_REMOVETABLES_CONFIRM_JS') ); ?>', '<?php echo $link; ?>');">
			<span class="vmicon48"></span>
			<br />
				<?php echo vmText::_('COM_VIRTUEMART_UPDATE_REMOVETABLES'); ?>
			</a></div>
		</td>

    </tr>
	<tr>
		<td align="center">
			<?php $link=JROUTE::_('index.php?option=com_virtuemart&view=updatesmigration&task=deleteInheritedCustoms&'.vRequest::getFormToken().'=1' ); ?>
			<div class="icon"><a onclick="javascript:confirmation('<?php echo addslashes( vmText::_('COM_VIRTUEMART_UPDATE_DELETE_INHERITEDC') ); ?>', '<?php echo $link; ?>');">
					<span class="vmicon48"></span>
					<br />
					<?php echo vmText::_('COM_VIRTUEMART_UPDATE_DELETE_INHERITEDC'); ?>
				</a></div>
		</td>
		<td align="center">
			<?php $link=JROUTE::_('index.php?option=com_virtuemart&view=updatesmigration&task=fixCustomsParams&'.vRequest::getFormToken().'=1' ); ?>
			<div class="icon"><a onclick="javascript:confirmation('<?php echo addslashes( vmText::_('COM_VIRTUEMART_UPDATE_OLD_CUSTOMFORMAT') ); ?>', '<?php echo $link; ?>');">
					<span class="vmicon48"></span>
					<br />
					<?php echo vmText::_('COM_VIRTUEMART_UPDATE_OLD_CUSTOMFORMAT'); ?>
				</a></div>
		</td>
		<td align="center">
			<?php $link=JROUTE::_('index.php?option=com_virtuemart&view=updatesmigration&task=updateDatabaseJoomla&'.vRequest::getFormToken().'=1' ); ?>
			<div class="icon"><a onclick="javascript:confirmation('<?php echo addslashes( vmText::_('Update Joomla Database') ); ?>', '<?php echo $link; ?>');">
					<span class="vmicon48"></span>
					<br />
					<?php echo vmText::_('Update Joomla Database for pros, use only if you know what you do'); ?>
				</a></div>
		</td>
	</tr>
</table>
</div>
<div>

</div>
<script type="text/javascript">
<!--
function confirmation(message, destnUrl) {
	var answer = confirm(message);
	if (answer) {
		window.location = destnUrl;
	}
}
//-->
</script>