<?php 
$space = get_spacing_class( get_field('space') );
$linkedin = get_field('linkedin', 'options');
$instagram = get_field('instagram', 'options');
$twitter = get_field('twitter', 'options');
$facebook = get_field('facebook', 'options');
$pinterest = get_field('pinterest', 'options');
$whatsapp = get_field('whatsapp', 'options');
?>

<div class="widget f fw gap-xsmall <?= "{$space}"; ?>">
	<?php 
	if ($linkedin) {
		?>
		<a class="link-icon-bg bg-text r-50 pr" href="<?= $linkedin; ?>" target="_blank" rel="nofollow noopener" title="<?php _e('LinkedIn', 'swift'); ?>"><i class="icon icon-linkedin cl-based pa pa-center"></i></a>
		<?
	}

	if ($instagram) {
		?>
		<a class="link-icon-bg bg-text r-50 pr" href="<?= $instagram; ?>" target="_blank" rel="nofollow noopener" title="<?php _e('Instagram', 'swift'); ?>"><i class="icon icon-instagram cl-based pa pa-center"></i></a>
		<?php
	}

	if ($twitter) {
		?>
		<a class="link-icon-bg bg-text r-50 pr" href="<?= $twitter; ?>" target="_blank" rel="nofollow noopener" title="<?php _e('X', 'swift'); ?>"><i class="icon icon-x cl-based pa pa-center"></i></a>
		<?php		
	}
	
	if ($facebook) {
		?>
		<a class="link-icon-bg bg-text r-50 pr" href="<?= $facebook; ?>" target="_blank" rel="nofollow noopener" title="<?php _e('Facebook', 'swift'); ?>"><i class="icon icon-facebook cl-based pa pa-center"></i></a>
		<?php
	}

	if ($pinterest) {
		?>
		<a class="link-icon-bg bg-text r-50 pr" href="<?= $pinterest; ?>" target="_blank" rel="nofollow noopener" title="<?php _e('Pinterest', 'swift'); ?>"><i class="icon icon-pinterest cl-based pa pa-center"></i></a>
		<?php
	}

	if ($whatsapp) {
		$whatsapp_number = str_replace([' ', '-', '(', ')'], '', $whatsapp);
		$whatsapp_number = '+31' . substr($whatsapp_number, 1);
		?>
		<a class="link-icon-bg bg-text r-50 pr" href='https://wa.me/<?= $whatsapp_number; ?>' target='_blank' rel='nofollow noopener' aria-label="<?php _e('Neem contact op via WhatsApp', 'swift'); ?>"><i class="icon icon-whatsapp cl-based pa pa-center"></i></a>
		<?php
	}
	?>
</div>