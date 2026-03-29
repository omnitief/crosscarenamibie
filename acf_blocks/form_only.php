<?php 
$space = get_spacing_class(get_field('space'));
$full_id = get_full_id(get_field('id'));
$form_id = get_field('form_select');
$form_shortcode = false;

if ($form_id) {
	$form_shortcode = "[gravityform id='{$form_id}' title='false' description='false' ajax='true']";
}
?>

<div <?= $full_id; ?> class="<?= "{$space}"; ?>">
	<?php 
	if ($form_shortcode) {
		echo do_shortcode($form_shortcode);
	}
	?>
</div>