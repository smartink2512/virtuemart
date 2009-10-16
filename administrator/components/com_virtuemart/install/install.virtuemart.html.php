<link rel="stylesheet" href="components/com_virtuemart/install.css" type="text/css" />
	<div align="center">
		<table width="100%" border="0">
			<tr>
				<td valign="middle" align="center">
					<div id="ctr" align="center">
						<div class="install">
							<div id="stepbar">
								<div>
									<a href="http://virtuemart.net" target="_blank"><img border="0" align="right" src="components/com_virtuemart/cart.gif" alt="Cart" /></a>
									<br/>
								</div>
								<div class="clr"></div>
								<br/><br/><br/>
								<div class="step-on" >
									<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
										Please consider a small donation to help us keep up the work on this component.<br /><br />
										<input type="hidden" name="cmd" value="_xclick" />
										<input type="hidden" name="business" value="" />
										<input type="hidden" name="item_name" value="VirtueMart Donation" />
										<input type="hidden" name="item_number" value="" />
										<input type="hidden" name="currency_code" value="EUR" />
										<input type="hidden" name="tax" value="0" />
										<input type="hidden" name="no_note" value="0" />
										<input type="hidden" name="amount" value="" />
										<input type="image" src="components/com_virtuemart/x-click-but21.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!" />
									</form>
								</div>
							</div>
							<div id="right">
								<div id="step">Welcome to <?php echo $shortversion ?>!</div>
			
								<div class="clr"></div>
								<pre><?php echo $myVersion ?></pre>
								<h1>The first step of the Installation was <font color="green">SUCCESSFUL</font></h1>
								<h1>The Name of the Storeowner is <?php echo $vmInstaller->userName ?> with the login name <?php echo $vmInstaller->userUserName ?></h1>
								<table>

									<tr>
									<?php if($vmInstaller -> oldVersion=="fresh"){?>
		<td width="40%">Basic Installation has been finished. You can use VirtueMart in a moment after having clicked on a link below.</td>
		<td width="20">&nbsp;</td>
		<td width="40%">To fill your Shop with dummy products, and to see how things can be set up, you can install some Sample Data now.</td>
									<?php }else if($vmInstaller -> oldVersion=="1.5"){?>
		<td width="80%">Updates of the files has been finished. You can use VirtueMart in a moment after having clicked on a link below.</td>										
									<?php }else{?>
		<td width="80%">Installation of the files has been finished, if you want to upgrade your old database data, click here</td>
									<?php } ?>
									</tr>
									<tr>
									<?php 	

									if($vmInstaller -> oldVersion=="fresh"){
										?>
										<td width="40%">&nbsp;
											<a name="Button1" onclick="alert('Please don\'t interrupt the next Step! \n It is essential for running VirtueMart.');" class="button" title="Install a fresh Shop &gt;&gt;" href="<?php $linkFresh?>">Install required data for a fresh shop &gt;&gt;</a>
										</td>
										<td width="20">&nbsp;</td>
										<td width="40">
											<a name="Button2" onclick="alert('Please don\'t interrupt the next Step! \n It is essential for running VirtueMart.');" class="button" title="Install SAMPLE DATA &gt;&gt;" href="<?php $linkSample?>">Install required and sample data for a example shop &gt;&gt;</a>
										</td>	
									<?php }else if($vmInstaller -> oldVersion=="1.5"){?>
										<td width="80%">
											<a name="Button3" onclick="alert('Please don\'t interrupt the next Step! \n It is essential for running VirtueMart.');" class="button" title="Do nothing and go to the shop &gt;&gt;" href="<?php $linkFresh?>">Do nothing and go to the shop &gt;&gt;</a>
										</td>	
									<?php }else{
										//TODO: at least the table admin_menu must be created or maybe some more
										?>						
										<td width="80%">&nbsp;
											<a name="Button4" onclick="alert('Please don\'t interrupt the next Step! \n It is essential for running VirtueMart.');" class="button" title="Go directly to the Update/Migration &gt;&gt;" href="<?php $linkEssentials?>">Go directly to the Update/Migration &gt;&gt;</a>
										</td>											
										<?php
									}
									?>

									</tr>
									<tr>
										<td align="center" colspan="3"><br /><br /><hr /><br /></td>
									</tr>
									
									<tr>
										<td align="center" colspan="3">Go to <a href="http://virtuemart.net" target="_blank">VirtueMart</a> for further Help</td>
									</tr>
								</table>
							</div>
							<div class="clr"></div>
					</div>
				</td>
			</tr>
		</table>
	</div>