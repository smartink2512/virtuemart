<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_modules
 *
 * Description
 *
 * @package    VirtueMart
 * @subpackage Paymentmethod
 * @author Max Milbers, Valérie Isaksen
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id$
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

    if($this->payment->payment_jplugin_id){
        if (  JVM_VERSION < 3) {
//     		vmdebug('my payment ',$this->payment);
	        //$parameters = new vmParameters($this->paym->payment_params, JPATH_PLUGINS.DS.'vmpayment'.DS.basename($this->paym->payment_element).'.xml', 'plugin' );
          $parameters = new vmParameters($this->payment,  $this->payment->payment_element , 'plugin' ,'vmpayment');
            echo $rendered = $parameters->render();
        } else {
            if ($this->payment->form) {
                $fieldSets = $this->payment->form->getFieldsets('params');
            ?>
                <dl>
                <?php

                foreach ($fieldSets as $name => $fieldSet) {
                     foreach ($this->payment->form->getFieldset($name) as $field) {
                        if ($field->hidden){
                            echo $field->input;
                        } else {
                            ?>
                            <dt>
                                <?php echo $field->label; ?>
                            </dt>
                            <dd<?php echo ($field->type == 'Editor' || $field->type == 'Textarea') ? ' style="clear: both; margin: 0;"' : ''?>>
                                <?php echo $field->input ?>
                            </dd>
                        <?php
                        }
                     }
                }
                ?>
                </dl>
            <?php
            }
        }
    } else {
        echo JText::_('COM_VIRTUEMART_SELECT_PAYMENT_METHOD');
    }




