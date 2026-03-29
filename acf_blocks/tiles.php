<?php 
$space = get_spacing_class(get_field('space'));
$background_color = get_color_classes(get_field('background_color'));
$full_id = get_full_id(get_field('id'));
$title = get_field('title');
$text = get_field('text');
$columns = get_field('columns');
$icon_image = get_field('icon_image');

if ($columns === 'two') {
	$tile_col_class = 'col-12 col-sm-6';
} else if ($columns === 'three') {
	$tile_col_class = 'col-12 col-sm-6 col-lg-4';
} else {
	$tile_col_class = 'col-12 col-sm-6 col-lg-4 col-xl-3';
}

if ($icon_image === 'image') {
	$row_class = 'gap-row-medium';
} else {
	$row_class = 'gap-row';
}
?>

<section <?= $full_id; ?> class="pr <?= "{$background_color}"; ?>">
	<?php divider() ?>
	<div class="container <?= $space; ?>">
		<?php 
		if ($title || $text) {
			?>
			<div class="heading text m-b--small">
				<?php 
				$subtitle = get_subtitle_el(get_field('subtitle'));
				if ($subtitle) {
					echo $subtitle;
				}
				?>
				<div class="row f fw f-c f--sb gap-heading">
					<?php 
					if ($title) {
						echo "<div class='col-12 col-lg-6'>";
							echo "<h2 class='m-t--none m-b--none'>{$title}</h2>";
						echo "</div>";
					}

					if ($text) {
						echo "<div class='col-12 col-lg-6 col-xl-5'>";
							echo $text;
						echo "</div>";
					}
					?>
				</div>
			</div>
			<?php
		}
		
		if (have_rows('tiles')) {
			?>
			<div class="row <?= $row_class; ?>">
				<?php
				while (have_rows('tiles')) : the_row();
					$link = get_sub_field('show_url');
					$title = get_sub_field('title');
					$text = get_sub_field('text');
					$post = false;

					if ($icon_image == 'image') {
						$image_id = get_sub_field('image');
					} elseif ($icon_image == 'icon') {
						$image_id = get_sub_field('icon');
					}

					if ($link) {
						$post = get_sub_field('post');
					}
					if ($icon_image == 'none') {
						get_template_part("components/tiles/{$icon_image}", "", [
							'tile_col_class' 			=> $tile_col_class,
							'show_url' 					=> $link,
							'title' 					=> $title,
							'text' 						=> $text,
							'post' 						=> $post,
						]);
					} else {
						get_template_part("components/tiles/{$icon_image}", "", [
							'tile_col_class' 			=> $tile_col_class,
							'show_url' 					=> $link,
							'title' 					=> $title,
							'text' 						=> $text,
							'image_id'					=> $image_id,
							'post' 						=> $post,
						]);						
					}
				endwhile;
				?>
			</div>
			<?php
		}
		?>
	</div>

	<?php 
	$pane_image = get_field('pane_image');
	get_template_part('components/pane_image', '', [
		'group_data' => $pane_image,
		'class_pane' => 'dn xl-f',
	]);
	?>
</section>