<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
* mambo-phpShop Review class code
* @version $Id: ps_reviews.php,v 1.12 2005/06/23 18:59:16 soeren_nb Exp $
* @package mambo-phpShop
*
* @copyright (C) 2004 Soeren Eberhardt
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
*
* www.mambo-phpshop.net
*/

class ps_reviews {
  

  
  function show_votes( $product_id ) {  
      echo ps_reviews::allvotes( $product_id );
  }
  
  function show_voteform( $product_id ) {
      echo ps_reviews::voteform( $product_id );
  }
    
  function show_reviews( $product_id ) {
    echo ps_reviews::product_reviews( $product_id );
  }
  
  function show_reviewform( $product_id ) {
      echo ps_reviews::reviewform( $product_id );
  }
  
  function allvotes( $product_id ) {
      global $database, $my, $PHPSHOP_LANG;
      
      if (PSHOP_ALLOW_REVIEWS == "1") {
          
          $q = "SELECT votes, allvotes, rating FROM #__pshop_product_votes "
                  . "WHERE product_id='$product_id' ";

          $database->setQuery( $q );
          $rows = null;
          $allvotes = 0;
          $rating=0;
          if ( $database->loadObject( $rows ) ) {
            $allvotes = $rows->allvotes;
            $rating = $rows->rating;
          }
          $html = "<img src=\"".IMAGEURL."stars/$rating.gif\" align=\"middle\" border=\"0\" alt=\"$rating stars\" />&nbsp;";
          $html .= $PHPSHOP_LANG->_PHPSHOP_TOTAL_VOTES.": ". $allvotes;
          return $html;
      }
  } 
  
  function voteform( $product_id ) {
      global $PHPSHOP_LANG, $page, $my;
      $html = "";
      if (PSHOP_ALLOW_REVIEWS == "1" && !empty($my->id)) { 
        $html = "<strong>". $PHPSHOP_LANG->_PHPSHOP_CAST_VOTE .":</strong>&nbsp;&nbsp;
        <form method=\"post\" action=\"". URL ."index.php\">
            <select name=\"user_rating\" class=\"inputbox\">
                <option value=\"5\">5</option>
                <option value=\"4\">4</option>
                <option selected=\"selected\" value=\"3\">3</option>
                <option value=\"2\">2</option>
                <option value=\"1\">1</option>
                <option value=\"0\">0</option>
            </select>
            <input class=\"button\" type=\"submit\" name=\"submit_vote\" value=\"". $PHPSHOP_LANG->_PHPSHOP_RATE_BUTTON."\" />
            <input type=\"hidden\" name=\"product_id\" value=\"$product_id\" />
            <input type=\"hidden\" name=\"option\" value=\"com_phpshop\" />
            <input type=\"hidden\" name=\"page\" value=\"$page\" />
            <input type=\"hidden\" name=\"category_id\" value=\"". @$_REQUEST['category_id'] ."\" />
            <input type=\"hidden\" name=\"Itemid\" value=\"". @$_REQUEST['Itemid'] ."\" />
            <input type=\"hidden\" name=\"func\" value=\"addVote\" />
        </form>";
      }
      return $html;
  }

  
  function product_reviews( $product_id, $limit=0 ) {
      global $database, $my, $PHPSHOP_LANG;
      $html = "";
      if (PSHOP_ALLOW_REVIEWS == "1" ) {
          $showall = mosgetparam( $_REQUEST, 'showall', 0);
          $q = "SELECT comment, time, userid, user_rating FROM #__pshop_product_reviews WHERE product_id='$product_id'";
          if( $limit > 0 )
            $q .= " LIMIT ".intval($limit);
          if( !$showall )
              $q .= "LIMIT 0,5";
          $database->setQuery( $q );
          $commentsdb=$database->loadObjectList();
          
          if ($commentsdb) {
              $html = "<h4>".$PHPSHOP_LANG->_PHPSHOP_REVIEWS.":</h4>";
              $i=0;
              foreach ($commentsdb as $commentdb)	{
                $database->setQuery("SELECT name FROM #__users WHERE id='".$commentdb->userid."'");
                $user= $database->loadObjectList();
                $html .= "<strong>". $user[0]->name."&nbsp;&nbsp;(". strftime (_DATE_FORMAT_LC, $commentdb->time).")</strong><br />";
                $html .= $PHPSHOP_LANG->_PHPSHOP_RATE_NOM.": <img src=\"".IMAGEURL."stars/".$commentdb->user_rating.".gif\" border=\"0\" alt=\"".$commentdb->user_rating."\" />";
                $html .= "<br />".$commentdb->comment."<br /><br />";
              }
          }
          else {
              $html .= $PHPSHOP_LANG->_PHPSHOP_NO_REVIEWS." <br />";
              if (!empty($my->id)) 
                $html .= $PHPSHOP_LANG->_PHPSHOP_WRITE_FIRST_REVIEW;
              else 
                $html .= $PHPSHOP_LANG->_PHPSHOP_REVIEW_LOGIN;
          }
          if( !$showall && sizeof( $commentsdb)>=5 )
            $html .= "<a href=\"".$_SERVER['REQUEST_URI']."&showall=1\">"._MORE."</a>";
      }
      return $html;
  }
  
