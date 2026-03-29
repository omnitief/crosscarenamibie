<?php 
$space = get_spacing_class(get_field('space'));
$background_color = get_color_classes(get_field('background_color'));
$full_id = get_full_id(get_field('id'));
$show_text_and_image = get_field('show_text_and_image');
$form_id = get_field('form_select');
$form_shortcode = false;
$form_col_class = "";
$section_class = "";

if ($form_id) {
	$form_shortcode = "[gravityform id='{$form_id}' title='false' description='false' ajax='true']";
}

if ($show_text_and_image) {
	$image = get_field('image_below_text');
	$button = get_field('button');
	$text = get_field('text');

	if ($image) {
		$section_class = "text-image--extra-img";
	}
} else {
	$section_class = "text-image--no-extra-img";
}
?>

<section <?= $full_id; ?> class="<?= "text-image pr {$section_class} {$background_color}"; ?>">
	<?php divider() ?>
	<div class="text-image__inner pr ohd <?= $space; ?>">
		<div class="container">
			<?php 
			if ($show_text_and_image) { 

				?>
				<div class="row gap-row f--sb">
					<div class="col-12 col-lg-6 col-xl-5 text text-image__text">
						<?php 
						if ($text) {
							echo "<div>";
							$subtitle = get_subtitle_el(get_field('subtitle'));
							echo $subtitle;
							echo "<div class='text'>{$text}</div>";
							echo "</div>";
						}

						get_template_part('components/button/wrapper', '', [
							'button' => $button,
						]);

						if ($image) {
							$image_below_text = get_field('image_below_text');
							$image_below_text_id = $image_below_text['image'];
							
							if ($image_below_text_id) {
								$show_radius = $image_below_text['show_radius'];
								$random_image_id = 0;
								
								if ($show_radius) {
									$custom_radius = $image_below_text['custom_radius'];
									$random_image_id = rand(0, 100000);
									$left_top = $custom_radius['left_top'];
									$right_top = $custom_radius['right_top'];
									$right_bottom = $custom_radius['right_bottom'];
									$left_bottom = $custom_radius['left_bottom'];
									$left_top_mobile = round($left_top/1.5);
									$right_top_mobile = round($right_top/1.5);
									$right_bottom_mobile = round($right_bottom/1.5);
									$left_bottom_mobile = round($left_bottom/1.5);
									$styles = "<style>
											.img-{$random_image_id} {
												--left-top: {$left_top_mobile}px;
												--right-top: {$right_top_mobile}px;
												--right-bottom: {$right_bottom_mobile}px;
												--left-bottom: {$left_bottom_mobile}px;
												border-radius: var(--left-top)|var(--right-top)|var(--right-bottom)|var(--left-bottom);
											}
											@media (min-width: 992px) {
												.img-{$random_image_id} {
													--left-top: {$custom_radius['left_top']}px;
													--right-top: {$custom_radius['right_top']}px;
													--right-bottom: {$custom_radius['right_bottom']}px;
													--left-bottom: {$custom_radius['left_bottom']}px;
												}
											}
										</style>";
									$styles = preg_replace("/\s+/", "", $styles);
									$styles = str_replace("|", " ", $styles);
									echo $styles;
								}

								echo wp_get_attachment_image($image_below_text_id, 'large', false, [
									'class' => "text-image__image text-image__image--extra m-t--large f r pr z9 dn lg-db img-{$random_image_id}"
								]);
							}
						}						
						?>
					</div>
					<div class="col-12 col-lg-6 pb <?= $form_col_class; ?>">
						<?php 
						if ($form_shortcode) {
							echo do_shortcode($form_shortcode);
						}
						if ($image) {
							$image_below_text = get_field('image_below_text');
							$image_below_text_id = $image_below_text['image'];
							
							if ($image_below_text_id) {
								$show_radius = $image_below_text['show_radius'];
								$random_image_id = 0;
								
								if ($show_radius) {
									$custom_radius = $image_below_text['custom_radius'];
									$random_image_id = rand(0, 100000);
									$left_top = $custom_radius['left_top'];
									$right_top = $custom_radius['right_top'];
									$right_bottom = $custom_radius['right_bottom'];
									$left_bottom = $custom_radius['left_bottom'];
									$left_top_mobile = round($left_top/1.5);
									$right_top_mobile = round($right_top/1.5);
									$right_bottom_mobile = round($right_bottom/1.5);
									$left_bottom_mobile = round($left_bottom/1.5);
									$styles = "<style>
											.img-{$random_image_id} {
												--left-top: {$left_top_mobile}px;
												--right-top: {$right_top_mobile}px;
												--right-bottom: {$right_bottom_mobile}px;
												--left-bottom: {$left_bottom_mobile}px;
												border-radius: var(--left-top)|var(--right-top)|var(--right-bottom)|var(--left-bottom);
											}
											@media (min-width: 992px) {
												.img-{$random_image_id} {
													--left-top: {$custom_radius['left_top']}px;
													--right-top: {$custom_radius['right_top']}px;
													--right-bottom: {$custom_radius['right_bottom']}px;
													--left-bottom: {$custom_radius['left_bottom']}px;
												}
											}
										</style>";
									$styles = preg_replace("/\s+/", "", $styles);
									$styles = str_replace("|", " ", $styles);
									echo $styles;
								}

								echo wp_get_attachment_image($image_below_text_id, 'large', false, [
									'class' => "text-image__image text-image__image--extra f r pr m-t--large z9 lg-dn img-{$random_image_id}"
								]);
							}
						}
						?>
					</div>
				</div>
				<?php
			} else {
				if ($form_shortcode) {
					echo do_shortcode($form_shortcode);
				}
			}
			?>
		</div>
		<?php
		if ($show_text_and_image && $image) {
			$background_color_overlap = get_color_classes(get_field('background_color_overlap'));
			
			if (get_block_divider_type() === 'wave') {
				echo "<svg class='divider bottom  {$background_color_overlap}' viewBox='0 0 1920 75.713'><path d='M1920,0S1432.253-78.1,958.659,0,0,0,0,0V41H1920Z' transform='translate(0 34.713)' fill='#111838'/></svg>";
			}

			echo "<div class='overlap bottom pa {$background_color_overlap}'></div>";
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
