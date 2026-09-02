<?php
// Custom block category
function custom_block_categories( $categories ) {
	return array_merge(
		$categories,
		[
			[
				'slug' => 'custom_blocks',
				'title' => __( 'Aangepaste blokken', 'swift' ),
			],
		]
	);
}
add_filter( 'block_categories_all', 'custom_block_categories', 10, 2 );

/**
 * ACF renders block templates for both the public site and its editor preview.
 * Keep this test deliberately backend-only: a front-end request can never pass
 * the is_admin() guard, irrespective of ACF preview state.
 *
 * @return bool
 */
function custom_acf_is_backend_block_preview() {
	if ( ! is_admin() ) {
		return false;
	}

	if ( function_exists( 'acf_get_data' ) && acf_get_data( 'acf_doing_block_preview' ) ) {
		return true;
	}

	return function_exists( 'acf_is_block_editor' ) && acf_is_block_editor();
}

/**
 * Keep the ACF Blocks v3 migration in one registration path.
 * Existing names, templates, supports and field data stay untouched.
 *
 * @param array $settings Block settings.
 * @return void
 */
function custom_register_acf_block_type( $settings ) {
	$settings['api_version'] = 3;
	$settings['acf_block_version'] = 3;
	unset( $settings['mode'] );

	if ( isset( $settings['supports']['mode'] ) ) {
		unset( $settings['supports']['mode'] );
	}

	acf_register_block_type( $settings );
}

// The blocks that are shown
add_filter ( 'allowed_block_types_all', 'allowed_post_type_blocks', 10, 2 );
function allowed_post_type_blocks( $allowed_block_types, $editor_context ) {
	$text_template = ['post', 'job_offer'];
	if ( 'core/edit-widgets' === $editor_context->name ) {
		return [
			'acf/contactwidget',
			'acf/menuwidget',
			'acf/socialwidget',
			'acf/textwidget',
			'acf/imagewidget',
		];
	}

	$post = isset( $editor_context->post ) ? $editor_context->post : null;
	$post_type = $post && isset( $post->post_type ) ? $post->post_type : '';

	if ( in_array( $post_type, $text_template, true ) || ( $post && get_page_template_slug( $post ) === 'text.php' ) ) {
		return [
			'core/paragraph',
			'core/heading',
			'core/list',
			'core/video',
			'core/list-item',
			'core/image',
			'core/quote',
			'core/embed',
			'core/html',
			'acf/button',
			'acf/accordiononly',
			'acf/formonly',
		];
	} else {
		return [
			'acf/posts',
			'acf/logoslider',
			'acf/reviews',
			'acf/team',
			'acf/form',
			'acf/accordion',
			'acf/rows',
			'acf/titles',
			'acf/projects',
			'acf/text',
			'acf/textimage',
			'acf/gallery',
			'acf/joboffers',
			'acf/usps',
			'acf/iframe',
			'acf/textsidebar',
			'acf/newspaper',
			'acf/downloads',
		];
	}
}