  function reviewform( $product_id ) {
      global $database, $my, $page, $PHPSHOP_LANG;
      $html = "";
      
      $database->setQuery("SELECT userid FROM #__pshop_product_reviews WHERE product_id='$product_id' AND userid='".$my->id."'");
      $alreadycommented = $database->loadObjectList();
      
      if (PSHOP_ALLOW_REVIEWS == "1" && !empty($my->id) && !$alreadycommented) { 
        $html = "<script language=\"JavaScript\" type=\"text/javascript\">//<![CDATA[
        function check_reviewform() {
            var form = document.getElementById('reviewform');

            var ausgewaehlt = false;
            for (var i=0; i<form.user_rating.length; i++)
               if (form.user_rating[i].checked)
                  ausgewaehlt = true;
            if (!ausgewaehlt)  {
              alert('".html_entity_decode($PHPSHOP_LANG->_PHPSHOP_REVIEW_ERR_RATE) ."');
              return false;
            }
            else if (form.comment.value.length < 100) {
              alert('". html_entity_decode($PHPSHOP_LANG->_PHPSHOP_REVIEW_ERR_COMMENT1) ."');
              return false;
            }
            else if (form.comment.value.length > 2000) {
              alert('". html_entity_decode($PHPSHOP_LANG->_PHPSHOP_REVIEW_ERR_COMMENT2) ."');
              return false;
            }
            else {
              return true;
            }
        }
        function refresh_counter() {
          var form = document.getElementById('reviewform');
          form.counter.value= form.comment.value.length;
        }
      //]]></script>
            <h4>". $PHPSHOP_LANG->_PHPSHOP_WRITE_REVIEW ."</h4>
            <br />". $PHPSHOP_LANG->_PHPSHOP_REVIEW_RATE ."
            <form method=\"post\" action=\"". URL ."index.php\" name=\"reviewForm\" id=\"reviewform\">
            <table cellpadding=\"5\" summary=\"".$PHPSHOP_LANG->_PHPSHOP_REVIEW_RATE."\">
              <tr>
                <th id=\"five_stars\"><img alt=\"5 stars\" src=\"".IMAGEURL."stars/5.gif\" border=\"0\" /></th>
                <th id=\"four_stars\"><img alt=\"4 stars\" src=\"".IMAGEURL."stars/4.gif\" border=\"0\" /></th>
                <th id=\"three_stars\"><img alt=\"3 stars\" src=\"".IMAGEURL."stars/3.gif\" border=\"0\" /></th>
                <th id=\"two_stars\"><img alt=\"2 stars\" src=\"".IMAGEURL."stars/2.gif\" border=\"0\" /></th>
                <th id=\"one_star\"><img alt=\"1 star\" src=\"".IMAGEURL."stars/1.gif\" border=\"0\" /></th>
                <th id=\"null_stars\"><img alt=\"0 stars\" src=\"".IMAGEURL."stars/0.gif\" border=\"0\" /></th>
              </tr>
              <tr>
                <td headers=\"five_stars\" style=\"text-align:center;\">
                  <input type=\"radio\" name=\"user_rating\" value=\"5\" /></td>
                <td headers=\"four_stars\" style=\"text-align:center;\"><input type=\"radio\" name=\"user_rating\" value=\"4\" /></td>
                <td headers=\"three_stars\" style=\"text-align:center;\"><input type=\"radio\" name=\"user_rating\" value=\"3\" /></td>
                <td headers=\"two_stars\" style=\"text-align:center;\"><input type=\"radio\" name=\"user_rating\" value=\"2\" /></td>
                <td headers=\"one_star\" style=\"text-align:center;\"><input type=\"radio\" name=\"user_rating\" value=\"1\" /></td>
                <td headers=\"null_stars\" style=\"text-align:center;\"><input type=\"radio\" name=\"user_rating\" value=\"0\" /></td>
              </tr>
            </table>
            <br /><br />". $PHPSHOP_LANG->_PHPSHOP_REVIEW_COMMENT ."<br />
            <textarea title=\"".$PHPSHOP_LANG->_PHPSHOP_REVIEW_COMMENT."\" class=\"inputbox\" id=\"comment\" onblur=\"refresh_counter();\" onfocus=\"refresh_counter();\" onkeypress=\"refresh_counter();\" name=\"comment\" rows=\"10\" cols=\"55\"></textarea>
            <br />
            <input class=\"button\" type=\"submit\" onclick=\"return( check_reviewform());\" name=\"submit_review\" title=\"". $PHPSHOP_LANG->_PHPSHOP_REVIEW_SUBMIT ."\" value=\"". $PHPSHOP_LANG->_PHPSHOP_REVIEW_SUBMIT ."\" />
            
            <div align=\"right\">". $PHPSHOP_LANG->_PHPSHOP_REVIEW_COUNT ."
            <input type=\"text\" value=\"0\" size=\"4\" class=\"inputbox\" name=\"counter\" maxlength=\"4\" readonly=\"readonly\" />
            </div>
            
            <input type=\"hidden\" name=\"product_id\" value=\"$product_id\" />
            <input type=\"hidden\" name=\"option\" value=\"com_phpshop\" />
            <input type=\"hidden\" name=\"page\" value=\"$page\" />
            <input type=\"hidden\" name=\"category_id\" value=\"". @$_REQUEST['category_id'] ."\" />
            <input type=\"hidden\" name=\"Itemid\" value=\"". @$_REQUEST['Itemid'] ."\" />
            <input type=\"hidden\" name=\"func\" value=\"addReview\" />
        </form>";
        
      }
      if ($alreadycommented) {
          $html .= $PHPSHOP_LANG->_PHPSHOP_REVIEW_ALREADYDONE;
      }
      return $html;
  }
  
