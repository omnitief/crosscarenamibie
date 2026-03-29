<?php
$tile_col_class = $args['tile_col_class'];
$link = $args['show_url'];
$title = $args['title'];
$text = $args['text'];
$image_id = $args['image_id'];
?>

<div class="<?= $tile_col_class; ?> card card--small f f_c">
	<?php 
	if ($link) {
		$post = $args['post'];
		$permalink = get_permalink($post);
		$aria_label = get_aria_label($title);
		
		if (!$title) {
			$title = get_the_title($post);
		}
		?>
		<a href="<?= $permalink; ?>" <?= $aria_label; ?> class="btn-icon-effect">
		<?php
	} else {
		?>
		<div>
		<?php
	}
	?>
		<div class="card__image pr ohd r">
			<?php 
			echo wp_get_attachment_image($image_id, 'large', false, [
				'class' => 'pa cover'
			]);

			if ($link) {
				get_template_part('components/button/icon', '', [
					'class' => 'btn-icon--large pa z9 bg-body cl-dark'
				]);
			}
			?>
		</div>
		<div class="card__content f f_c f-fs text m-b--none">
			<?php
			echo "<h5 class='m-b--h5'>{$title}</h5>"; 
			echo "<p>{$text}</p>";
			?>
		</div>
		<?php 
	if ($link) {
		echo "</a>";
	} else {
		echo "</div>";
	}
	?>
</div>