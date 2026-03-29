<?php 
$space = get_spacing_class( get_field('space') );
$button = get_field('button');
?>

<div class="widget text <?= "{$space}"; ?>">
	<div>
		<?php the_field('text'); ?>
	</div>
	<?php 
	if ($button) {
		if ($button['button']) {
			get_template_part('components/button', '', [
				'button' => $button['button'],
				'type' => $button['style'],
			]);
		}
	}
	?>
</div>