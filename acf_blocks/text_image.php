<?php
if ( custom_acf_is_backend_block_preview() ) {
	return;
}
 
$space = get_spacing_class(get_field('space'));
$background_color = get_color_classes(get_field('background_color'));
$full_id = get_full_id(get_field('id'));
$button = get_field('button');
$layout = get_field('layout');
$text = get_field('text');
$image = get_field('image');
$image_id = $image['image_id'];
$image_in_container = $image['in_container'];
$show_icon_title = get_field('show_icon_title');
$show_extra_image = get_field('show_extra_image');
$row_class = '';

if ($image_in_container) {
	if ($layout === 'image_text') {
		$row_class = 'f_rr f--sb';
	} else {
		$row_class = 'f--sb';
	}
} else {
	if ($layout === 'image_text') {
		$row_class = 'f--fe';
	}
}

if ($show_extra_image) {
	$section_class = "text-image--extra-img";
} else {
	$section_class = "text-image--no-extra-img";
	
	if ($image_in_container) {
		$section_class .= " img-contain";
	}
}

?>

<section <?= $full_id; ?> class="<?= "text-image pr {$section_class} {$background_color}"; ?> <?= $space; ?>">
	<?php divider(); ?>
	<div class="text-image__inner pr ohd">
		<div class="container">
			<div class="row <?= $row_class; ?>">
				<div class="col-12 col-lg-6 col-xl-5 text text-image__text">
					<?php 
					if ($text) {
						$subtitle = get_subtitle_el(get_field('subtitle'));

						if ($subtitle) {
							echo $subtitle;
						}
						echo "<div class='text'>{$text}</div>";
					}

					get_template_part('components/button/wrapper', '', [
						'button' => $button,
					]);

					if ($show_icon_title && have_rows('icons_title')	) {
						?>
						<div class="icon-title-wrapper m-t--xsmall grid grid-2">
							<?php 
							while (have_rows('icons_title')) : the_row();
								$icon_id = get_sub_field('icon');
								$title = get_sub_field('title');
								?>
								<div class="icon-title f f-c fw gap-small">
									<?php 
									if ($icon_id) {
										echo wp_get_attachment_image($icon_id, 'full'); 
									}

									if ($title) {
										echo "<h6>{$title}</h6>";
									}
									?>
								</div>
								<?php
							endwhile;
							?>
						</div>
						<?php
					}

					if ($show_extra_image) {
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
								'class' => "text-image__image text-image__image--extra f r pr m-t--large z9 img-{$random_image_id}"
							]);
						}
					}
					?>
				</div>
				<?php 
				if ($image_in_container) {
					$wrapper_class = "";
					$img_style = "";
					$custom_radius = false;
					$show_custom_radius = false;
					$image_class = "of-contain";
					$img_fit = $image['img_fit'] ?? false;
					
					if (!$img_fit) {
						$wrapper_class = "img-covered";
						$show_custom_radius = $image['show_radius'];
						$image_class = "cover";
						$wrapper_class .= " r-large";
						
						if ($show_custom_radius) {
							$random_image_id = rand(0, 100000);
							$custom_radius = $image['custom_radius'];
							$wrapper_class .= " img-{$random_image_id}";
						}
					}
					?>
					<div class="col-12 col-lg-6">
						<?php 
						if ($custom_radius) {
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
						?>
						<div class="text-image__image--contain pr ohd f f-c f--c <?= $wrapper_class; ?>">
							<?php 
							echo wp_get_attachment_image($image_id, 'large', false, [
								'class' => $image_class,
								'style'	=> $img_style
							]);
							?>
						</div>
					</div>
					<?php
				}
				?>
			</div>
		</div>
		<?php
		if (!$image_in_container) {
			$radius = $image['radius'];

			if ($radius === 'top') {
				if ($layout === 'text_image') {
					$radius = 'r-img-tl';
				} else {
					$radius = 'r-img-tr';
				}
			} else if ($radius === 'bottom') {
				if ($layout === 'image_text') {
					$radius = 'r-img-br';
				} else {
					$radius = 'r-img-bl';
				}
			}

			if ($layout === 'text_image') {
				$pos = 'right';
			} else if ($layout === 'image_text') {
				$pos = 'left';
			}

			if ($show_extra_image) {
				$img_class = "dn lg-db";
			} else {
				$img_class = 'h-100 w-49';
			}

			echo "<div class='text-image__image text-image__image--large pr ohd {$img_class} {$pos} {$radius}'>";
				echo wp_get_attachment_image($image_id, 'large', false, [
					'class' => ' pa cover'
				]);
			echo "</div>";
		}

		if ($show_extra_image) {
			$background_color_overlap = get_color_classes(get_field('background_color_overlap'));
			
			if (get_block_divider_type() === 'wave') {
				echo "<svg class='divider bottom {$background_color_overlap}' viewBox='0 0 1920 75.713'><path d='M1920,0S1432.253-78.1,958.659,0,0,0,0,0V41H1920Z' transform='translate(0 34.713)' fill='#111838'/></svg>";
			}

			echo "<div class='overlap bottom pa {$background_color_overlap}'></div>";
		}
		?>
	</div>

	<?php 
	if (!$show_extra_image) {
		$pane_image = get_field('pane_image');
		get_template_part('components/pane_image', '', [
			'group_data' => $pane_image,
			'class_pane' => 'dn xl-f',
		]);
	}
	?>
</section>