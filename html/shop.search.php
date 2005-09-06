<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: shop.search.php,v 1.5 2005/05/02 19:48:16 soeren_nb Exp $
* 
* @package mambo-phpShop
* @subpackage HTML
* @copyright (C) John Syben (www.webme.co.nz)
* @license under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @version $Revision: 1.5 $
* 
* www.mambo-phpshop.net
*
* Advanced search for phpShop
*/
mm_showMyFileName( __FILE__ );

if( isset($_VERSION)) {
 $mainframe->setPageTitle( $PHPSHOP_LANG->_PHPSHOP_ADVANCED_SEARCH );
}

?>
<h2><?php echo $PHPSHOP_LANG->_PHPSHOP_ADVANCED_SEARCH ?></h2>

<br/>
<a href="<?php echo URL ?>index.php?option=com_phpshop&page=shop.parameter_search&Itemid=<?php $_REQUEST['Itemid'] ?>">
<h3><?php echo $PHPSHOP_LANG->_PHPSHOP_PARAMETER_SEARCH ?></h3></a>
<br/>
<table width="100%" border="0" cellpadding="2" cellspacing="0">
<tr>
<td valign="top">
<!-- body starts here -->
<br />

	<form action="<?php echo URL ?>index.php" method="post" name="adv_search">
	<input type="hidden" name="page" value="shop.browse" />
	<input type="hidden" name="option" value="com_phpshop" />
	<input type="hidden" name="Itemid" value="<?php echo @$_REQUEST['Itemid'] ?>" />
  
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
	<td>
			<table width="100%" border="0" cellpadding="2" cellspacing="0">
			<tr>
			<td valign="top"	>
            <input class="inputbox" type="text" name="keyword1" size="20"/>
            <br /><br />
            <select class="inputbox" name="search_op">
                <option value="and"><?php echo $PHPSHOP_LANG->_PHPSHOP_SEARCH_AND ?></option>
                <option value="and not"><?php echo $PHPSHOP_LANG->_PHPSHOP_SEARCH_NOT ?></option>
            </select>
            <br /><br />
            <input type="text"  class="inputbox" name="keyword2" size="20" />
            <br /><br />
            <select class="inputbox" name="search_category">
              <option value="0"><?php echo $PHPSHOP_LANG->_PHPSHOP_SEARCH_ALL_CATEGORIES ?></option>
              <?php 
              // Show only top level categories and categories that are
              // being published
              $q = "SELECT category_id,category_name FROM #__pshop_category ";
              $q .= "WHERE category_publish='Y' ";
              $q .= "ORDER BY category_name ASC";
              $db->query($q);
              while ($db->next_record()) {   ?> 
                  <option value="<?php echo $db->f("category_id"); ?>">
                    <?php echo $db->f("category_name"); ?>
                    </option>
                  <?php 
              } 
              ?>
            </select>
            <br /><br />
            <select class="inputbox" name="search_limiter">
                <option value="anywhere"><?php echo $PHPSHOP_LANG->_PHPSHOP_SEARCH_ALL_PRODINFO ?></option>
                <option value="name"><?php echo $PHPSHOP_LANG->_PHPSHOP_SEARCH_PRODNAME ?></option>
                <option value="cp"><?php echo $PHPSHOP_LANG->_PHPSHOP_SEARCH_MANU_VENDOR ?></option>
                <option value="desc"><?php echo $PHPSHOP_LANG->_PHPSHOP_SEARCH_DESCRIPTION ?></option>
            </select>
            <br /><br />
            
            <input type="submit" class="button" name="search" value="<?php echo $PHPSHOP_LANG->_PHPSHOP_SEARCH_TITLE ?>">
            <br />
			</td>
			<td valign="top">
				<table width="100%" cellspacing="2" cellpadding="2" border="0">
				<tr>
				<td>
				<?php echo $PHPSHOP_LANG->_PHPSHOP_SEARCH_TEXT2 ?>
        <br /><br />
        <?php echo $PHPSHOP_LANG->_PHPSHOP_SEARCH_TEXT1 ?>
       <br />
				</td>
				</tr>
				</table>
			</td>
			</tr>
			</table>
	</td>
	</tr>
	</table>
			</form>
      <script>
      document.adv_search.keyword1.select();
      document.adv_search.keyword1.focus();
      </script>
</td>
</tr>
</table>
