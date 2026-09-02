<?php
if ( custom_acf_is_backend_block_preview() ) {
	return;
}

$button = get_field('button');
get_template_part('components/button/wrapper', '', [
	'button' 				=> $button,
	'button_class'	=> 'mt-1'
]);