<?php 
$title = get_the_title( get_option('page_for_posts', true) );
$row_class = $args['row_class'];
$container_class = $args['container_class'];
$columns_class = $args['columns_class'];

global $filter_post_type;
$selected_page = $_GET['is_page'] ?? false;
$selected_category = $_GET['category'] ?? false;

$args = [
	'post_type' => 'post',
	'order' 		=> 'DESC',
	'paged'			=> max( $selected_page, 1 )
];

if ( $selected_category !== 'all' && $selected_category !== '' && $selected_category ) {
	$args['tax_query'] = [[
		'field'    => 'slug',
		'terms'    => $selected_category,
		'taxonomy' => 'category'
	]];
}

$filter_posts = new WP_Query($args);

$block_divider_type = get_field('block_divider_type', 'options');
?>

<section id="filter" class="pr p-b--large bg-body ohd" data-post-type="post" data-card="/posts/card">
	<?php 
	if ($block_divider_type === 'wave') {
		?>
		<svg class='divider z9' viewBox='0 0 1920 75.713'><path d='M1920,0S1432.253-78.1,958.659,0,0,0,0,0V41H1920Z' transform='translate(0 34.713)' fill='#0E316B'/></svg>
		<?php
	}
	?>
	<div class="container <?= $container_class; ?>">
		<div id="filter-results" class="row <?= $row_class; ?>"> 
			<?php 
			if ( ! $filter_posts->have_posts() ) {
				?>
				<div class="col-12">
					<p><?php _e('Er kunnen geen berichten gevonden worden.', 'swift'); ?></p>
				</div>
				<?php
			} else {
				while ($filter_posts->have_posts()) : 
					$filter_posts->the_post();
					$id = get_the_id();

					get_template_part('components/posts/card', '', [
						'id' 		=> $id,
						'class' => $columns_class
					]);
				endwhile;
				
				$pages = intval($filter_post_type->calculate_pages( $filter_posts ));
				echo get_template_part('components/pagination', '', [
					'pages' => $pages,
				]);
			}
			wp_reset_postdata();
			?>
		</div>
	</div>
</section>
