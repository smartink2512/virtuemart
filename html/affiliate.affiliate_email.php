<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: affiliate.affiliate_email.php,v 1.3 2005/01/27 19:34:00 soeren_nb Exp $
* @package mambo-phpShop
* @subpackage HTML
* Contains code from PHPShop(tm):
* 	@copyright (C) 2000 - 2004 Edikon Corporation (www.edikon.com)
*	Community: www.phpshop.org, forums.phpshop.org
* Conversion to Mambo and the rest:
* 	@copyright (C) 2004-2005 Soeren Eberhardt
*
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
*
* www.mambo-phpshop.net
*/
mm_showMyFileName( __FILE__ );
?> 

<form method="post" action="<?php echo $PHP_SELF ?>" name="adminForm"> 
<input type="hidden" name="user_id" value="<?php $db->sp("user_id"); ?>">
<input type="hidden" name="func" value="affiliateemail"> 
<input type="hidden" name="page" value="<?php echo $modulename?>.affiliate_email">
<input type="hidden" name="option" value="com_phpshop">
<input type="hidden" name="task" value="">

<table width="100%" border="1" cellspacing="0" cellpadding="2" align="center"> 

<?php if (isset($email_status)) {?> 
  <tr bgcolor="#cccccc">
    <td colspan="2"><?php echo $email_status ?> 
    </td>
  </tr>
  <?php }?> 
  <tr> 
    <td width="30%" height="20" valign="top">
    <div align="left"><?php echo $PHPSHOP_LANG->_PHPSHOP_AFFILIATE_EMAIL_WHO ?></div>
    </td>
    <td width="70%" height="20"><?php $ps_affiliate->get_affiliate_list();?></td>
  </tr>
  <tr>
    <td width="30%" valign="top" height="20"><?php echo $PHPSHOP_LANG->_PHPSHOP_AFFILIATE_EMAIL_STATS ?>
    </td>
    <td width="70%" height="20">
      <input type="checkbox" name="send_stats" value="stats_on">
    </td>
  </tr>
  <tr>
      <td width="30%" valign="top" height="20"><?php echo $PHPSHOP_LANG->_PHPSHOP_AFFILIATE_EMAIL_SUBJECT ?></td>
      <td width="70%" align="left" height="20"><input type="text" name="subject" value="<?php echo$PHPSHOP_LANG->_PHPSHOP_AFFILIATE_EMAIL_SUBJECT ?>">
      </td>
  </tr> 
  <tr>
      <td nowrap valign="top" width="30%">
          <?php echo $PHPSHOP_LANG->_PHPSHOP_AFFILIATE_EMAIL_CONTENT ?>
          <br><br><br> 
      </td>
      <td nowrap width="70%">
          <div align="left"><textarea name="email" cols="40" rows="5" wrap="physical"></textarea></div>
      </td>
  </tr>
    <tr>
        <td nowrap width="30%">
            <div align="center"><input type="submit" name="send email" value="submit"></div>
        </td>
        <td nowrap width="70%">&nbsp;</td>
    </tr> 
</table>
</form>

