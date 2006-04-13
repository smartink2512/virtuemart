<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
*
* @version $Id$
* @package VirtueMart
* @subpackage classes
* @copyright Copyright (C) 2005 ALATIS GmbH & Co. KG. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/             

class ps_recommend {
  var $classname = "ps_recommend";
  
  function validate( &$d ) {
    global $vmLogger, $VM_LANG;
    
    if (empty($d['sender_name'])) {
      $vmLogger->err( $VM_LANG->_PHPSHOP_RECOMMEND_VALIDATE_SENDER_NAME );
      return false;
    }
    
    if (empty($d['sender_mail'])) {
      $vmLogger->err( $VM_LANG->_PHPSHOP_RECOMMEND_VALIDATE_SENDER_MAIL );
      return false;
    }
    
    if (empty($d['recipient_name'])) {
      $vmLogger->err( $VM_LANG->_PHPSHOP_RECOMMEND_VALIDATE_RECIPIENT_NAME );
      return false;
    }
    
    if (empty($d['recipient_mail'])) {
      $vmLogger->err( $VM_LANG->_PHPSHOP_RECOMMEND_VALIDATE_RECIPIENT_MAIL );
      return false;
    }    
    
    return true;
  }
  
  function send_mail( &$d ) {
    global $vmLogger, $VM_LANG;
    
    if (!$this->validate( $d )) {
        return false;
    }
    
    $send = vmMail($d['sender_mail'], 
                   $d['sender_name'],
                   "$d[recipient_name]<$d[recipient_mail]>",
                   $VM_LANG->_PHPSHOP_RECOMMEND_SUBJECT,
                   str_replace("\n", "<br/>", $d['message']),
                   $d['message']
                  );
    
    if ($send) {
        $vmLogger->info( $VM_LANG->_PHPSHOP_RECOMMEND_DONE );
    }
    else {
        $vmLogger->warning( $VM_LANG->_PHPSHOP_RECOMMEND_FAILED );
        return false;
    }
    
    unset($_REQUEST['sender_name']);
    unset($_REQUEST['sender_mail']);
    unset($_REQUEST['recipient_name']);
    unset($_REQUEST['recipient_mail']);
    unset($_REQUEST['message']);
    
    return true;    
  }
  
  function show_form( $product_id ) {
    global $VM_LANG;
    
    $sender_name = mosgetparam( $_REQUEST, 'sender_name', null);
    $sender_mail = mosgetparam( $_REQUEST, 'sender_mail', null);
    $recipient_name = mosgetparam( $_REQUEST, 'recipient_name', null);
    $recipient_mail = mosgetparam( $_REQUEST, 'recipient_mail', null);
    $message = mosgetparam( $_REQUEST, 'message', null);
    
    echo '
    <form action="index.php" method="post">
    
    <table border="0" cellspacing="2" cellpadding="1" width="80%">
      <tr>
        <td>'.$VM_LANG->_PHPSHOP_RECOMMEND_SENDER_NAME.'</td>
        <td><input type="text" name="sender_name" size="50" value="'.(!empty($sender_name)?$sender_name:'').'" /></td>
      </tr>
      <tr>
        <td>'.$VM_LANG->_PHPSHOP_RECOMMEND_SENDER_MAIL.'</td>
        <td><input type="text" name="sender_mail" size="50" value="'.(!empty($sender_mail)?$sender_mail:'').'" /></td>
      </tr>
      <tr>
        <td>'.$VM_LANG->_PHPSHOP_RECOMMEND_RECIPIENT_NAME.'</td>
        <td><input type="text" name="recipient_name" size="50" value="'.(!empty($recipient_name)?$recipient_name:'').'" /></td>
      </tr>
      <tr>
        <td>'.$VM_LANG->_PHPSHOP_RECOMMEND_RECIPIENT_MAIL.'</td>
        <td><input type="text" name="recipient_mail" size="50" value="'.(!empty($recipient_mail)?$recipient_mail:'').'" /></td>
      </tr>
      <tr>
        <td colspan="2">'.$VM_LANG->_PHPSHOP_RECOMMEND_MESSAGE.'</td>
      </tr>
      <tr>
        <td colspan="2">
          <textarea name="message" style="width: 100%; height: 200px">';
     
    if (!empty($message)) {
        echo $message;
    }
    else {
        echo sprintf($VM_LANG->_PHPSHOP_RECOMMEND_FORM_MESSAGE, URL.$product_id);
    }

    echo '</textarea>
        </td>
      </tr>
    </table>
    
    <input type="hidden" name="option" value="com_virtuemart" />
    <input type="hidden" name="page" value="shop.product_details" />
    <input type="hidden" name="product_id" value="'.$product_id.'" />
    <input type="hidden" name="func" value="recommendProduct" />
    <input type="submit" value="'.$VM_LANG->_PHPSHOP_RECOMMEND_FORM_SUBMIT.'" />
    </form>
    ';
  }

}
?>