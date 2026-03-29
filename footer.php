<?php 
$cta_hide = $args['cta_hide'] ?? false;

if (!$cta_hide) {
	$cta_background_color = $args['cta_background_color'] ?? '';
	if (get_field('cta_image')) {
		$cta_image = get_field('cta_image');
	} else {
		$cta_image = get_field('cta_image', 'options');
	}
	if (get_field('cta_text')) {
		$cta_text = get_field('cta_text');
	} else {
		$cta_text = get_field('cta_text', 'options');
	}
	$cta_button = get_field('cta_button', 'options');
	$phone = get_field('phone');
	$phone_url = get_field('phone_url');
	$email = get_field('email');
	$whatsapp = get_field('whatsapp', 'options');

	if (!$phone) {
		$phone = get_field('phone', 'options');
		$phone_url = get_field('phone_url', 'options');
	}

	if (!$phone_url) {
		$phone_url = $phone;
	}

	if (!$email) {
		$email = get_field('email', 'options');
	}
	?>

	<section class="cta pr <?= $cta_background_color; ?>">
		<?php divider('cta_hide_divider'); ?>
		<div class="container  p-t--medium p-b--medium">
			<div class="row">
				<div class="col-12 f f-c fw f--sb gap-row pr z10">
								<div class="cta__left f fw f-c">
				<?php 
				if ($cta_image) {
				?>
					<div class="cta__image pr ohd r-50">
						<?= wp_get_attachment_image($cta_image, 'medium', '', ['class' => 'pa cover']) ?>
					</div>
					<?php 
				}

				if ($cta_text) {
					echo "<div class='cta__text text'>{$cta_text}</div>";
				}
				?>
			</div>
			<div class="cta__right f fw">
				<div class="f f-c fw gap-xsmall">
					<?php 
					if ($phone_url)	{
						?>
						<a href="tel:<?= $phone_url; ?>" aria-label="<?php _e('Bel ons', 'swift'); ?>" class="link-icon-bg bg-dark link-icon-bg--large bg-based r-50 pr f">
							<i class="icon icon-phone pa pa-center"></i>
							<div class="nowrap fw-6 label-hover r50 pa ff-primary bg-accent">
								<i class="icon icon-triangle-menu"></i>
								<?= $phone; ?>
							</div>
						</a>
						<?php
					}

					if ($email) {
						?>
						<a href="mailto:<?= $email; ?>" aria-label="<?php _e('Mail naar ons', 'swift'); ?>" class="link-icon-bg bg-dark link-icon-bg--large bg-based r-50 pr f">
							<i class="icon icon-at pa pa-center"></i>
							<div class="nowrap fw-6 label-hover r50 pa ff-primary bg-accent">
								<i class="icon icon-triangle-menu"></i>
								<?= $email; ?>
							</div>
						</a>
						<?php 
					}

					if ($whatsapp) {
						$whatsapp_number = str_replace([' ', '-', '(', ')'], '', $whatsapp);
						$whatsapp_number = '+31' . substr($whatsapp_number, 1);
						?>
						<a href="https://wa.me/<?= $whatsapp_number; ?>" aria-label="<?php _e('Stuur een WhatsApp', 'swift'); ?>" class="link-icon-bg bg-dark link-icon-bg--large bg-based r-50 f pr" target="_blank" rel="nofollow noopener">
							<i class="icon icon-whatsapp pa pa-center"></i>
							<div class="nowrap fw-6 label-hover r50 pa ff-primary bg-accent">
								<i class="icon icon-triangle-menu"></i>
								<?php _e('Stuur een WhatsApp', 'swift'); ?>
							</div>
						</a>
						<?php
					}
					?>
				</div>
				<?php 
				get_template_part('components/button/wrapper', '', [
					'button' => $cta_button,
				]);
				?>
			</div>
				</div>
			</div>
		</div>
		<?php 
		$pane_image = get_field('pane_image', 'options');
		get_template_part('components/pane_image', '', [
			'group_data' => $pane_image,
			'class_pane' => 'dn xl-f z9',
		]);
		?>
	</section>
	<?php
}
?>

<footer class="footer pr">
	<?php divider(); ?>
	<div class="footer__row pr p-t--large p-b--large">
		<div class="container">
			<div class="row gap-row">
				<div class="col-12 col-sm-6 col-xl-3">
					<?php dynamic_sidebar('footer_column_first'); ?>
				</div>
				<div class="col-12 col-sm-6 col-xl-3">
					<?php dynamic_sidebar('footer_column_second'); ?>
				</div>
				<div class="col-12 col-sm-6 col-xl-3">
					<?php dynamic_sidebar('footer_column_third'); ?>
				</div>
				<div class="col-12 col-sm-6 col-xl-3">
					<?php dynamic_sidebar('footer_column_fourth'); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="footer__row footer__row--last">
		<div class="container f f-c f--sb fw gap-small text-small p-t--xsmall p-b--xsmall">
			<div class="footer__row--last__left f f-c fw gap-small">
				<?php _e('Copyright', 'swift'); ?> &copy; <?php echo date("Y"); ?> <?php echo esc_attr( get_bloginfo( 'name', 'description' ) ); ?>
				<?php
				if (have_rows('footer_links', 'options')) {
					echo "<ul class='links list--disable f f-c fw'>";
					while (have_rows('footer_links', 'options')) : the_row();
					$link = get_sub_field('link');
							echo "<li class='bl m-b--none'>";
							get_template_part('components/button/button', '', [
								'button' 	=> $link,
								'type' 		=> 'link',
								'class' 	=> 'pr'
							]);
							echo "</li>";
						endwhile;
					echo "</ul>";
				}
				?>
			</div>
			<div class="f f-c f--c gap-small">
				<?php if ( get_field('footer_inhoud','options') == 'keurmerken' ) {
					if( have_rows('footer_keurmerken','options') ): ?>
						<ul class="list--disable footer-logos f f-c f--c gap-small">
						<?php while( have_rows('footer_keurmerken','options') ) : the_row();
							$image = get_sub_field('logo');
                            if ( $image ):
                                $url = $image['url'];
                                $alt = $image['alt'];
                                $size = 'large';
                                $logo = $image['sizes'][ $size ];
                            ?>
                            <?php endif; ?>
							<li>
								<?php if ( get_sub_field('url') ) { ?><a href="<?php the_sub_field('url'); ?>" target="_blank" rel="nofollow noopener"><?php } ?><img src="<?php echo $logo ?>" alt="<?php echo $alt; ?>"><?php if ( get_sub_field('url') ) { ?></a><?php } ?>
							</li>
						<?php endwhile; ?>
						</ul>
					<?php endif;
				} elseif( get_field('footer_inhoud','options') == 'text' ) {
					the_field('footer_tekst','options');
				} ?>
			</div>
		</div>
	</div>
</footer>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<?php 
wp_footer();
