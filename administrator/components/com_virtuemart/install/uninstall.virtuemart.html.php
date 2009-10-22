<?php/**
 * VirtueMart installation file.
 *
 * This installation file is executed after the XML manifest file is complete.
 * This installation function extracts some of the frontend and backend files
 * need for this component.
 *
 * @author Max Milbers
 * @package VirtueMart
 */ ?>
 
 <link rel="stylesheet" href="components/com_virtuemart/install.css" type="text/css" />
	<div align="center">
		<table>				
			<tr>
				<td align="center" colspan="3" >Uninstallation.</td>
				</tr>
				<tr>
				<td width="33%">
<a name="Button1" onclick="alert('');" class="button" title="Delete VM related tables &gt;&gt;" href="<?php echo $linkDeleteALL?>">Delete all Tables created by VirtueMart &gt;&gt;</a>
				</td>
				<td width="33%">
<a name="Button2" onclick="alert('');" class="button" title="Delete Essential but restoreable data &gt;&gt;" href="<?php echo $linkDeleteOnlyRestorable?>">Delete all Tables that can easily be restored (countries, states, menu, functions,..)&gt;&gt;</a>
				</td>	

				<td width="33%">
<a name="Button3" onclick="alert('');" class="button" title="Do nothing and go to the shop &gt;&gt;" href="<?php echo $linkDoNothing?>">Do nothing, only uninstall in Joomla and delete the files &gt;&gt;</a>
				</td>
			
			</tr>
				
			<tr>
				<td align="center" colspan="3"><br /><br /><hr /><br /></td>
			</tr>
			
			<tr>
				<td align="center" colspan="3">Go to <a href="http://virtuemart.net" target="_blank">VirtueMart</a> for further Help</td>
			</tr>
		</table>
	</div>