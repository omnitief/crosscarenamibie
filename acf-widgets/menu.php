<?php 
$space = get_spacing_class( get_field('space') );
$display = get_field('display');
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
	?>
	<ul class="list--disable line-space">
		<?php 
		if (have_rows('links')) {
			while (have_rows('links')) : the_row();
				$link = get_sub_field('link');
				?>
				<li>
					<?php 
					get_template_part('components/button/button', '', [
						'button' => $link,
						'type' => 'link',
					]);
					?>
				</li>
				<?php
			endwhile;
		}
		?>
	</ul>
</div>