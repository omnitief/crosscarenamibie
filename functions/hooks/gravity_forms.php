<?php
add_filter( 'gform_submit_button', 'submit_change_html', 10, 2 );
function submit_change_html( $button, $form ) {
	$dom = new DOMDocument();
	$dom->loadHTML( '<?xml encoding="utf-8" ?>' . $button );
	$input = $dom->getElementsByTagName( 'input' )->item(0);
	$button_text = $input->getAttribute( 'value' );
	return '<button id="gform_submit_button_' . $form["id"] . '" type="submit" class="btn btn--primary style-primary ohd pr dif f-c fw-7" aria-label="' .$button_text . '" aanpak">' .$button_text . '<span class="btn-icon r-50 pr ohd pa hover-disabled bg-based"><i class="icon icon-arrow pa pa-center"></i><i class="icon icon-arrow pa pa-center"></i></span><span class="btn-icon r-50 pr ohd pa hover-disabled bg-based"><i class="icon icon-arrow pa pa-center"></i><i class="icon icon-arrow pa pa-center"></i></span></button>';
}

add_filter( 'gform_validation_message', 'change_message', 10, 2 );
function change_message( $message, $form ) {
	return "<div class='validation_error'>" . __('U heeft niet alle velden correct ingevoerd.', 'swift') . "</div>";
}

/* make gravity forms available to Editor role */
function add_gf_cap()
{
    $role = get_role( 'editor' );
    $role->add_cap( 'gform_full_access' );
}
 add_action( 'admin_init', 'add_gf_cap' );
