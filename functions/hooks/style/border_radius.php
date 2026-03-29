<?php
add_action('wp_head', 'theme_border_radius');
function theme_border_radius(){
	$br_small = get_field('br_small', 'options');

	if (!$br_small) {
		echo __('Voordat je het thema kunt gebruiken moeten er eerst een aantal vereiste instellingen zijn ingevuld. Hiervoor ga je naar: Dashboard -> Site instellingen -> Stijl.', 'ch');

		wp_die();
	}

	$radius_divided = 1.5;
	$br_medium = intval(get_field('br_medium', 'options'));
	$br_large = intval(get_field('br_large', 'options'));
	$br_image_outside_corner = intval(get_field('br_image_outside_corner', 'options'));
	$br_small_mobile = round($br_small/$radius_divided);
	$br_medium_mobile = round($br_medium/$radius_divided);
	$br_large_mobile = round($br_large/$radius_divided);
	$br_image_outside_corner_mobile = round($br_image_outside_corner/$radius_divided);

	$button_full_radius = get_field('button_full_radius', 'options');
	if ($button_full_radius) {
		$btn_left_top = 50;
		$btn_right_top = 50;
		$btn_right_bottom = 50;
		$btn_left_bottom = 50;
	} else {
		$btn_left_top = get_field('button_br_left_top', 'options');
		$btn_right_top = get_field('button_br_right_top', 'options');
		$btn_right_bottom = get_field('button_br_right_bottom', 'options');
		$btn_left_bottom = get_field('button_br_left_bottom', 'options');
	}

	$variables = "<style>
		:root {
			--radius: {$br_medium_mobile}px;
			--radius-small: {$br_small_mobile}px;
			--radius-large: {$br_large_mobile}px;
			--radius-img-large: {$br_image_outside_corner_mobile}px;
			--radius-btn: {$btn_left_top}px|{$btn_right_top}px|{$btn_right_bottom}px|{$btn_left_bottom}px;
		}
		@media (min-width: 992px) {
			:root {
				--radius: {$br_medium}px;
				--radius-small: {$br_small}px;
				--radius-large: {$br_large}px;
				--radius-img-large: {$br_image_outside_corner}px;
			}
		}
	</style>";

	$variables = preg_replace("/\s+/", "", $variables);
	$variables = str_replace("|", " ", $variables);
	echo $variables;
};