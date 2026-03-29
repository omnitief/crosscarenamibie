<?php
$id = $args['id'] ?? false;
$title = get_the_title($id);
$aria_label = get_aria_label($title);
$categories = get_the_terms($id, 'category');
$date = get_the_date('d F Y', $id);
$image_id = get_post_image_id($id);
$class = $args['class'] ?? '';
$page_for_posts = get_permalink(get_option('page_for_posts'));
?>

<div class="<?= $class; ?> card f f_c">
	<a href="<?= get_permalink($id); ?>" <?= $aria_label; ?> class="btn-icon-effect">
		<div class="card__image pr ohd r">
			<?php 
			echo wp_get_attachment_image($image_id, 'large', false, [
				'class' => 'pa cover'
			]);

			get_template_part('components/button/icon', '', [
				'class' => 'btn-icon--large pa z9 bg-body cl-dark'
			]);
			?>
		</div>
		<div class="card__content f f_c f-fs">
			<?php
			echo "<p class='card__date text-small opacity-50 fw-5'>{$date}</p>";
			echo "<h4 class='m-b--none'>{$title}</h4>"; 
			?>
		</div>
	</a>
	<?php 
	if ($categories) {
		echo "<div class='f f-c fw gap-xsmall m-t--auto'>";
		foreach ($categories as $category) {
				get_template_part('components/label', '', [
					'title' => $category->name,
					'url' 	=> "{$page_for_posts}?category={$category->slug}",
				]);
			}
		echo "</div>";
	}
	?>
</div>