  function process_vote( &$d ) {
    global $database, $my, $PHPSHOP_LANG;
    
    if (PSHOP_ALLOW_REVIEWS == "1" && !empty($my->id)) {
    
        if (($d["user_rating"]>=0) && ($d["user_rating"]<=5)) {
          $sql = "SELECT votes,allvotes FROM #__pshop_product_votes WHERE product_id = '". $d["product_id"]."'";
          $database->setQuery( $sql );
          $votesdb=null;
          if (!($database->loadObject( $votesdb ))){
            $sql="INSERT INTO #__pshop_product_votes (product_id) VALUES (".$d["product_id"].")";
            $database->setQuery( $sql );
            $database->query();
            $votes = '';
            $lastip = '';
            $allvotes = 0;
          }
          $currip = getenv("REMOTE_ADDR");

          $allvotes=intval( $votesdb->allvotes );
          $votes=$d["user_rating"].','.$votesdb->votes;
          $votes_arr=explode(",", $votes);
          $votes_count=array_sum($votes_arr);
          $newrating=$votes_count / ( ( $votesdb->allvotes )+1 );
          $newrating = round( $newrating );
          $sql="UPDATE #__pshop_product_votes SET allvotes=allvotes+1, rating=$newrating, votes='$votes', lastip='$currip' WHERE product_id='".$d["product_id"]."'";
          $database->setQuery( $sql );
          $database->query();

        }
        
    }
    return true;
  }
  
