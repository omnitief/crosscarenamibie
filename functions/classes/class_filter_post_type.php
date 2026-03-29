<?php
class Filter_Post_Type {
	private $posts_per_page;

	function __construct() {
		$this->posts_per_page = get_option('posts_per_page');
	}

	public function calculate_pages( $post_loop ) {
		/**
		 * $post_loop is the WP_Query
		 * $pages is the number of pages
		 */

		$post_amount = $post_loop->found_posts;
		$post_per_page = $this->posts_per_page;
		$pages = ceil($post_amount / $post_per_page);

		return $pages;
	}
	
	public function pagination($post_loop, $current_page = 0) {
		$pages = intval($this->calculate_pages($post_loop));

		ob_start();
		get_template_part('components/pagination', '', array(
				'pages' => $pages,
				'current_page' => $current_page
		));
		$pagination = ob_get_clean();

		return $pagination;
	}

	public function get_posts() {
		$filter_object = stripslashes($_POST['filter_object']);
		$data = json_decode($filter_object);
		$is_page = isset($data->is_page) ? sanitize_text_field(intval($data->is_page)) : 1;
		$component = sanitize_text_field($data->component);
		$post_type = sanitize_text_field($data->post_type);
		$category = isset($data->category->selected) ? sanitize_text_field($data->category->selected) : '';
		$taxonomy = isset($data->category->taxonomy) ? sanitize_text_field($data->category->taxonomy) : '';

		if ( $is_page !== 1 && $is_page != false ) {
			$post_offset = ($is_page - 1) * $this->posts_per_page;
		} else {
			$post_offset = 0;
		}

		$args = [
			'post_type'       => $post_type,
			'post_status'     => 'publish',
			'posts_per_page'	=> $this->posts_per_page,
			'order'           => 'DESC',
			'offset'          => $post_offset,
		];

		if ( $category !== 'all' && $category !== '' && $taxonomy !== '' ) {
			$args['tax_query'] = [[
				'taxonomy' => $taxonomy,
				'field'    => 'slug',
				'terms'    => $category
			]];
		}

		$filter_posts = new WP_Query($args);
		$number_of_posts = $filter_posts->found_posts;

		$response = [
			'html'          	=> [],
			'pagination'    	=> '',
		];

		if ($post_type === 'project') {
			$columns = get_field('columns_projects', 'options');
		} else {
			$columns = get_field('columns_posts', 'options');
		}
		
		if ($columns === 'two') {
			$column_class = 'col-12 col-md-6';
		} else if ($columns === 'three') {
			$column_class = 'col-12 col-sm-6 col-lg-4';
		}

		if ($filter_posts->have_posts()) {
			while ($filter_posts->have_posts()) :
				$filter_posts->the_post();
				$id = get_the_id();
				
				$pages = $this->pagination($filter_posts, $is_page);
				$response['pagination'] = $pages;
				
				ob_start();
				get_template_part('components/' . $component, '', [
					'id'						=> $id,
					'lazyload' 			=> false,
					'class' 				=> $column_class,
					'column_class' 	=> $column_class
				]);
				$response['html'][] = ob_get_clean();
			endwhile;
		} else {
			ob_start();
			echo '<p class="col-12 cl--white">' . __("Er kunnen geen berichten gevonden worden.", "ch") . '</p>';
			$response['html'][] = ob_get_clean();
		}

		echo json_encode( $response );

		if ( wp_doing_ajax() ) {
			wp_die();
		}
	}
}
