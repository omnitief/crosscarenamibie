<?php
if ( custom_acf_is_backend_block_preview() ) {
	return;
}
 
$space = get_spacing_class(get_field('space'));
$background_color = get_color_classes(get_field('background_color'));
$full_id = get_full_id(get_field('id'));
$title = get_field('title');
$subtitle = get_field('subtitle');
$job_offers_object = get_post_ids('job_offer');
?>

<section <?= $full_id; ?> class="<?= "pr ohd {$background_color}"; ?>">
	<?php divider() ?>
	<div class="container <?= $space; ?>">
		<?php 
		if ($title || $subtitle) {
			$subtitle_el = get_subtitle_el($subtitle);
			?>
			<div class="heading m-b--small">
				<?php 
				if ($subtitle) {
					echo $subtitle_el;
				}

				if ($title) {
					$post_count = 0;

					if ($job_offers_object && $job_offers_object->have_posts()) {
						$post_count = $job_offers_object->post_count;
					}

					echo "<h2 class='text'>{$title} <sup>({$post_count})</sup></h2>";
				}
				?>
			</div>
			<?php
		}
		
		if ($job_offers_object && $job_offers_object->have_posts()) {
			$job_offers = $job_offers_object->posts;
			
			foreach ($job_offers as $job_offer) {
				get_template_part('components/job_offers/card', '', [
					'id' => $job_offer,
				]);
			}
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