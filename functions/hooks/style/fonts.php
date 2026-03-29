<?php
add_action('wp_head', 'theme_fonts');
function theme_fonts(){
	$heading = get_field('heading_font', 'options');

	if (!$heading['link']) {
		echo __('Voordat je het thema kunt gebruiken moeten er eerst een aantal vereiste instellingen zijn ingevuld. Hiervoor ga je naar: Dashboard -> Site instellingen -> Stijl.', 'ch');

		wp_die();
	}

	$text = get_field('text_font', 'options');
	$text_family = $text['family'];
	
	if (!$text['family']) {
		$text_family = $heading['family'];
	}

	echo $heading['link'];

	if (isset($text['link']) && $text['link'] != $heading['link']) {
		echo $text['link'];
	}
	
	$variables = "<style>:root {
		--font-primary: {$heading['family']};
		--font-primary-weight: {$heading['weight']};
		--font-primary-line-height: {$heading['line_height']};
		--font-secondary: {$text_family};
		--font-secondary-weight: {$text['weight']};
		--font-secondary-line-height: {$text['line_height']};
	}</style>";

	// echo preg_replace("/\s+/", "", $variables);
	echo $variables;
};