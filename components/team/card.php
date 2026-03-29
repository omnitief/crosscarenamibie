<?php
$team_member = $args['team_member'] ?? false;

if (!$team_member) {
	return;
}

$class = $args['class'] ?? '';
$in_slider = $args['in_slider'] ?? false;
$image_id = $team_member['image_slider'] ?? false;

if ($in_slider && !$image_id || !$in_slider) {
	$image_id = $team_member['image'] ?? false;
}

$link = $team_member['link'] ?? false;
$tags = $team_member['tags'] ?? false;
if ($tags) {
	$tags = explode(',', $tags);
}

if ($link) {
	$card_tag = 'a';
	$target = $args['button']['target'] ?? '';
	$aria_label = get_aria_label($link['title']);
	if ($target) {
		$target = 'target="_blank" rel="noopener nofollow"';
	}
	$link_attr = "href='{$link['url']}' {$target} {$aria_label}";
	$class .= ' btn-icon-effect';
} else {
	$card_tag = 'div';
	$link_attr = '';
}
?>
<<?= $card_tag; ?> <?= $link_attr; ?> class="card card--team f f_c <?= $class; ?>">
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

		if ($tags) {
			echo "<div class='tags z9 pa f f-c fw gap-xsmall'>";
			foreach ($tags as $tag) {
					get_template_part('components/label', '', [
						'title' => $tag,
						'class' => 'large fw-7'
					]);
				}
			echo "</div>";
		}
		?>
	</div>
	<div class="card__content m-b--none f f_c f-fs text">
		<?php
		echo "<h4>{$team_member['name']}</h4>"; 
		echo "<p class='m-b--none'>{$team_member['job_title']}</p>";
		?>
	</div>
</<?= $card_tag; ?>>