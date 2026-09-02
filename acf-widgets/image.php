<?php
if ( custom_acf_is_backend_block_preview() ) {
	return;
}
 
$space = get_spacing_class( get_field('space') );
$image_id = get_field('image');
?>

<div class="widget widget-image <?= "{$space}"; ?>">
	<?= wp_get_attachment_image($image_id, 'medium') ?>
</div>