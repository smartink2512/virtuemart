<?php
defined('_JEXEC') or die('');

echo vmText::sprintf('COM_VIRTUEMART_WELCOME_VENDOR', $this->vendor->vendor_store_name) . "\n" . "\n";
echo vmText::_('COM_VIRTUEMART_QUESTION_ABOUT') . ' '. $this->product->product_name;
if ($this->product->product_sku) echo ' ('.vmText::_('COM_VIRTUEMART_PRODUCT_SKU').' '.$this->product->product_sku .')' ;
echo "\n" . "\n";
echo vmText::sprintf('COM_VIRTUEMART_QUESTION_MAIL_FROM', $this->user->name, $this->user->email) . "\n";
 
echo $this->comment. "\n";
