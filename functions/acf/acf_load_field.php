<?php

/**
 * Load Gravity forms in select field
 */
add_filter('acf/load_field/name=form_select', 'acf_load_forms');
function acf_load_forms( $field ) {
	$field['choices'] = [];
	$forms = GFAPI::get_forms();

	if ($forms) {
		foreach ( $forms as $form ) {
			$value = $form['id'];
			$label = $form['title'];
			$field['choices'][ $value ] = $label;
		}
	}

	return $field;
}

/**
 * Load logos in select field
 */
add_filter('acf/load_field/name=logos_select', 'acf_load_logos');
function acf_load_logos( $field ) {
	$field['choices'] = [];
	$logos = get_field('logos', 'options');

	if ($logos) {
		foreach ( $logos as $key => $logo ) {
			$label = $logo['company_name'];
			$field['choices'][ $key ] = $label;
		}
	}

	return $field;
}

/**
 * Load team members in select field
 */
add_filter('acf/load_field/name=team_members_select', 'acf_load_team');
function acf_load_team( $field ) {
	$field['choices'] = [];
	$team_members = get_field('team_members', 'options');

	if ($team_members)  {
		foreach ( $team_members as $key => $team_member ) {
			$label = $team_member['name'];
			$field['choices'][ $key ] = $label;
		}
	}

	return $field;
}

/**
 * Load reviews in select field
 */
add_filter('acf/load_field/name=reviews_select', 'acf_load_reviews');
function acf_load_reviews( $field ) {
	$field['choices'] = [];
	$reviews = get_field('reviews', 'options');

	if ($reviews) {
		foreach ( $reviews as $key => $review ) {
			$label = $review['name'];
			$field['choices'][ $key ] = $label;
		}
	}

	return $field;
}
