<?php 
defined('_JEXEC') or die('Restricted access');

AdminMenuHelper::startAdminArea(); 
?>

<form action="index.php" method="post" name="adminForm">

<div class="col50">
	<fieldset class="adminform">
	<legend><?php echo JText::_( 'Credit Card Details' ); ?></legend>
	<table class="admintable">			
		<tr>
			<td width="110" class="key">
				<label for="title">
					<?php echo JText::_( 'Credit Card Name' ); ?>:
				</label>
			</td>
			<td>
				<input class="inputbox" type="text" name="creditcard_name" id="creditcard_name" size="50" value="<?php echo $this->creditcard->creditcard_name; ?>" />				
			</td>
		</tr>		
		<tr>
			<td width="110" class="key">
				<label for="title">
					<?php echo JText::_( 'Vendor Id' ); ?>:
				</label>
			</td>
			<td>
				<input class="inputbox" type="text" name="vendor_id" id="vendor_id" size="50" value="<?php echo $this->creditcard->vendor_id; ?>" />										
			</td>
		</tr>		
		<tr>
			<td width="110" class="key">
				<label for="title">
					<?php echo JText::_( 'Credit Card Code' ); ?>:
				</label>
			</td>
			<td>
				<input class="inputbox" type="text" name="creditcard_code" id="creditcard_code" size="10" value="<?php echo $this->creditcard->creditcard_code; ?>" />				
			</td>
		</tr>					
	</table>
	</fieldset>
</div>

	<input type="hidden" name="option" value="com_jmart" />
	<input type="hidden" name="creditcard_id" value="<?php echo $this->creditcard->creditcard_id; ?>" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="controller" value="creditcard" />
</form>


<?php AdminMenuHelper::endAdminArea(); ?> 