// All types of blocks
function register_acf_block_types() {
	custom_register_acf_block_type([
		'api_version'       => 3,
		'acf_block_version' => 3,
		'name'            => 'downloads',
		'title'           => __( 'Downloads', 'swift' ),
		'render_template' => 'acf_blocks/downloads.php',
		'category'        => 'custom_blocks',
		'icon'            => 'download',
		'keywords'        => [ 'Downloads' ],
		'supports'        => [
				'align'  => false,
		],
	]);

	custom_register_acf_block_type([
		'api_version'       => 3,
		'acf_block_version' => 3,
		'name'            => 'button',
		'title'           => __( 'Knop', 'swift' ),
		'render_template' => 'acf_blocks/button.php',
		'category'        => 'custom_blocks',
		'icon'            => 'admin-links',
		'keywords'        => [ 'Knop' ],
		'supports'        => [
				'align'  => false,
		],
	]);

	custom_register_acf_block_type([
		'api_version'       => 3,
		'acf_block_version' => 3,
		'name'            => 'iframe',
		'title'           => __( 'Iframe', 'swift' ),
		'render_template' => 'acf_blocks/iframe.php',
		'category'        => 'custom_blocks',
		'icon'            => 'editor-code',
		'keywords'        => [ 'Iframe', 'Maps' ],
		'supports'        => [
				'align'  => false,
		],
	]);

	custom_register_acf_block_type([
		'api_version'       => 3,
		'acf_block_version' => 3,
		'name'            => 'accordiononly',
		'title'           => __( 'Accordeon', 'swift' ),
		'render_template' => 'acf_blocks/accordion_only.php',
		'category'        => 'custom_blocks',
		'icon'            => 'align-wide',
		'keywords'        => [ 'Accordeon' ],
		'supports'        => [
				'align'  => false,
		],
	]);

	custom_register_acf_block_type([
		'api_version'       => 3,
		'acf_block_version' => 3,
		'name'            => 'accordion',
		'title'           => __( 'Accordeon', 'swift' ),
		'render_template' => 'acf_blocks/accordion.php',
		'category'        => 'custom_blocks',
		'icon'            => 'align-wide',
		'keywords'        => [ 'Accordeon' ],
		'supports'        => [
				'align'  => false,
		],
	]);

	custom_register_acf_block_type([
		'api_version'       => 3,
		'acf_block_version' => 3,
		'name'            => 'formonly',
		'title'           => __( 'Formulier', 'swift' ),
		'render_template' => 'acf_blocks/form_only.php',
		'category'        => 'custom_blocks',
		'icon'            => 'email',
		'keywords'        => [ 'Formulier' ],
		'supports'        => [
				'align'  => false,
		],
	]);

	custom_register_acf_block_type([
		'api_version'       => 3,
		'acf_block_version' => 3,
		'name'            => 'newspaper',
		'title'           => __( 'Nieuwsbrief', 'swift' ),
		'render_template' => 'acf_blocks/newspaper.php',
		'category'        => 'custom_blocks',
		'icon'            => 'email',
		'keywords'        => [ 'Nieuwsbrief', 'Inschrijven' ],
		'supports'        => [
				'align'  => false,
		],
	]);

	custom_register_acf_block_type([
		'api_version'       => 3,
		'acf_block_version' => 3,
		'name'            => 'form',
		'title'           => __( 'Formulier', 'swift' ),
		'render_template' => 'acf_blocks/form.php',
		'category'        => 'custom_blocks',
		'icon'            => 'email',
		'keywords'        => [ 'Formulier' ],
		'supports'        => [
				'align'  => false,
		],
	]);

	custom_register_acf_block_type([
		'api_version'       => 3,
		'acf_block_version' => 3,
		'name'            => 'rows',
		'title'           => __( 'Icoon + tekst', 'swift' ),
		'render_template' => 'acf_blocks/rows.php',
		'category'        => 'custom_blocks',
		'icon'            => 'align-wide',
		'keywords'        => [ 'Icoon + tekst' ],
		'supports'        => [
				'align'  => false,
		],
	]);

	custom_register_acf_block_type([
		'api_version'       => 3,
		'acf_block_version' => 3,
		'name'            => 'projects',
		'title'           => __( 'Projecten', 'swift' ),
		'render_template' => 'acf_blocks/projects.php',
		'category'        => 'custom_blocks',
		'icon'            => 'admin-generic',
		'keywords'        => [ 'Projecten' ],
		'supports'        => [
				'align'  => false,
		],
	]);

	custom_register_acf_block_type([
		'api_version'       => 3,
		'acf_block_version' => 3,
		'name'            => 'text',
		'title'           => __( 'Tekst', 'swift' ),
		'render_template' => 'acf_blocks/text.php',
		'category'        => 'custom_blocks',
		'icon'            => 'editor-textcolor',
		'keywords'        => [ 'Tekst', 'Paragraaf' ],
		'supports'        => [
				'align'  => false,
		]
	]);

	custom_register_acf_block_type([
		'api_version'       => 3,
		'acf_block_version' => 3,
		'name'            => 'textimage',
		'title'           => __( 'Tekst - afbeelding', 'swift' ),
		'render_template' => 'acf_blocks/text_image.php',
		'category'        => 'custom_blocks',
		'icon'            => 'align-pull-right',
		'keywords'        => [ 'Tekst', 'Afbeelding' ],
		'supports'        => [
				'align'  => false,
		]
	]);

	custom_register_acf_block_type([
		'api_version'       => 3,
		'acf_block_version' => 3,
		'name'            => 'textsidebar',
		'title'           => __( 'Tekst - sidebar', 'swift' ),
		'render_template' => 'acf_blocks/text_sidebar.php',
		'category'        => 'custom_blocks',
		'icon'            => 'align-pull-left',
		'keywords'        => [ 'Tekst', 'Sidebar' ],
		'supports'        => [
				'align'  => false,
		]
	]);

	custom_register_acf_block_type([
		'api_version'       => 3,
		'acf_block_version' => 3,
		'name'            => 'gallery',
		'title'           => __( 'Galerij', 'swift' ),
		'render_template' => 'acf_blocks/gallery.php',
		'category'        => 'custom_blocks',
		'icon'            => 'format-gallery',
		'keywords'        => [ 'Galerij', 'Afbeelding(en)' ],
		'supports'        => [
				'align'  => false,
		]
	]);

	custom_register_acf_block_type([
		'api_version'       => 3,
		'acf_block_version' => 3,
		'name'            => 'joboffers',
		'title'           => __( 'Vacatures', 'swift' ),
		'render_template' => 'acf_blocks/job_offers.php',
		'category'        => 'custom_blocks',
		'icon'            => 'businessperson',
		'keywords'        => [ 'Vacatures' ],
		'supports'        => [
				'align'  => false,
		]
	]);

	custom_register_acf_block_type([
		'api_version'       => 3,
		'acf_block_version' => 3,
		'name'            => 'titles',
		'title'           => __( 'Pagina tegels', 'swift' ),
		'render_template' => 'acf_blocks/tiles.php',
		'category'        => 'custom_blocks',
		'icon'            => 'grid-view',
		'keywords'        => [ 'Tegels', 'Links', 'Pagina links' ],
		'supports'        => [
				'align'  => false,
		]
	]);

	custom_register_acf_block_type([
		'api_version'       => 3,
		'acf_block_version' => 3,
		'name'            => 'logoslider',
		'title'           => 'Logo slider',
		'render_template' => 'acf_blocks/logo_slider.php',
		'category'        => 'custom_blocks',
		'icon'            => 'format-image',
		'keywords'        => [ 'Logos', 'Slider' ],
		'supports'        => [
				'align'  => false,
		],
	]);

	custom_register_acf_block_type([
		'api_version'       => 3,
		'acf_block_version' => 3,
		'name'            => 'reviews',
		'title'           => 'Reviews',
		'render_template' => 'acf_blocks/reviews.php',
		'category'        => 'custom_blocks',
		'icon'            => 'format-quote',
		'keywords'        => [ 'Reviews' ],
		'supports'        => [
				'align'  => false,
		],
	]);

	custom_register_acf_block_type([
		'api_version'       => 3,
		'acf_block_version' => 3,
		'name'            => 'team',
		'title'           => 'Team',
		'render_template' => 'acf_blocks/team.php',
		'category'        => 'custom_blocks',
		'icon'            => 'groups',
		'keywords'        => [ 'Team' ],
		'supports'        => [
				'align'  => false,
		],
	]);

	custom_register_acf_block_type([
		'api_version'       => 3,
		'acf_block_version' => 3,
		'name'            => 'posts',
		'title'           => 'Berichten',
		'render_template' => 'acf_blocks/posts.php',
		'category'        => 'custom_blocks',
		'icon'            => 'welcome-write-blog',
		'keywords'        => [ 'Berichten' ],
		'supports'        => [
				'align'  => false,
		],
	]);

	custom_register_acf_block_type([
		'api_version'       => 3,
		'acf_block_version' => 3,
		'name'            => 'usps',
		'title'           => 'USPs',
		'render_template' => 'acf_blocks/usps.php',
		'category'        => 'custom_blocks',
		'icon'            => 'heart',
		'keywords'        => [ 'USPs' ],
		'supports'        => [
				'align'  => false,
		],
	]);
}

