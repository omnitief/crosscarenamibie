<?php 
function has_valid_url($value) {
	return !empty($value) && filter_var($value, FILTER_VALIDATE_URL);
}

$space = get_spacing_class(get_field('space'));

$linkedin  = trim(get_field('linkedin', 'options'));
$instagram = trim(get_field('instagram', 'options'));
$twitter   = trim(get_field('twitter', 'options'));
$facebook  = trim(get_field('facebook', 'options'));
$pinterest = trim(get_field('pinterest', 'options'));
$whatsapp  = trim(get_field('whatsapp', 'options'));
?>

<div class="widget f fw gap-xsmall <?= $space; ?>">
	<?php if (has_valid_url($linkedin)) : ?>
		<a class="link-icon-bg bg-text r-50 pr" href="<?= esc_url($linkedin); ?>" target="_blank" rel="nofollow noopener" title="<?php _e('LinkedIn', 'swift'); ?>">
			<i class="icon icon-linkedin cl-based pa pa-center"></i>
		</a>
	<?php endif; ?>

	<?php if (has_valid_url($instagram)) : ?>
		<a class="link-icon-bg bg-text r-50 pr" href="<?= esc_url($instagram); ?>" target="_blank" rel="nofollow noopener" title="<?php _e('Instagram', 'swift'); ?>">
			<i class="icon icon-instagram cl-based pa pa-center"></i>
		</a>
	<?php endif; ?>

	<?php if (has_valid_url($twitter)) : ?>
		<a class="link-icon-bg bg-text r-50 pr" href="<?= esc_url($twitter); ?>" target="_blank" rel="nofollow noopener" title="<?php _e('X', 'swift'); ?>">
			<i class="icon icon-x cl-based pa pa-center"></i>
		</a>
	<?php endif; ?>

	<?php if (has_valid_url($facebook)) : ?>
		<a class="link-icon-bg bg-text r-50 pr" href="<?= esc_url($facebook); ?>" target="_blank" rel="nofollow noopener" title="<?php _e('Facebook', 'swift'); ?>">
			<i class="icon icon-facebook cl-based pa pa-center"></i>
		</a>
	<?php endif; ?>

	<?php if (has_valid_url($pinterest)) : ?>
		<a class="link-icon-bg bg-text r-50 pr" href="<?= esc_url($pinterest); ?>" target="_blank" rel="nofollow noopener" title="<?php _e('Pinterest', 'swift'); ?>">
			<i class="icon icon-pinterest cl-based pa pa-center"></i>
		</a>
	<?php endif; ?>

	<?php if (!empty($whatsapp)) :
		$whatsapp_number = preg_replace('/[^0-9]/', '', $whatsapp);

		if (substr($whatsapp_number, 0, 1) === '0') {
			$whatsapp_number = '31' . substr($whatsapp_number, 1);
		}
	?>
		<a class="link-icon-bg bg-text r-50 pr" href="https://wa.me/<?= esc_attr($whatsapp_number); ?>" target="_blank" rel="nofollow noopener" aria-label="<?php _e('Neem contact op via WhatsApp', 'swift'); ?>">
			<i class="icon icon-whatsapp cl-based pa pa-center"></i>
		</a>
	<?php endif; ?>
</div>