<?php
if ( custom_acf_is_backend_block_preview() ) {
	return;
}

$space = get_spacing_class( get_field('space') );
$background_color = get_color_classes(get_field('background_color'));
$full_id = get_full_id(get_field('id'));
$images = get_field('images');
$slider = get_field('slider');
$layout = get_field('layout');

$section_class = '';
if($layout === 'slider') {
	$section_class = 'slider slider--gallery';
}

?>

<section <?= $full_id; ?> class="<?= "pr ohd {$section_class} {$background_color}"; ?>">
	<?php divider() ?>
	<div class="container <?= $space; ?>">
		<div class="row">
			<div class="col-12">
				<?php if($layout === 'static' && $images) { ?>
				<div class="gallery f fw gap-row-horizontal">
					<?php 
					foreach ( $images as $image ) {
						?>
						<div class="gallery__item r pr ohd">
							<?= wp_get_attachment_image($image, 'full', '', ['class' => 'cover']); ?>
						</div>
						<?php
					}
					?>
				</div>
				<?php } elseif($layout === 'slider' && $slider) { ?>
				<div class="swiper">
					<div class="swiper-wrapper">
					<?php 
					foreach ( $slider as $slide ) {
						?>
						<div class="swiper-slide r pr ohd">
							<?= wp_get_attachment_image($slide, 'full', '', ['class' => '']); ?>
						</div>
						<?php
					}
					?>
					</div>
					<div class="swiper-pagination f f--c p-t--xsmall"></div>
				</div>					
				<?php } ?>
			</div>
		</div>
	</div>

	<?php 
	$pane_image = get_field('pane_image');
	get_template_part('components/pane_image', '', [
		'group_data' => $pane_image
	]);
	?>
</section>