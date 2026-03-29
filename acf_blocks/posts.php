<?php
/**
 * Template Name: Nieuwsartikelen
 */

$lang = function_exists('pll_current_language') ? pll_current_language() : 'nl';

$cta_background_color = get_color_classes(get_field('cta_background_color') ?? '');
$cta_hide = get_field('cta_hide') ?? false;

get_header('', [
	'default_template' => true,
]); 

$space_field = get_field('space') ?? ['top' => 0, 'bottom' => 0];
$space = get_spacing_class($space_field);

$background_color = get_color_classes(get_field('background_color') ?? '');
$title = get_field('title') ?? '';
$button = get_field('button') ?? false;
$posts = get_field('posts') ?? [];
$full_id = get_full_id(get_field('id') ?? '');
$subtitle = get_subtitle_el(get_field('subtitle') ?? '');

if (empty($posts)) {
	$posts_query = new WP_Query([
		'post_type'      => 'post',
		'posts_per_page' => -1,
		'orderby'        => 'date',
		'order'          => 'DESC',
		'lang'           => $lang,
	]);

	if ($posts_query->have_posts()) {
		$posts = $posts_query->posts;
	}
	wp_reset_postdata();
}

if (!empty($posts)) {
	get_template_part('components/posts/section', '', [
		'posts'         => $posts,
		'title'         => $title,
		'button'        => $button,
		'class'         => "{$background_color}",
		'space'         => "{$space}",
		'id'            => $full_id,
		'subtitle'      => $subtitle,
		'show_divider'  => true,
	]);
} else {
	?>
	<section>
		<div class="container center">
			<p><?php _e('Er kunnen geen berichten gevonden worden.', 'swift'); ?></p>
		</div>
	</section>
	<?php
}

get_footer('', [
	'cta_background_color' => $cta_background_color,
	'cta_hide' => $cta_hide,
]);