<?php 
$text = $args['text'] ?? false;
$class = $args['class'] ?? 'false';
$full_id = $args['full_id'] ?? '';
$team_members = $args['team_members'] ?? false;

$container_class = $args['container_class'];
$row_class = $args['row_class'];
$column_class = $args['column_class'];
?>

<section <?= $full_id; ?> class="slider slider--team pr ohd <?= $class; ?>">
	<div class="pr ohd">
		<div class="container <?= $container_class; ?>">
			<div class="row gap-row <?= $row_class; ?>">
				<?php
				if ($team_members) {
					foreach ($team_members as $team_member) {
						echo "<div class='{$column_class}'>";
						get_template_part('components/team/card', '', [
							'team_member' => $team_member
						]);
						echo "</div>";
					}
				}
				?>
			</div>
		</div>
	</div>
</section>