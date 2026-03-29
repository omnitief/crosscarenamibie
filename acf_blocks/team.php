<?php 
$space = get_spacing_class(get_field('space'));
$background_color = get_color_classes(get_field('background_color'));
$full_id = get_full_id(get_field('id'));
$text = get_field('text');
$button = get_field('button');
$team_members_select = get_field('team_members_select');
$team_members = get_field('team_members', 'options');

if ($team_members_select) {
	$team_members = rearrange_array($team_members, $team_members_select);
}

get_template_part('components/team/slider', '', [
	'team_members'	=> $team_members,
	'text'					=> $text,
	'button'				=> $button,
	'class'					=> $background_color,
	'space'					=> $space,
	'id'						=> $full_id
]);