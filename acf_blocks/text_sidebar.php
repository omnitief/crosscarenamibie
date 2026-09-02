<?php
if ( custom_acf_is_backend_block_preview() ) {
	return;
}
 
$space = get_spacing_class(get_field('space'));
$background_color = get_color_classes(get_field('background_color'));
$full_id = get_full_id(get_field('id'));
$button = get_field('button');
$text = get_field('text');
$subtitle = get_subtitle_el(get_field('subtitle'));
?>

<section <?= $full_id; ?> class="<?= "pr {$background_color}"; ?>">
	<?php divider(); ?>
	<div class="container text <?= $space; ?>">
		<div class="row f--sb gap-row">
			<div class="col-lg-8">
				<?php

					if ($subtitle) {
						echo $subtitle;
					}

					if($text) {
						echo "<div class='text'>{$text}</div>";
					}
				
					if($button) {
						$link = $button['link'];
						$style = $button['style'];
			
						get_template_part('components/button/button', '', [
							'button'	=> $link,
							'style'		=> $style
						]);
					}
				
				?>
			</div>
			<div class="col-lg-4 sidebar">
				<div class="sidebar-cta bg-light r m-b--xxsmall">
					<?php
					$cta_image = get_field('cta_sidebar_image') ?: get_field('cta_sidebar_image', 'options');
					$cta_text  = get_field('cta_sidebar_text')  ?: get_field('cta_sidebar_text', 'options');

					$cta_group = get_field('cta_sidebar_button');
					if (!is_array($cta_group) || empty($cta_group['link'])) {
						$cta_group = get_field('cta_sidebar_button', 'options');
					}

					$style = is_array($cta_group) ? ($cta_group['style'] ?? '') : '';
					$link  = is_array($cta_group) ? ($cta_group['link']  ?? null) : null;

					if (!is_array($link) || empty($link['url'])) {
						$link = null;
					}
					?>

					<?php if ($cta_image): ?>
						<div class="cta__image pr ohd r-50">
							<?= wp_get_attachment_image($cta_image, 'medium', '', ['class' => 'pa cover']) ?>
						</div>
					<?php endif; ?>

					<?php if ($cta_text): ?>
						<div class="text m-t--xxsmall"><?= $cta_text; ?></div>
					<?php endif; ?>

					<?php if ($link): ?>
						<?php get_template_part('components/button/button', '', [
							'button' => $link,
							'style'  => $style,
						]); ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>
