<?php
if ( custom_acf_is_backend_block_preview() ) {
	return;
}
 
$space = get_spacing_class(get_field('space'));
$background_color = get_color_classes(get_field('background_color'));
$full_id = get_full_id(get_field('id'));
$text = get_field('text');
$logos = get_field('logos', 'options');
$logos_select = get_field('logos_select');

if ($logos_select) {
	$logos = rearrange_array($logos, $logos_select);
}
?>

<section <?= $full_id; ?> class="<?= "slider slider--logos pr {$background_color}"; ?>">
	<?php divider() ?>
	<div class="pr ohd">
		<div class="container <?= $space; ?>">
			<?php
			if ($text) {
				?>
				<div class="heading m-b--small text">
					<?= $text; ?>
				</div>
				<?php
			}

			if ($logos) {
				?>
				<div class="swiper">
					<div class="swiper-wrapper">
						<?php 
						foreach ( $logos as $logo_item ) {
							$url = $logo_item['url'];

							if ( $url ) {
								?>	
								<a href="<?= $url; ?>" target="_blank" rel="noopener nofollow" aria-label="<?php _e('Navigate to website', 'swift'); ?> <?= $logo_item['company_name']; ?>" class="swiper-slide f f-c f--c pr br border r">
									<?= wp_get_attachment_image($logo_item['logo'], 'full'); ?>
								</a>
								<?php
							} else {
								?>	
								<div class="swiper-slide bg-based border-based br border r f f-c f--c">
									<?= wp_get_attachment_image($logo_item['logo'], 'full'); ?>
								</div>
								<?php
							}
						} 
						foreach ( $logos as $logo_item ) {
							$url = $logo_item['url'];

							if ( $url ) {
								?>	
								<a href="<?= $url; ?>" target="_blank" rel="noopener nofollow" aria-label="<?php _e('Navigate to website', 'swift'); ?> <?= $logo_item['company_name']; ?>" class="swiper-slide f f-c f--c pr br border r">
									<?= wp_get_attachment_image($logo_item['logo'], 'full'); ?>
								</a>
								<?php
							} else {
								?>	
								<div class="swiper-slide bg-based border-based br border r f f-c f--c">
									<?= wp_get_attachment_image($logo_item['logo'], 'full'); ?>
								</div>
								<?php
							}
						} 
						foreach ( $logos as $logo_item ) {
							$url = $logo_item['url'];

							if ( $url ) {
								?>	
								<a href="<?= $url; ?>" target="_blank" rel="noopener nofollow" aria-label="<?php _e('Navigate to website', 'swift'); ?> <?= $logo_item['company_name']; ?>" class="swiper-slide f f-c f--c pr br border r">
									<?= wp_get_attachment_image($logo_item['logo'], 'full'); ?>
								</a>
								<?php
							} else {
								?>	
								<div class="swiper-slide bg-based border-based br border r f f-c f--c">
									<?= wp_get_attachment_image($logo_item['logo'], 'full'); ?>
								</div>
								<?php
							}
						} 
						?>
					</div>
				</div>
				<?php
			} else {
				?>
				<div class="container center">
					<p><?php _e('Geen logo\'s gevonden.', 'swift'); ?></p>
				</div>
				<?php
			}
			?>
		</div>
	</div>

	<?php
	$pane_image = get_field('pane_image');
	get_template_part('components/pane_image', '', [
		'group_data' => $pane_image
	]);
	?>
</section>