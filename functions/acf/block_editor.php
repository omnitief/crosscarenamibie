<?php

/**
 * Keep this theme's legacy ACF blocks on the WordPress/ACF v3 APIs.
 *
 * This deliberately mirrors the production registration normalisation, but
 * only for blocks owned by this theme. Plugin-provided ACF blocks must retain
 * their own declared block version and editing configuration.
 */
function swift_get_theme_acf_block_names() {
	return [
		'acf/downloads',
		'acf/button',
		'acf/iframe',
		'acf/accordiononly',
		'acf/accordion',
		'acf/formonly',
		'acf/newspaper',
		'acf/form',
		'acf/rows',
		'acf/projects',
		'acf/text',
		'acf/textimage',
		'acf/textsidebar',
		'acf/gallery',
		'acf/joboffers',
		'acf/titles',
		'acf/logoslider',
		'acf/reviews',
		'acf/team',
		'acf/posts',
		'acf/usps',
		'acf/contactwidget',
		'acf/menuwidget',
		'acf/socialwidget',
		'acf/textwidget',
		'acf/imagewidget',
	];
}

function swift_acf_block_type_args( $args, $name = null ) {
	$block_name = isset( $args['name'] ) ? $args['name'] : $name;

	if ( ! in_array( $block_name, swift_get_theme_acf_block_names(), true ) ) {
		return $args;
	}

	$args['api_version'] = 3;
	$args['acf_block_version'] = 3;
	unset( $args['mode'], $args['auto_inline_editing'] );

	if ( isset( $args['supports'] ) && is_array( $args['supports'] ) ) {
		unset( $args['supports']['mode'] );
	}

	return $args;
}
add_filter( 'acf/register_block_type_args', 'swift_acf_block_type_args', 10, 2 );

/**
 * Temporary, opt-in registration tracing for staging. Enable only with
 * define( 'SWIFT_ACF_BLOCK_DEBUG', true ) in wp-config.php.
 */
function swift_log_acf_text_block_args( $args, $name = null ) {
	$block_name = isset( $args['name'] ) ? $args['name'] : $name;

	if ( 'acf/text' === $block_name && defined( 'SWIFT_ACF_BLOCK_DEBUG' ) && SWIFT_ACF_BLOCK_DEBUG ) {
		error_log(
			'ACF text final registration args: ' . wp_json_encode(
				[
					'name'              => $block_name,
					'api_version'       => $args['api_version'] ?? null,
					'acf_block_version' => $args['acf_block_version'] ?? null,
					'mode'              => $args['mode'] ?? null,
					'auto_inline_editing' => $args['auto_inline_editing'] ?? null,
					'supports'          => $args['supports'] ?? null,
					'render_template'   => $args['render_template'] ?? null,
				]
			)
		);
	}

	return $args;
}
add_filter( 'acf/register_block_type_args', 'swift_log_acf_text_block_args', PHP_INT_MAX, 2 );

function swift_get_theme_font_stylesheets() {
	$stylesheets = [];
	if ( ! function_exists( 'get_field' ) || ! did_action( 'acf/init' ) ) {
		return $stylesheets;
	}

	$heading = get_field( 'heading_font', 'options' );
	$text = get_field( 'text_font', 'options' );

	foreach ( [ $heading, $text ] as $font_group ) {
		if ( ! is_array( $font_group ) || empty( $font_group['link'] ) ) {
			continue;
		}

		$urls = wp_extract_urls( $font_group['link'] );

		if ( empty( $urls ) ) {
			$urls = [ $font_group['link'] ];
		}

		foreach ( $urls as $url ) {
			$url = esc_url_raw( $url );

			if ( $url ) {
				$stylesheets[] = $url;
			}
		}
	}

	return array_values( array_unique( $stylesheets ) );
}

