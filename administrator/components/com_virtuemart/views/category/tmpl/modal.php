<?php
/**
*
* Lists all the categories in the shop
*
* @package	VirtueMart
* @subpackage Category
* @author RickG, jseros, RolandD, Max Milbers
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

if (!class_exists ('shopFunctionsF'))
	require(JPATH_VM_SITE . DS . 'helpers' . DS . 'shopfunctionsf.php');
JHtml::_('behavior.framework');
AdminUIHelper::startAdminArea($this);
$function	= vmRequest::getCmd('function', 'jSelectCategory');

?>

<form action="index.php" method="post" name="adminForm" id="adminForm">
<div id="header">
<div id="filterbox">
	<table class="">
		<tr>
			<td align="left">
			<?php echo $this->displayDefaultViewSearch() ?>
			</td>

		</tr>
	</table>
	</div>
	<div id="resultscounter"><?php echo $this->catpagination->getResultsCounter(); ?></div>

</div>


	<div id="editcell">
		<table class="adminlist" cellspacing="0" cellpadding="0">
		<thead>
		<tr>


			<th align="left" width="12%">
				<?php echo $this->sort('category_name') ?>
			</th>
			<th align="left">
				<?php echo $this->sort('category_description', 'COM_VIRTUEMART_DESCRIPTION') ; ?>
			</th>
			<th align="left" width="11%">
				<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_S'); ?>
			</th>


			<?php if(Vmconfig::get('multix','none')!=='none'){
				if(!class_exists('Permissions')) require(JPATH_VM_ADMINISTRATOR.DS.'helpers'.DS.'permissions.php');
				if(Permissions::getInstance()->check('admin') ){ ?>
					<th width="20px">
					<?php echo $this->sort( 'cx.category_shared' , 'COM_VIRTUEMART_SHARED') ?>
					</th>
			<?php }
			}?>

			<th><?php echo $this->sort('virtuemart_category_id', 'COM_VIRTUEMART_ID')  ?></th>
			<!--th></th-->
		</tr>
		</thead>
		<tbody>
		<?php
		$k = 0;
		$repeat = 0;

 		$nrows = count( $this->categories );

		if( $this->catpagination->limit < $nrows ){
			if( ($this->catpagination->limitstart + $this->catpagination->limit) < $nrows ) {
				$nrows = $this->catpagination->limitstart + $this->catpagination->limit;
			}
		}

// 		for ($i = $this->pagination->limitstart; $i < $nrows; $i++) {

		foreach($this->categories as $i=>$cat){

// 			if( !isset($this->rowList[$i])) $this->rowList[$i] = $i;
// 			if( !isset($this->depthList[$i])) $this->depthList[$i] = 0;

// 			$row = $this->categories[$this->rowList[$i]];

			$shared = $this->toggle($cat->shared, $i, 'toggle.shared');

			$categoryLevel = '';
			if(!isset($cat->level)){
				if($cat->category_parent_id){
					$cat->level = 1;
				} else {
					$cat->level = 0;
				}

			}
			$repeat = $cat->level;

			if($repeat > 1){
				$categoryLevel = str_repeat(".&nbsp;&nbsp;&nbsp;", $repeat - 1);
				$categoryLevel .= "<sup>|_</sup>&nbsp;";
			}
		?>
			<tr class="<?php echo "row".$k;?>">

				<td align="left">
					<span class="categoryLevel"><?php echo $categoryLevel;?></span>
					<a class="pointer" onclick="if (window.parent) window.parent.<?php echo $this->escape($function);?>('<?php echo $cat->virtuemart_category_id; ?>', '<?php echo $this->escape(addslashes($cat->category_name)); ?>', '<?php echo 'index.php?option=com_virtuemart&view=category&virtuemart_category_id='.$cat->virtuemart_category_id; ?>');">
					<?php echo $this->escape($cat->category_name);?>
						</a>
				</td>
				<td align="left">

					<?php

					echo shopFunctionsF::limitStringByWord(JFilterOutput::cleanText($cat->category_description),200); ?>
				</td>
				<td>
					<?php echo  $this->catmodel->countProducts($cat->virtuemart_category_id); ?>
					</a>
				</td>


				<?php
				if((Vmconfig::get('multix','none')!='none')) {
					?><td align="center">
						<?php echo $shared; ?>
                    </td>
					<?php
				}
				?>
				<td><?php echo $cat->virtuemart_category_id; // echo $product->vendor_name; ?></td>
				<!--td >
					<span class="vmicon vmicon-16-move"></span>
				</td-->
			</tr>
		<?php
			$k = 1 - $k;
		}
		?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="10">
					<?php echo $this->catpagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
	</table>
</div>

	<?php
	vmdebug('my name here is '.$this->_name);
	echo $this->addStandardHiddenToForm($this->_name,$this->task);

	  ?>
</form>


<?php AdminUIHelper::endAdminArea(); ?>
