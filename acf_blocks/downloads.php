<?php 
$space = get_spacing_class(get_field('space'));
$background_color = get_color_classes(get_field('background_color'));
$full_id = get_full_id(get_field('id'));
?>

<section <?= $full_id; ?> class="downloads pr <?= "{$background_color}"; ?>">
	<div class="container <?= $space; ?>">
		<?php
			$text = get_field('text');	
			$subtitle = get_subtitle_el(get_field('subtitle'));
			if ($subtitle) {
				echo $subtitle;
			}
			if ($text) {
				echo "<div class='m-b--small text'>{$text}</div>";
			}
		?>
		<div class="grid">
			<?php
			if (have_rows('downloads')) {
				while (have_rows('downloads')) : the_row();
					$file_url = get_sub_field('file');
					$title = get_sub_field('title');
					?>
					<a href="<?= esc_url($file_url); ?>" target="_blanc" class="pr f fw f--sb f-c downloads__item r bg-based border">
						<span class="fw-7"><?= esc_html($title); ?></span>
					</a>
					<?php
				endwhile;
			}
			?>
		</div>
	</div>
</section>