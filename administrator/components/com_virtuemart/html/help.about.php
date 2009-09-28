<?php 
if( !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version $Id: help.about.php 1755 2009-05-01 22:45:17Z rolandd $
* @package JMart
* @subpackage html
* @copyright Copyright (C) 2004-2007 soeren - All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* JMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_jmart/COPYRIGHT.php for copyright notices and details.
*
* http://joomlacode.org/gf/project/jmart/
*/
mm_showMyFileName( __FILE__ );
include_once( ADMINPATH . "version.php" );
?>
<br /><br />
<div class="shop_info"><?php echo str_replace('{product}',$VMVERSION->PRODUCT,JText::_('JM_HELP_YOURVERSION')) ?>: <strong><?php echo $myVersion ?></strong></div>
    <img hspace="5" align="left" src="<?php echo $mosConfig_live_site ?>/administrator/components/com_jmart/cart.gif" alt="cart.gif" />
    <?php echo JText::_('JM_HELP_ABOUT'); ?>
     <br /><br /><?php echo str_replace('{licenseurl}','http://www.gnu.org/copyleft/gpl.html',str_replace('{licensename}','GNU / GPL',JText::_('JM_HELP_LICENSE_DESC'))); ?>
     <br /><br /><br /><?php echo JText::_('JM_HELP_TEAM'); ?>
      <br /><br />
      <span style="font-weight: bold;"><?php echo JText::_('JM_HELP_PROJECTLEADER'); ?>:</span> Soeren Eberhardt-Biermann<br />
      <span style="font-weight: bold;"><?php echo JText::_('JM_HELP_HOMEPAGE'); ?>:</span> <a href="http://joomlacode.org/gf/project/jmart/" target="_blank" title="virtuemart.net">http://joomlacode.org/gf/project/jmart/</a><br />
      <span style="font-weight: bold;"><?php echo JText::_('JM_COMMUNITY_FORUM'); ?>:</span> <a href="http://forum.virtuemart.net" target="_blank" title="JMart Forum">JMart Forum</a><br />

	<hr />
	<br /><br />
      <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank"><span style="font-weight: bold;">
      <?php echo JText::_('JM_HELP_DONATION_DESC'); ?></span><br style="font-weight: bold;" /><br />
      <input type="hidden" name="cmd" value="_xclick" />
      <input type="hidden" name="business" value="soeren_nb@yahoo.de" />
      <input type="hidden" name="item_name" value="JMart Donation" />
      <input type="hidden" name="item_number" />
      <input type="hidden" name="currency_code" value="EUR" />
      <input type="hidden" name="tax" value="0" />
      <input type="hidden" name="no_note" value="0" />
      <input type="hidden" name="amount" />
	  <?php
	  global $mosConfig_lang;
	  switch ($mosConfig_lang) {
		case 'english': $paypal_lang='en_US'; break;
		case 'french': $paypal_lang='fr_FR'; break;
		case 'italian': $paypal_lang='it_IT'; break;
		case 'german': $paypal_lang='de_DE'; break;
		case 'germani': $paypal_lang='de_DE'; break;
		case 'spanish': $paypal_lang='es_ES'; break;
		default: $paypal_lang='en_US'; break;
	  }
	  $paypal_button = 'http://www.paypal.com/' . $paypal_lang . '/i/btn/x-click-but21.gif';
	  ?>
      <input type="image" border="0" src="<?php echo $paypal_button; ?>" name="submit" alt="<?php echo JText::_('JM_HELP_DONATION_BUTTON_ALT'); ?>" />
    </form>
      <br />
	  <hr />
	<?php
	include( ADMINPATH."COPYRIGHT.php" );
	?>
