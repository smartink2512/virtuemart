<?php

/**
 *
 * @package	VirtueMart
 * @subpackage Plugins  - Field
 * @author Max Milbers
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2016 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: $
 */

defined('JPATH_BASE') or die;
defined('DS') or define('DS', DIRECTORY_SEPARATOR);
if (!class_exists( 'VmConfig' )) require(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_virtuemart'.DS.'helpers'.DS.'config.php');

class JFormFieldVmhelptext extends JFormField {

    /**
     * Element name
     * @access	protected
     * @var		string
     */
    var $_name = 'vmhelptext';

    function getInput() {
        VmConfig::loadConfig();
        VmConfig::loadJLang('com_virtuemart');
        VmConfig::loadJLang('com_virtuemart_config');
        //vmdebug('my this',$this);
        $this->name = (string) $this->element['name'];
        return vmText::_($this->name);
    }

    function getLabel(){

        return '';
    }
}