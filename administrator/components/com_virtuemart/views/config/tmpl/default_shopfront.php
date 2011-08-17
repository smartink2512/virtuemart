<?php
/**
*
* Description
*
* @package	VirtueMart
* @subpackage Config
* @author RickG
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

?>
<br />
<table width="100%">
    <tr><td valign="top" width="50%">
	    <fieldset>
		<legend><?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_MORE_CORE_SETTINGS') ?></legend>
		<table class="admintable">
		<?php /*    <tr>
			<td class="key">
			    <span class="hasTip" title="<?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_ERRORPAGE_EXPLAIN'); ?>">
			    <?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_ERRORPAGE') ?>
			</span>
			</td>
			<td>
			    <input type="text" name="errorpage" class="inputbox" value="<?php echo $this->config->get('errorpage'); ?>" />
			</td>
		    </tr> */ ?>
		    <tr>
			<td class="key">
			    <span class="hasTip" title="<?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_PDF_BUTTON_EXPLAIN'); ?>" >
			    <label for="pdf_button_enable"><?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_PDF_BUTTON') ?></label>
			</span>
			</td>
			<td>
			    <?php echo VmHTML::checkbox('pdf_button_enable', $this->config->get('pdf_button_enable')); ?>
			</td>
		    </tr>
		    <tr>
			<td class="key">
			    <span class="hasTip" title="<?php echo JText::_('COM_VIRTUEMART_ADMIN_SHOW_EMAILFRIEND_TIP'); ?>">
			    <label for="show_emailfriend"><?php echo JText::_('COM_VIRTUEMART_ADMIN_SHOW_EMAILFRIEND') ?></label>
			    </span>
			</td>
			<td>
			    <?php echo VmHTML::checkbox('show_emailfriend', $this->config->get('show_emailfriend')); ?>
			</td>
		    </tr>
		    <tr>
			<td class="key">
			    <span class="hasTip" title="<?php echo JText::_('COM_VIRTUEMART_ADMIN_SHOW_PRINTICON_TIP'); ?>" >
			    <label for="show_printicon"><?php echo JText::_('COM_VIRTUEMART_ADMIN_SHOW_PRINTICON') ?></label>
			    </span>
			    </td>
			<td>
			    <?php echo VmHTML::checkbox('show_printicon', $this->config->get('show_printicon')); ?>
			</td>
		    </tr>
