<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: product.review_list.php,v 1.5 2005/01/27 19:34:03 soeren_nb Exp $
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

$product_id = mosgetparam($_REQUEST, 'product_id', 0);
$keyword = mosgetparam($_REQUEST, 'keyword', '');
$offset = mosgetparam($_REQUEST, 'offset', 0);
?>
 <table width="100%" cellspacing="0" cellpadding="4" border="0">
  <tr>
    <td>
      <br />&nbsp;&nbsp;&nbsp;<img alt="reviews" align="center" src="<?php echo IMAGEURL ?>ps_image/reviews.gif" width="51" height="51" border="0" />
      <span class="sectionname"><?php echo $PHPSHOP_LANG->_PHPSHOP_REVIEWS; ?>: 
        <?php
          $url = $_SERVER['PHP_SELF'] . "?page=$modulename.product_form&product_id=$product_id";
          echo "<a href=" . $sess->url($url) . ">";
          echo $ps_product->get_field($product_id,"product_name");
          echo "</a>"; 
        ?>
      </span>
    </td>
    <td>&nbsp;
    </td>
  </tr>
</table>

<table width="100%" cellpadding="1" cellspacing="0" border="0" align="center">
  <tr> 
    <td> 
      <table width="100%" class="adminlist">
        <tr> 
          <th width="5%">#</th>
          <th width="15%">Name/Date</th>
          <th width="45%"><?php echo $PHPSHOP_LANG->_PHPSHOP_REVIEW_COMMENT ?></th>
          <th width="25%"><?php echo $PHPSHOP_LANG->_PHPSHOP_RATE_NOM ?></th>
          <th width="10%"><? echo _E_REMOVE ?></th>
        </tr>
        <?php
        $product_id = $vars["product_id"];
        $q = "SELECT comment, user_rating,userid,username,time FROM #__pshop_product_reviews,#__users ";
        $q .= "WHERE product_id = '$product_id' AND id=userid ORDER BY userid"; 
        $db->query($q);
        $i = 1;
        while ($db->next_record()) { 
            if ($i % 2)
                $bgcolor=SEARCH_COLOR_1;
            else
              $bgcolor=SEARCH_COLOR_2;
 ?>         
        <tr bgcolor="<?php echo $bgcolor ?>" nowrap>
            <td><?php echo $i++; ?></td>
            <td><strong><?php echo $db->f("username")."</strong><br />(".date("Y-m-d", $db->f("time")).")"; ?></td>
            <td ><?php echo substr($db->f("comment"), 0 , 500); ?></td>
          <td ><img src="<?php echo IMAGEURL."stars/".$db->f("user_rating").".gif"; ?>" border="0" alt="stars" /></td>
          <td>
        <a class="toolbar" href="index2.php?option=com_phpshop&page=<?php echo $_REQUEST['page'] ?>&func=productReviewDelete&product_id=<?php echo $product_id ?>&userid=<?php echo $db->f("userid") ?>" onclick="return confirm('<? echo $PHPSHOP_LANG->_PHPSHOP_DELETE_MSG ?>');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('Delete<? echo $i ?>','','<? echo IMAGEURL ?>ps_image/delete_f2.gif',1);"><img src="<? echo IMAGEURL ?>ps_image/delete.gif" alt="Delete this record" name="delete<? echo $i ?>" align="middle" border="0"/>
        </a>
    </td>
          
        </tr>
        <?php 
        }
        $num_rows = $i;
?>
      </table>
    </td>
  </tr>
</table>
<?php
  search_footer($modulename, "product_list", $offset, $num_rows, $keyword);
?>
