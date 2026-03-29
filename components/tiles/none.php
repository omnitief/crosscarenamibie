<?php
$tile_col_class = $args['tile_col_class'];
$link = $args['show_url'];
$title = $args['title'];
$text = $args['text'];
?>

<div class="<?= $tile_col_class; ?>">
	<?php 
	if ($link) {
		$post = $args['post'];
		$permalink = get_permalink($post);
		$aria_label = get_aria_label($title);

		if (!$title) {
			$title = get_the_title($post);
		}
		?>
		<a href="<?= $permalink; ?>" <?= $aria_label; ?> class="tile bg-body border-body f f_c r btn-icon-effect ohd pr">
		<?php
	} else {
		?>
		<div class="tile bg-body border-body f f_c r ohd pr">
		<?php
	}
	?>
		<?php 
		
		echo "<h5 class='m-b--h5'>{$title}</h5>";

		if ($text) {
			echo "<p class='text-small m-b--none'>{$text}</p>";
		}

		if ($link) {
			get_template_part('components/button/icon', '', [
				'class' => 'btn-icon--large pa z9',
				'background_color' => 'bg-text',
			]);
		}
		?>
	<?php 
	if ($link) {
		?>
		</a>
		<?php
	} else {
		?>
		</div>
		<?php
	}
	?>
</div>