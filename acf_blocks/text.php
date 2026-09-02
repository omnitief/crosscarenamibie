<?php
if ( custom_acf_is_backend_block_preview() ) {
	return;
}
 
$space = get_spacing_class(get_field('space'));
$background_color = get_color_classes(get_field('background_color'));
$full_id = get_full_id(get_field('id'));
$button = get_field('button');
$text_width = get_field('text_width');
$pane_image = get_field('pane_image');
?>
<section <?= $full_id; ?> class="pr <?= "{$background_color}"; ?>">
	<?php divider(); ?>
	<div class="<?= $space; ?>">
		<div class="container ">
			<div class="row">
				<div class="col-12">
					<div class="text <?= $text_width; ?>">
						<div>
							<?php the_field('text'); ?>
						</div>
						<?php 
						get_template_part('components/button/wrapper', '', [
							'button' => $button,
						]);
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php 
	get_template_part('components/pane_image', '', [
		'group_data' => $pane_image,
		'class_pane' => 'dn xl-f',
	]);
	?>
</section>