function register_acf_widget_types() {
	custom_register_acf_block_type([
		'api_version'       => 3,
		'acf_block_version' => 3,
		'name'            => 'contactwidget',
		'title'           => __( 'Contactgegevens - widget', 'swift' ),
		'render_template' => 'acf-widgets/contact.php',
		'category'        => 'custom_blocks',
		'icon'            => 'phone',
		'keywords'        => [ 'Contact' ],
		'supports'        => [
			'align'  => false,
		]
	]);

	custom_register_acf_block_type([
		'api_version'       => 3,
		'acf_block_version' => 3,
		'name'            => 'menuwidget',
		'title'           => __( 'Menu - widget', 'swift' ),
		'render_template' => 'acf-widgets/menu.php',
		'category'        => 'custom_blocks',
		'icon'            => 'admin-links',
		'keywords'        => [ 'Menu', 'Link' ],
		'supports'        => [
			'align'  => false,
		]
	]);

	custom_register_acf_block_type([
		'api_version'       => 3,
		'acf_block_version' => 3,
		'name'            => 'socialwidget',
		'title'           => __( 'Social media - widget', 'swift' ),
		'render_template' => 'acf-widgets/social.php',
		'category'        => 'custom_blocks',
		'icon'            => 'share',
		'keywords'        => [ 'Social' ],
		'supports'        => [
			'align'  => false,
		]
	]);

	custom_register_acf_block_type([
		'api_version'       => 3,
		'acf_block_version' => 3,
		'name'            => 'textwidget',
		'title'           => __( 'Tekst - widget', 'swift' ),
		'render_template' => 'acf-widgets/text.php',
		'category'        => 'custom_blocks',
		'icon'            => 'editor-textcolor',
		'keywords'        => [ 'Tekst', 'Paragraaf' ],
		'supports'        => [
			'align'  => false,
		]
	]);

	custom_register_acf_block_type([
		'api_version'       => 3,
		'acf_block_version' => 3,
		'name'            => 'imagewidget',
		'title'           => __( 'Afbeelding - widget', 'swift' ),
		'render_template' => 'acf-widgets/image.php',
		'category'        => 'custom_blocks',
		'icon'            => 'format-image',
		'keywords'        => [ 'Afbeelding' ],
		'supports'        => [
			'align'  => false,
		]
	]);
}

// Check if function exists and hook into setup.
if ( function_exists('acf_register_block_type') ) {
	add_action( 'acf/init', 'register_acf_block_types' );
	add_action( 'acf/init', 'register_acf_widget_types' );

}
