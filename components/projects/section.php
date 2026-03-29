<?php
$class = $args['class'] ?? '';
$button = $args['button'] ?? false;
$id = $args['id'] ?? '';
$space = $args['space'] ?? "";
$title = $args['title'] ?? false;
$projects = $args['projects'];
$container_class = $args['container_class'] ?? '';
$row_class = $args['row_class'] ?? 'gap-row';
$column_class = $args['column_class'] ?? 'col-12 col-sm-6 col-lg-4';
$subtitle = $args['subtitle'] ?? false;
$show_divider = $args['show_divider'] ?? false;
?>

<section <?= $id; ?> class="pr projects <?= $class; ?>">
	<?php 
	if ($show_divider) {
		divider();
	}
	?>
	<div class="<?= $space; ?>">
		<div class="container <?= $container_class; ?>">
			<?php 
			if (!empty($button['button']['link']) || $title) {
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
			<div class="row <?= $row_class; ?>">
				<?php
				if ($projects) {
					foreach ( $projects as $id ) {
						echo "<div class='{$column_class}'>";
							get_template_part('components/projects/card', '', [
								'id' => $id
							]);
						echo "</div>";
					}
				} else {
					_e('Geen projecten gevonden', 'swift');
				}
				?>
			</div>
			<?php 
			if (!empty($button['button']['link'])) {
				?>
				<div class="md-dn m-t--medium">
					<?php 
					get_template_part('components/button/wrapper', '', [
						'button' => $button,
					]);
					?>
				</div>
				<?php
			}
			?>
		</div>
	</div>
	<?php 
	$pane_image = $args['pane_image'] ?? false;
	if ($pane_image) {
		get_template_part('components/pane_image', '', [
			'group_data' => $pane_image
		]);
	}
	?>
</section>