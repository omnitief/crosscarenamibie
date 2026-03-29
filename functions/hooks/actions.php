<?php
add_action( 'wp_enqueue_scripts', 'enqueue_scripts' );
function enqueue_scripts() {
	remove_action('wp_head', 'wp_print_head_scripts', 9); 
	remove_action('wp_head', 'wp_enqueue_scripts', 1);
	add_action('wp_footer', 'wp_enqueue_scripts', 5);
	add_action('wp_footer', 'wp_print_head_scripts', 5); 
	
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'wc-blocks-style' );
	wp_dequeue_style( 'global-styles' );

	wp_enqueue_style( 'global', get_template_directory_uri() . '/dist/main.css', [], '1.0.5' );
}

add_action( 'wp_footer', 'footer_enqueue' );
function footer_enqueue() {
	wp_enqueue_script( 'script', get_template_directory_uri(). '/dist/main.bundle.js', [], '1.0.5' );
	wp_enqueue_style( 'not-critical', get_template_directory_uri() . '/dist/not_critical.css', [], '1.0.5' );
}

// Remove standard WP elements
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

// Theme support
add_theme_support( 'post-thumbnails' ); 
remove_theme_support( 'core-block-patterns' );

// Custom css for Gutenberg editor
add_action( 'admin_head', 'ac_custom_admin_css' );
function ac_custom_admin_css() {
	echo '<style type="text/css">
			.wp-block { max-width: 1050px; }
			.edit-post-visual-editor .block-editor-block-list__block:not(.wp-block-paragraph):not(.wp-block-heading):not(.wp-block-list):not(.wp-block-quote):not(.wp-block-image):not(.wp-block-list-item) {
				margin-top: 5rem;
			}
	</style>';
}

add_action('admin_head', 'admin_styles');
function admin_styles() {
  echo '<style>.dn{display:none!important;}.block-editor-block-list__block::before{content:attr(data-title);position:relative;display:block;font-size:20px;font-weight:700;max-width:1050px;margin:0 auto 16px;line-height:1;}.block-editor-block-list__block .acf-block-component{max-width:1050px;margin:0 auto;}.wp-block-paragraph:before,.wp-block-heading:before,.wp-block-list:before,.wp-block-quote:before,.wp-block-image:before,.wp-block-list-item:before{content:none;}</style>';
}

add_action( 'init', 'register_my_menus' );
function register_my_menus() {
	register_nav_menus([
		'nav' => __( 'Navigatiebalk' )
	]);
}

// Removes menu page - dashboard wordpress
add_action( 'admin_menu', 'remove_menus' );
function remove_menus(){
	if ( ! is_admin() ) return;

	$user = wp_get_current_user();
	$roles = ( array ) $user->roles;

	if ( in_array('editor', $roles) ) {
		remove_menu_page( 'edit-comments.php' );
		remove_menu_page( 'tools.php' );
		remove_menu_page( 'themes.php' );
		add_menu_page( 'Menu', 'Menu', 'read', 'nav-menus.php', false );
		add_menu_page( 'Widgets', 'Widgets', 'read', 'widgets.php', false );

		$role_object = get_role( 'editor' );
		$role_object->add_cap( 'edit_theme_options' );
	}
}

