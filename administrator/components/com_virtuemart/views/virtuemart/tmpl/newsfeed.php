<?php
defined('_JEXEC') or die('Restricted access');

$totalItems=5;
if ( $this->virtuemartFeed) {
	foreach ($this->virtuemartFeed as $item) {
		if (!empty($item->link)) {
			$description=strip_tags($item->description);
			$description=substr($description, 0,200)."...";
			?>
			<li class="newsfeed-item">
				<a href="<?php echo $item->link; ?>" target="_blank" title=" <?php echo $description; ?>"> <?php echo $item->title; ?></a>
			</li>
		<?php
		}
	}
}
?>
