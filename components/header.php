<?php 
if (is_home()) {
	$post_id = get_option('page_for_posts');
} else {
	$post_id = get_the_id();
}

$acf_header = get_field('header', $post_id);
$header = (is_array($acf_header) && isset($acf_header[0])) ? $acf_header[0] : [];

if (!empty($header)) {
	$header_type = get_field('header_type', 'options');
	$title = empty($header['title']) ? get_the_title($post_id) : $header['title'];
	$text = $header['text'] ?? false;
	$buttons = $header['buttons'] ?? false;
	$video = $header['video'] ?? false;
	$hide_image = $header['hide_image'] ?? false;
	$header_overlap = $header['header_overlap'] ?? false;
	$show_contact_data = $header['show_contact_data'] ?? false;
	$header_image_pane_image = get_field('header_image_pane_image', 'options');
	$header_pane_image = get_field('header_pane_image', 'options');
	$container_class = '';
	$header_class = '';
	$default_template = $args['default_template'] ?? false;

	if ($hide_image) {
		$container_class = 'container--small';
		$header_class = 'header--small';
		if (is_page_template('text.php')) $header_class .= ' template-text';
		if ($header_overlap) $header_class .= ' header--overlap';
	} else {
		$header_class = "header--large {$header_type}";
		$overlay_transparency = '1';
		$image_id = get_post_image_id($post_id);
		$image_wrapper_class = '';
		$fullscreen_image = false;

		if ($header_type === 'image_overflow') {
			$fullscreen_image = $header['image_fullscreen'] ?? false;
			$overlay_transparency = $header['overlay_transparency'] ?? "1";
			$image_class = '';

			if ($fullscreen_image) {
				$header_class .= ' header--fullscreen';
				$image_wrapper_class = 'pa cover fullscreen';
			} else {
				$image_wrapper_class = 'pr ohd boxed';
			}
		} else {
			$image_wrapper_class = 'pr m-t--large';
			$image_class = 'r-img-tl';
		}

		if (is_page_template('text.php')) {
			$header_class = "header--small {$header_type}";
		}
	}

	if ($default_template) {
		$hide_image = true;
		$container_class = $args['container_class'];
		$header_class = 'header--small header--overlap';
	}

} elseif (is_singular('post')) {
	$header_type = get_field('header_type', 'options');
	$title = get_the_title();
	$text = '';
	$buttons = [];
	$video = '';
	$hide_image = false;
	$header_overlap = false;
	$show_contact_data = false;
	$image_id = get_post_thumbnail_id($post_id);
	$header_image_pane_image = null;
	$header_pane_image = null;
	$fullscreen_image = false;
	$overlay_transparency = '1';
		if ($header_type === 'image_overflow') {
			$image_wrapper_class = 'pr ohd boxed';
			$image_class = '';
		} else {
			$image_wrapper_class = 'pr m-t--large';
			$image_class = 'r-img-tl';
		}
	$container_class = '';
	$header_class = "header--small {$header_type}";
} else {
	return;
}
?>

