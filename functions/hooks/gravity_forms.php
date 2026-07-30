<?php
add_filter( 'gform_submit_button', 'submit_change_html', 10, 2 );
function submit_change_html( $button, $form ) {
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

	$form_id = isset( $form['id'] ) ? absint( $form['id'] ) : 0;

	if ( preg_match( '/<button\b([^>]*)>(.*?)<\/button>/is', $button, $matches ) ) {
		$attributes = $matches[1];
		$icon_markup = '<span class="btn-icon r-50 pr ohd pa hover-disabled bg-based"><i class="icon icon-arrow pa pa-center"></i><i class="icon icon-arrow pa pa-center"></i></span><span class="btn-icon r-50 pr ohd pa hover-disabled bg-based"><i class="icon icon-arrow pa pa-center"></i><i class="icon icon-arrow pa pa-center"></i></span>';

		$attributes = preg_replace( '/\sclass=(["\']).*?\1/i', '', $attributes );
		$attributes = preg_replace( '/\saria-label=(["\']).*?\1/i', '', $attributes );

		return '<button' . $attributes . ' class="btn btn--primary style-primary ohd pr dif f-c fw-7" aria-label="' . esc_attr( $button_text ) . '">' . esc_html( $button_text ) . $icon_markup . '</button>';
	}

	if ( preg_match( '/<input\b([^>]*)>/is', $button, $matches ) ) {
		$attributes = $matches[1];
		$attributes = preg_replace( '/\sclass=(["\']).*?\1/i', '', $attributes );
		$attributes = preg_replace( '/\svalue=(["\']).*?\1/i', '', $attributes );

		return '<button' . $attributes . ' class="btn btn--primary style-primary ohd pr dif f-c fw-7" type="submit" aria-label="' . esc_attr( $button_text ) . '">' . esc_html( $button_text ) . '<span class="btn-icon r-50 pr ohd pa hover-disabled bg-based"><i class="icon icon-arrow pa pa-center"></i><i class="icon icon-arrow pa pa-center"></i></span><span class="btn-icon r-50 pr ohd pa hover-disabled bg-based"><i class="icon icon-arrow pa pa-center"></i><i class="icon icon-arrow pa pa-center"></i></span></button>';
	}

	return $button;
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