  function process_review( &$d ) {
      global $database, $my, $PHPSHOP_LANG;
      
      if (PSHOP_ALLOW_REVIEWS == "1" && !empty($my->id) ) {
          if( strlen( $d["comment"] ) < 100 ) {
            $_REQUEST['mosmsg'] = $PHPSHOP_LANG->_PHPSHOP_REVIEW_ERR_COMMENT1;
            return true;
          }
          if( strlen ( $d["comment"] ) > 2000 ) {
            $_REQUEST['mosmsg'] = $PHPSHOP_LANG->_PHPSHOP_REVIEW_ERR_COMMENT2;
            return true;
          }
          if( empty( $d["user_rating"] ) || intval( $d["user_rating"] ) < 0 || intval( $d["user_rating"] ) > 5) {
            $_REQUEST['mosmsg'] = $PHPSHOP_LANG->_PHPSHOP_REVIEW_ERR_RATE;
            return true;
          }
          $commented=false;
          $sql = "SELECT userid FROM #__pshop_product_reviews WHERE product_id = '".$d["product_id"]."'";
          $database->setQuery( $sql );
          if ($commentsdb = $database->loadObjectList()){
            foreach ($commentsdb as $commentdb)
            {
              if ($commentdb->userid==$my->id){
                  $commented=true;
                  break;
              }
            } 
          } 
          if ($commented==false) {
            $comment=nl2br(htmlspecialchars(strip_tags($d["comment"])));
            $sql="INSERT INTO #__pshop_product_reviews (product_id, comment, userid, time, user_rating) VALUES 
                      ('".$d["product_id"]."', '$comment', '".$my->id."', '".time()."', '".$d["user_rating"]."')";
            $database->setQuery( $sql );
            $database->query();
            $this->process_vote( $d );
          } 
          else {
            $_REQUEST['mosmsg'] = $PHPSHOP_LANG->_PHPSHOP_REVIEW_ALREADYDONE;
          }
          
          $_REQUEST['mosmsg'] = $PHPSHOP_LANG->_PHPSHOP_REVIEW_THANKYOU;
      }
      return true;
  }
  
  
  function delete_review( &$d ) {
      global $database, $my;
      
      $database->setQuery("SELECT user_rating FROM #__pshop_product_reviews "
                                        ."WHERE product_id='".$d["product_id"]."' AND userid='".$d["userid"]."'");
      $row  = $database->loadObjectList();
      $user_rating = $row[0]->user_rating;
      
      $database->setQuery("SELECT allvotes,votes FROM #__pshop_product_votes WHERE product_id='".$d["product_id"]."'");
      $row  = $database->loadObjectList();
      $votes = $row[0]->votes;
      $allvotes = $row[0]->allvotes;
      
      /** Exclude one vote with the value of the user_rating 
      * of the user, we delete the review of  **/
      if (strpos($votes, $user_rating)==0)
          $votes = substr($votes, 2);
      else {
          $votes = substr( $votes, 0, strpos($votes, $user_rating))
                  . substr( $votes, strpos($votes, $user_rating)+2);
      }
      $votes_arr=explode(",", $votes);
      $votes_count=array_sum($votes_arr);
      $newrating=$votes_count / ( ( $allvotes )-1 );
      $newrating = round( $newrating );
      $database->setQuery("UPDATE #__pshop_product_votes SET allvotes=allvotes-1, votes = '$votes', rating='$newrating'"
                                        ." WHERE product_id='".$d["product_id"]."'");
      $database->query();
      
      /** Now delete the review ***/
      $database->setQuery("DELETE FROM #__pshop_product_reviews WHERE userid='".$d["userid"]."' AND product_id='".$d["product_id"]."'");
      $database->query();
      
      return true;
  }
}
