<?php
add_action('wp_head', 'theme_colors');
function theme_colors(){
	$body = get_field('body_colors', 'options');

	if (!$body['color']) {
		echo __('Voordat je het thema kunt gebruiken moeten er eerst een aantal vereiste instellingen zijn ingevuld. Hiervoor ga je naar: Dashboard -> Site instellingen -> Stijl.', 'ch');

		wp_die();
	}

	$light = get_field('light_colors', 'options');
	$dark = get_field('dark_colors', 'options');
	$dark_contrast = get_field('dark_contrast_colors', 'options');
	$accent = get_field('accent_colors', 'options');
	$error = get_field('error_colors', 'options');
	$header = get_field('header_colors', 'options');
	$footer = get_field('footer_colors', 'options');
	$button_primary = get_field('button_primary_colors', 'options');
	$button_secondary = get_field('button_secondary_colors', 'options');
	$button_tertiary = get_field('button_tertiary_colors', 'options');

	$variables = "<style>:root {
		--cl-body: rgba({$body['color']['red']}, {$body['color']['green']}, {$body['color']['blue']}, {$body['color']['alpha']});
		--cl-body-20: rgba({$body['color']['red']}, {$body['color']['green']}, {$body['color']['blue']}, .2);
		--cl-body-25: rgba({$body['color']['red']}, {$body['color']['green']}, {$body['color']['blue']}, .25);
		--cl-body-text: rgba({$body['text']['red']}, {$body['text']['green']}, {$body['text']['blue']}, {$body['text']['alpha']});
		--cl-dark: rgba({$dark['color']['red']}, {$dark['color']['green']}, {$dark['color']['blue']}, {$dark['color']['alpha']});
		--cl-dark-10: rgba({$dark['color']['red']}, {$dark['color']['green']}, {$dark['color']['blue']}, .1);
		--cl-dark-text: rgba({$dark['text']['red']}, {$dark['text']['green']}, {$dark['text']['blue']}, {$dark['text']['alpha']});
		--cl-header: rgba({$header['color']['red']}, {$header['color']['green']}, {$header['color']['blue']}, {$header['color']['alpha']});
		--cl-header-10: rgba({$header['color']['red']}, {$header['color']['green']}, {$header['color']['blue']}, .1);
		--cl-header-60: rgba({$header['color']['red']}, {$header['color']['green']}, {$header['color']['blue']}, .6);
		--cl-header-text: rgba({$header['text']['red']}, {$header['text']['green']}, {$header['text']['blue']}, {$header['text']['alpha']});
		--cl-footer: rgba({$footer['color']['red']}, {$footer['color']['green']}, {$footer['color']['blue']}, {$footer['color']['alpha']});
		--cl-footer-accent: rgba({$footer['text']['red']}, {$footer['text']['green']}, {$footer['text']['blue']}, .1);
		--cl-footer-text: rgba({$footer['text']['red']}, {$footer['text']['green']}, {$footer['text']['blue']}, {$footer['text']['alpha']});
		--cl-accent: rgba({$accent['color']['red']}, {$accent['color']['green']}, {$accent['color']['blue']}, {$accent['color']['alpha']});
		--cl-accent-40: rgba({$accent['color']['red']}, {$accent['color']['green']}, {$accent['color']['blue']}, .4);
		--cl-accent-text: rgba({$accent['text']['red']}, {$accent['text']['green']}, {$accent['text']['blue']}, {$accent['text']['alpha']});
		--cl-dark-contrast: rgba({$dark_contrast['color']['red']}, {$dark_contrast['color']['green']}, {$dark_contrast['color']['blue']}, {$dark_contrast['color']['alpha']});
		--cl-dark-contrast-text: rgba({$dark_contrast['text']['red']}, {$dark_contrast['text']['green']}, {$dark_contrast['text']['blue']}, {$dark_contrast['text']['alpha']});
		--cl-dark-contrast-text-50: rgba({$dark_contrast['text']['red']}, {$dark_contrast['text']['green']}, {$dark_contrast['text']['blue']}, .5);
		--cl-light: rgba({$light['color']['red']}, {$light['color']['green']}, {$light['color']['blue']}, {$light['color']['alpha']});
		--cl-light-10: rgba({$light['color']['red']}, {$light['color']['green']}, {$light['color']['blue']}, .1);
		--cl-light-text: rgba({$light['text']['red']}, {$light['text']['green']}, {$light['text']['blue']}, {$light['text']['alpha']});
		--cl-based: var(--cl-light-10);
		--cl-border: var(--cl-light); 
		--cl-error: rgba({$error['color']['red']}, {$error['color']['green']}, {$error['color']['blue']}, {$error['color']['alpha']});
		--cl-error-text: rgba({$error['text']['red']}, {$error['text']['green']}, {$error['text']['blue']}, {$error['text']['alpha']});
		--cl-btn-primary: rgba({$button_primary['color']['red']}, {$button_primary['color']['green']}, {$button_primary['color']['blue']}, {$button_primary['color']['alpha']});
		--cl-btn-primary-text-ball: rgba({$button_primary['text_ball_color']['red']}, {$button_primary['text_ball_color']['green']}, {$button_primary['text_ball_color']['blue']}, {$button_primary['text_ball_color']['alpha']});
		--cl-btn-primary-arrow: rgba({$button_primary['arrow']['red']}, {$button_primary['arrow']['green']}, {$button_primary['arrow']['blue']}, {$button_primary['arrow']['alpha']});
		--cl-btn-secondary: rgba({$button_secondary['color']['red']}, {$button_secondary['color']['green']}, {$button_secondary['color']['blue']}, {$button_secondary['color']['alpha']});
		--cl-btn-secondary-text-ball: rgba({$button_secondary['text_ball_color']['red']}, {$button_secondary['text_ball_color']['green']}, {$button_secondary['text_ball_color']['blue']}, {$button_secondary['text_ball_color']['alpha']});
		--cl-btn-secondary-arrow: rgba({$button_secondary['arrow']['red']}, {$button_secondary['arrow']['green']}, {$button_secondary['arrow']['blue']}, {$button_secondary['arrow']['alpha']});
		--cl-btn-tertiary: rgba({$button_tertiary['color']['red']}, {$button_tertiary['color']['green']}, {$button_tertiary['color']['blue']}, {$button_tertiary['color']['alpha']});
		--cl-btn-tertiary-text-ball: rgba({$button_tertiary['text_ball_color']['red']}, {$button_tertiary['text_ball_color']['green']}, {$button_tertiary['text_ball_color']['blue']}, {$button_tertiary['text_ball_color']['alpha']});
		--cl-btn-tertiary-arrow: rgba({$button_tertiary['arrow']['red']}, {$button_tertiary['arrow']['green']}, {$button_tertiary['arrow']['blue']}, {$button_tertiary['arrow']['alpha']});
	}</style>";

	echo preg_replace("/\s+/", "", $variables);
};