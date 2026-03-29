<?php
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
function custom_excerpt_length( $length ) {
	return 40;
}

add_filter( 'excerpt_more', 'custom_excerpt_more', 999 );
function custom_excerpt_more( $more ) {
	if ( is_admin() ) {
		return $more;
	}
	return '...';
}