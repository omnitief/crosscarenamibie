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
	} else if ( in_array($editor_context->post->post_type, $text_template) || get_page_template_slug($editor_context->post) === 'text.php' ) {
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
	acf_register_block_type([
		'name'            => 'downloads',
		'title'           => __( 'Downloads', 'swift' ),
		'render_template' => 'acf_blocks/downloads.php',
		'category'        => 'custom_blocks',
		'icon'            => 'download',
		'keywords'        => [ 'Downloads' ],
		'api_version'     => 3,
		'acf_block_version'=> 3,
		'supports'        => [
				'align'  => false,
		],
	]);

	acf_register_block_type([
		'name'            => 'button',
		'title'           => __( 'Knop', 'swift' ),
		'render_template' => 'acf_blocks/button.php',
		'category'        => 'custom_blocks',
		'icon'            => 'admin-links',
		'keywords'        => [ 'Knop' ],
		'api_version'     => 3,
		'acf_block_version'=> 3,
		'supports'        => [
				'align'  => false,
		],
	]);

	acf_register_block_type([
		'name'            => 'iframe',
		'title'           => __( 'Iframe', 'swift' ),
		'render_template' => 'acf_blocks/iframe.php',
		'category'        => 'custom_blocks',
		'icon'            => 'editor-code',
		'keywords'        => [ 'Iframe', 'Maps' ],
		'api_version'     => 3,
		'acf_block_version'=> 3,
		'supports'        => [
				'align'  => false,
		],
	]);

	acf_register_block_type([
		'name'            => 'accordiononly',
		'title'           => __( 'Accordeon', 'swift' ),
		'render_template' => 'acf_blocks/accordion_only.php',
		'category'        => 'custom_blocks',
		'icon'            => 'align-wide',
		'keywords'        => [ 'Accordeon' ],
		'api_version'     => 3,
		'acf_block_version'=> 3,
		'supports'        => [
				'align'  => false,
		],
	]);

	acf_register_block_type([
		'name'            => 'accordion',
		'title'           => __( 'Accordeon', 'swift' ),
		'render_template' => 'acf_blocks/accordion.php',
		'category'        => 'custom_blocks',
		'icon'            => 'align-wide',
		'keywords'        => [ 'Accordeon' ],
		'api_version'     => 3,
		'acf_block_version'=> 3,
		'supports'        => [
				'align'  => false,
		],
	]);

	acf_register_block_type([
		'name'            => 'formonly',
		'title'           => __( 'Formulier', 'swift' ),
		'render_template' => 'acf_blocks/form_only.php',
		'category'        => 'custom_blocks',
		'icon'            => 'email',
		'keywords'        => [ 'Formulier' ],
		'api_version'     => 3,
		'acf_block_version'=> 3,
		'supports'        => [
				'align'  => false,
		],
	]);

	acf_register_block_type([
		'name'            => 'newspaper',
		'title'           => __( 'Nieuwsbrief', 'swift' ),
		'render_template' => 'acf_blocks/newspaper.php',
		'category'        => 'custom_blocks',
		'icon'            => 'email',
		'keywords'        => [ 'Nieuwsbrief', 'Inschrijven' ],
		'api_version'     => 3,
		'acf_block_version'=> 3,
		'supports'        => [
				'align'  => false,
		],
	]);

	acf_register_block_type([
		'name'            => 'form',
		'title'           => __( 'Formulier', 'swift' ),
		'render_template' => 'acf_blocks/form.php',
		'category'        => 'custom_blocks',
		'icon'            => 'email',
		'keywords'        => [ 'Formulier' ],
		'api_version'     => 3,
		'acf_block_version'=> 3,
		'supports'        => [
				'align'  => false,
		],
	]);

	acf_register_block_type([
		'name'            => 'rows',
		'title'           => __( 'Icoon + tekst', 'swift' ),
		'render_template' => 'acf_blocks/rows.php',
		'category'        => 'custom_blocks',
		'icon'            => 'align-wide',
		'keywords'        => [ 'Icoon + tekst' ],
		'api_version'     => 3,
		'acf_block_version'=> 3,
		'supports'        => [
				'align'  => false,
		],
	]);

	acf_register_block_type([
		'name'            => 'projects',
		'title'           => __( 'Projecten', 'swift' ),
		'render_template' => 'acf_blocks/projects.php',
		'category'        => 'custom_blocks',
		'icon'            => 'admin-generic',
		'keywords'        => [ 'Projecten' ],
		'api_version'     => 3,
		'acf_block_version'=> 3,
		'supports'        => [
				'align'  => false,
		],
	]);

	acf_register_block_type([
		'name'            => 'text',
		'title'           => __( 'Tekst', 'swift' ),
		'render_template' => 'acf_blocks/text.php',
		'category'        => 'custom_blocks',
		'icon'            => 'editor-textcolor',
		'keywords'        => [ 'Tekst', 'Paragraaf' ],
		'api_version'     => 3,
		'acf_block_version'=> 3,
		'supports'        => [
				'align'  => false,
		]
	]);

	acf_register_block_type([
		'name'            => 'textimage',
		'title'           => __( 'Tekst - afbeelding', 'swift' ),
		'render_template' => 'acf_blocks/text_image.php',
		'category'        => 'custom_blocks',
		'icon'            => 'align-pull-right',
		'keywords'        => [ 'Tekst', 'Afbeelding' ],
		'api_version'     => 3,
		'acf_block_version'=> 3,
		'supports'        => [
				'align'  => false,
		]
	]);

	acf_register_block_type([
		'name'            => 'textsidebar',
		'title'           => __( 'Tekst - sidebar', 'swift' ),
		'render_template' => 'acf_blocks/text_sidebar.php',
		'category'        => 'custom_blocks',
		'icon'            => 'align-pull-left',
		'keywords'        => [ 'Tekst', 'Sidebar' ],
		'api_version'     => 3,
		'acf_block_version'=> 3,
		'supports'        => [
				'align'  => false,
		]
	]);

	acf_register_block_type([
		'name'            => 'gallery',
		'title'           => __( 'Galerij', 'swift' ),
		'render_template' => 'acf_blocks/gallery.php',
		'category'        => 'custom_blocks',
		'icon'            => 'format-gallery',
		'keywords'        => [ 'Galerij', 'Afbeelding(en)' ],
		'api_version'     => 3,
		'acf_block_version'=> 3,
		'supports'        => [
				'align'  => false,
		]
	]);

	acf_register_block_type([
		'name'            => 'joboffers',
		'title'           => __( 'Vacatures', 'swift' ),
		'render_template' => 'acf_blocks/job_offers.php',
		'category'        => 'custom_blocks',
		'icon'            => 'businessperson',
		'keywords'        => [ 'Vacatures' ],
		'api_version'     => 3,
		'acf_block_version'=> 3,
		'supports'        => [
				'align'  => false,
		]
	]);

	acf_register_block_type([
		'name'            => 'titles',
		'title'           => __( 'Pagina tegels', 'swift' ),
		'render_template' => 'acf_blocks/tiles.php',
		'category'        => 'custom_blocks',
		'icon'            => 'grid-view',
		'keywords'        => [ 'Tegels', 'Links', 'Pagina links' ],
		'api_version'     => 3,
		'acf_block_version'=> 3,
		'supports'        => [
				'align'  => false,
		]
	]);

	acf_register_block_type([
		'name'            => 'logoslider',
		'title'           => 'Logo slider',
		'render_template' => 'acf_blocks/logo_slider.php',
		'category'        => 'custom_blocks',
		'icon'            => 'format-image',
		'keywords'        => [ 'Logos', 'Slider' ],
		'api_version'     => 3,
		'acf_block_version'=> 3,
		'supports'        => [
				'align'  => false,
		],
	]);

	acf_register_block_type([
		'name'            => 'reviews',
		'title'           => 'Reviews',
		'render_template' => 'acf_blocks/reviews.php',
		'category'        => 'custom_blocks',
		'icon'            => 'format-quote',
		'keywords'        => [ 'Reviews' ],
		'api_version'     => 3,
		'acf_block_version'=> 3,
		'supports'        => [
				'align'  => false,
		],
	]);

	acf_register_block_type([
		'name'            => 'team',
		'title'           => 'Team',
		'render_template' => 'acf_blocks/team.php',
		'category'        => 'custom_blocks',
		'icon'            => 'groups',
		'keywords'        => [ 'Team' ],
		'api_version'     => 3,
		'acf_block_version'=> 3,
		'supports'        => [
				'align'  => false,
		],
	]);

	acf_register_block_type([
		'name'            => 'posts',
		'title'           => 'Berichten',
		'render_template' => 'acf_blocks/posts.php',
		'category'        => 'custom_blocks',
		'icon'            => 'welcome-write-blog',
		'keywords'        => [ 'Berichten' ],
		'api_version'     => 3,
		'acf_block_version'=> 3,
		'supports'        => [
				'align'  => false,
		],
	]);

	acf_register_block_type([
		'name'            => 'usps',
		'title'           => 'USPs',
		'render_template' => 'acf_blocks/usps.php',
		'category'        => 'custom_blocks',
		'icon'            => 'heart',
		'keywords'        => [ 'USPs' ],
		'api_version'     => 3,
		'acf_block_version'=> 3,
		'supports'        => [
				'align'  => false,
		],
	]);
}

