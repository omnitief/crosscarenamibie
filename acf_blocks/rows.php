<?php 
$space = get_spacing_class(get_field('space'));
$background_color = get_color_classes(get_field('background_color'));
$full_id = get_full_id(get_field('id'));
$text = get_field('text');	
$button = get_field('button');
?>

<section <?= $full_id; ?> class="<?= "pr {$background_color}"; ?>">
	<?php divider() ?>
	<div class="container text <?= $space; ?>">
		<?php
		$subtitle = get_subtitle_el(get_field('subtitle'));
		if ($subtitle) {
			echo $subtitle;
		}
		if ($text) {
			echo "<div class='m-b--small text'>{$text}</div>";
		}

		while (have_rows('rows')) : the_row();
			$icon_id = get_sub_field('icon');
			$icon = wp_get_attachment_image($icon_id, 'large', false, [
				'class' => 'pa of-contain'
			]);	
			?>
			<div class="row-item f fw bg-based border-based r">
				<div class="row-item__icon pr">
					<?= $icon; ?>
				</div>
				<div class="row-item__content">
					<?php the_sub_field('text'); ?>
				</div>
			</div>
			<?php
		endwhile;

		if($button) { ?>
			<div class="center m-t--xsmall">
				<?php
				get_template_part('components/button/wrapper', '', [
					'button' => $button
				]);
				?>
			</div>
		<?php } ?>
	</div>
</section>