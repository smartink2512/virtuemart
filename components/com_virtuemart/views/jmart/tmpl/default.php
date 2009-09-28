<?php 
defined('_JEXEC') or die('Restricted access');
?>

<link rel="stylesheet" href="<?php echo JMART_THEMEPATH.DS.JMART_THEMENAME.DS.'theme.css'; ?>" type="text/css" />
        
<div id="store">

<?php    
// Display a list of child categories
include(JMART_THEMEPATH.DS.JMART_THEMENAME.DS.'templates'.DS.'common'.DS.'categoryChildlist.tpl.php');

// Display the featured products
include(JMART_THEMEPATH.DS.JMART_THEMENAME.DS.'templates'.DS.'common'.DS.'featuredProducts.tpl.php');
?>

</div>