function register_acf_widget_types() {
	acf_register_block_type([
		'name'            => 'contactwidget',
		'title'           => __( 'Contactgegevens - widget', 'swift' ),
		'render_template' => 'acf-widgets/contact.php',
		'category'        => 'custom_blocks',
		'icon'            => 'phone',
		'keywords'        => [ 'Contact' ],
		'api_version'     => 3,
		'acf_block_version'=> 3,
		'supports'        => [
			'align'  => false,
		]
	]);

	acf_register_block_type([
		'name'            => 'menuwidget',
		'title'           => __( 'Menu - widget', 'swift' ),
		'render_template' => 'acf-widgets/menu.php',
		'category'        => 'custom_blocks',
		'icon'            => 'admin-links',
		'keywords'        => [ 'Menu', 'Link' ],
		'api_version'     => 3,
		'acf_block_version'=> 3,
		'supports'        => [
			'align'  => false,
		]
	]);

	acf_register_block_type([
		'name'            => 'socialwidget',
		'title'           => __( 'Social media - widget', 'swift' ),
		'render_template' => 'acf-widgets/social.php',
		'category'        => 'custom_blocks',
		'icon'            => 'share',
		'keywords'        => [ 'Social' ],
		'api_version'     => 3,
		'acf_block_version'=> 3,
		'supports'        => [
			'align'  => false,
		]
	]);

	acf_register_block_type([
		'name'            => 'textwidget',
		'title'           => __( 'Tekst - widget', 'swift' ),
		'render_template' => 'acf-widgets/text.php',
		'category'        => 'custom_blocks',
		'icon'            => 'editor-textcolor',
		'keywords'        => [ 'Tekst', 'Paragraaf' ],
		'api_version'     => 3,
		'acf_block_version'=> 3,
		'supports'        => [
			'align'  => false,
		]
	]);

	acf_register_block_type([
		'name'            => 'imagewidget',
		'title'           => __( 'Afbeelding - widget', 'swift' ),
		'render_template' => 'acf-widgets/image.php',
		'category'        => 'custom_blocks',
		'icon'            => 'format-image',
		'keywords'        => [ 'Afbeelding' ],
		'api_version'     => 3,
		'acf_block_version'=> 3,
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
