<?php 
$button = get_field('nav_button', 'options');
$logo_id = get_field('logo', 'options');
$header_type = get_field('header_type', 'options');
$nav_type = get_field('nav_type', 'options');
$nav_class = '';

if ($header_type === 'image_overflow' && $nav_type !== 'white') {
	$nav_class = 'nav--border';
} elseif($nav_type === 'white') {
	$nav_class = 'nav--white';
}

if($nav_type === 'white') {
	$button_style = 'primary';
} else {
	$button_style = 'secondary';
}

?>

<nav class="nav pf f f-c z999 <?= $nav_class; ?>">
	<div class="container f f-c f--sb">
		<a href="<?= esc_url(home_url('/')); ?>" aria-label="<?php _e('Navigeer naar de homepagina', 'swift'); ?>" class="z999 if">
			<?= wp_get_attachment_image($logo_id, 'full', '',['class' => 'nav__brand', 'alt' => get_bloginfo('name')]) ?>
		</a>

		<div class="nav__menu">
			<ul class="nav__menu__items list--disable f">
				<?php 
				if (has_nav_menu('nav')) {
					wp_nav_menu([
						'container' => false, 
						'items_wrap' => '%3$s', 
						'theme_location' => 'nav', 
						'depth' => 2, 
						'walker' => new Submenu_Add_Icon()
					]); 
				}

				if ($button) {
					echo get_template_part('components/button/button', '', [
						'button' => $button,
						'style'	=> $button_style
					]);
				}
				?>
			</ul>

			<button id="toggle-menu" class="btn btn--toggle nav__toggle pr fw-7 z9 bg-body r f f-c f--sb ff-primary cl-dark xl-dn" aria-label="<?php _e('Open het mobiele menu', 'swift'); ?>">
				<span data-toggle-title="<?php _e('Sluiten', 'swift'); ?>"><?php _e('Menu', 'swift'); ?></span>
				<span class="btn__icon pr">
					<span class="bg-dark bg-dark--skip"></span>
					<span class="bg-dark bg-dark--skip"></span>
					<span class="bg-dark bg-dark--skip"></span>
				</span>
			</button>
		</div>

	</div>
</nav>