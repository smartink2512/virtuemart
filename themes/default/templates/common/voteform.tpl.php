<?php defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); ?>

<!-- The "Vote for a product" Form -->
<strong><?php $VM_LANG->_PHPSHOP_CAST_VOTE ?>:</strong>&nbsp;&nbsp;

<form method="post" action="<?php echo $mm_action_url ?>index.php">
    <select name="user_rating" class="inputbox">
        <option value="5">5</option>
        <option value="4">4</option>
        <option selected="selected" value="3">3</option>
        <option value="2">2</option>
        <option value="1">1</option>
        <option value="0">0</option>
    </select>
    <input class="button" type="submit" name="submit_vote" value="". $VM_LANG->_PHPSHOP_RATE_BUTTON."" />
    <input type="hidden" name="product_id" value="$product_id" />
    <input type="hidden" name="option" value="$option" />
    <input type="hidden" name="page" value="$page" />
    <input type="hidden" name="category_id" value="". @intval($_REQUEST['category_id']) ."" />
    <input type="hidden" name="Itemid" value="". @intval($_REQUEST['Itemid']) ."" />
    <input type="hidden" name="func" value="addVote" />
</form>