<?php /*			<tr>
	    	<td class="key">
				<span class="hasTip" title="<?php echo JText::_('COM_VIRTUEMART_CFG_CONTENT_PLUGINS_ENABLE_TIP'); ?>">
				<label for="content_plugins_enable"><?php echo JText::_('COM_VIRTUEMART_CFG_CONTENT_PLUGINS_ENABLE') ?></label>
				</span>
	    	</td>
	    	<td>
				<?php echo VmHTML::checkbox('content_plugins_enable', $this->config->get('content_plugins_enable')); ?>
	    	</td>
			</tr> */ ?>
			<tr>
	    	<td class="key">
				<span class="hasTip" title="<?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_SHOW_OUT_OF_STOCK_PRODUCTS_EXPLAIN'); ?>">
				<label for="show_out_of_stock_products"><?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_SHOW_OUT_OF_STOCK_PRODUCTS') ?></label>
				</span>
	    	</td>
	    	<td valign="top">
				<?php echo VmHTML::checkbox('show_out_of_stock_products', $this->config->get('show_out_of_stock_products')); ?>
	    	</td>
			</tr>
			<tr>
	    	<td class="key">
				<span class="hasTip" title="<?php echo JText::_('COM_VIRTUEMART_COUPONS_ENABLE_EXPLAIN'); ?>">
				<label for="coupons_enable"><?php echo JText::_('COM_VIRTUEMART_COUPONS_ENABLE') ?></label>
				</span>
	   	 	</td>
	    	<td>
				<?php echo VmHTML::checkbox('coupons_enable', $this->config->get('coupons_enable')); ?>
	    	</td>
			</tr>
			<tr>
	    	<td class="key">
				<span class="hasTip" title="<?php echo JText::_('COM_VIRTUEMART_COUPONS_EXPIRE_EXPLAIN'); ?>">
				<label for="coupons_default_expire"><?php echo JText::_('COM_VIRTUEMART_COUPONS_EXPIRE') ?></label>
				</span>
	    	</td>
			<td>
				<?php
					// TODO This must go to the view.html.php.... but then... that goes for most of the config sruff I'ld say :-S
					$_defaultExpTime = array(
						 '1,D' => '1 '.JText::_('COM_VIRTUEMART_DAY')
						,'1,W' => '1 '.JText::_('COM_VIRTUEMART_WEEK')
						,'2,W' => '2 '.JText::_('COM_VIRTUEMART_WEEK_S')
						,'1,M' => '1 '.JText::_('COM_VIRTUEMART_MONTH')
						,'3,M' => '3 '.JText::_('COM_VIRTUEMART_MONTH_S')
						,'6,M' => '6 '.JText::_('COM_VIRTUEMART_MONTH_S')
						,'1,Y' => '1 '.JText::_('COM_VIRTUEMART_YEAR')
					);
					echo VmHTML::selectList('coupons_default_expire',$this->config->get('coupons_default_expire'),$_defaultExpTime)
				?>
			</td>
			</tr>

                        <tr>
	    	<td class="key">
				<span class="hasTip" title="<?php echo JText::_('COM_VIRTUEMART_WEIGHT_UNIT_DEFAULT_EXPLAIN'); ?>">
				<label for="weight_unit_default"><?php echo JText::_('COM_VIRTUEMART_WEIGHT_UNIT_DEFAULT') ?></label>
				</span>
	    	</td>
			<td>
				<?php
                                     echo ShopFunctions::renderWeightUnitList('weight_unit_default', $this->config->get('weight_unit_default') );
				?>
			</td>
			</tr>
			<tr>
                              <tr>
	    	<td class="key">
				<span class="hasTip" title="<?php echo JText::_('COM_VIRTUEMART_LWH_UNIT_DEFAULT_EXPLAIN'); ?>">
				<label for="weight_unit_default"><?php echo JText::_('COM_VIRTUEMART_LWH_UNIT_DEFAULT') ?></label>
				</span>
	    	</td>
			<td>
				<?php
                                     echo ShopFunctions::renderLWHUnitList('lwh_unit_default', $this->config->get('lwh_unit_default') );
				?>
			</td>
			</tr>
			<tr>
			<td class="key">
				<span class="hasTip" title="<?php echo JText::_('COM_VIRTUEMART_LIST_LIMIT_EXPLAIN'); ?>">
				<label for="list_limit"><?php echo JText::_('COM_VIRTUEMART_LIST_LIMIT') ?></label>
				</span>
			</td>
			<td>
				<input type="text" value="<?php echo $this->config->get('list_limit',10); ?>" class="inputbox" size="4" name="list_limit">
			</td>
			</tr>
