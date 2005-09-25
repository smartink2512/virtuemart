<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: product.product_category_form.php,v 1.8 2005/09/04 20:08:55 soeren_nb Exp $
* @package mambo-phpShop
* @subpackage HTML
* @copyright (C) 2004-2005 Soeren Eberhardt
*
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
*
* www.mambo-phpshop.net
*/
mm_showMyFileName( __FILE__ );
global $ps_product_category, $ps_product;

$category_id = mosgetparam($_REQUEST, 'category_id', 0);

//First create the object and let it print a form heading
$formObj = &new formFactory( $PHPSHOP_LANG->_PHPSHOP_CATEGORY_FORM_LBL );
//Then Start the form
$formObj->startForm( 'adminForm', 'enctype="multipart/form-data"');

if ($category_id) {
    $q = "SELECT * FROM #__pshop_category,#__pshop_category_xref ";
    $q .= "WHERE #__pshop_category.category_id='$category_id' ";
    $q .= "AND #__pshop_category_xref.category_child_id=#__pshop_category.category_id";
    $db->query($q);
    $db->next_record();
} 
elseif (empty($vars["error"])) {
    $default["category_publish"] = "Y";
    $default["category_flypage"] = "shop.flypage";
    $default["category_browsepage"] = CATEGORY_TEMPLATE;
    $default["products_per_row"] = PRODUCTS_PER_ROW; 
}
  
$tabs = new mShopTabs(0, 1, "_main");
$tabs->startPane("category-pane");
$tabs->startTab( "<img src=\"". IMAGEURL ."ps_image/edit.png\" align=\"center\" width=\"16\" height=\"16\" border=\"0\" />&nbsp;".$PHPSHOP_LANG->_PHPSHOP_CATEGORY_FORM_LBL, "info-page");
?> 
<table class="adminform">
    <tr> 
      <td width="21%" nowrap><div align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_CATEGORY_FORM_PUBLISH ?>:</div></td>
      <td width="79%"><?php 
        if ($db->sf("category_publish")=="Y") { 
          echo "<input type=\"checkbox\" name=\"category_publish\" value=\"Y\" checked=\"checked\" />";
        } 
        else {
          echo "<input type=\"checkbox\" name=\"category_publish\" value=\"Y\" />";
        }
      ?> 
      </td>
    </tr>
    <tr> 
      <td width="21%" nowrap><div align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_CATEGORY_FORM_NAME ?>:</div></td>
      <td width="79%"> 
        <input type="text" class="inputbox" name="category_name" size="60" value="<?php echo shopMakeHtmlSafe( $db->sf('category_name')) ?>" />
      </td>
    </tr>
    <tr> 
      <td width="21%" valign="top" nowrap><div  align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_CATEGORY_FORM_DESCRIPTION ?>:</div></td>
      <td width="79%" valign="top"><?php
        editorArea( 'editor1', $db->f("category_description"), 'category_description', '300', '100', '60', '6' ) ?>
      </td>
    </tr>
    <tr>
      <td ><div align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_MODULE_LIST_ORDER ?>: </div></td>
      <td valign="top"><?php 
        echo $ps_product_category->list_level( $db->f("category_parent_id"), $db->f("category_id"), $db->f("list_order"));
        echo "<input type=\"hidden\" name=\"currentpos\" value=\"".$db->f("list_order")."\" />";
      ?>
      </td>
    </tr>
    <tr> 
      <td width="21%" valign="top" nowrap><div  align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_CATEGORY_FORM_PARENT ?>:</div></td>
      <td width="79%" valign="top"> <?php 
          if (!$category_id) {
            $ps_product_category->list_all("parent_category_id", $category_id);
          }
          else {
            $ps_product_category->list_all("category_parent_id", $category_id);
          }
        echo "<input type=\"hidden\" name=\"current_parent_id\" value=\"".$db->f("category_parent_id")."\" />"; ?>
      </td>
    </tr>
    <tr>
      <td colspan="2"><br /></td>
    </tr>
    <tr>
      <td><div align="right">Category Browse Page: </div></td>
      <td valign="top">
      <input type="text" class="inputbox" name="category_browsepage" value="<?php $db->sp("category_browsepage"); ?>" />
      </td>
    </tr>
    <tr>
      <td ><div align="right">Show x products per row: </div></td>
      <td valign="top">
      <input type="text" class="inputbox" size="3" name="products_per_row" value="<?php $db->sp("products_per_row"); ?>" />
      </td>
    </tr>
    <tr>
      <td colspan="2"><br /></td>
    </tr>
     <tr>
      <td ><div align="right">
        <?php echo $PHPSHOP_LANG->_PHPSHOP_CATEGORY_FORM_FLYPAGE ." ". $PHPSHOP_LANG->_PHPSHOP_LEAVE_BLANK ?>:</div>
      </td>
      <td valign="top">
      <input type="text" class="inputbox" name="category_flypage" value="<?php $db->sp("category_flypage"); ?>" />
      </td>
    </tr>
