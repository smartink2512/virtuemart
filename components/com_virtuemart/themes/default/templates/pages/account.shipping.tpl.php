<?php
if( !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version $Id: account.shipping.tpl.php 1760 2009-05-03 22:58:57Z Aravot $
* @package JMart
* @subpackage html
* @copyright Copyright (C) 2004-2007 Soeren Eberhardt. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* JMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_jmart/COPYRIGHT.php for copyright notices and details.
*
* http://joomlacode.org/gf/project/jmart/
*/

?>
<div class="pathway"><?php echo $vmPathway; ?></div>
<fieldset>
   <legend class="sectiontableheader"><?php echo JText::_('JM_USER_FORM_SHIPTO_LBL') ?></legend>
   <br/><br/>
   <div><?php echo JText::_('JM_ACC_BILL_DEF'); ?></div>
   <br />
<?php
  while( $db->next_record() ) {
?>
   <div>
   - <a href="<?php $sess->purl(SECUREURL . "index.php?next_page=account.shipping&page=account.shipto&user_info_id=" . $db->f("user_info_id")); ?>">
   <?php echo $db->f("address_type_name"); ?></a>
   </div>
   <br />
<?php
  }
?>
   <br /><br />
   <div>
      <a class="button" href="<?php $sess->purl(SECUREURL . "index.php?page=account.shipto&next_page=account.shipping"); ?>"><?php echo JText::_('JM_USER_FORM_ADD_SHIPTO_LBL') ?></a>
   </div>
</fieldset>
<!-- Body ends here -->