function swift_get_editor_dynamic_css() {
	if ( ! function_exists( 'get_field' ) || ! did_action( 'acf/init' ) ) {
		return '';
	}

	$heading = get_field( 'heading_font', 'options' );
	$text = get_field( 'text_font', 'options' );
	$body = get_field( 'body_colors', 'options' );
	$light = get_field( 'light_colors', 'options' );
	$dark = get_field( 'dark_colors', 'options' );
	$dark_contrast = get_field( 'dark_contrast_colors', 'options' );
	$accent = get_field( 'accent_colors', 'options' );
	$error = get_field( 'error_colors', 'options' );
	$header = get_field( 'header_colors', 'options' );
	$footer = get_field( 'footer_colors', 'options' );
	$button_primary = get_field( 'button_primary_colors', 'options' );
	$button_secondary = get_field( 'button_secondary_colors', 'options' );
	$button_tertiary = get_field( 'button_tertiary_colors', 'options' );
	$br_small = get_field( 'br_small', 'options' );
	$br_medium = get_field( 'br_medium', 'options' );
	$br_large = get_field( 'br_large', 'options' );
	$br_image_outside_corner = get_field( 'br_image_outside_corner', 'options' );
	$button_full_radius = get_field( 'button_full_radius', 'options' );
	$btn_left_top = get_field( 'button_br_left_top', 'options' );
	$btn_right_top = get_field( 'button_br_right_top', 'options' );
	$btn_right_bottom = get_field( 'button_br_right_bottom', 'options' );
	$btn_left_bottom = get_field( 'button_br_left_bottom', 'options' );

	if ( ! is_array( $heading ) || empty( $heading['family'] ) || ! is_array( $body ) || empty( $body['color'] ) ) {
		return '';
	}

	$text_family = isset( $text['family'] ) && $text['family'] ? $text['family'] : $heading['family'];
	$text_weight = isset( $text['weight'] ) ? $text['weight'] : '';
	$text_line_height = isset( $text['line_height'] ) ? $text['line_height'] : '';
	$text_link = isset( $text['link'] ) ? $text['link'] : '';

	$heading_link = isset( $heading['link'] ) ? $heading['link'] : '';

	$button_radius = '50|50|50|50';

	if ( ! $button_full_radius ) {
		$button_radius = implode(
			'|',
			[
				$btn_left_top,
				$btn_right_top,
				$btn_right_bottom,
				$btn_left_bottom,
			]
		);
	}

	$css = ':root {';
	$css .= sprintf( '--font-primary:%s;', $heading['family'] );
	$css .= sprintf( '--font-primary-weight:%s;', $heading['weight'] );
	$css .= sprintf( '--font-primary-line-height:%s;', $heading['line_height'] );
	$css .= sprintf( '--font-secondary:%s;', $text_family );
	$css .= sprintf( '--font-secondary-weight:%s;', $text_weight );
	$css .= sprintf( '--font-secondary-line-height:%s;', $text_line_height );
	$css .= sprintf( '--cl-body:rgba(%d,%d,%d,%s);', $body['color']['red'], $body['color']['green'], $body['color']['blue'], $body['color']['alpha'] );
	$css .= sprintf( '--cl-body-20:rgba(%d,%d,%d,.2);', $body['color']['red'], $body['color']['green'], $body['color']['blue'] );
	$css .= sprintf( '--cl-body-25:rgba(%d,%d,%d,.25);', $body['color']['red'], $body['color']['green'], $body['color']['blue'] );
	$css .= sprintf( '--cl-body-text:rgba(%d,%d,%d,%s);', $body['text']['red'], $body['text']['green'], $body['text']['blue'], $body['text']['alpha'] );
	$css .= sprintf( '--cl-dark:rgba(%d,%d,%d,%s);', $dark['color']['red'], $dark['color']['green'], $dark['color']['blue'], $dark['color']['alpha'] );
	$css .= sprintf( '--cl-dark-10:rgba(%d,%d,%d,.1);', $dark['color']['red'], $dark['color']['green'], $dark['color']['blue'] );
	$css .= sprintf( '--cl-dark-text:rgba(%d,%d,%d,%s);', $dark['text']['red'], $dark['text']['green'], $dark['text']['blue'], $dark['text']['alpha'] );
	$css .= sprintf( '--cl-header:rgba(%d,%d,%d,%s);', $header['color']['red'], $header['color']['green'], $header['color']['blue'], $header['color']['alpha'] );
	$css .= sprintf( '--cl-header-10:rgba(%d,%d,%d,.1);', $header['color']['red'], $header['color']['green'], $header['color']['blue'] );
	$css .= sprintf( '--cl-header-60:rgba(%d,%d,%d,.6);', $header['color']['red'], $header['color']['green'], $header['color']['blue'] );
	$css .= sprintf( '--cl-header-text:rgba(%d,%d,%d,%s);', $header['text']['red'], $header['text']['green'], $header['text']['blue'], $header['text']['alpha'] );
	$css .= sprintf( '--cl-footer:rgba(%d,%d,%d,%s);', $footer['color']['red'], $footer['color']['green'], $footer['color']['blue'], $footer['color']['alpha'] );
	$css .= sprintf( '--cl-footer-accent:rgba(%d,%d,%d,.1);', $footer['text']['red'], $footer['text']['green'], $footer['text']['blue'] );
	$css .= sprintf( '--cl-footer-text:rgba(%d,%d,%d,%s);', $footer['text']['red'], $footer['text']['green'], $footer['text']['blue'], $footer['text']['alpha'] );
	$css .= sprintf( '--cl-accent:rgba(%d,%d,%d,%s);', $accent['color']['red'], $accent['color']['green'], $accent['color']['blue'], $accent['color']['alpha'] );
	$css .= sprintf( '--cl-accent-40:rgba(%d,%d,%d,.4);', $accent['color']['red'], $accent['color']['green'], $accent['color']['blue'] );
	$css .= sprintf( '--cl-accent-text:rgba(%d,%d,%d,%s);', $accent['text']['red'], $accent['text']['green'], $accent['text']['blue'], $accent['text']['alpha'] );
	$css .= sprintf( '--cl-dark-contrast:rgba(%d,%d,%d,%s);', $dark_contrast['color']['red'], $dark_contrast['color']['green'], $dark_contrast['color']['blue'], $dark_contrast['color']['alpha'] );
	$css .= sprintf( '--cl-dark-contrast-text:rgba(%d,%d,%d,%s);', $dark_contrast['text']['red'], $dark_contrast['text']['green'], $dark_contrast['text']['blue'], $dark_contrast['text']['alpha'] );
	$css .= sprintf( '--cl-dark-contrast-text-50:rgba(%d,%d,%d,.5);', $dark_contrast['text']['red'], $dark_contrast['text']['green'], $dark_contrast['text']['blue'] );
	$css .= sprintf( '--cl-light:rgba(%d,%d,%d,%s);', $light['color']['red'], $light['color']['green'], $light['color']['blue'], $light['color']['alpha'] );
	$css .= sprintf( '--cl-light-10:rgba(%d,%d,%d,.1);', $light['color']['red'], $light['color']['green'], $light['color']['blue'] );
	$css .= sprintf( '--cl-light-text:rgba(%d,%d,%d,%s);', $light['text']['red'], $light['text']['green'], $light['text']['blue'], $light['text']['alpha'] );
	$css .= '--cl-based:var(--cl-light-10);';
	$css .= '--cl-border:var(--cl-light);';
	$css .= sprintf( '--cl-error:rgba(%d,%d,%d,%s);', $error['color']['red'], $error['color']['green'], $error['color']['blue'], $error['color']['alpha'] );
	$css .= sprintf( '--cl-error-text:rgba(%d,%d,%d,%s);', $error['text']['red'], $error['text']['green'], $error['text']['blue'], $error['text']['alpha'] );
	$css .= sprintf( '--cl-btn-primary:rgba(%d,%d,%d,%s);', $button_primary['color']['red'], $button_primary['color']['green'], $button_primary['color']['blue'], $button_primary['color']['alpha'] );
	$css .= sprintf( '--cl-btn-primary-text-ball:rgba(%d,%d,%d,%s);', $button_primary['text_ball_color']['red'], $button_primary['text_ball_color']['green'], $button_primary['text_ball_color']['blue'], $button_primary['text_ball_color']['alpha'] );
	$css .= sprintf( '--cl-btn-primary-arrow:rgba(%d,%d,%d,%s);', $button_primary['arrow']['red'], $button_primary['arrow']['green'], $button_primary['arrow']['blue'], $button_primary['arrow']['alpha'] );
	$css .= sprintf( '--cl-btn-secondary:rgba(%d,%d,%d,%s);', $button_secondary['color']['red'], $button_secondary['color']['green'], $button_secondary['color']['blue'], $button_secondary['color']['alpha'] );
	$css .= sprintf( '--cl-btn-secondary-text-ball:rgba(%d,%d,%d,%s);', $button_secondary['text_ball_color']['red'], $button_secondary['text_ball_color']['green'], $button_secondary['text_ball_color']['blue'], $button_secondary['text_ball_color']['alpha'] );
	$css .= sprintf( '--cl-btn-secondary-arrow:rgba(%d,%d,%d,%s);', $button_secondary['arrow']['red'], $button_secondary['arrow']['green'], $button_secondary['arrow']['blue'], $button_secondary['arrow']['alpha'] );
	$css .= sprintf( '--cl-btn-tertiary:rgba(%d,%d,%d,%s);', $button_tertiary['color']['red'], $button_tertiary['color']['green'], $button_tertiary['color']['blue'], $button_tertiary['color']['alpha'] );
	$css .= sprintf( '--cl-btn-tertiary-text-ball:rgba(%d,%d,%d,%s);', $button_tertiary['text_ball_color']['red'], $button_tertiary['text_ball_color']['green'], $button_tertiary['text_ball_color']['blue'], $button_tertiary['text_ball_color']['alpha'] );
	$css .= sprintf( '--cl-btn-tertiary-arrow:rgba(%d,%d,%d,%s);', $button_tertiary['arrow']['red'], $button_tertiary['arrow']['green'], $button_tertiary['arrow']['blue'], $button_tertiary['arrow']['alpha'] );
	$css .= sprintf( '--radius:%spx;', round( (int) $br_medium / 1.5 ) );
	$css .= sprintf( '--radius-small:%spx;', round( (int) $br_small / 1.5 ) );
	$css .= sprintf( '--radius-large:%spx;', round( (int) $br_large / 1.5 ) );
	$css .= sprintf( '--radius-img-large:%spx;', round( (int) $br_image_outside_corner / 1.5 ) );
	$css .= sprintf( '--radius-btn:%s;', $button_radius );
	$css .= '}';
	$css .= '@media (min-width: 992px) { :root {';
	$css .= sprintf( '--radius:%spx;', (int) $br_medium );
	$css .= sprintf( '--radius-small:%spx;', (int) $br_small );
	$css .= sprintf( '--radius-large:%spx;', (int) $br_large );
	$css .= sprintf( '--radius-img-large:%spx;', (int) $br_image_outside_corner );
	$css .= '} }';

	return $css;
}

