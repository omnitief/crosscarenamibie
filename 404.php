<?php 
get_header('', [
	'show_header' => false
]);

$button = get_field('404_button', 'options');
?>

<section class="p-t--medium p-b--medium bg-body">
	<div class="container m-b--none">
		<div class="text text--mw center">
			<?php 
			the_field('404_text', 'options'); 
			
			if ( $button ) {
				get_template_part('components/button/button', '', [
					'button' => $button
				]);
			}
			?>
		</div>
	</div>
</section>

<?php
get_footer('', [
	'cta_background_color' => 'bg-light'
]);