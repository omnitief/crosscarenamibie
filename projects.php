<?php 
/**
 * Template Name: Projecten
 */

$lang = function_exists('pll_current_language') ? pll_current_language() : 'nl';

$cta_background_color = get_color_classes(get_field('cta_background_color'));
$cta_hide = get_field('cta_hide');

$projects_object = new WP_Query([
	'post_type'      => 'project',
	'posts_per_page' => -1,
	'orderby'        => 'ASC',
	'lang'           => $lang, 
	'fields'         => 'ids',
]);

$columns = get_field('columns_projects', 'options');

if ($columns === 'two') {
	$container_class = 'container--small';
	$row_class = 'gap-row-large';
	$column_class = 'col-12 col-md-6';
} else if ($columns === 'three') {
	$container_class = '';
	$row_class = 'gap-row-medium';
	$column_class = 'col-12 col-sm-6 col-lg-4';
}

get_header('', [
	'default_template' => true,
	'container_class' => $container_class
]); 

if ($projects_object->have_posts()) {
	$projects = $projects_object->posts;

	get_template_part('components/projects/filter', '', [
		'projects'        => $projects,
		'class'           => 'p-b--medium',
		'container_class' => $container_class,
		'row_class'       => $row_class,
		'column_class'    => $column_class
	]);
}

wp_reset_postdata();

if (have_posts()) :
	while (have_posts()) : the_post();
		the_content();
	endwhile;
endif;

get_footer('', [
	'cta_background_color' => $cta_background_color,
	'cta_hide' => $cta_hide
]);