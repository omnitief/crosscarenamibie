<?php 
$class = $args['class'] ?? '';
$tag = $args['tag'] ?? 'span';
$background_color = $args['background_color'] ?? 'bg-based';
?>

<<?= $tag; ?> class="btn-icon r-50 pr ohd <?= "{$class} {$background_color}"; ?>">
	<i class="icon icon-arrow pa pa-center"></i>
	<i class="icon icon-arrow pa pa-center"></i>
</<?= $tag; ?>>