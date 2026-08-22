<?php
add_filter( 'gform_submit_button', 'swift_change_gravity_forms_submit_button_html', 10, 2 );
add_filter( 'gform_next_button', 'swift_change_gravity_forms_next_button_html', 10, 2 );
add_filter( 'gform_previous_button', 'swift_change_gravity_forms_previous_button_html', 10, 2 );

function swift_change_gravity_forms_submit_button_html( $button, $form ) {
	return swift_change_gravity_forms_button_html( $button, $form, 'submit' );
}

function swift_change_gravity_forms_next_button_html( $button, $form ) {
	return swift_change_gravity_forms_button_html( $button, $form, 'next' );
}

function swift_change_gravity_forms_previous_button_html( $button, $form ) {
	return swift_change_gravity_forms_button_html( $button, $form, 'previous' );
}

function swift_change_gravity_forms_button_html( $button, $form, $button_type = 'submit' ) {
	if ( empty( $button ) || ! is_string( $button ) ) {
		return $button;
	}

	$button_text = '';

	if ( preg_match( '/<button\b[^>]*>(.*?)<\/button>/is', $button, $matches ) ) {
		$button_text = trim( wp_strip_all_tags( $matches[1] ) );
	} elseif ( preg_match( '/value=[\"\']([^\"\']+)[\"\']/i', $button, $matches ) ) {
		$button_text = trim( $matches[1] );
	}

	if ( '' === $button_text ) {
		return $button;
	}

	$button_classes = 'btn btn--primary style-primary ohd pr dif f-c fw-7';
	$button_icon = 'submit' === $button_type ? '<span class="btn-icon r-50 pr ohd pa hover-disabled bg-based"><i class="icon icon-arrow pa pa-center"></i><i class="icon icon-arrow pa pa-center"></i></span><span class="btn-icon r-50 pr ohd pa hover-disabled bg-based"><i class="icon icon-arrow pa pa-center"></i><i class="icon icon-arrow pa pa-center"></i></span>' : '';

	if ( preg_match( '/<button\b([^>]*)>(.*?)<\/button>/is', $button, $matches ) ) {
		$attributes = $matches[1];
		$button_class = swift_merge_gf_button_classes( $attributes, $button_classes );
		$attributes = preg_replace( '/\sclass=(["\']).*?\1/i', '', $attributes );
		$attributes = preg_replace( '/\saria-label=(["\']).*?\1/i', '', $attributes );

		return '<button' . $attributes . ' class="' . esc_attr( $button_class ) . '" aria-label="' . esc_attr( $button_text ) . '">' . esc_html( $button_text ) . $button_icon . '</button>';
	}

	if ( preg_match( '/<input\b([^>]*)>/is', $button, $matches ) ) {
		$attributes = $matches[1];
		$button_class = swift_merge_gf_button_classes( $attributes, $button_classes );
		$attributes = preg_replace( '/\sclass=(["\']).*?\1/i', '', $attributes );
		$attributes = preg_replace( '/\svalue=(["\']).*?\1/i', '', $attributes );
		$type = 'submit';

		if ( 'next' === $button_type || 'previous' === $button_type ) {
			$type = 'button';
		}

		return '<button' . $attributes . ' class="' . esc_attr( $button_class ) . '" type="' . esc_attr( $type ) . '" aria-label="' . esc_attr( $button_text ) . '">' . esc_html( $button_text ) . $button_icon . '</button>';
	}

	return $button;
}

function swift_merge_gf_button_classes( $attributes, $button_classes ) {
	$original_classes = '';

	if ( preg_match( '/\sclass=(["\'])(.*?)\1/i', $attributes, $matches ) ) {
		$original_classes = trim( $matches[2] );
	}

	if ( '' === $original_classes ) {
		return $button_classes;
	}

	return trim( $original_classes . ' ' . $button_classes );
}

