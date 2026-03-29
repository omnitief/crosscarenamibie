<?php
$class = $args['class'] ?? '';
$button = $args['button'] ?? false;
$id = $args['id'] ?? '';
$title = $args['title'];
$posts = $args['posts'];
$subtitle = $args['subtitle'] ?? false;
$show_divider = $args['show_divider'] ?? false;
$space = $args['space'] ?? '';
?>

<section <?= $id; ?> class="blog pr <?= $class; ?>">
	<?php 
	if ($show_divider) {	
		divider(); 
	}
	?>
	<div class="<?= $space; ?>">
		<div class="container">
			<?php 
			if ($button || $title) {
				?>
				<div class="heading m-b--small">
					<?php 
					if ($subtitle) {
						echo $subtitle;
					}
					?>
					<div class="f fw f-c f--sb gap-small">
						<?php 
						if ($title) {
							echo "<h2 class=\"m-b--none\">{$title}</h2>";
						}

						get_template_part('components/button/wrapper', '', [
							'button' => $button,
							'button_class'	=> 'dn md-f'
						]);
						?>
					</div>
				</div>
				<?php
			}
			?>
			<div class="row gap-row">
				<?php
				if ($posts) {
					foreach ( $posts as $id ) {
						get_template_part('components/posts/card', '', [
							'id' 		=> $id,
							'class' => 'col-12 col-sm-6 col-lg-4'
						]);
					}
				} else {
					_e('Geen berichten gevonden', 'swift');
				}
				?>
			</div>
			<?php 
			if (!empty($button['link'])) {
				?>
				<div class="md-dn m-t--medium">
					<?php 
					get_template_part('components/button/wrapper', '', [
						'button' => $button
					]);
					?>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</section>