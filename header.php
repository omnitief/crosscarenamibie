<?php 
$body_class = get_extra_body_class();
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php 
		echo get_field('head_injection', 'options');

		wp_head(); 
		?>
	</head>
	<body <?php body_class($body_class); ?>>
		<?php
		echo get_field('body_injection', 'options');

		get_template_part('components/nav');
		
		if (!is_404()) {
			get_template_part('components/header', '', $args);
		}