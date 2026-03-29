<?php 
$title = $args['title'];
$class = $args['class'] ?? '';
$url = $args['url'] ?? false;
$default_class = "label dif f-c fw-6 ff-primary bg-accent";

if ( $url ) {
	$aria_label = get_aria_label( $title );
	?>
	<a href="<?= $url; ?>" <?= $aria_label; ?> class="<?= "{$default_class} {$class}"; ?>">
		<?= $title; ?>
	</a>
	<?php
} else {
	?>
	<div class="<?= "{$default_class} {$class}"; ?>">
		<?= $title; ?>
	</div>
	<?php
}