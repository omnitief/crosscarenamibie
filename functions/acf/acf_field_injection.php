<?php
add_filter('acf/load_field/name=header', 'header_load_extra_fields');
function header_load_extra_fields($field) {
	$header_type = get_field('header_type', 'options');

	if ($header_type === 'image_overflow') {
		if (!isset($field['sub_fields']) || !is_array($field['sub_fields'])) {
			$field['sub_fields'] = [];
		}
		
		$existing_keys = array_column($field['sub_fields'], 'name');
		
		if (!in_array('image_fullscreen', $existing_keys)) {
			$field['sub_fields'][] = [
				"ID" => "field_id_image_fullscreen",
				"key" => "field_image_fullscreen",
				"label" => 'Afbeelding fullscreen',
				"name" => 'image_fullscreen',
				"_name" => 'image_fullscreen',
				"type" => 'true_false',
				"ui" => 1,
				"wrapper" => [
					"width" => "",
					"class" => "",
					"id" => "",
				],
			];
		}

		if (!in_array('overlay_transparency', $existing_keys)) {
			$field['sub_fields'][] = [
				"ID" => "field_id_overlay_transparency",
				"key" => "field_overlay_transparency",
				"label" => 'Overlay doorzichtigheid',
				"name" => 'overlay_transparency',
				"_name" => 'overlay_transparency',
				"type" => 'range',
				"conditional_logic" => [[
					"field" => "field_image_fullscreen",
					"operator" => "==",
					"value" => "1"
				]],
				"min" => 0,
				"max" => 1,
				"step" => "0.1",
				"default_value" => "1",
				"instructions" => "0 is volledig doorzichtig.",
				"wrapper" => [
					"width" => "",
					"class" => "",
					"id" => "",
				],
			];
		}
	}

	return $field;
}

add_filter('acf/prepare_field/name=cta_hide_divider', 'hide_divider_prepare_field');
add_filter('acf/prepare_field/name=hide_divider', 'hide_divider_prepare_field');
function hide_divider_prepare_field( $field ) {
	$block_divider_type = get_field('block_divider_type', 'options') ?? "none";
	
	if ($block_divider_type === 'rounded_corners' || $block_divider_type === 'none') {
		$field['wrapper']['class'] = "dn";
	}

	return $field;
}
