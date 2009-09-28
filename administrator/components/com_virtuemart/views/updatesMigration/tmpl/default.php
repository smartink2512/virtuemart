<?php 
defined('_JEXEC') or die('Restricted access'); 

AdminMenuHelper::startAdminArea();
?>
<form name="adminForm" enctype="multipart/form-data">
<?php

		echo $this->pane->startPane("versionCheckPane");
		echo $this->pane->startPanel( JText::_('VM_PRODUCT_FORM_PRODUCT_INFO_LBL'), 'versionCheckPane' );
		
		$correctTableLink = JROUTE::_('index.php?option=com_virtuemart&controller=updatesMigration&task=correctTable&view=updatesMigration');
?>
      	
		<table class="adminlist">
		  <tr>
		    <th class="title"><?php echo JText::_('VM_UPDATE_CHECK_VERSION_INSTALLED'); ?></th>
		    <th class="title"><?php echo JText::_('VM_UPDATE_CHECK_LATEST_VERSION'); ?></th>
		  </tr>
		  <tr>
		    <td style="color:grey;font-size:18pt;text-align:center;"><?php echo $this->JmVersion ?></td>
		    <td id="updateversioncontainer" >
		    	<img src="<?php echo VM_THEMEURL ?>images/indicator.gif" align="left" alt="<?php echo JText::_('VM_UPDATE_CHECK_CHECKING'); ?>" style="display:none;" id="checkingindicator" />
		    	<input name="checkbutton" id="checkbutton" type="button" value="<?php echo JText::_('VM_UPDATE_CHECK_CHECKNOW'); ?>" onclick="performUpdateCheck();" style="<?php echo $checkbutton_style ?>font-weight:bold;" />
		    	<input name="downloadbutton" id="downloadbutton" type="submit" value="<?php echo JText::_('VM_UPDATE_CHECK_DLUPDATE'); ?>" style="<?php echo $downloadbutton_style ?>font-weight:bold;" />
		    	<span id="versioncheckresult"><?php echo JRequest::getVar( 'vmLatestVersion' ) ?></span>
		    </td>
		    
		  </tr>
		</table>
		<a href="<?php echo $correctTableLink; ?>">Correct the Table</a>
		<?php
		echo $this->pane->endPanel();
		
		echo $this->pane->startPanel( 'Upload a Patch', 'upload_patch' );
		?>
		 <div style="padding: 20px;">
		 <h2 class="vmicon vmicon32 vmicon-32-upload" name="patchupload">Upload a Patch Package</h2>
		  	<input type="file" name="uploaded_package" class="inputbox" />
		  	<br />
		  	<br />
		  	&nbsp;&nbsp;&nbsp;<input type="submit" value="Upload &amp; Preview" />
		  	<br />
		  	<br />
		</div>
		<?php
		echo $this->pane->endPanel();
		
		echo $this->pane->startPanel( 'Database Migration', 'Database_migration' );
		?>
		 <div style="padding: 20px;">
		 <h2 class="vmicon vmicon32 vmicon-32-upload" name="sqlupload">Upload a SQL File</h2>
		  	<input type="file" name="uploaded_sql" class="inputbox" />
		  	<br />
		  	<br />
		  	&nbsp;&nbsp;&nbsp;<input type="submit" value="Upload &amp; Preview" />
		  	<br />
		  	<br />
		</div>
		<?php
		
		echo $this->pane->endPanel();
		
		echo $this->pane->endPane(); 

		   ?>
		<script type="text/javascript">
		//<!--
		function performUpdateCheck() {
			form = document.adminForm;
			$("checkingindicator").setStyle("display", "inline");
			form.checkbutton.value="<?php echo JText::_('VM_UPDATE_CHECK_CHECKING'); ?>";
			var vRequest = new Json.Remote("<?php echo $mosConfig_live_site ?>/administrator/index2.php?option=com_virtuemart&task=checkForUpdate&page=admin.ajax_tools&only_page=1&no_html=1", 
												{
													method: 'get',
													onComplete: handleUpdateCheckResult
													}).send();
		}
		function handleUpdateCheckResult( o ) {
		
			$("checkingindicator").setStyle("display", "none");
			$("checkbutton").setStyle("display", "none");
		
			if( typeof o != "undefined" ) {
				$("versioncheckresult").setText( o.version_string );
				
				if( isNaN( o.version ) ) {
					$("checkbutton").setStyle("display", "");
					$("checkbutton").value= "<?php echo JText::_('VM_UPDATE_CHECK_CHECKNOW' ); ?>";
				}
				else if( o.version == "<?php echo number_format($VMVERSION->RELEASE, 2 ) ?>" ) {
					$("versioncheckresult").setStyle( "color", "green" );
				} 
				else if( o.version > "<?php echo number_format($VMVERSION->RELEASE, 2 ) ?>" ) {
					$("versioncheckresult").setStyle( "color", "red" );
					$("downloadbutton").setStyle("display", "");
				} else {
					$("versioncheckresult").setStyle( "color", "blue" );
				}
				$("versioncheckresult").setStyle( "font-size", "18pt" );
			} else { 
				form.checkbutton.value="<?php echo JText::_('VM_UPDATE_CHECK_CHECK'); ?>";
			}
		}
		//-->
		</script>
	<input type="hidden" name="controller" value="updatesMigration" />
	<input type="hidden" name="option" value="com_virtuemart" />
	<input type="hidden" name="view" value="updatesMigration" />       
</form>     

<?php AdminMenuHelper::endAdminArea(); ?> 