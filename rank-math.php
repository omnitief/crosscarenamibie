<?php 
/**
 * Filter to remove the plugin credit notice added to the source.
 *
 */
add_filter( 'rank_math/frontend/remove_credit_notice', '__return_true' );

/**
 * Filter to change breadcrumb args.
 *
 * @param  array $args Breadcrumb args.
 * @return array $args.
 */
add_filter( 'rank_math/frontend/breadcrumb/args', function( $args ) {
	$args['wrap_before'] = '<nav class="breadcrumbs ff-secondary fw-6 text-small opacity-80"><p>';
	$args['wrap_after']  = '</p></nav>';
	$args['before']      = '';
	$args['after']       = '';

	// De bestaande 'separator' behouden uit Rank Math-instellingen
	return $args;
});

/**
 * Filter to shorten the post title of Rank Math Breadcrumbs.
 */
add_filter( 'rank_math/frontend/breadcrumb/items', function( $crumbs, $class ) {
    if( is_home() ) {
        $title = get_the_title( get_option('page_for_posts', true) );
    } else {
        $title = get_the_title();
    }
    $max_char_limit = 45;
    
    if(strlen($title) > $max_char_limit){
        $RM_truncate_breadcrumb_title = substr($title, 0, $max_char_limit).'...';
        array_splice($crumbs, count($crumbs) - 1, 1);   
        $crumbs[][0] = $RM_truncate_breadcrumb_title; 
    }   
    return $crumbs;
}, 10, 2);

/**
 * Filter to add archive links to Rank Math Breadcrumbs for custom post types.
 */
add_filter( 'rank_math/frontend/breadcrumb/items', function( $crumbs, $class ) {

    if ( is_singular('project') ) {
        $cases_archive = get_field('cases_archive', 'options');
        if ( $cases_archive ) {
            $title = get_the_title($cases_archive);
            $permalink = get_permalink($cases_archive);
            $archive_crumb = [$title, $permalink];
            array_splice( $crumbs, 1, 0, array($archive_crumb) );
        }
    }

    if ( is_singular('job_offer') ) {
        $vacatures_archive = get_field('vacatures_archive', 'options');
        if ( $vacatures_archive ) {
            $title = get_the_title($vacatures_archive);
            $permalink = get_permalink($vacatures_archive);
            $archive_crumb = [$title, $permalink];
            array_splice( $crumbs, 1, 0, array($archive_crumb) );
        }
    }

    return $crumbs;
}, 10, 2);