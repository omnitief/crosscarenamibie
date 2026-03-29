<?php
$id = $args['id'] ?? false;
$column_class = $args['column_class'] ?? false;
$title = get_the_title($id);
$aria_label = get_aria_label($title);
$customer = get_field('customer_name', $id);

if ($column_class) {
	echo "<div class='{$column_class}'>";
}
?>

<a href="<?= get_permalink($id); ?>" <?= $aria_label; ?> class="card-bg f pr ohd r cl-white btn-icon-effect">
	<div class="card-bg__content pa z9 gap-small f f_c f-fs">
		<?php
		if ($customer) {
			get_template_part('components/label', '', [
				'title' => $customer,
			]);
		}

		echo "<h4 class='m-b--none'>{$title}</h4>";
		?>
	</div>
	<div class="card-bg__hover pa z9 f f-c f--sb">
		<p class="ff-primary m-b--none"><?php the_field('project_card_hover', 'options'); ?></p>
	</div>
	<?php
	get_template_part('components/button/icon', '', [
		'class' => 'btn-icon--large pa z9 bg-body cl-dark'
	]);

	$image_id = get_post_image_id($id);
	
	echo wp_get_attachment_image($image_id, 'large', false, [
		'class' => 'pa cover'
	]);
	?>
</a>

<?php
if ($column_class) {
	echo "</div>";
}