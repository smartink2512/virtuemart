<?php
/**
 *TODO Improve the CSS , ADD CATCHA ?
 * Show the form Ask a Question
 *
 * @package	VirtueMart
 * @subpackage
 * @author Kohl Patrick
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
* @version $Id: default.php 2810 2011-03-02 19:08:24Z Milbo $
 */

// Check to ensure this file is included in Joomla!
defined ( '_JEXEC' ) or die ( 'Restricted access' );
$min = VmConfig::get('vm_asks_minimum_comment_length', 50);
$max = VmConfig::get('vm_asks_maximum_comment_length', 2000) ;

$document = JFactory::getDocument();
$document->addScript(JURI::root(true).'/components/com_virtuemart/assets/js/jquery.validation.js');
$document->addScriptDeclaration('
	jQuery(function($){
		var askForm = $("#askform");
		askForm.validation();
		askForm.find(".highlight-button").click(function() {
			if(!askForm.validate()) {
				alert("'.JText::_('COM_VIRTUEMART_COMMENT_NOT_VALID').'");
				return false;
			}
		});
		$.Validation.addRule("range",{
			check: function(value) {
			   if(value)
				   return (value.length >= '.$min.' && value.length <= '.$max.' );
			   return false;
			},
			msg : "'.JText::sprintf('COM_VIRTUEMART_COMMENT_MIN_MAX',$min, $max).'"
		});

		$("#comment").keyup( function () {
			var result = $(this).val();
				$("#counter").val( result.length );
		});
	});
');
/* Let's see if we found the product */
if (empty ( $this->product )) {
	echo JText::_ ( 'COM_VIRTUEMART_PRODUCT_NOT_FOUND' );
	echo '<br /><br />  ' . $this->continue_link_html;
} else { ?>

<div class="ask-a-question-view">
	<h1><?php echo JText::_('COM_VIRTUEMART_PRODUCT_ASK_QUESTION')  ?></h1>

	<div class="product-summary">
		<div class="width70 floatleft">
			<h2><?php echo $this->product->product_name ?></h2>

			<?php // Product Short Description
			if (!empty($this->product->product_s_desc)) { ?>
				<div class="short-description">
					<?php echo $this->product->product_s_desc ?>
				</div>
			<?php } // Product Short Description END ?>

		</div>

		<div class="width30 floatleft center">
			<?php // Product Image
			echo $this->product->images[0]->displayMediaThumb('class="product-image"',false); ?>
		</div>

	<div class="clear"></div>
	</div>

	<?php // Get User
	if (!empty($this->user->id)) {
		$user = JFactory::getUser();
	} ?>

	<div class="form-field">

		<form method="post" class="form-validate" action="<?php echo JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id='.$this->product->virtuemart_product_id.'&virtuemart_category_id='.$this->product->virtuemart_category_id.'&tmpl=component') ; ?>" name="askform" id="askform">

			<label><?php echo JText::_('COM_VIRTUEMART_USER_FORM_NAME')  ?> : <input type="text" value="<?php echo $this->user->name ?>" name="name" id="name" size="30"  validation="required name"/></label>
			<br />
			<label><?php echo JText::_('COM_VIRTUEMART_USER_FORM_EMAIL')  ?> : <input type="text" value="<?php echo $this->user->email ?>" name="email" id="email" size="30"  validation="required email"/></label>
			<br/>
			<label>
				<?php
				$ask_comment = JText::sprintf('COM_VIRTUEMART_ASK_COMMENT', $min, $max);
				echo $ask_comment;
				?>
				<br />
				<textarea title="<?php echo $ask_comment ?>" class="field" id="comment" name="comment" rows="10" validation="range"></textarea>
			</label>
			<div class="submit">
				<input class="highlight-button" type="submit" name="submit_ask" title="<?php echo JText::_('COM_VIRTUEMART_ASK_SUBMIT')  ?>" value="<?php echo JText::_('COM_VIRTUEMART_ASK_SUBMIT')  ?>" />

				<div class="width50 floatright right paddingtop">
					<?php echo JText::_('COM_VIRTUEMART_ASK_COUNT')  ?>
					<input type="text" value="0" size="4" class="counter" ID="counter" name="counter" maxlength="4" readonly="readonly" />
				</div>
			</div>

			<input type="hidden" name="cid[]" value="<?php echo JRequest::getInt('virtuemart_product_id',0); ?>" />
			<input type="hidden" name="virtuemart_product_id" value="<?php echo JRequest::getInt('virtuemart_product_id',0); ?>" />
			<input type="hidden" name="tmpl" value="component" />
			<input type="hidden" name="view" value="productdetails" />
			<input type="hidden" name="option" value="com_virtuemart" />
			<input type="hidden" name="virtuemart_category_id" value="<?php echo JRequest::getInt('virtuemart_category_id'); ?>" />
			<input type="hidden" name="task" value="mailAskquestion" />
			<?php echo JHTML::_( 'form.token' ); ?>
		</form>

	</div>

</div>

<?php } ?>