add_filter( 'gform_validation_message', 'change_message', 10, 2 );
function change_message( $message, $form ) {
	return '<div class="validation_error">' . esc_html__( 'U heeft niet alle velden correct ingevoerd.', 'swift' ) . '</div>';
}

add_filter( 'gform_get_form_filter', 'change_gform_submit_button_in_form', 20, 2 );
function change_gform_submit_button_in_form( $form_string, $form ) {
	if ( empty( $form_string ) || empty( $form['id'] ) ) {
		return $form_string;
	}

	$button_id = 'gform_submit_button_' . absint( $form['id'] );
	if ( ! preg_match( '/<button\b[^>]*id=(["\'])' . preg_quote( $button_id, '/' ) . '\1[^>]*>.*?<\/button>/is', $form_string ) && ! preg_match( '/<input\b[^>]*id=(["\'])' . preg_quote( $button_id, '/' ) . '\1[^>]*>/is', $form_string ) ) {
		return $form_string;
	}

	$button = extract_gf_submit_button_markup( $form_string, $button_id );
	if ( '' === $button ) {
		return $form_string;
	}

	return preg_replace( '/<button\b[^>]*id=(["\'])' . preg_quote( $button_id, '/' ) . '\1[^>]*>.*?<\/button>/is', $button, $form_string, 1 );
}

function extract_gf_submit_button_markup( $form_string, $button_id ) {
	if ( preg_match( '/<button\b[^>]*id=(["\'])' . preg_quote( $button_id, '/' ) . '\1([^>]*)>(.*?)<\/button>/is', $form_string, $matches ) ) {
		$attributes = $matches[2];
		$button_text = trim( wp_strip_all_tags( $matches[3] ) );
		$attributes = preg_replace( '/\sclass=(["\']).*?\1/i', '', $attributes );
		$attributes = preg_replace( '/\saria-label=(["\']).*?\1/i', '', $attributes );
		return '<button id="' . esc_attr( $button_id ) . '"' . $attributes . ' class="btn btn--primary style-primary ohd pr dif f-c fw-7" aria-label="' . esc_attr( $button_text ) . '">' . esc_html( $button_text ) . '<span class="btn-icon r-50 pr ohd pa hover-disabled bg-based"><i class="icon icon-arrow pa pa-center"></i><i class="icon icon-arrow pa pa-center"></i></span><span class="btn-icon r-50 pr ohd pa hover-disabled bg-based"><i class="icon icon-arrow pa pa-center"></i><i class="icon icon-arrow pa pa-center"></i></span></button>';
	}

	if ( preg_match( '/<input\b[^>]*id=(["\'])' . preg_quote( $button_id, '/' ) . '\1([^>]*)>/is', $form_string, $matches ) ) {
		$attributes = $matches[2];
		$button_text = '';
		if ( preg_match( '/value=(["\'])(.*?)\1/i', $matches[0], $value_match ) ) {
			$button_text = trim( $value_match[2] );
		}
		$attributes = preg_replace( '/\sclass=(["\']).*?\1/i', '', $attributes );
		$attributes = preg_replace( '/\svalue=(["\']).*?\1/i', '', $attributes );
		return '<button id="' . esc_attr( $button_id ) . '"' . $attributes . ' class="btn btn--primary style-primary ohd pr dif f-c fw-7" type="submit" aria-label="' . esc_attr( $button_text ) . '">' . esc_html( $button_text ) . '<span class="btn-icon r-50 pr ohd pa hover-disabled bg-based"><i class="icon icon-arrow pa pa-center"></i><i class="icon icon-arrow pa pa-center"></i></span><span class="btn-icon r-50 pr ohd pa hover-disabled bg-based"><i class="icon icon-arrow pa pa-center"></i><i class="icon icon-arrow pa pa-center"></i></span></button>';
	}

	return '';
}

/* make gravity forms available to Editor role */
function add_gf_cap() {
	$role = get_role( 'editor' );

	if ( ! $role ) {
		return;
	}

	$role->add_cap( 'gform_full_access' );
}
add_action( 'admin_init', 'add_gf_cap' );
