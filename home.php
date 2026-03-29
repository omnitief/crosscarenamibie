<?php 
$columns = get_field('columns_posts', 'options');

if ($columns === 'two') {
	$row_class = 'gap-row-large';
	$container_class = 'container--small';
	$columns_class = 'col-12 col-sm-6';
} else {
	$row_class = 'gap-row-medium';
	$container_class = '';
	$columns_class = 'col-12 col-sm-6 col-lg-4';
}

get_header('', [
	'default_template' => true,
	'container_class'	=> "f fw f--sb f-fe gap-row {$container_class}"
]); 

get_template_part('components/posts/filter', '', [
	'row_class' => $row_class,
	'container_class' => $container_class,
	'columns_class' => $columns_class
]);

get_footer('', [
	'cta_background_color' => 'bg-light'
]);	