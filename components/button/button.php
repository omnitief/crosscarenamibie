<?php 
if (empty($args['button'])) {
	return;
}
$type = $args['type'] ?? false;
$target = $args['button']['target'] ?? false;
$aria_label = get_aria_label($args['button']['title']);
$class = $args['class'] ?? '';
$end_class = "{$class}"; 

if ($type !== 'link') {
	$icon_class = $args['icon_class'] ?? '';
	$style = $args['style'] ?? 'secondary';
	$end_class .= " btn btn--primary ohd pr dif f-c style-{$style} fw-7";
}

if ($target) {
	$target = 'target="_blank" rel="noopener nofollow"';
}
?>

<a href="<?= $args['button']['url']; ?>" class="<?= $end_class; ?>" <?= $target; ?> <?= $aria_label; ?>>
	<?php
	echo $args['button']['title'];
	
	if ($type !== 'link') {
		get_template_part('components/button/icon', '', [
			'class' => 'pa hover-disabled',
		]);	
		get_template_part('components/button/icon', '', [
			'class' => 'pa hover-disabled',
		]);	
	}
	?>
</a>