function swift_register_block_editor_styles() {
	add_theme_support( 'editor-styles' );

	add_editor_style( [
		'dist/main.css',
		'dist/not_critical.css',
		'dist/editor.css',
	] );
}
add_action( 'after_setup_theme', 'swift_register_block_editor_styles' );

function swift_add_block_editor_sidebar_width_styles() {
	$css = '
		.interface-complementary-area__fill,
		.interface-complementary-area.editor-sidebar {
			width: 550px !important;
			flex-basis: 550px !important;
			min-width: 550px !important;
			max-width: 550px !important;
		}
	';

	wp_add_inline_style( 'wp-edit-blocks', $css );
}
add_action( 'enqueue_block_editor_assets', 'swift_add_block_editor_sidebar_width_styles' );

function swift_add_block_editor_dynamic_styles( $editor_settings, $editor_context ) {
	$css = swift_get_editor_dynamic_css();
	$font_stylesheets = swift_get_theme_font_stylesheets();

	if ( ! empty( $font_stylesheets ) ) {
		foreach ( $font_stylesheets as $font_stylesheet ) {
			$css = sprintf( '@import url("%s");%s', esc_url_raw( $font_stylesheet ), $css );
		}
	}

	if ( '' === $css ) {
		return $editor_settings;
	}

	if ( empty( $editor_settings['styles'] ) || ! is_array( $editor_settings['styles'] ) ) {
		$editor_settings['styles'] = [];
	}

	$editor_settings['styles'][] = [
		'css' => $css,
	];

	return $editor_settings;
}
add_filter( 'block_editor_settings_all', 'swift_add_block_editor_dynamic_styles', 10, 2 );

function swift_filter_tinymce_editor_css( $mce_css ) {
	$blocked = array_merge(
		[
			get_theme_file_uri( 'dist/main.css' ),
			get_theme_file_uri( 'dist/not_critical.css' ),
			get_theme_file_uri( 'dist/editor.css' ),
		],
		swift_get_theme_font_stylesheets()
	);

	if ( '' === trim( (string) $mce_css ) ) {
		return $mce_css;
	}

	$stylesheets = array_filter( array_map( 'trim', explode( ',', $mce_css ) ) );
	$stylesheets = array_filter(
		$stylesheets,
		function ( $stylesheet ) use ( $blocked ) {
			return ! in_array( $stylesheet, $blocked, true );
		}
	);

	return implode( ',', $stylesheets );
}
add_filter( 'mce_css', 'swift_filter_tinymce_editor_css' );

function swift_tinymce_editor_content_style( $init ) {
	$style = 'a { text-decoration: underline; }';

	if ( isset( $init['content_style'] ) && '' !== trim( (string) $init['content_style'] ) ) {
		$init['content_style'] .= ' ' . $style;
	} else {
		$init['content_style'] = $style;
	}

	return $init;
}
add_filter( 'tiny_mce_before_init', 'swift_tinymce_editor_content_style' );
