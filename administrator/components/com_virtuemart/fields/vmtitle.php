<?php
/**
 *
 * @author Jeremy Magne
 * @version $Id$
 * @package VirtueMart
 * @subpackage payment
 * @copyright ${PHING.VM.COPYRIGHT}
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
 *
 * http://virtuemart.net
 */


defined ('_JEXEC') or die();

class JFormFieldVmtitle extends JFormFieldList {

	/**
	 * Element name
	 *
	 * @access    protected
	 * @var        string
	 */
	var $_name = 'Vmtitle';

	function getInput() {

		/*
		$class = ($node->attributes('class') ? 'class="' . $node->attributes('class') . '"' : '');
        if (empty($class)) {
            $class="level2";
        }
		$description = ($node->attributes('description') ? vmText::_($node->attributes('description')) : '');

		$html = '';
		if ($this->value) {

            $html .= '<div '.$class.' style="margin: 10px 0 5px 0; font-weight: bold; padding: 5px; background-color: #cacaca; float:none; clear:both;">';
			$html .= vmText::_($this->value);
			$html .= '</div>';
            if ($description){
                $html .= $description.'<br/>';
            }
		} else {
			$html .= '<div '.$class.'>'.$description.'</div>';
		}
		*/
		// todo
		$html='';
		return $html;
	}

}