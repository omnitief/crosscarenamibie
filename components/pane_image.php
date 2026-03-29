<?php
$group_data = $args['group_data'];
if (!$group_data) {
	return;
}

$show = $group_data['show'];
if (!$show) {
	return;
}

$class_pane = $args['class_pane'] ?? '';
$image = $group_data['image'];
$pane_overflow = $group_data['pane_overflow'] ?? false;
$pane_position = $group_data['pane_position'] ?? false;

if ($pane_position) {
	$pane_position_top_bottom = $pane_position['top_bottom'];
	$pane_position_left_right = $pane_position['left_right'];
	$style_pane = "{$pane_position_left_right}:0;{$pane_position_top_bottom}:0;";
} else {
	$style_pane = "";
}

if (!$pane_overflow) {
	$style_pane .= "overflow:hidden;";
}

$side = $group_data['side'];
$side_top_bottom = $side['from_top_bottom'];
$side_left_right = $side['from_left_right'];

$position = $group_data['position'];
$position_top_bottom = $position['from_top_bottom'];
$position_left_right = $position['from_left_right'];
$width = $group_data['width'];

$class_image = "of-contain";
$style_image = "width:{$width}%;{$side_top_bottom}:{$position_top_bottom}%;{$side_left_right}:{$position_left_right}%;";
?>

<div class="pane-image pa z9 <?= $class_pane; ?>" style="<?= "$style_pane"; ?>">
	<?php 
	echo wp_get_attachment_image($image, 'medium', false, [
		'class' => "pa {$class_image}",
		'style' => $style_image,
	]);
	?>
</div>