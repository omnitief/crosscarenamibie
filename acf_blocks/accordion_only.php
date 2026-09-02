<?php
if ( custom_acf_is_backend_block_preview() ) {
	return;
}
 
$space = get_spacing_class(get_field('space'), 'm');
$full_id = get_full_id(get_field('id'));
$accordion = get_field('accordion');
?>

<div <?= $full_id; ?> class="pr <?= "{$space}"; ?>">
	<?php 
	if ($accordion) {
		get_template_part('components/accordion', '', [
			'accordion' => $accordion,
		]);
	}
	?>
</div>