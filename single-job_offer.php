<?php 
get_header();
?>

<section class="bg-body pr">
	<?php divider(); ?>
	<div class="container container--small p-t--large p-b--large text">
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