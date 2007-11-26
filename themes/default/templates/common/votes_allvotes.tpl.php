<?php defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); ?>

<!-- The "Average Customer Rating: xxxxX (2 votes) " Part -->
<span class="contentpagetitle"><?php echo $VM_LANG->_('PHPSHOP_CUSTOMER_RATING') ?>:</span>
<br />
<img src="<?php echo VM_THEMEURL ?>images/stars/<?php echo $rating ?>.gif" align="middle" border="0" alt="<?php echo $rating ?> stars" />&nbsp;
<?php echo $VM_LANG->_('PHPSHOP_TOTAL_VOTES').": ". $allvotes; ?>
