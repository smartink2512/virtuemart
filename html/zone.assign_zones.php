<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: zone.assign_zones.php,v 1.3 2005/02/22 18:58:32 soeren_nb Exp $
* @package mambo-phpShop
* @subpackage HTML
* Contains code from PHPShop(tm):
* 	@copyright (C) 2000 - 2004 Edikon Corporation (www.edikon.com)
*	Community: www.phpshop.org, forums.phpshop.org
* Conversion to Mambo and the rest:
* 	@copyright (C) 2004-2005 Soeren Eberhardt
*
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
*
* www.mambo-phpshop.net
*/
mm_showMyFileName( __FILE__ );

search_header($PHPSHOP_LANG->_PHPSHOP_ASSIGN_ZONE_PG_LBL, "zone", "assign_zones"); 

// Enable the multi-page search result display
$limitstart = mosGetParam( $_REQUEST, "limitstart", 0 );
$keyword = mosGetParam( $_REQUEST, "keyword", "" );


if (!empty($keyword)) {
  $list  = "SELECT * FROM #__pshop_country WHERE ";
  $count = "SELECT count(*) as num_rows FROM #__pshop_country WHERE ";
  $q  = "(country_name LIKE '%$keyword%')";
  $q .= "ORDER BY country_name ASC ";
  $list .= $q . " LIMIT $limitstart, " . SEARCH_ROWS;
  $count .= $q;   
}
else  {
  $q = "";
  $list  = "SELECT * FROM #__pshop_country ORDER BY country_id ASC ";
  $count = "SELECT count(*) as num_rows FROM #__pshop_country"; 
  $list .= $q . " LIMIT $limitstart, " . SEARCH_ROWS;
  $count .= $q;   
}
$db->query($count);
$db->next_record();
$num_rows = $db->f("num_rows");
if ($num_rows == 0) {
  echo $PHPSHOP_LANG->_PHPSHOP_NO_SEARCH_RESULT;
}
else {
  ?>
  
  <table border="0" cellpadding="2" cellspacing="0" width="100%">
    <tr>
      <th width="25%" align="center"><?php echo $PHPSHOP_LANG->_PHPSHOP_ZONE_ASSIGN_COUNTRY_LBL;?></th>
      <th width="25%" align="center"><?php echo $PHPSHOP_LANG->_PHPSHOP_ZONE_ASSIGN_CURRENT_LBL;?></th>
      <th width="25%" align="center"><?php echo $PHPSHOP_LANG->_PHPSHOP_ZONE_ASSIGN_ASSIGN_LBL;?></th>
      <th width="25%" align="center"><?php echo $PHPSHOP_LANG->_PHPSHOP_ZONE_ASSIGN_UPDATE_LBL;?></th>
    </tr>
  <?php
  $db->query($list);
  $i = 0;
  while ($db->next_record()) {
    if ($i++ % 2) 
       $bgcolor=SEARCH_COLOR_1;
    else
       $bgcolor=SEARCH_COLOR_2;
    ?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
    <input type="hidden" name="country_id" value="<?php echo $db->f("country_id");?>">
      <tr bgcolor="<?php echo $bgcolor ?>"> 
        <td width="25%" align="center"><?php $db->p("country_name") ?> </td>
        <td width="25%" align="center">
        <?php 
        // Get the zone rate for each country
        
        $per_item = $ps_zone->per_item($db->f("zone_id"));
        $zone_limit = $ps_zone->zone_limit($db->f("zone_id"));
        ?>
        Per Item: <strong><?php echo $CURRENCY_DISPLAY->getFullValue($per_item);?></strong><br/>
        Limit: <strong><?php echo $CURRENCY_DISPLAY->getFullValue($zone_limit);?></strong>
        <?php
          if($db->f("zone_id") > "1") {
            $url = $_SERVER['PHP_SELF']."?page=zone.zone_form&zone_id=" . $db->f("zone_id");
            echo "<a href=\"" . $sess->url($url) . "\">";
            echo "Edit This Zone"; 
            echo "</a>"; 
        }
        ?>
        </td>
        <td width="25%" align="center"><?php  $ps_zone->list_zones("zone_id", $db->f("zone_id")); ?></td>
        <td width="25%" align="center">
          <input type="submit" name="submit" value="<?php echo $PHPSHOP_LANG->_PHPSHOP_ZONE_ASSIGN_UPDATE_LBL;?>" />
        </td>
      </tr>
      <input type="hidden" name="option" value="com_phpshop" />
      <input type="hidden" name="page" value="zone.assign_zones" />
      <input type="hidden" name="func" value="zoneassign" />
    </form>
    
    <?php 
  }
}
echo "</table>";
 search_footer("zone", "assign_zones", $limitstart, $num_rows, $keyword); 

?>
