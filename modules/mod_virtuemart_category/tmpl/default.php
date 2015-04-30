<?php // no direct access
defined('_JEXEC') or die('Restricted access');
//JHTML::stylesheet ( 'menucss.css', 'modules/mod_virtuemart_category/css/', false );

/* ID for jQuery dropdown */
$ID = str_replace('.', '_', substr(microtime(true), -8, 8));
$js="jQuery(document).ready(function() {
		jQuery('#VMmenu".$ID." li.VmClose ul').hide();
		jQuery('#VMmenu".$ID." li .VmArrowdown').click(
		function() {

			if (jQuery(this).parent().next('ul').is(':hidden')) {
				jQuery('#VMmenu".$ID." ul:visible').delay(500).slideUp(500,'linear').parents('li').addClass('VmClose').removeClass('VmOpen');
				jQuery(this).parent().next('ul').slideDown(500,'linear');
				jQuery(this).parents('li').addClass('VmOpen').removeClass('VmClose');
			}
		});
	});
" ;
vmJsApi::addJScript('catMenuOpenClose',$js);
?>

<ul class="VMmenu<?php echo $class_sfx ?>" id="<?php echo "VMmenu".$ID ?>" >

<?php
function renderCats($cats,$parentCategories,$class_sfx,$first = true){

	if (!$first and isset($cats) and is_array($cats) and count($cats)>0){
		echo '<ul class="menu'.$class_sfx.'">';
	} else if (!$first) {
		return;
	}
	foreach ($cats as $cat) {
		$caturl = JRoute::_('index.php?option=com_virtuemart&view=category&virtuemart_category_id='.$cat->virtuemart_category_id);
		$cattext = vmText::_($cat->category_name);

		$active_menu = 'class="VmClose"';
		if (in_array( $cat->virtuemart_category_id, $parentCategories)) $active_menu = 'class="VmOpen"';
		echo '<li '.$active_menu.' >';

		echo '<div>';
		echo JHTML::link($caturl, $cattext);
		if (isset($cat->childs) and is_array($cat->childs) and count($cat->childs)>0) {
			echo '<span class="VmArrowdown"> </span>';echo '</div>';
			renderCats($cat->childs,$parentCategories,$class_sfx,false);
		} else {
			echo '</div>';
		}

		echo '</li>';
	}
	echo '</ul>';
}
renderCats($categories,$parentCategories,$class_sfx,true);

echo '</ul>';

?>

