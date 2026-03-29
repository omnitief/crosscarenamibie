<?php
$filter_post_type = new Filter_Post_Type();
add_action('wp_ajax_get_posts', array($filter_post_type, 'get_posts'));
add_action('wp_ajax_nopriv_get_posts', array($filter_post_type, 'get_posts'));