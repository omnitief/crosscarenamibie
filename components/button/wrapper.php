<?php
$button = $args['button'] ?? false;

if ($button) {
	$button = $button['button'] ?? $button;
	$link = $button['link'];
	$style = $button['style'];
	$button_class = $args['button_class'] ?? '';

	if ($link) {
		get_template_part('components/button/button', '', [
			'button'	=> $link,
			'style'		=> $style,
			'class'		=> $button_class
		]);
	}
}