<?php /*	    <tr>
			<td class="key">
			    <span class="hasTip" title="<?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_SHOWVM_VERSION_EXPLAIN'); ?>">
			    <?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_SHOWVM_VERSION') ?>
			    </span>
			</td>
			<td>
			    <?php echo VmHTML::checkbox('show_footer', $this->config->get('show_footer')); ?>
			</td>
		    </tr> */ ?>
		</table>
	    </fieldset>

	    <fieldset>
		<legend><?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_REVIEW_TITLE') ?></legend>
		<table class="admintable">
			<tr>
		    	<td class="key">
					<span class="hasTip" title="<?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_REVIEW_SHOW_EXPLAIN'); ?>">
					<label ><?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_REVIEW_SHOW') ?></label>
					</span>
		    	</td>
		    	<td><fieldset class="checkboxes">
		    	<?php
		    		$showReviewFor = array(	'none' => JText::_('COM_VIRTUEMART_ADMIN_CFG_REVIEW_SHOW_NONE'),
											'registered' => JText::_('COM_VIRTUEMART_ADMIN_CFG_REVIEW_SHOW_REGISTERED'),
											'all' => JText::_('COM_VIRTUEMART_ADMIN_CFG_REVIEW_SHOW_ALL')
											); //showReviewFor
					echo VmHTML::radioList('showReviewFor', $this->config->get('showReviewFor',2),$showReviewFor); ?>

		    	</fieldset></td>
			</tr>
			<tr>
	    	<td class="key">
				<span class="hasTip" title="<?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_REVIEW_EXPLAIN'); ?>">
				<label ><?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_REVIEW') ?></label>
				</span>
	    	</td>
	    	<td><fieldset class="checkboxes">
				<?php
				 $showReviewFor = array('none' => JText::_('COM_VIRTUEMART_ADMIN_CFG_REVIEW_MODE_NONE'),
				 						'bought' => JText::_('COM_VIRTUEMART_ADMIN_CFG_REVIEW_MODE_BOUGHT_PRODUCT'),
				 						'registered' => JText::_('COM_VIRTUEMART_ADMIN_CFG_REVIEW_MODE_REGISTERED'),
				 					//	3 => JText::_('COM_VIRTUEMART_ADMIN_CFG_REVIEW_MODE_ALL')
										);
				echo VmHTML::radioList('reviewMode', $this->config->get('reviewMode',2),$showReviewFor); ?>
	    	</fieldset></td>
			</tr>
			<tr>
		    	<td class="key">
					<span class="hasTip" title="<?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_RATING_SHOW_EXPLAIN'); ?>">
					<label><?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_RATING_SHOW') ?></label>
					</span>
		    	</td>
		    	<td><fieldset class="checkboxes">
		    	<?php
		    		$showReviewFor = array(	'none' => JText::_('COM_VIRTUEMART_ADMIN_CFG_RATING_SHOW_NONE'),
		    								'registered' => JText::_('COM_VIRTUEMART_ADMIN_CFG_RATING_SHOW_REGISTERED'),
											'all' => JText::_('COM_VIRTUEMART_ADMIN_CFG_RATING_SHOW_ALL')
											);
					echo VmHTML::radioList('showRatingFor', $this->config->get('showRatingFor',2),$showReviewFor); ?>

		    	</fieldset></td>
				</tr>
			<tr>
	    	<td class="key">
				<span class="hasTip" title="<?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_RATING_EXPLAIN'); ?>">
				<label><?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_RATING') ?></label>
				</span>
	    	</td>
	    	<td><fieldset class="checkboxes">
				<?php
				 $showReviewFor = array('none' => JText::_('COM_VIRTUEMART_ADMIN_CFG_RATING_MODE_NONE'),
				 						'bought' => JText::_('COM_VIRTUEMART_ADMIN_CFG_RATING_MODE_BOUGHT_PRODUCT'),
										'registered' => JText::_('COM_VIRTUEMART_ADMIN_CFG_RATING_MODE_REGISTERED'),
									//	3 => JText::_('COM_VIRTUEMART_ADMIN_CFG_RATING_MODE_ALL')	//TODO write system for all users (cookies)
										);
				echo VmHTML::radioList('ratingMode', $this->config->get('ratingMode',2),$showReviewFor); ?>
	    	</fieldset></td>
			</tr>
			<tr>
	    	<td class="key">
				<span class="hasTip" title="<?php echo JText::_('COM_VIRTUEMART_REVIEWS_AUTOPUBLISH_TIP'); ?>">
				<label for="reviews_autopublish" ><?php echo JText::_('COM_VIRTUEMART_REVIEWS_AUTOPUBLISH') ?></label>
			</span>
	    	</td>
	    	<td>
				<?php echo VmHTML::checkbox('reviews_autopublish', $this->config->get('reviews_autopublish')); ?>
	    	</td>
			</tr>
			<tr>
	    	<td class="key">
				<span class="hasTip" title="<?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_REVIEW_MINIMUM_COMMENT_LENGTH_TIP'); ?>">
				<label for="reviews_minimum_comment_length"><?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_REVIEW_MINIMUM_COMMENT_LENGTH') ?></label>
				</span>
	    	</td>
	    	<td>
				<input type="text" size="6" id="reviews_minimum_comment_length" name="reviews_minimum_comment_length" class="inputbox" value="<?php echo $this->config->get('reviews_minimum_comment_length'); ?>" />
	   	 	</td>
			</tr>
			<tr>
	    	<td class="key">
				<span class="hasTip" title="<?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_REVIEW_MAXIMUM_COMMENT_LENGTH_TIP'); ?>" >
				<label><?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_REVIEW_MAXIMUM_COMMENT_LENGTH'); ?></label>
				</span>
	   	 	</td>
	    	<td>
			<input type="text" size="6" id="reviews_maximum_comment_length" name="reviews_maximum_comment_length" class="inputbox" value="<?php echo $this->config->get('reviews_maximum_comment_length'); ?>" />
	    	</td>
			</tr>
		</table>
		</fieldset>

	</td><td valign="top" width="50%">

	    <fieldset>
		<legend><?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_SHOPFRONT_SETTINGS') ?></legend>
		<table class="admintable">
		    <tr>
			<td class="key">
			    <span class="hasTip" title="<?php echo JText::_('COM_VIRTUEMART_SELECT_DEFAULT_SHOP_TEMPLATE_TIP'); ?>">
			    <?php echo JText::_('COM_VIRTUEMART_SELECT_DEFAULT_SHOP_TEMPLATE') ?>
			    </span>
			</td>
			<td>
			    <?php
			    echo JHTML::_('Select.genericlist', $this->jTemplateList, 'vmtemplate', 'size=1 width=200', 'value', 'name', $this->config->get('vmtemplate'));
			    ?>
			</td>
		    </tr>

		    <tr>
			<td class="key">
			    <span class="hasTip" title="<?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_CATEGORY_TEMPLATE_EXPLAIN'); ?>">
			    <?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_CATEGORY_TEMPLATE') ?>
			    </span>
			</td>
			<td>
			    <?php
			    echo JHTML::_('Select.genericlist', $this->jTemplateList, 'categorytemplate', 'size=1', 'value', 'name', $this->config->get('categorytemplate'));
			    ?>
			</td>
		    </tr>

		    <tr>
			<td class="key">
			    <span class="hasTip" title="<?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_SHOW_CATEGORY_EXPLAIN'); ?>">
			    <label for="showCategory"><?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_SHOW_CATEGORY') ?></label>
			    </span>
			</td>
			<td>
			   <?php echo VmHTML::checkbox('showCategory', $this->config->get('showCategory',1)); ?>
			</td>
		    </tr>
		    <tr>
			<td class="key">
			    <span class="hasTip" title="<?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_CATEGORY_LAYOUT_EXPLAIN'); ?>">
			    <?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_CATEGORY_LAYOUT') ?>
			    </span>
			</td>
			<td>
			    <?php
			    echo JHTML::_('Select.genericlist', $this->categoryLayoutList, 'categorylayout', 'size=1', 'text', 'text', $this->config->get('categorylayout'));
			    ?>
			</td>
		    </tr>
		    <tr>
			<td class="key">
			    <span class="hasTip" title="<?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_CATEGORIES_PER_ROW_EXPLAIN'); ?>">
			    <?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_CATEGORIES_PER_ROW') ?>
			    </span>
			</td>
			<td>
			    <input type="text" name="categories_per_row" size="4" class="inputbox" value="<?php echo $this->config->get('categories_per_row') ?>" />
			</td>
		    </tr>
		    <tr>
			<td class="key">
			    <span class="hasTip" title="<?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_PRODUCT_LAYOUT_EXPLAIN'); ?>">
			    <?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_PRODUCT_LAYOUT') ?>
			    </span>
			</td>
			<td>
			    <?php
			    echo JHTML::_('Select.genericlist', $this->productLayoutList, 'productlayout', 'size=1', 'text', 'text', $this->config->get('productlayout'));
			    ?>
			</td>
		    </tr>
		    <tr>
			<td class="key">
			    <span class="hasTip" title="<?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_PRODUCTS_PER_ROW_EXPLAIN'); ?>">
			    <?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_PRODUCTS_PER_ROW') ?>
			    </span>
			</td>
			<td>
			    <input type="text" name="products_per_row" size="4" class="inputbox" value="<?php echo $this->config->get('products_per_row') ?>" />
			</td>
		    </tr>
		    <tr>
			<td class="key">
			    <span class="hasTip" title="<?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_NAV_AT_TOP_TIP'); ?>" >
			    <?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_NAV_AT_TOP') ?>
			    </span>
			</td>
			<td>
			    <?php echo VmHTML::checkbox('show_top_pagenav', $this->config->get('show_top_pagenav')); ?>
			</td>
		    </tr>
                </table>
                    </fieldset>
                     <fieldset>
		<legend><?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_HOMEPAGE_SETTINGS') ?></legend>
                    <table class="admintable">
                           <tr>
			<td class="key">
			    <span class="hasTip" title="<?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_MAIN_LAYOUT_TIP'); ?>">
			    <?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_MAIN_LAYOUT') ?>
			    </span>
			</td>
			<td>
			    <?php
			    echo JHTML::_('Select.genericlist', $this->vmLayoutList, 'vmlayout', 'size=1', 'text', 'text', $this->config->get('vmlayout'));
			    ?>
			</td>
		    </tr>
		    <tr>
			<td class="key">
			    <span class="hasTip" title="<?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_SHOW_FEATURED_TIP'); ?>" >
			    <label for="show_featured"><?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_SHOW_FEATURED') ?></label>
			    </span>
			</td>
			<td>
			    <?php echo VmHTML::checkbox('show_featured', $this->config->get('show_featured')); ?>
			</td>
		    </tr>
		    <tr>
			<td class="key">
			    <span class="hasTip" title="<?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_FEATURED_PRODUCTS_PER_ROW_EXPLAIN'); ?>">
			    <?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_FEATURED_PRODUCTS_PER_ROW') ?>
			    </span>
			</td>
			<td>
			    <input type="text" name="featured_products_per_row" size="4" class="inputbox" value="<?php echo $this->config->get('featured_products_per_row') ?>" />
			</td>
		    </tr>
			<tr>
			<td class="key">
			    <span class="hasTip" title="<?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_SHOW_TOPTEN_TIP'); ?>" >
			    <label for="show_topTen"><?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_SHOW_TOPTEN') ?></label>
			    </span>
			</td>
			<td>
			    <?php echo VmHTML::checkbox('show_topTen', $this->config->get('show_topTen')); ?>
			</td>
		    </tr>
		     <tr>
			<td class="key">
			    <span class="hasTip" title="<?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_TOPTEN_PRODUCTS_PER_ROW_EXPLAIN'); ?>">
			    <?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_TOPTEN_PRODUCTS_PER_ROW') ?>
			    </span>
			</td>
			<td>
			    <input type="text" name="topten_products_per_row" size="4" class="inputbox" value="<?php echo $this->config->get('topten_products_per_row') ?>" />
			</td>
		    </tr>
			<tr>
			<td class="key">
			    <span class="hasTip" title="<?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_SHOW_RECENT_TIP'); ?>" >
			    <label for="show_recent"><?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_SHOW_RECENT') ?></label>
			    </span>
			</td>
			<td>
			    <?php echo VmHTML::checkbox('show_recent', $this->config->get('show_recent')); ?>
			</td>
		    </tr>

		    <tr>
			<td class="key">
			    <span class="hasTip" title="<?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_SHOW_LATEST_TIP'); ?>" >
			    <label for="show_latest"><?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_SHOW_LATEST') ?></label>
			    </span>
			</td>
			<td>
			    <?php echo VmHTML::checkbox('show_latest', $this->config->get('show_latest')); ?>
			</td>
		    </tr>
		</table>
	    </fieldset>
	</td></tr>
