<?php 
$cta_background_color = get_color_classes(get_field('cta_background_color'));
$cta_hide = get_field('cta_hide');

get_header(); 

if (have_posts()) :
	while (have_posts()) : the_post();
		the_content();
	endwhile;
endif;

get_footer('', [
	'cta_background_color' => $cta_background_color,
	'cta_hide' => $cta_hide
]);