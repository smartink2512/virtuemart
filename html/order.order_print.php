<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version $Id$
* @package VirtueMart
* @subpackage html
* @copyright Copyright (C) 2004-2008 soeren - All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/
mm_showMyFileName( __FILE__ );
global $ps_order_status;

require_once(CLASSPATH.'ps_product.php');
$ps_product =& new ps_product;

require_once(CLASSPATH.'ps_order_status.php');
require_once(CLASSPATH.'ps_checkout.php');

$order_id = vmRequest::getInt('order_id');

    $dbc = new ps_DB;
	$q = "SELECT * FROM #__{vm}_orders WHERE order_id='$order_id'";
	$db->query($q);
	if( $db->next_record() ) {
	
	  echo ps_order::order_print_navigation( $order_id );
	  
	  $q = "SELECT * FROM #__{vm}_order_history WHERE order_id='$order_id' ORDER BY order_status_history_id ASC";
	  $dbc->query( $q );
	  $order_events = $dbc->record;
	  ?>
  <table class="adminlist" style="width:100%; table-layout: fixed;">
	<tr> 
	  <td valign="top" width="35%"> 
		<table border="0" cellspacing="0" cellpadding="1">
		  <tr class="sectiontableheader"> 
			<th colspan="2"><?php echo $VM_LANG->_('PHPSHOP_ORDER_PRINT_PO_LBL') ?></th>
		  </tr>
		  <tr> 
			<td><strong><?php echo $VM_LANG->_('PHPSHOP_ORDER_PRINT_PO_NUMBER') ?>:</strong></td>
			<td><?php printf("%08d", $db->f("order_id"));?></td>
		  </tr>
		  <tr> 
			<td><strong><?php echo $VM_LANG->_('PHPSHOP_ORDER_PRINT_PO_DATE') ?>:</strong></td>
			<td><?php echo vmFormatDate( $db->f("cdate")+$mosConfig_offset);?></td>
		  </tr>
		  <tr> 
			<td><strong><?php echo $VM_LANG->_('PHPSHOP_ORDER_PRINT_PO_STATUS') ?>:</strong></td>
			<td><?php echo ps_order_status::getOrderStatusName($db->f("order_status")) ?></td>
		  </tr>
		  <tr>
			  <td><strong><?php echo $VM_LANG->_('VM_ORDER_PRINT_PO_IPADDRESS') ?>:</strong></td>
			  <td><?php $db->p("ip_address"); ?></td>
		  </tr>
		  <?php 
		  if( PSHOP_COUPONS_ENABLE == '1') { ?>
		  <tr>
			  <td><strong><?php echo $VM_LANG->_('PHPSHOP_COUPON_COUPON_HEADER') ?>:</strong></td>
			  <td><?php if( $db->f("coupon_code") ) $db->p("coupon_code"); else echo '-'; ?></td>
		  </tr>
		  <?php 
			} ?>
		</table>
	  </td>
	  <td valign="top" width="65%">
	  <div>
	  <div>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
		<?php
		$tab = new vmTabPanel( 1, 1, "orderstatuspanel");
		$tab->startPane( "order_change_pane" );
		$tab->startTab(  $VM_LANG->_('PHPSHOP_ORDER_STATUS_CHANGE'), "order_change_page" );
		?>
		<table class="adminlist">
		 <tr>
		  <th colspan="3"><?php echo $VM_LANG->_('PHPSHOP_ORDER_STATUS_CHANGE') ?></th>
		 </tr>
		 <tr>
		  <td colspan="3"><?php echo "<strong>".$VM_LANG->_('PHPSHOP_ORDER_PRINT_PO_STATUS') .": </strong>";
			  $ps_order_status->list_order_status($db->f("order_status")); ?>
				<input type="submit" class="button" name="Submit" value="<?php echo $VM_LANG->_('PHPSHOP_UPDATE') ?>" />
				<input type="hidden" name="page" value="order.order_print" />
				<input type="hidden" name="func" value="orderStatusSet" />
				<input type="hidden" name="vmtoken" value="<?php echo vmSpoofValue($sess->getSessionId()) ?>" />
				<input type="hidden" name="option" value="com_virtuemart" />
				<input type="hidden" name="current_order_status" value="<?php $db->p("order_status") ?>" />
				<input type="hidden" name="order_id" value="<?php echo $order_id ?>" />
		  </td>
		 </tr>
		 <tr>
		  <td valign="top"><?php echo "<strong>".$VM_LANG->_('PHPSHOP_COMMENT') .": </strong>"; ?>
		  </td>
		  <td>
			<textarea name="order_comment" rows="4" cols="35"></textarea>
		  </td>
		  <td>
			<input type="checkbox" name="notify_customer" id="notify_customer" checked="checked" value="Y" /> 
				<label for="notify_customer"><?php echo $VM_LANG->_('PHPSHOP_ORDER_LIST_NOTIFY') ?></label>
			<br/>
			<input type="checkbox" name="include_comment" id="include_comment" checked="checked" value="Y" /> 
				<label for="include_comment"><?php echo $VM_LANG->_('PHPSHOP_ORDER_HISTORY_INCLUDE_COMMENT') ?></label>
		  </td>
		 </tr>
		</table>
		</form>
			<?php
			$tab->endTab();
			$tab->startTab( $VM_LANG->_('PHPSHOP_ORDER_HISTORY'), "order_history_page" );
			?>
		<table class="adminlist">
		 <tr >
		  <th><?php echo $VM_LANG->_('PHPSHOP_ORDER_HISTORY_DATE_ADDED') ?></th>
		  <th><?php echo $VM_LANG->_('PHPSHOP_ORDER_HISTORY_CUSTOMER_NOTIFIED') ?></th>
		  <th><?php echo $VM_LANG->_('PHPSHOP_ORDER_LIST_STATUS') ?></th>
		  <th><?php echo $VM_LANG->_('PHPSHOP_COMMENT') ?></th>
		 </tr>
		 <?php 
		 foreach( $order_events as $order_event ) {
		  echo "<tr>";
		  echo "<td>".$order_event->date_added."</td>\n";
		  echo "<td align=\"center\"><img alt=\"" . $VM_LANG->_('VM_ORDER_STATUS_ICON_ALT') ."\" src=\"$mosConfig_live_site/administrator/images/";
		  echo $order_event->customer_notified == 1 ? 'tick.png' : 'publish_x.png';
		  
		  echo "\" border=\"0\" align=\"absmiddle\" /></td>\n";
		  echo "<td>".$order_event->order_status_code."</td>\n";
		  echo "<td>".$order_event->comments."</td>\n";
		  echo "</tr>\n";
		 }
		 ?>
		</table>
		<?php
		$tab->endTab();
		$tab->startTab( $VM_LANG->_('VM_ORDER_EDIT'), "order_edit_page" ); 
			/**
			 * This is the Order Edit Addon
			 * @since 1.1.0
			 */
			require_once(CLASSPATH.'ps_order_edit.php');
		$tab->endTab();

		$tab->endPane();
		?>
		</div>
		</div>
	  </td>
	</tr>
  </table>
  <table class="adminlist">
	<tr> 
	  <td colspan="2">&nbsp; </td>
	</tr><?php
	  $user_id = $db->f("user_id");
	  $dbt = new ps_DB;
	  $qt = "SELECT * from #__{vm}_order_user_info WHERE user_id='$user_id' AND order_id='$order_id' ORDER BY address_type ASC"; 
	  $dbt->query($qt);
	  $dbt->next_record();
	require_once( CLASSPATH . 'ps_userfield.php' );
	$userfields = ps_userfield::getUserFields('registration', false, '', true, true );
	$shippingfields = ps_userfield::getUserFields('shipping', false, '', true, true );
   ?> 
	<tr> 
	  <th width="48%" valign="top"><?php echo $VM_LANG->_('PHPSHOP_ORDER_PRINT_BILL_TO_LBL') ?></th>
	  <th width="52%" valign="top"><?php echo $VM_LANG->_('PHPSHOP_ORDER_PRINT_SHIP_TO_LBL') ?></th>
	</tr>
	<tr> 
	  <td width="48%" valign="top">
		<table width="100%" border="0" cellspacing="0" cellpadding="1">
		<?php 
		foreach( $userfields as $field ) {
			if( $field->name == 'email') $field->name = 'user_email';
			?>
		  <tr> 
			<td width="35%" align="right">&nbsp;<?php echo $VM_LANG->_($field->title) ? $VM_LANG->_($field->title) : $field->title ?>:</td>
			<td width="65%"><?php
				switch($field->name) {
		          	case 'country':
		          		require_once(CLASSPATH.'ps_country.php');
		          		$country = new ps_country();
		          		$dbc = $country->get_country_by_code($dbt->f($field->name));
	          			if( $dbc !== false ) echo $dbc->f('country_name');
		          		break;
		          	default: 
		          		echo $dbt->f($field->name);
		          		break;
		          }
		          ?>
			</td>
		  </tr>
		  <?php
			}
		   ?>
		</table>
	  </td>
	  <td width="52%" valign="top">
  <?php
  // Get Ship To Address
  $dbt->next_record();
  ?> 
		<table width="100%" border="0" cellspacing="0" cellpadding="1">
		<?php 
		foreach( $shippingfields as $field ) {
			if( $field->name == 'email') $field->name = 'user_email';
			?>
		  <tr> 
			<td width="35%" align="right">&nbsp;<?php echo $VM_LANG->_($field->title) ? $VM_LANG->_($field->title) : $field->title ?>:</td>
			<td width="65%"><?php
				switch($field->name) {
		          	case 'country':
		          		require_once(CLASSPATH.'ps_country.php');
		          		$country = new ps_country();
		          		$dbc = $country->get_country_by_code($dbt->f($field->name));
		          		if( $dbc !== false ) echo $dbc->f('country_name');
		          		break;
		          	default: 
		          		echo $dbt->f($field->name);
		          		break;
		          }
		          ?>
			</td>
		  </tr>
		  <?php
			}
		   ?>
		</table>
	  </td>
	</tr>
	<tr> 
	  <td colspan="2"><hr/></td>
	</tr>
	<tr> 
	  <td colspan="2"> 
		<table  class="adminlist">
		  <tr > 
			<th class="title" width="5%"><?php echo $VM_LANG->_('PHPSHOP_ORDER_PRINT_QUANTITY') ?></th>
			<th class="title" width="32%"><?php echo $VM_LANG->_('PHPSHOP_ORDER_PRINT_NAME') ?></th>
			<th class="title" width="9%"><?php echo $VM_LANG->_('PHPSHOP_ORDER_PRINT_SKU') ?></th>
			<th class="title" width="10%"><?php echo $VM_LANG->_('PHPSHOP_ORDER_PRINT_PO_STATUS') ?></th>
			<th class="title" width="12%"><?php echo $VM_LANG->_('PHPSHOP_PRODUCT_FORM_PRICE_NET') ?></th>
			<th class="title" width="12%"><?php echo $VM_LANG->_('PHPSHOP_PRODUCT_FORM_PRICE_GROSS') ?></th>
			<th class="title" width="19%"><?php echo $VM_LANG->_('PHPSHOP_ORDER_PRINT_TOTAL') ?></th>
		  </tr>
		  <?php
		  $dbt = new ps_DB;
		  $qt  = "SELECT order_item_id, product_quantity,order_item_name,order_item_sku,product_id,product_item_price,product_final_price, product_attribute, order_status
					FROM `#__{vm}_order_item`
					WHERE #__{vm}_order_item.order_id='$order_id' ";
		  $dbt->query($qt);
		  $i = 0;
		  $dbd = new ps_DB();
		  while ($dbt->next_record()){
			if ($i++ % 2) {
				$bgcolor='row0';
			} else {
				$bgcolor='row1';
			}
			$t = $dbt->f("product_quantity") * $dbt->f("product_final_price");
			// Check if it's a downloadable product
			$downloadable = false;
			$files = array();
			$dbd->query('SELECT product_id, attribute_name
							FROM `#__{vm}_product_attribute`
							WHERE product_id='.$dbt->f('product_id').' AND attribute_name=\'download\'' );
			if( $dbd->next_record() ) {
				$downloadable = true;
				$dbd->query('SELECT product_id, end_date, download_max, download_id, file_name
							FROM `#__{vm}_product_download`
							WHERE product_id='.$dbt->f('product_id').' AND order_id=\''.$order_id .'\'' );
				while( $dbd->next_record() ) {
					$files[] = $dbd->get_row();
				}
			}
		  ?>
		  <tr class="<?php echo $bgcolor; ?>" valign="top"> 
			<td width="5%"> <?php $dbt->p("product_quantity") ?></td>
			<td width="32%"><?php $dbt->p("order_item_name"); 
			  echo "<br /><span style=\"font-size: smaller;\">" . ps_product::getDescriptionWithTax($dbt->f("product_attribute")) . "</span>"; 
			  if( $downloadable ) {
			  	echo '<br /><br />
			  			<div style="font-weight:bold;">'.$VM_LANG->_('VM_DOWNLOAD_STATS') .'</div>';
			  	if( empty( $files )) {
			  		echo '<em>- '.$VM_LANG->_('VM_DOWNLOAD_NOTHING_LEFT') .' -</em>';
			  		$enable_download_function = $ps_function->get_function('insertDownloadsForProduct');
			  		if( $perm->check( $enable_download_function['perms'] ) ) {
			  			echo '<form action="'.$_SERVER['PHP_SELF'].'" method="post">				  		
			  			<input type="hidden" name="page" value="'.$page.'" />
			  			<input type="hidden" name="order_id" value="'.$order_id.'" />
			  			<input type="hidden" name="product_id" value="'.$dbt->f('product_id').'" />
			  			<input type="hidden" name="user_id" value="'.$dbt->f('user_id').'" />
			  			<input type="hidden" name="func" value="insertDownloadsForProduct" />
						<input type="hidden" name="vmtoken" value="'. vmSpoofValue($sess->getSessionId()) .'" />
			  			<input type="hidden" name="option" value="'.$option.'" />
			  			<input class="button" type="submit" name="submit" value="'.$VM_LANG->_('VM_DOWNLOAD_REENABLE').'" />
			  			</form>';
			  		}
			  	} else {
			  		foreach( $files as $file ) {
			  			echo '<em>'
			  					.'<a href="'.$sess->url( $_SERVER['PHP_SELF'].'?page=product.file_form&amp;product_id='.$dbt->f('product_id').'&amp;file_id='.$db->f("file_id")).'&amp;no_menu='.@$_REQUEST['no_menu'].'" title="'.$VM_LANG->_('PHPSHOP_MANUFACTURER_LIST_ADMIN').'">'
			  					.$file->file_name.'</a></em><br />';
			  			echo '<ul>';
			  			echo '<li>'.$VM_LANG->_('VM_DOWNLOAD_REMAINING_DOWNLOADS') .': '.$file->download_max.'</li>';
			  			if( $file->end_date > 0 ) {
			  				echo '<li>'.$VM_LANG->_('VM_EXPIRY').': '.vmFormatDate( $file->end_date + $mosConfig_offset ).'</li>';
			  			}
			  			echo '</ul>';
			  			echo '<form action="'.$_SERVER['PHP_SELF'].'" method="post">				  		
			  			<input type="hidden" name="order_id" value="'.$order_id.'" />
			  			<input type="hidden" name="page" value="'.$page.'" />
			  			<input type="hidden" name="func" value="mailDownloadId" />
						<input type="hidden" name="vmtoken" value="'. vmSpoofValue($sess->getSessionId()) .'" />
			  			<input type="hidden" name="option" value="'.$option.'" />
			  			<input class="button" type="submit" name="submit" value="'.$VM_LANG->_('VM_DOWNLOAD_RESEND_ID').'" />
			  			</form>';
			  		}
			  		
			  	}
			  }
			  ?>
			</td>
			<td width="9%"><?php  $dbt->p("order_item_sku") ?>&nbsp;</td>
			<td width="10%">
				<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
				<?php echo "<strong>".$VM_LANG->_('PHPSHOP_ORDER_PRINT_PO_STATUS') .": </strong>";
			 	 $ps_order_status->list_order_status($dbt->f("order_status")); ?>
				<input type="submit" class="button" name="Submit" value="<?php echo $VM_LANG->_('PHPSHOP_UPDATE') ?>" />
				<input type="hidden" name="page" value="order.order_print" />
				<input type="hidden" name="func" value="orderStatusSet" />
				<input type="hidden" name="vmtoken" value="<?php echo vmSpoofValue($sess->getSessionId()) ?>" />
				<input type="hidden" name="option" value="com_virtuemart" />
				<input type="hidden" name="current_order_status" value="<?php $dbt->p("order_status") ?>" />
				<input type="hidden" name="order_id" value="<?php echo $order_id ?>" />
				<input type="hidden" name="order_item_id" value="<?php $dbt->p("order_item_id") ?>" />
				</form>
			</td>
			<td width="12%" align="right"><?php 
				echo $GLOBALS['CURRENCY_DISPLAY']->getFullValue($dbt->f("product_item_price"), 5, $db->f('order_currency'));  
				
				?></td>
			<td width="12%" align="right"><?php echo $GLOBALS['CURRENCY_DISPLAY']->getFullValue($dbt->f("product_final_price"), '', $db->f('order_currency'));  ?></td>
			<td width="19%" align="right"><?php echo $GLOBALS['CURRENCY_DISPLAY']->getFullValue($t, '', $db->f('order_currency')); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		  </tr>
		  <?php 
		  } 
		  ?> 
		  <tr> 
			<td colspan="7">&nbsp; </td>
		  </tr>
		  <tr> 
			<td width="5%">&nbsp;</td>
			<td width="42%">&nbsp;</td>
			<td colspan="4"><div align="right"><strong> <?php echo $VM_LANG->_('PHPSHOP_ORDER_PRINT_SUBTOTAL') ?>: </strong></div></td>
			<td width="19%"><div align="right"><?php echo $GLOBALS['CURRENCY_DISPLAY']->getFullValue($db->f("order_subtotal"), '', $db->f('order_currency')); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
		  </tr>
  <?php
		  /* COUPON DISCOUNT */
		$coupon_discount = $db->f("coupon_discount");
		
  
		if( PAYMENT_DISCOUNT_BEFORE == '1') {
		  if ($db->f("order_discount") != 0) {
  ?>
		  <tr>
			 <td width="5%">&nbsp;</td>
			<td width="42%">&nbsp;</td>
			<td colspan="4"><div  align="right"><strong><?php 
			  if( $db->f("order_discount") > 0)
				echo $VM_LANG->_('PHPSHOP_PAYMENT_METHOD_LIST_DISCOUNT');
			  else
				echo $VM_LANG->_('PHPSHOP_FEE');
				?>:</div></strong></td>
			<td width="19%"><div  align="right"><?php
				  if ($db->f("order_discount") > 0 )
				 echo "-" . $GLOBALS['CURRENCY_DISPLAY']->getFullValue(abs($db->f("order_discount")), '', $db->f('order_currency'));
			elseif ($db->f("order_discount") < 0 )
				 echo "+" . $GLOBALS['CURRENCY_DISPLAY']->getFullValue(abs($db->f("order_discount")), '', $db->f('order_currency')); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
			  </td>
		  </tr>
		  
		  <?php 
		  } 
		  if( $coupon_discount > 0 || $coupon_discount < 0) {
  ?>
		  <tr>
			<td colspan="6"><div align="right"><?php echo $VM_LANG->_('PHPSHOP_COUPON_DISCOUNT') ?>:</div>
			</td> 
			<td><div align="right"><?php
			  echo "- ".$GLOBALS['CURRENCY_DISPLAY']->getFullValue( $coupon_discount, '', $db->f('order_currency') ); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
			</td>
		  </tr>
		  <?php
		  }
		}
  ?>
		  
		  <tr> 
			<td width="5%">&nbsp;</td>
			<td width="42%">&nbsp;</td>
			<td colspan="4"><div align="right"><strong><?php echo $VM_LANG->_('PHPSHOP_ORDER_PRINT_TOTAL_TAX') ?>: </div></strong></td>
			<td width="19%"><div align="right"><?php echo $GLOBALS['CURRENCY_DISPLAY']->getFullValue($db->f("order_tax"), '', $db->f('order_currency')) ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
		  </tr>
		  <tr> 
			<td width="5%">&nbsp;</td>
			<td width="42%">&nbsp;</td>
			<td colspan="4"><div align="right"><strong><?php echo $VM_LANG->_('PHPSHOP_ORDER_PRINT_SHIPPING') ?>: </div></strong></td>
			<td width="19%"><div align="right"><?php echo $GLOBALS['CURRENCY_DISPLAY']->getFullValue($db->f("order_shipping"), '', $db->f('order_currency')) ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
		  </tr>
		  <tr> 
			<td width="5%">&nbsp;</td>
			<td width="42%">&nbsp;</td>
			<td colspan="4"><div align="right"><strong><?php echo $VM_LANG->_('PHPSHOP_ORDER_PRINT_SHIPPING_TAX') ?>: </div></strong></td>
			<td width="19%"><div align="right"><?php echo $GLOBALS['CURRENCY_DISPLAY']->getFullValue($db->f("order_shipping_tax"), '', $db->f('order_currency')) ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
		  </tr>
  <?php
		if( PAYMENT_DISCOUNT_BEFORE != '1') {
		  if ($db->f("order_discount") != 0) {
  ?>
		  <tr> 
			<td width="5%">&nbsp;</td>
			<td width="42%">&nbsp;</td>
			<td colspan="4"><div align="right"><strong><?php 
			  if( $db->f("order_discount") > 0)
				echo $VM_LANG->_('PHPSHOP_PAYMENT_METHOD_LIST_DISCOUNT');
			  else
				echo $VM_LANG->_('PHPSHOP_FEE');
				?>:</strong></div></td>
			<td width="19%"><div align="right"><?php
				  if ($db->f("order_discount") > 0 )
				 echo "-" . $GLOBALS['CURRENCY_DISPLAY']->getFullValue(abs($db->f("order_discount")), '', $db->f('order_currency'));
			elseif ($db->f("order_discount") < 0 )
				 echo "+" . $GLOBALS['CURRENCY_DISPLAY']->getFullValue(abs($db->f("order_discount")), '', $db->f('order_currency')); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
			  </td>
		  </tr>
		  
		  <?php 
		  } 
		  if( $coupon_discount > 0 || $coupon_discount < 0) {
  ?>
		  <tr> 
			<td width="5%">&nbsp;</td>
			<td width="42%">&nbsp;</td>
			<td colspan="4"><div align="right"><strong><?php echo $VM_LANG->_('PHPSHOP_COUPON_DISCOUNT') ?>:</div></strong>
			</td> 
			<td><div align="right"><?php
			  echo "- ".$GLOBALS['CURRENCY_DISPLAY']->getFullValue( $coupon_discount, '', $db->f('order_currency') ); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
			</td>
		  </tr>
		  <?php
		  }
		}
  ?>
		  <tr>
			<td width="5%">&nbsp;</td>
			<td width="42%">&nbsp;</td>
			<td colspan="4"><div align="right"><strong><?php echo $VM_LANG->_('PHPSHOP_CART_TOTAL') ?>:</div> </strong></td>
			<td width="19%"><div align="right"><strong><?php echo $GLOBALS['CURRENCY_DISPLAY']->getFullValue($db->f("order_total"), '', $db->f('order_currency')); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></strong>
			  </td>
		  </tr>
		  <tr>
			<td width="5%">&nbsp;</td>
			<td width="42%">&nbsp;</td>
			<td colspan="4">&nbsp;</td>
			<td width="19%"><?php echo ps_checkout::show_tax_details( $db->f('order_tax_details'), $db->f('order_currency') ); ?></td>
		  </tr>
		  </table>
	  </td>
	</tr>
	<tr>
	<td colspan="2">
	 <table width="100%">
		<tr class="sectiontableheader"> 
			
		  <?php if( $db->f("ship_method_id") ) { ?>
		  <td valign="top">
			<table class="adminlist">
			  <tr>
				<th ><?php 
						$details = explode( "|", $db->f("ship_method_id"));
						echo $VM_LANG->_('PHPSHOP_ORDER_PRINT_SHIPPING_LBL') ?>
				</th>
			  </tr>
			  <tr> 
				<td width="50%">
				  <strong><?php echo $VM_LANG->_('PHPSHOP_ORDER_PRINT_SHIPPING_CARRIER_LBL') ?>: </strong>
					<?php  echo $details[1]; ?>&nbsp;</td>
  
			  <tr>
				<td width="50%">
				  <strong><?php echo $VM_LANG->_('PHPSHOP_ORDER_PRINT_SHIPPING_MODE_LBL') ?>: </strong>
				  <?php echo $details[2]; ?></td>
				
			  </tr>
			  <tr>
				<td width="50%">
				  <strong><?php echo $VM_LANG->_('PHPSHOP_ORDER_PRINT_SHIPPING_PRICE_LBL') ?>: </strong>
				<?php echo $GLOBALS['CURRENCY_DISPLAY']->getFullValue($details[3], '', $db->f('order_currency')); ?>
				</td>
			  </tr>
			</table>
		  </td>
		  <?php 
		  } ?>
		  
		  <!-- Customer Note -->
		  <td valign="top">
			<table class="adminlist">
			  <tr>
				<th><?php echo $VM_LANG->_('PHPSHOP_ORDER_PRINT_CUSTOMER_NOTE') ?></th>
			  </tr>
			  <tr>
			  <td valign="top" width="50%" rowspan="4"><?php
				  if( $db->f("customer_note") ) {
					echo nl2br( $db->f("customer_note") );
				  }
				  else
					echo " ./. ";
					  
				  ?>&nbsp;
				</td>
			  </tr>
			</table>
		  </td>
		  <?php
		    $dbpm =& new ps_DB;
			$q  = "SELECT * FROM #__{vm}_payment_method, #__{vm}_order_payment WHERE #__{vm}_order_payment.order_id='$order_id' ";
			$q .= "AND #__{vm}_payment_method.payment_method_id=#__{vm}_order_payment.payment_method_id";
			$dbpm->query($q);
			$dbpm->next_record();
		   
			// DECODE Account Number
			$dbaccount =& new ps_DB;
		    $q = "SELECT ".VM_DECRYPT_FUNCTION."(order_payment_number,'".ENCODE_KEY."') 
				AS account_number, order_payment_code FROM #__{vm}_order_payment  
				WHERE order_id='".$order_id."'";
			$dbaccount->query($q);
			$dbaccount->next_record();
			?>
		  <!-- Payment Information -->
		  <td valign="top">
			<table class="adminlist">
			  <tr class="sectiontableheader"> 
				<th width="13%"><?php echo $VM_LANG->_('PHPSHOP_ORDER_PRINT_PAYMENT_LBL') ?></th>
				<th width="40%"><?php echo $VM_LANG->_('PHPSHOP_ORDER_PRINT_ACCOUNT_NAME') ?></th>
				<th width="30%"><?php echo $VM_LANG->_('PHPSHOP_ORDER_PRINT_ACCOUNT_NUMBER'); ?></th>
				<th width="17%"><?php echo $VM_LANG->_('PHPSHOP_ORDER_PRINT_EXPIRE_DATE') ?></th>
			  </tr>
			  <tr> 
				<td width="13%"><?php $dbpm->p("payment_method_name");?> </td>
				<td width="40%"><?php $dbpm->p("order_payment_name");?></td>
				<td width="30%"><?php 
				echo ps_checkout::asterisk_pad( $dbaccount->f("account_number"), 4, true );
				if( $dbaccount->f('order_payment_code')) {
					echo '<br/>(' . $VM_LANG->_('VM_ORDER_PAYMENT_CCV_CODE') . ': '.$dbaccount->f('order_payment_code').') ';
				}
				?></td>
				<td width="17%"><?php echo vmFormatDate( $dbpm->f("order_payment_expire"), '%b-%Y'); ?></td>
			  </tr>
			  <tr> 
			  <tr class="sectiontableheader"> 
				<th colspan="4"><?php echo $VM_LANG->_('PHPSHOP_ORDER_PRINT_PAYMENT_LOG_LBL') ?></th>
			  </tr>
			  <tr> 
				<td colspan="4"><?php if($dbpm->f("order_payment_log")) echo $dbpm->f("order_payment_log"); else echo "./."; ?></td>
			  </tr>
			</table>
		  </td>
		  
		</tr>
	  </table>
	 </td>
	</tr>
	<tr> 
	  <td colspan="2">&nbsp;</td>
	</tr>
  </table>
<?php
}
else {
  echo $VM_LANG->_('VM_ORDER_NOTFOUND');
}
?>