</table>
<?php
$tabs->endTab();
$tabs->startTab( "<img src=\"". IMAGEURL ."ps_image/image.png\" width=\"16\" height=\"16\" align=\"center\" border=\"0\" />&nbsp;"._E_IMAGES, "status-page");

if( !stristr( $db->f("category_thumb_image"), "http") )
  echo "<input type=\"hidden\" name=\"category_thumb_image_curr\" value=\"". $db->f("category_thumb_image") ."\" />";

if( !stristr( $db->f("category_full_image"), "http") )
  echo "<input type=\"hidden\" name=\"category_full_image_curr\" value=\"". $db->f("category_full_image") ."\" />";
?>

  <table width="100%" border="0" cellspacing="0" cellpadding="2">
    <tr> 
      <td valign="top" width="50%" style="border-right: 1px solid black;">
        <h2><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_FORM_FULL_IMAGE ?></h2>
        <table>
          <tr> 
            <td colspan="2" ><?php 
              if ($category_id) {
                echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_FORM_IMAGE_UPDATE_LBL . "<br />"; } ?> 
              <input type="file" class="inputbox" name="category_full_image" size="50" maxlength="255" />
            </td>
          </tr>
          <tr> 
            <td colspan="2" ><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_IMAGE_ACTION ?>:</strong><br/>
              <input type="radio" class="inputbox" name="category_full_image_action" checked="checked" value="none" onchange="toggleDisable( document.adminForm.category_full_image_action[1], document.adminForm.category_thumb_image, true );toggleDisable( document.adminForm.category_full_image_action[1], document.adminForm.category_thumb_image_url, true );"/>
              <?php echo $PHPSHOP_LANG->_PHPSHOP_NONE ?><br/>
              <input type="radio" class="inputbox" name="category_full_image_action" value="auto_resize" onchange="toggleDisable( document.adminForm.category_full_image_action[1], document.adminForm.category_thumb_image, true );toggleDisable( document.adminForm.category_full_image_action[1], document.adminForm.category_thumb_image_url, true );"/>
              <?php echo $PHPSHOP_LANG->_PHPSHOP_FILES_FORM_AUTO_THUMBNAIL . "<br />"; 
              if ($category_id and $db->f("category_full_image")) { ?>
                <input type="radio" class="inputbox" name="category_full_image_action" value="delete" onchange="toggleDisable( document.adminForm.category_full_image_action[1], document.adminForm.category_thumb_image, true );toggleDisable( document.adminForm.category_full_image_action[1], document.adminForm.category_thumb_image_url, true );"/>
                <?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_FORM_IMAGE_DELETE_LBL . "<br />"; 
              } ?> 
            </td>
          </tr>
          <tr><td colspan="2">&nbsp;</td></tr>
          <tr> 
            <td width="21%" ><?php echo _URL." ("._CMN_OPTIONAL."!)&nbsp;"; ?></td>
            <td width="79%" >
              <?php 
              if( stristr($db->f("category_full_image"), "http") )
                $category_full_image_url = $db->f("category_full_image");
              else if(!empty($_REQUEST['category_full_image_url']))
                $category_full_image_url = $_REQUEST['category_full_image_url'];
              else
                $category_full_image_url = "";
              ?>
              <input type="text" class="inputbox" size="50" name="category_full_image_url" value="<?php echo $category_full_image_url ?>" onchange="if( this.value.length>0) document.adminForm.auto_resize.checked=false; else document.adminForm.auto_resize.checked=true; toggleDisable( document.adminForm.auto_resize, document.adminForm.category_thumb_image_url, true );toggleDisable( document.adminForm.auto_resize, document.adminForm.category_thumb_image, true );" />
            </td>
          </tr>
          <tr><td colspan="2">&nbsp;</td></tr>
          <tr> 
            <td colspan="2" >
              <div style="overflow:auto;">
                <?php echo $ps_product->image_tag($db->f("category_full_image"), "", 0, "category") ?>
              </div>
            </td>
          </tr>
        </table>
      </td>

      <td valign="top" width="50%">
        <h2><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_FORM_THUMB_IMAGE ?></h2>
        <table>
          <tr> 
            <td colspan="2" ><?php if ($category_id) {
                echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_FORM_IMAGE_UPDATE_LBL . "<br>"; } ?> 
              <input type="file" class="inputbox" name="category_thumb_image" size="50" maxlength="255" onchange="if(document.adminForm.category_thumb_image.value!='') document.adminForm.category_thumb_image_url.value='';" />
            </td>
          </tr>
          <tr> 
            <td colspan="2" ><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_IMAGE_ACTION ?>:</strong><br/>
              <input type="radio" class="inputbox" name="category_thumb_image_action" checked="checked" value="none" onchange="toggleDisable( document.adminForm.image_action[1], document.adminForm.category_thumb_image, true );toggleDisable( document.adminForm.image_action[1], document.adminForm.category_thumb_image_url, true );"/>
              <?php echo $PHPSHOP_LANG->_PHPSHOP_NONE ?><br/>
              <?php 
              if ($category_id and $db->f("category_thumb_image")) { ?>
                <input type="radio" class="inputbox" name="category_thumb_image_action" value="delete" onchange="toggleDisable( document.adminForm.image_action[1], document.adminForm.category_thumb_image, true );toggleDisable( document.adminForm.image_action[1], document.adminForm.category_thumb_image_url, true );"/>
                <?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_FORM_IMAGE_DELETE_LBL . "<br />"; 
              } ?> 
            </td>
          </tr>
          <tr><td colspan="2">&nbsp;</td></tr>
          <tr> 
            <td width="21%" ><?php echo _URL." ("._CMN_OPTIONAL.")&nbsp;"; ?></td>
            <td width="79%" >
              <?php 
              if( stristr($db->f("category_thumb_image"), "http") )
                $category_thumb_image_url = $db->f("category_thumb_image");
              else if(!empty($_REQUEST['category_thumb_image_url']))
                $category_thumb_image_url = $_REQUEST['category_thumb_image_url'];
              else
                $category_thumb_image_url = "";
              ?>
              <input type="text" class="inputbox" size="50" name="category_thumb_image_url" value="<?php echo $category_thumb_image_url ?>" />
            </td>
          </tr>
          <tr><td colspan="2">&nbsp;</td></tr>
          <tr>
            <td colspan="2" >
              <div style="overflow:auto;">
                <?php echo $ps_product->image_tag($db->f("category_thumb_image"), "", 0, "category") ?>
              </div>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
<?php
$tabs->endTab();
$tabs->endPane();

// Add necessary hidden fields
$formObj->hiddenField( 'category_id', $category_id );

$funcname = !empty($category_id) ? echo "productCategoryUpdate" : "productCategoryAdd";

//finally close the form:
$formObj->finishForm( $funcname, $modulename.'.product_category_list', $option );

?>
<script language="javascript">
<!--
function toggleDisable( elementOnChecked, elementDisable, disableOnChecked ) {
  if( !disableOnChecked ) {
    if(elementOnChecked.checked==true) {
      elementDisable.disabled=false; 
    }
    else {
      elementDisable.disabled=true;
    }
  }
  else {
    if(elementOnChecked.checked==true) {
      elementDisable.disabled=true; 
    }
    else {
      elementDisable.disabled=false;
    }
  }
}

toggleDisable( document.adminForm.category_full_image_action[1], document.adminForm.category_thumb_image, true );
-->
</script>