<header class="header pr bg-dark <?= $header_class; ?>">
	<div class="container <?= $container_class; ?>">
		<div class="header__text text z10 pr">
			<?php 
			if (function_exists('rank_math_the_breadcrumbs') && !is_front_page()) {
				rank_math_the_breadcrumbs();
			}

			echo "<h1>{$title}</h1>";

			if (is_singular('post')) {
				$text_date_before = get_field('text_date', 'options');
				$date = get_the_date('d F Y');
				$categories = get_the_terms(get_the_id(), 'category');
				
				echo "<p class='m-b--xxsmall fw-5'>{$text_date_before} {$date}</p>";

				if ($categories) {
					$page_for_posts = get_permalink(get_option('page_for_posts'));
					echo "<div class='f f-c gap-xsmall m-t--xxsmall'>";
					foreach ($categories as $category) {
						get_template_part('components/label', '', [
							'title' => $category->name,
							'class' => 'large',
							'url' 	=> "{$page_for_posts}?category={$category->slug}",
						]);
					}
					echo "</div>";
				}
			}

			if ($text) {
				echo "<div>{$text}</div>";
			}

			if ($show_contact_data) {
				$contact_data_class = $text ? 'm-t--xsmall' : '';
				get_template_part('components/contact_data', '', [
					'kvk' 	=> false,
					'btw' 	=> false,
					'class'	=> 'f fw gap-medium ' . $contact_data_class,
				]);
			}

			if (is_singular('job_offer')) {
				$location = get_field('location', $post_id);
				$hours_pw = get_field('hours_pw', $post_id);
				if ($hours_pw || $location) {
					echo "<div class='info f fw gap-xsmall m-t--xxsmall'>";
					if ($location) {
						echo "<span><b>" . get_field('location_text', 'options') . ":</b> {$location}</span>";
						if ($hours_pw) echo "<span>|</span>";
					}
					if ($hours_pw) {
						echo "<span><b>" . get_field('hours_text', 'options') . ":</b> {$hours_pw}</span>";
					}
					echo "</div>";
				}
			}

			if( $buttons ) {
				echo '<div class="buttons-wrapper f fw f-c gap-small m-t--xsmall">';
				foreach( $buttons as $button ) {
					$button = $button['button'];
					$link = $button['link'];
					$style = $button['style'];
	
					if ($link && $style !== 'link') {
						get_template_part('components/button/button', '', [
							'button'	=> $link,
							'style'		=> $style,
							'class'		=> 'm-t--none '
						]);
					} elseif ($link) {
						get_template_part('components/button/button', '', [
							'button'	=> $link,
							'type'		=> 'link',
							'class'		=> 'm-t--none fw-7 ff-primary pr'
						]);
					}
				}
				echo '</div>';
			}
			?>
		</div>
		<?php 
		if (is_home()) {
			$selected_category = $_GET['category'] ?? false;
			$categories = get_categories([
				'order'       => 'DESC',
				'hide_empty'  => true,
				'taxonomy'    => 'category',
			]);
			?>
			<div id="filter-input" class="select pr ohd text-small btn style-secondary">
				<select id="filter-category" class="ff-primary cl-white fw-7 text-small" data-type="category">
					<option value="" <?= $selected_category == '' ? 'selected' : ''; ?>><?php _e('Filter op categorie', 'swift'); ?></option>
					<?php 
					foreach ($categories as $category) {
						echo "<option value='{$category->slug}' " . selected($selected_category, $category->slug, false) . ">{$category->name}</option>";
					}
					?>
				</select>
				<span class="btn-icon r-50 pa ohd bg-text f hover-disabled">
					<i class="icon icon-filter pa pa-center"></i>
					<i class="icon icon-filter pa pa-center"></i>
				</span>
			</div>
			<?php
		}
		?>
	</div>

	<?php
	if (!$hide_image && $image_id) {
		echo "<div class='header__image {$image_wrapper_class}'>";

		if ($video) {
			echo wp_get_attachment_image($image_id, 'large', false, [
				'class' => "pa cover {$image_class}",
			]);
			echo "<video class='pa cover' autoplay muted loop playsinline poster='' disablepictureinpicture>";
			echo "<source src='" . esc_url($video) . "' type='video/mp4'>";
			echo "</video>";

			if ($fullscreen_image) {
				echo "<div class='overlay bg-dark pa cover z9 bg-dark--skip' style='opacity:{$overlay_transparency}'></div>";
			}
		} else {
			echo wp_get_attachment_image($image_id, 'large', false, [
				'class' => "pa cover {$image_class}",
			]);
			if ($fullscreen_image) {
				echo "<div class='overlay bg-dark pa cover z9 bg-dark--skip' style='opacity:{$overlay_transparency}'></div>";
			}
			get_template_part('components/pane_image', '', [
				'group_data' => $header_image_pane_image
			]);
		}

		echo "</div>";
	} else {
		get_template_part('components/pane_image', '', [
			'group_data' => $header_pane_image
		]);
	}
	?>
</header>