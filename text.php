<?php 
/**
 * Template Name: Simpele tekstpagina
 */

get_header();
?>

<section class="p-t--large p-b--large bg-body pr">
	<div class="container container--small text">
		<?php
		if (have_posts()) :
			while (have_posts()) : the_post();
				the_content();
			endwhile;
		endif;
		?>
	</div>
</section>

<?php
get_footer('', [
	'cta_background_color' => 'bg-light'
]);