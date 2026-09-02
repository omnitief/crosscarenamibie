<?php
if ( custom_acf_is_backend_block_preview() ) {
	return;
}
 
$space = get_spacing_class(get_field('space'));
$background_color = get_color_classes(get_field('background_color'));
$full_id = get_full_id(get_field('id'));
$text = get_field('text');
$form_id = get_field('form_select');
$form_shortcode = false;

if ($form_id) {
	$form_shortcode = "[gravityform id='{$form_id}' title='false' description='false' ajax='true']";
}
?>

<section <?= $full_id; ?> class="<?= "newspaper pr {$background_color}"; ?>">
	<?php divider() ?>
	<div class="pr ohd">
		<div class="container container--small <?= $space; ?>">
			<?php
			if ($text) {
				?>
				<div class="heading m-b--xsmall text">
					<?= $text; ?>
				</div>
				<?php
			}

			if ($form_shortcode) {
				echo do_shortcode($form_shortcode);
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