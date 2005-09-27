<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
*
* @version $Id: COPYRIGHT.php 70 2005-09-15 20:45:51Z spacemonkey $
* @package VirtueMart
* @subpackage html
* @copyright Copyright (C) 2004-2005 Soeren Eberhardt. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_phpshop/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/
mm_showMyFileName( __FILE__ );

global $page, $last_page, $error, $database;
$return_to_page = mosGetParam( $_REQUEST, 'return_to_page' );
$i = 0;
if( !empty( $database->_log )) {
  foreach( $database->_log as $sql ) {
    if( strstr( $sql, "_pshop_" ) || strstr( $sql, "'BT'" ) || strstr( $sql, "first_name"))
      $i++;
  }
}
include_once(ADMINPATH ."/version.php");
$tabs = new mShopTabs(0, 1, "_main");
$tabs->startPane("content-pane");
$tabs->startTab( "Shop Core Variables", "shop-variables" );
?>
      <table width="100%" border="0" cellspacing="0" cellpadding="2" >
        <tr class="sectiontableheader" nowrap> 
          <td colspan="4" align="center">
          <h3>--DEBUG--</h3><br />
          <?php echo "Version: <div align=\"center\">$version</div>"; ?></td>
        </tr>
        <tr nowrap> 
          <td class="sectiontableentry1" nowrap align="right" width="14%"><b>RunTime:</b></td>
          <td align="left" nowrap width="32%"><?php echo @$runtime; ?> sec.&nbsp;</td>
          <td class="sectiontableentry1" width="18%" align="right" valign="top"><b>Current Page:</b></td>
          <td width="36%" valign="top"><?php echo $page; ?></td>
        </tr>
        <tr nowrap> 
          <td class="sectiontableentry2" width="14%" align="right" valign="top" nowrap><b>No. of queries executed:</b></td>
          <td width="32%" valign="top" nowrap><?php 
            echo $i 
                . "&nbsp;&nbsp;"
                .mosToolTip( mysql_escape_string("Note: This is only the number of queries related to mambo-phpShop, 
                              which have been processed so far. Because the component is wrapped 
                              into the Mambo Framework, we can't get the total number of Queries at THIS point")); 
            ?>
          </td>
          <td class="sectiontableentry2" width="18%" align="right" valign="top"><b>Last Page:</b></td>
          <td width="36%" valign="top"><?php echo empty($_SESSION['last_page']) ? "empty" : $_SESSION['last_page']; ?>&nbsp;</td>
        </tr>
        <tr nowrap> 
          <td class="sectiontableentry1" width="14%" align="right" nowrap valign="top"><b>UID:</b></td>
          <td width="32%" nowrap valign="top"><?php echo $auth["user_id"]; ?>&nbsp;</td>
          <td class="sectiontableentry1" width="18%" align="right" valign="top"><b>Return To Page:</b></td>
          <td width="36%" valign="top"><?php echo $return_to_page; ?>&nbsp;</td>
        </tr>
        <tr nowrap> 
          <td class="sectiontableentry2" width="14%" align="right" valign="top"><b>Username:</b></td>
          <td width="32%" valign="top"><?php echo $auth["username"]; ?>&nbsp;</td>
          <td class="sectiontableentry2" width="18%" align="right" valign="top"><b>Function:</b></td>
          <td width="36%" valign="top"><?php echo $func;?>&nbsp;</b></td>
        </tr>
        <tr nowrap> 
          <td class="sectiontableentry1" width="14%" align="right" valign="top"><b>Perms:</b></td>
          <td width="32%" valign="top"><?php echo $auth["perms"]; ?>&nbsp;</td>
          <td class="sectiontableentry1" width="18%" align="right" valign="top"><b>&nbsp;&nbsp;Command:</b></td>
          <td width="36%" valign="top">
            <?php echo $cmd."<br />Result:"; 
                  if ($ok) 
                     echo "True"; 
                  else  
                     echo "False"; ?>  &nbsp;</td>
        </tr>
        <tr nowrap> 
          <td class="sectiontableentry2" width="14%" align="right" valign="top"><b>$func_perms:</b></td>
          <td width="32%" valign="top"><?php echo $func_list["perms"]; ?>&nbsp;</td>
          <td class="sectiontableentry2" width="18%" align="right" valign="top"><b>$ps_vendor_id:</b></td>
          <td width="36%" valign="top"><?php echo $ps_vendor_id; ?> &nbsp;&nbsp;</td>
        </tr>
        <tr> 
          <td class="sectiontableentry1" width="14%" align="right" valign="top"><b>&nbsp;&nbsp;</b><b>$dir_perms:</b></td>
          <td width="32%" valign="top"><?php echo $dir_list["perms"]; ?>&nbsp;</td>
          <td class="sectiontableentry1" width="18%" align="right" valign="top"><b>$error:</b></td>
          <td width="36%" valign="top"><?php echo $error; ?> &nbsp;&nbsp;</td>
        </tr>
        <tr> 
          <td class="sectiontableentry2" align="right" width="14%"><b>$cart:</b></td>
          <td colspan="3" width="32%"><?php   
          for ($i=0; $i < $_SESSION["cart"]["idx"];$i++) {
            echo "\$cart[$i]:ID[" . $_SESSION["cart"][$i]["product_id"];
            echo "]->Qty:[" . $_SESSION["cart"][$i]["quantity"] . "]<br />";
           } 
           ?></td>
        </tr>
        <tr> 
          <td class="sectiontableentry2" align="right" width="14%"><b>$auth:</b></td>
          <td colspan="3" width="32%"><?php   print_r( $auth ); ?></td>
        </tr>
    </table>
<?php
$tabs->endTab();
$tabs->startTab( "Global Variables", "global-variables");
?>
    <table width="100%" border="0" cellspacing="0" cellpadding="2" >
    
        <?php 
        if ($_POST) { ?>
        <tr class="sectiontableentry1"> 
          <td width="14%" align="right" valign="top"><b>$_POST:</b></td>
          <td colspan="3" width="32%" valign="top"><?php   
            while (list($val,$key) = each($_POST)) {
              echo "$val=>$key<br/>";
            }
            ?>
          </td>
          <?php 
          }
          if ($_GET) { ?>
        <tr class="sectiontableentry1"> 
          <td width="14%" align="right" valign="top"><b>$_GET:</b> </td>
          <td colspan="3" width="32%" valign="top"><?php   
            while (list($val,$key) = each($_GET)) {
              echo "$val=>$key<br/>";
            }
            ?>
          </td>
    <?php } ?>
        </tr><?php
        if ($_SESSION) { ?>
        <tr class="sectiontableentry1"> 
          <td width="14%" align="right" valign="top"><b>$_SESSION:</b></td>
          <td colspan="3" width="32%" valign="top"><?php   echo "<pre>".print_r( $_SESSION, true )."</pre>";  ?>
          </td>
          <?php 
        }
        else {
          echo "<strong>Something's wrong with your Session Setup - the Session is empty. mambo-phpShop cannot run without
          Sessions!</strong>";
        }
          ?>
        <tr class="sectiontableentry1"> 
          <td width="14%" align="right" valign="top">&nbsp;</td>
          <td colspan="3" width="32%" valign="top">&nbsp;</td>
        </tr>
        <tr class="sectiontableentry2">
          <td width="18%" align="right" valign="top"><b>$vars:</b></td>
          <td colspan="3" width="36%"><?php   
            while (list($val,$key) = each($vars)) {
              echo "$val=>$key<br/>";
            }
            ?>
          </td>
        </tr>
      </table>
<?php
$tabs->endTab();
$tabs->endPane();
?>

