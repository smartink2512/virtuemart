<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
*
* @version $Id$
* @package VirtueMart
* @subpackage templates
* @copyright Copyright (C) 2007 Soeren Eberhardt. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/
?>
<h4><input type="radio" name="togglerchecker" id="toggler1" class="toggler" checked="checked" />
<label for="toggler1"><?php echo $VM_LANG->_('PHPSHOP_RETURN_LOGIN') ?></label>
</h4>
    <div class="stretcher" id="login_stetcher">
<?php 
    include( PAGEPATH . 'checkout.login_form.php' );
?>
    </div>
<?php


?><br />
	<h4><input type="radio" name="togglerchecker" id="toggler2" class="toggler" />
	<label for="toggler2"><?php echo $VM_LANG->_('PHPSHOP_NEW_CUSTOMER') ?></label></h4>
	
    <div class="stretcher" id="register_stretcher"><?php

    include(PAGEPATH. 'checkout_register_form.php');
?>
   </div>
   <br />
   
   <?php
   echo vmCommonHTML::scriptTag('', 'Window.onDomReady(function() {
	
	// get accordion elements
	myStretch = $$( \'.toggler\' );
	myStretcher = $$( \'.stretcher\' );
	

	
	// Create the accordion
	myAccordion = new Fx.Accordion(myStretch, myStretcher, 
		{
			/*fixedHeight: 125,*/
			opacity : true,
			display: 0
		});

});');
   ?>