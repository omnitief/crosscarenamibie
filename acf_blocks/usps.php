<?php
if ( custom_acf_is_backend_block_preview() ) {
	return;
}
 
$space = get_spacing_class(get_field('space'));
$background_color = get_color_classes(get_field('background_color'));
$full_id = get_full_id(get_field('id'));
$usps_source = have_rows('usps') ? null : 'options';
?>

<section <?= $full_id; ?> class="<?= "usps pr {$background_color}"; ?>">
	<?php divider() ?>
	<div class="pr ohd">
		<div class="container <?= $space; ?>">
			<?php if (have_rows('usps', $usps_source)): ?>
				<div class="f fw f--sb gap-small">
					<?php while (have_rows('usps', $usps_source)) : the_row();
						$text = get_sub_field('text'); ?>
						<div class="usp f f-c fw gap-small">
							<span class="btn-icon small r-50 pr ohd hover-disabled">
								<i class="icon icon-check pa pa-center"></i>
								<i class="icon icon-check pa pa-center"></i>
							</span>
							<span><?= esc_html($text); ?></span>
						</div>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
