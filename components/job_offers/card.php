<?php
$post_id = $args['id'];
$permalink = get_permalink($post_id);

if (!$permalink) {
	return;
}

$title = get_the_title($post_id);
$aria_label = get_aria_label($title); 
$location = get_field('location', $post_id);
$hours_pw = get_field('hours_pw', $post_id);
$text = get_the_excerpt($post_id);
?>

<a href="<?= $permalink; ?>" aria-label="<?= $aria_label; ?>" class="row-item pr db ohd bg-based btn-icon-effect border-based r">
	<div class="text">
		<h4><?= $title; ?></h4>
		<?php 
		if ($location || $hours_pw) {
			?>
			<p class="info f fw gap-xsmall">
				<?php 
				if ($location) {
					?>
					<span><b><?php the_field('location_text', 'options'); ?>:</b> <?= $location; ?></span>
					<?php

					if ($hours_pw) {
						echo "<span>|</span>";
					}
				}

				if ($hours_pw) {
					?>
					<span><b><?php the_field('hours_text', 'options'); ?>:</b> <?= $hours_pw; ?></span>
					<?php
				}
				?>
			</p>
			<?php 
		}

		if ($text) {
			echo "<p>{$text}</p>";
		}
		?>
	</div>
	<?php 
	get_template_part('components/button/icon', '', [
		'class' => 'btn-icon--large pa z9',
		'background_color' => 'bg-text',
	]);
	?>
</a>