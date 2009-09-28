<?php
if( !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version $Id: shop.error.php 1760 2009-05-03 22:58:57Z Aravot $
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
?>
<table width="100%" border="0" cellspacing="0" cellpadding="1" bgcolor="#000000">
  <tr>
    <td>
      <table width="100%" border="0" cellspacing="0" cellpadding="2" bgcolor="khaki">
        <tr align="center"> 
          <td> 
            <h4><?php echo JText::_('JM_ERROR') ?></h4>
            <span class="message"><?php echo $error_type;?></span>
            <center>
              <span class="message"><?php echo $error?></span>
              </center>
</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
