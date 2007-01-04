<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
*
* @version $Id$
* @package VirtueMart
* @subpackage classes
* @copyright Copyright (C) 2004-2006 Soeren Eberhardt. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
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
	
	/**
	 * Returns the average customer rating for a given product ID
	 *
	 * @param int $product_id
	 * @return string
	 */
	function allvotes( $product_id ) {
		global $db;
		$tpl = new $GLOBALS['VM_THEMECLASS']();
		
		$q = "SELECT votes, allvotes, rating FROM #__{vm}_product_votes "
			. "WHERE product_id='$product_id' ";

		$db->query( $q );
		$allvotes = 0;
		$rating=0;
		if ( $db->next_record() ) {
			$allvotes = $db->f("allvotes");
			$rating = $db->f("rating");
		}
		$tpl->set('allvotes', $allvotes );
		$tpl->set('rating', $rating );
		$tpl->set('product_id', $product_id );
		
		return $tpl->fetch( 'common/votes_allvotes.tpl.php' );
		
	}
	/**
	 * Creates a voting form to vote for a product
	 *
	 * @param int $product_id
	 * @return string
	 */
	function voteform( $product_id ) {
		
		$tpl = new $GLOBALS['VM_THEMECLASS']();
		$tpl->set( 'product_id', $product_id );
		
		return $tpl->fetch( 'common/voteform.tpl.php' );
	}
	
	/**
	 * Returns a list of all reviews for the given product
	 *
	 * @param int $product_id
	 * @param int $limit
	 * @return string
	 */
	function product_reviews( $product_id, $limit=0 ) {
		global $db, $my, $VM_LANG;

		$tpl = new $GLOBALS['VM_THEMECLASS']();

		$dbc = &new ps_DB;
		$showall = mosgetparam( $_REQUEST, 'showall', 0);
		$q = "SELECT comment, time, userid, user_rating FROM #__{vm}_product_reviews WHERE product_id='$product_id' AND published='Y' ORDER BY `time` DESC ";
		$count = "SELECT COUNT(*) as num_rows FROM #__{vm}_product_reviews WHERE product_id='$product_id' AND published='Y'";

		if( $limit > 0 ) {
			$q .= " LIMIT ".intval($limit);
		}
		elseif( !$showall ) {
			$q .= " LIMIT 0, 5";
		}

		$dbc->query( $count );
		$num_rows = $dbc->f('num_rows');
		$dbc->query( $q );
		$reviews = array();
		$i=0;
		while( $dbc->next_record() ) {
			$db->query("SELECT username, name FROM #__users WHERE id='".$dbc->f("userid")."'");
			$db->next_record();
			$reviews[$i]['userid'] = $dbc->f("userid");
			$reviews[$i]['username'] = $db->f("username");
			$reviews[$i]['name'] = $db->f("name");
			$reviews[$i]['time'] = $dbc->f("time");
			$reviews[$i]['user_rating'] = $dbc->f("user_rating");
			$reviews[$i]['comment'] = $dbc->f("comment");
			$i++;
		}
		$tpl->set( 'num_rows', $num_rows );
		$tpl->set( 'reviews', $reviews );
		$tpl->set( 'showall', $showall );

		return $tpl->fetch( 'common/reviews.tpl.php' );
	}

	function update( &$d ) {
		global $VM_LANG, $vmLogger, $perm, $my, $mosConfig_offset;
		$db = new ps_DB;

		$d["comment"] = $db->getEscaped( trim(stripslashes($d["comment"])) );
		if( strlen( $d["comment"] ) < VM_REVIEWS_MINIMUM_COMMENT_LENGTH ) {
			$vmLogger->err( sprintf( $VM_LANG->_PHPSHOP_REVIEW_ERR_COMMENT1, VM_REVIEWS_MINIMUM_COMMENT_LENGTH ));
			return false;
		}
		if( strlen ( $d["comment"] ) > VM_REVIEWS_MAXIMUM_COMMENT_LENGTH ) {
			$vmLogger->err( sprintf( $VM_LANG->_PHPSHOP_REVIEW_ERR_COMMENT2, VM_REVIEWS_MAXIMUM_COMMENT_LENGTH ) );
			return false;
		}
		$time = time() + $mosConfig_offset*60*60;
		$q = "REPLACE INTO #__{vm}_product_reviews (`product_id`, `userid`, `comment`, `user_rating`, `time` )
      			VALUES (".$d['product_id'].", ".$d['userid'] . ", '".$d['comment']."', ".$d['user_rating'].", $time )";
		$db->query($q);
		$db->next_record();

		$this->process_vote( $d );

		$vmLogger->info( $VM_LANG->_PHPSHOP_REVIEW_MODIFIED );

		return true;
	}
	
	/**
	 * Returns a review form with a textarea to review and stars to rate a product
	 *
	 * @param int $product_id
	 * @return string
	 */
	function reviewform( $product_id ) {
		global $db, $my, $VM_LANG;
		
		$tpl = new $GLOBALS['VM_THEMECLASS']();

		$db->query("SELECT userid FROM #__{vm}_product_reviews WHERE product_id='$product_id' AND userid='".$my->id."'");
		$db->next_record();
		$alreadycommented = $db->num_rows() > 0;

		$review_comment = sprintf( $VM_LANG->_PHPSHOP_REVIEW_COMMENT, VM_REVIEWS_MINIMUM_COMMENT_LENGTH, VM_REVIEWS_MAXIMUM_COMMENT_LENGTH );
		
		$tpl->set( 'alreadycommented', $alreadycommented );
		$tpl->set( 'review_comment', $review_comment );

		return $tpl->fetch( 'common/reviewform.tpl.php' );
	}
	
	/**
	 * Processes a product vote / rating
	 *
	 * @param array $d
	 * @return boolean
	 */
	function process_vote( &$d ) {
		global $db, $my, $VM_LANG;

		if (PSHOP_ALLOW_REVIEWS == "1" && !empty($my->id)) {

			if (($d["user_rating"]>=0) && ($d["user_rating"]<=5)) {
				$sql = "SELECT votes,allvotes FROM #__{vm}_product_votes WHERE product_id = '". $d["product_id"]."'";
				$db->query( $sql );
				$db->next_record();

				if( $db->num_rows() < 1 ){
					$sql="INSERT INTO #__{vm}_product_votes (product_id) VALUES (".$d["product_id"].")";
					$db->query( $sql );
					$votes = $d["user_rating"];
					$lastip = '';
					$allvotes = 0;
				}
				else {
					$allvotes=intval( $db->f("allvotes") );
					$votes = $d["user_rating"].','.$db->f("votes");
				}
				$currip = $_SERVER["REMOTE_ADDR"];

				$votes_arr=explode(",", $votes);
				$votes_count=array_sum($votes_arr);
				$newrating=$votes_count / ( ( $allvotes )+1 );
				$newrating = round( $newrating );
				$sql="UPDATE #__{vm}_product_votes SET allvotes=allvotes+1, rating=$newrating, votes='$votes', lastip='$currip' WHERE product_id='".$d["product_id"]."'";
				$db->query( $sql );

			}

		}
		return true;
	}
	
	/**
	 * Process and store a product review
	 *
	 * @param array $d
	 * @return boolean
	 */
	function process_review( &$d ) {
		global $db, $my, $VM_LANG, $vmLogger;

		if (PSHOP_ALLOW_REVIEWS == "1" && !empty($my->id) ) {
			$d["comment"] = trim($d["comment"]);
			if( strlen( $d["comment"] ) < VM_REVIEWS_MINIMUM_COMMENT_LENGTH ) {
				$vmLogger->err($VM_LANG->_PHPSHOP_REVIEW_ERR_COMMENT1);
				return true;
			}
			if( strlen ( $d["comment"] ) > VM_REVIEWS_MAXIMUM_COMMENT_LENGTH ) {
				$vmLogger->err($VM_LANG->_PHPSHOP_REVIEW_ERR_COMMENT2);
				return true;
			}
			if( empty( $d["user_rating"] ) || intval( $d["user_rating"] ) < 0 || intval( $d["user_rating"] ) > 5) {
				$vmLogger->err($VM_LANG->_PHPSHOP_REVIEW_ERR_RATE);
				return true;
			}
			$commented=false;
			$sql = "SELECT userid FROM #__{vm}_product_reviews WHERE product_id = '".$d["product_id"]."'";
			$db->query( $sql );

			while( $db->next_record() ) {
				$uid = $db->f("userid");
				if ($db->f("userid") == $my->id){
					$commented=true;
					break;
				}
			}
			if ($commented==false) {
				$comment=$db->getEscaped( nl2br(htmlspecialchars(strip_tags($d["comment"]))) );
				$published = VM_REVIEWS_AUTOPUBLISH ? 'Y' : 'N';
				$sql="INSERT INTO #__{vm}_product_reviews (product_id, comment, userid, time, user_rating, published) VALUES
                      ('".$d["product_id"]."', '$comment', '".$my->id."', '".time()."', '".$d["user_rating"]."', '$published')";
				$db->query( $sql );
				$this->process_vote( $d );
				$vmLogger->info($VM_LANG->_PHPSHOP_REVIEW_THANKYOU);
			}
			else {
				$vmLogger->info( $VM_LANG->_PHPSHOP_REVIEW_ALREADYDONE );
			}
		}
		return true;
	}

	/**
	* Controller for Deleting Records.
	*/
	function delete_review( &$d ) {

		$record_id = $d["review_id"];

		if( is_array( $record_id)) {
			foreach( $record_id as $record) {
				if( !ps_reviews::delete_record( $record, $d ))
				return false;
			}
			return true;
		}
		else {
			return ps_reviews::delete_record( $record_id, $d );
		}
	}
	/**
	* Deletes one Record.
	*/
	function delete_record( $record_id, &$d ) {

		global $db, $my;
		$record_id = intval($record_id);
		$db->query("SELECT user_rating FROM #__{vm}_product_reviews "
		."WHERE review_id=".$record_id);
		$db->next_record();
		$user_rating = $db->f("user_rating");

		$db->query("SELECT allvotes,votes FROM #__{vm}_product_votes WHERE product_id='".$d["product_id"]."'");
		$db->next_record();
		$votes = $db->f("votes");
		$allvotes = $db->f("allvotes");

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
		if( ( $allvotes )-1 < 1 ) {
			$newrating=0;
		} else {
			$newrating=$votes_count / ( ( $allvotes )-1 );
		}
		$newrating = round( $newrating );
		if( !empty( $votes )) {
			$db->query("UPDATE #__{vm}_product_votes SET allvotes=allvotes-1, votes = '$votes', rating='$newrating'"
			." WHERE product_id='".$d["product_id"]."'");
		}
		else {
			// If there are no votes and reviews left, we can delete the vote record
			$db->query("DELETE FROM #__{vm}_product_votes
      					WHERE product_id='".$d["product_id"]."'");
		}
		/** Now delete the review ***/
		$db->query("DELETE FROM #__{vm}_product_reviews WHERE review_id=$record_id" );

		return true;
	}
}