</table>

<table width="100%">
    <tr><td valign="top">
		<fieldset>
		<legend><?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_MEDIA_TITLE') ?></legend>
		<table class="admintable">
	    	<tr>
				<td class="key">
				<span class="hasTip" title="<?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_ASSETS_GENERAL_PATH_EXPLAIN'); ?>">
			    <?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_ASSETS_GENERAL_PATH') ?>
			    </span>
				</td>
				<td>
					<input type="text" name="assets_general_path"  size="60" class="inputbox" value="<?php echo $this->config->get('assets_general_path') ?>" />
				</td>
		    </tr>
		    <tr>
				<td class="key">
				<span class="hasTip" title="<?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_MEDIA_CATEGORY_PATH_EXPLAIN'); ?>">
			    <?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_MEDIA_CATEGORY_PATH') ?>
			    </span>
				</td>
				<td>
					<input type="text" name="media_category_path"  size="60" class="inputbox" value="<?php echo $this->config->get('media_category_path') ?>" />
				</td>
		    </tr>
		    <tr>
				<td class="key">
				<span class="hasTip" title="<?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_MEDIA_PRODUCT_PATH_EXPLAIN'); ?>">
			    <?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_MEDIA_PRODUCT_PATH') ?>
			    </span>
				</td>
				<td>
					<input type="text" name="media_product_path"  size="60" class="inputbox" value="<?php echo $this->config->get('media_product_path') ?>" />
				</td>
		    </tr>
		    <tr>
				<td class="key">
				<span class="hasTip" title="<?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_MEDIA_MANUFACTURER_PATH_EXPLAIN'); ?>">
			    <?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_MEDIA_MANUFACTURER_PATH') ?>
			    </span>
				</td>
				<td>
					<input type="text" name="media_manufacturer_path"  size="60" class="inputbox" value="<?php echo $this->config->get('media_manufacturer_path') ?>" />
				</td>
		    </tr>
		    <?php
		    if( function_exists('imagecreatefromjpeg') ) {
				?>
				<tr>
					<td class="key">
						<span class="hasTip" title="<?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_DYNAMIC_THUMBNAIL_RESIZING_TIP'); ?>">
						<label for="img_resize_enable"><?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_DYNAMIC_THUMBNAIL_RESIZING') ?></label>
						</span>
					</td>
					<td>
						<?php echo VmHTML::checkbox('img_resize_enable', $this->config->get('img_resize_enable')); ?>
					</td>
				</tr>
				<tr>
					<td class="key">
						<span class="hasTip" title="<?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_THUMBNAIL_WIDTH_TIP'); ?>">
						<?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_THUMBNAIL_WIDTH') ?>
						</span>
					</td>
					<td>
						<input type="text" name="img_width" class="inputbox" value="<?php echo $this->config->get('img_width') ?>" />
					</td>
				</tr>
				<tr>
					<td class="key">
						<span class="hasTip" title="<?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_SHOWVM_VERSION_EXPLAIN'); ?>">
						<?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_THUMBNAIL_HEIGHT') ?>
						</span>
					</td>
					<td>
						<input type="text" name="img_height" class="inputbox" value="<?php echo $this->config->get('img_height') ?>" />
					</td>
				</tr>
				<?php
			}
			else { ?>
				<tr>
					<td colspan="2"><strong><?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_GD_MISSING') ?></strong>
						<input type="hidden" name="img_resize_enable" value="0" />
						<input type="hidden" name="img_width" value="<?php echo  $this->config->get('img_width',90) ?>" />
						<input type="hidden" name="img_height" value="<?php echo  $this->config->get('img_height',90) ?>" />
					</td>
				</tr>
			<?php }
		    ?>
		    <tr>
			<td class="key">
			    <span class="hasTip" title="<?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_NOIMAGEPAGE_EXPLAIN'); ?>">
			    <?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_NOIMAGEPAGE') ?>
			    </span>
			</td>
			<td>
			    <?php
			    echo JHTML::_('Select.genericlist', $this->noimagelist, 'no_image_set', 'size=1', 'value', 'text', $this->config->get('no_image_set'));
			    ?>
			</td>
		    </tr>
		    <tr>
			<td class="key">
			    <span class="hasTip" title="<?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_NOIMAGEFOUND_EXPLAIN'); ?>">
			    <?php echo JText::_('COM_VIRTUEMART_ADMIN_CFG_NOIMAGEFOUND') ?>
			    </span>
			</td>
			<td>
			    <?php
			    echo JHTML::_('Select.genericlist', $this->noimagelist, 'no_image_found', 'size=1', 'value', 'text', $this->config->get('no_image_found'));
			    ?>
			</td>
		    </tr>

	    </table>
	    </fieldset>
	</td></tr>
</table>
