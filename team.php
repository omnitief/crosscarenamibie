<?php 
/**
 * Template Name: Team
 */

$cta_background_color = get_color_classes(get_field('cta_background_color'));
$cta_hide = get_field('cta_hide');
$team_members = get_field('team_members', 'options');
$columns = get_field('columns_team', 'options');

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
	'container_class'	=> $container_class
]);  

get_template_part('components/team/columns', '', [
	'team_members'		=> $team_members,
	'class'						=> "p-b--large",
	'container_class'	=> $container_class,
	'row_class' 			=> $row_class,
	'column_class' 		=> $column_class
]);

if (have_posts()) :
	while (have_posts()) : the_post();
		the_content();
	endwhile;
endif;

get_footer('', [
	'cta_background_color' => $cta_background_color,
	'cta_hide' => $cta_hide
]);