<?php
function get_spacing_class ( $space, $type = 'p' ) {
	$space = $space['space'] ?? $space;
	$spacing_class = "{$type}-t--{$space['top']} {$type}-b--{$space['bottom']}";

	return $spacing_class;
}

function get_color_classes( $background ) {
	$background = $background['background_color'] ?? $background;

	if ($background) {
		$colors = "bg-{$background}";
	} else {
		$colors = "bg-body";
	}

	return $colors;
}

function get_aria_label( $title ) {
	$navigate_default_string = __('Navigeer naar', 'swift');
	$data = "aria-label='{$navigate_default_string} {$title}'";

	return $data;
}

function get_post_ids( $posttype, $posts_per_page = -1 ) {
	$query = new WP_Query([
		'post_type'				=> $posttype,
		'orderby'         => 'ASC',
		'posts_per_page'  => $posts_per_page,
		'fields' 					=> 'ids',
	]);

	if ( $query->have_posts() ) {
		return $query;
	} else {
		return false;
	}
}

function get_post_image_id( $post_id ) {
	[$header] = get_field('header', $post_id);
	$image_id = false;

	if ($header) {
		$image_id = $header['image_id'];
	}

	if (!$image_id) {
		$image_id = get_post_thumbnail_id($post_id);
	}

	return $image_id;
}

function get_full_id( $id ) {
	$id = $id ?? '';

	if ( $id ) {
		$id = "id='{$id}'";
	}

	return $id;
}

function rearrange_array($old_array, $new_order_array) {
	$newArray = array_map(function($index) use ($old_array) {
		return $old_array[$index] ?? null;
	}, $new_order_array);

	return $newArray;
}

function truncate($string, $length = 150, $append = "&hellip;") {
  $string = trim($string);

  if (strlen($string) > $length) {
    $string = wordwrap($string, $length);
    $string = explode("\n", $string, 2);
		$translated_string = __('Lees meer', 'swift');
    $string = "{$string[0]}<span class='dots'>...</span><span class='read-more dn'> {$string[1]}</span>&nbsp;&nbsp;<button class='btn-read-more pr fw-6'>{$translated_string}</button>";
  }

  return $string;
}

function get_subtitle_el($title) {
	if ($title) {
		$title = "<p class='subtitle ccn-yellow ff-primary opacity-80 fw-6'>{$title}</p>";
	}

	return $title;
}

function get_block_divider_type() {
	$block_divider_type = get_field('block_divider_type', 'options') ?? "none";
	return $block_divider_type;
}

function get_extra_body_class() {
	$block_divider_type = get_field('block_divider_type', 'options') ?? "none";
	$body_class = "";

	if ($block_divider_type === 'rounded_corners') {
		$body_class = "dv-radius";
	} else if ($block_divider_type === 'wave') {
		$body_class = "dv-wave";
	} else if ($block_divider_type === 'obliquely') {
		$body_class = "dv-obliquely";
	} else {
		$body_class = "dv-none";
	}

	return $body_class;
}

function show_divider($hide_divider_field) {
	$block_divider_type = get_field('block_divider_type', 'options');

	$show_divider_value = [
		'show' => true,
		'type' => $block_divider_type,
	];

	if ($block_divider_type === 'wave' || $block_divider_type === 'obliquely') {
		$hide_divider = get_field($hide_divider_field);

		if ($hide_divider) {
			$show_divider_value['show'] = false;
		} 
	} else {
		$show_divider_value['show'] = false;
	}

	return $show_divider_value;
}

function divider($hide_divider_field = 'hide_divider') {
	$show_divider = show_divider($hide_divider_field);

	if ($show_divider['show']) {
		if ($show_divider['type'] === 'obliquely') {
			echo "<div class='divider pr ohd'></div>";
		} else {
			echo "<svg class='divider z9 ' viewBox='0 0 1920 75.713'><path d='M1920,0S1432.253-78.1,958.659,0,0,0,0,0V41H1920Z' transform='translate(0 34.713)' fill='#0E316B'/></svg>";
		}
	}
}

add_filter('duplicate_post_meta_keys_filter', function ($meta_keys) {
    $original_post_id = isset($_GET['post']) ? (int) $_GET['post'] : 0;
    $original_meta = get_post_meta($original_post_id);

    return array_filter($meta_keys, function($key) use ($original_meta) {
        if (!str_starts_with($key, '_')) {
            return true;
        }

        if (isset($original_meta[$key]) && is_string($original_meta[$key][0])) {
            if (preg_match('/^field_[a-z0-9]{5,}$/', $original_meta[$key][0])) {
                return false;
            }
        }

        return true;
    });
});