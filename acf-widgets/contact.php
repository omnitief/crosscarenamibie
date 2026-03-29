<?php 
$space = get_spacing_class( get_field('space') );
$title_group = get_field('title');

if ($title_group) {
	$heading = $title_group['heading'];
	$title = $title_group['title'];
} else {
	$heading = $title = false;
}
?>

<div class="widget <?= "{$space}"; ?>">
	<?php 
	if ($title) {
		?>
		<div class="text p-b--xxsmall">
			<?= "<{$heading}>{$title}</{$heading}>"; ?>
		</div>
		<?php
	}

	get_template_part('components/contact_data', '', [
		'address_class' => 'm-b--xxxsmall'
	]);
	?>
</div>