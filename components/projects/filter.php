<?php
$class = $args['class'] ?? '';
$button = $args['button'] ?? false;
$id = $args['id'] ?? '';
$title = $args['title'] ?? false;
$projects = $args['projects'];
$container_class = $args['container_class'] ?? '';
$row_class = $args['row_class'] ?? 'gap-row-medium';
$column_class = $args['column_class'] ?? 'col-12 col-sm-6 col-lg-4';
$block_divider_type = get_field('block_divider_type', 'options');

global $filter_post_type;
$selected_page = $_GET['is_page'] ?? false;

$args = [
	'post_type' => 'project',
	'order' 		=> 'DESC',
	'paged'			=> max( $selected_page, 1 )
];

$filter_projects = new WP_Query($args);
?>

<section id="filter" class="pr p-b--large bg-body ohd" data-post-type="project" data-card="/projects/card">
	<?php 
	if ($block_divider_type === 'wave') {
		?>
		<svg class='divider z9' viewBox='0 0 1920 75.713'><path d='M1920,0S1432.253-78.1,958.659,0,0,0,0,0V41H1920Z' transform='translate(0 34.713)' fill='#111838'/></svg>
		<?php
	}
	?>
	<div class="container <?= $container_class; ?>">
		<div id="filter-results" class="row <?= $row_class; ?>"> 
			<?php 
			if ( ! $filter_projects->have_posts() ) {
				?>
				<div class="col-12">
					<p><?php _e('Er kunnen geen projecten gevonden worden.', 'swift'); ?></p>
				</div>
				<?php
			} else {
				while ($filter_projects->have_posts()) : 
					$filter_projects->the_post();
					$id = get_the_id();

					get_template_part('components/projects/card', '', [
						'id' 						=> $id,
						'column_class' 	=> $column_class
					]);
				endwhile;
				
				$pages = intval($filter_post_type->calculate_pages( $filter_projects ));
				echo get_template_part('components/pagination', '', [
					'pages' => $pages,
				]);
			}
			wp_reset_postdata();
			?>
		</div>
	</div>
</section>