<?php 
$text = $args['text'] ?? false;
$class = $args['class'] ?? '';
$space = $args['space'] ?? '';
$full_id = $args['id'] ?? '';
$team_members = $args['team_members'] ?? false;
?>

<section <?= $full_id; ?> class="slider slider--team pr <?= $class; ?>">
	<?php divider() ?>
	<div class="pr ohd <?= $space; ?>">
		<div class="container">
			<div class="row gap-row f--sb">
				<div class="col-12 col-md-4 col-xl-3 slider__text pr z9">
					<?php
					$subtitle = get_subtitle_el(get_field('subtitle'));
					if ($subtitle) {
						echo $subtitle;
					}
					if ( $text ) {
						echo "<div class='text m-b--xsmall'>{$text}</div>";
					}
					?>
					<div class="slider__nav f fw gap-xsmall">
						<?php 
						get_template_part('components/button/icon', '', [
							'tag' 							=> 'button',
							'class'							=> 'prev large',
							'background_color' 	=> 'bg-yellow ',
							'aria_label' 				=> __('Navigeer naar de vorige slide', 'swift')
						]);
						
						get_template_part('components/button/icon', '', [
							'tag' 							=> 'button',
							'class'							=> 'next large',
							'background_color' 	=> 'bg-yellow',
							'aria_label' 				=> __('Navigeer naar de volgende slide', 'swift')
						]);
						?>
					</div>
				</div>
				<div class="col-12 col-md-8 col-xl-8 slider__slider">
					<div class="swiper">
						<div class="swiper-wrapper">
							<?php
							if ($team_members) {
								foreach ($team_members as $team_member) {
									get_template_part('components/team/card', '', [
										'team_member' => $team_member,
										'in_slider'		=> true,
										'class'				=> 'swiper-slide'	
									]);
								}
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>