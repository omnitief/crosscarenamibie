<?php
if ( custom_acf_is_backend_block_preview() ) {
	return;
}
 
$space = get_spacing_class(get_field('space'));
$background_color = get_color_classes(get_field('background_color'));
$full_id = get_full_id(get_field('id'));
$text = get_field('text');
$button = get_field('button');
$reviews = get_field('reviews', 'options');
$reviews_select = get_field('reviews_select');

if ($reviews_select) {
	$reviews = rearrange_array($reviews, $reviews_select);
}
?>

<section <?= $full_id; ?> class="<?= "slider slider--reviews pr ohd {$background_color}"; ?>">
	<?php divider() ?>
	<div class="container <?= $space; ?>">
		<?php 
		if (!empty($button['link']) || $text) {
			?>
			<div class="heading f fw f-c f--sb m-b--small gap-small">
				<?php 
				if ($text) {
					echo "<div class='text'>{$text}</div>";
				}

				get_template_part('components/button/wrapper', '', [
					'button' => $button,
					'button_class'	=> 'dn md-f'
				]);
				?>
			</div>
			<?php
		}

		if ($reviews) {
			?>
			<div class="swiper">
				<div class="swiper-wrapper">
					<?php 
					foreach ($reviews as $review) {
						$stars = $review['stars'];
						$percentage = $stars / 5 * 100;
						$text = truncate($review['text']);

						"<span id='dots'>...</span><span id='more'>"
						?>
						<div class="swiper-slide">
							<div class="review bg-based r border text">
								<div class="review__heading f fw f-c f--sb gap-xsmall">
									<?php 
									if ($review['name']) {
										echo "<p class='text-large ff-primary fw-7 m-b--none'>{$review['name']}</p>";
									}
									echo "<div class='review__stars f fw f-c gap-xsmall'>";
										get_template_part('components/svg/stars', '', [
											'percentage' => $percentage
										]);
										echo "<p class='text-small fw-7 m-b--none'>({$stars})</p>";
									echo "</div>";
									?>
								</div>
								<?php
								if ($review['text']) {
									echo "<p>\"{$text}\"</p>";
								}
								?>
							</div>
						</div>
						<?php
					}
					?>
				</div>
			</div>
			<?php
		}
		if (!empty($button['link']) || $text) {
			?>
			<div class="md-dn m-t--medium">
				<?php 
				get_template_part('components/button/wrapper', '', [
					'button' => $button
				]);
				?>
			</div>
			<?php
		}
		?>
	</div>
</section>
