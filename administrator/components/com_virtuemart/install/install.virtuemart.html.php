<?php
defined('_JEXEC') or die('Restricted access');
?>

<link rel="stylesheet" href="components/com_virtuemart/install.css" type="text/css" />
<div align="center">
	<table width="100%" border="0">
	<tr>
		<td valign="top" align="center">
			<a href="http://virtuemart.net" target="_blank">
				<img border="0" align="center" src="components/com_virtuemart/assets/images/cart.gif" alt="Cart" />
			</a>
			<br /><br />
			<h1>Welcome to<br />Virtuemart!</h1>
		</td>
		<td>	
			<h1>The first step of the Installation was <font color="green">SUCCESSFUL</font></h1>
			<br />
			
			<table>				
			<tr>
				<td align="center" colspan="3" >Basic Installation has been finished.</td>
			</tr>
			<tr>
				<td width="33%">
					<a name="Button1" onclick="alert('Please don\'t interrupt the next Step! \n It is essential for running VirtueMart.');" class="button" title="Install a fresh Shop &gt;&gt;" href="<?php echo $linkFresh?>">Install required data for a fresh shop &gt;&gt;</a>
				</td>
				<td width="33%">
					<a name="Button2" onclick="alert('Please don\'t interrupt the next Step! \n It is essential for running VirtueMart.');" class="button" title="Install SAMPLE DATA &gt;&gt;" href="<?php echo $linkSample?>">Install required and sample data for a example shop &gt;&gt;</a>
				</td>	
				<td width="33%">
					<a name="Button3" onclick="alert('Please don\'t interrupt the next Step! \n It is essential for running VirtueMart.');" class="button" title="Do nothing and go to the shop &gt;&gt;" href="<?php echo $linkFresh?>">Do nothing and go to the shop &gt;&gt;</a>
				</td>
			</tr>
			<tr>
				<td align="center" colspan="3"><br /><br /><hr /><br /></td>
			</tr>
			<tr>
				<td align="center">
					Go to <a href="http://virtuemart.net" target="_blank">VirtueMart</a> for further Help
				</td>
				<td colspan="2" align="center">
					Please consider a small donation to help us keep up the work on this component.<br /><br />
					<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
						<input type="hidden" name="cmd" value="_xclick" />
						<input type="hidden" name="business" value="" />
						<input type="hidden" name="item_name" value="VirtueMart Donation" />
						<input type="hidden" name="item_number" value="" />
						<input type="hidden" name="currency_code" value="EUR" />
						<input type="hidden" name="tax" value="0" />
						<input type="hidden" name="no_note" value="0" />
						<input type="hidden" name="amount" value="" />
						<input type="image" src="components/com_virtuemart/assets/images/donate.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!" />
					</form>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	</table>
</div>