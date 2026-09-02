<?php
if ( custom_acf_is_backend_block_preview() ) {
	return;
}

$space           = get_spacing_class( get_field('space') );
$background_color= get_color_classes( get_field('background_color') );
$title           = get_field('title');
$button          = get_field('button');
$projects        = get_field('projects');
$full_id         = get_full_id( get_field('id') );
$pane_image      = get_field('pane_image');
$subtitle        = get_subtitle_el( get_field('subtitle') );

if (empty($projects)) {
  $q = new WP_Query([
    'post_type'      => 'project',
    'posts_per_page' => 3,
    'post_status'    => 'publish',
    'no_found_rows'  => true,
  ]);
  $projects = $q->posts;
}

get_template_part('components/projects/section', '', [
  'projects'     => $projects,
  'title'        => $title,
  'button'       => $button,
  'class'        => "{$background_color}",
  'space'        => "{$space}",
  'id'           => $full_id,
  'pane_image'   => $pane_image,
  'subtitle'     => $subtitle,
  'show_divider' => true,
]);