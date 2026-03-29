<?php
get_header();

$lang = function_exists('pll_current_language') ? pll_current_language() : 'nl';

$back_title       = ($lang === 'en') ? 'Back to overview' : 'Terug naar overzicht';
$share_heading    = ($lang === 'en') ? 'Share via social media?' : 'Delen via social media?';
$share_whatsapp   = ($lang === 'en') ? 'Share via WhatsApp' : 'Deel via WhatsApp';
$share_linkedin   = ($lang === 'en') ? 'Share via LinkedIn' : 'Deel via LinkedIn';
$share_mail       = ($lang === 'en') ? 'Share via e-mail' : 'Deel via e-mail';
$share_twitter    = ($lang === 'en') ? 'Share via X (Twitter)' : 'Deel via X (Twitter)';
$cta_button_title = ($lang === 'en') ? 'More info' : 'Meer info';
$related_title    = ($lang === 'en') ? 'You might also find this interesting' : 'Misschien vind je dit ook interessant?';
$no_posts_text    = ($lang === 'en') ? 'No posts could be found.' : 'Er kunnen geen berichten gevonden worden.';
?>

<section class="bg-body pr">
	<?php divider(); ?>
	<div class="container p-t--large p-b--large text">
		<div class="row f--sb gap-row">
			<div class="col-lg-8">
				<?php
				if (have_posts()) :
					while (have_posts()) : the_post();
						the_content();
					endwhile;
				endif;
				?>
				<div class="m-t--small f fw f--sb gap-small align-items-center">
					<?php
					$previous_url = get_permalink(get_option('page_for_posts'));
					$button = [
						'title' => $back_title,
						'url'   => $previous_url,
					];

					$title     = get_the_title();
					$permalink = get_permalink();

					get_template_part('components/button/button', '', [
						'button' => $button,
						'class'  => 'back m-t--none',
					]);
					?>

					<div class="share f gap-small">
						<p class="ff-primary text-large fw-7 m-b--none"><?= esc_html($share_heading); ?></p>
						<div class="share__options f gap-xsmall">
							<a href="https://wa.me/?text=<?= $title; ?>%20-%20<?= $permalink; ?>" aria-label="<?= esc_attr($share_whatsapp); ?>" rel="noopener" target="_blank" class="link-icon-bg bg-dark link-icon-bg--medium bg-based r-50 pr f">
								<i class="icon icon-whatsapp pa pa-center"></i>
								<div class="nowrap fw-6 label-hover r50 pa ff-primary bg-accent">
									<i class="icon icon-triangle-menu"></i>
									<?= esc_html($share_whatsapp); ?>
								</div>
							</a>
							<a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?= $permalink; ?>&amp;title=<?= $title; ?>" aria-label="<?= esc_attr($share_linkedin); ?>" rel="noopener" target="_blank" class="link-icon-bg bg-dark link-icon-bg--medium bg-based r-50 pr f">
								<i class="icon icon-linkedin pa pa-center"></i>
								<div class="nowrap fw-6 label-hover r50 pa ff-primary bg-accent">
									<i class="icon icon-triangle-menu"></i>
									<?= esc_html($share_linkedin); ?>
								</div>
							</a>
							<a href="mailto:?body=<?= $permalink; ?>" aria-label="<?= esc_attr($share_mail); ?>" class="link-icon-bg bg-dark link-icon-bg--medium bg-based r-50 pr f">
								<i class="icon icon-at pa pa-center"></i>
								<div class="nowrap fw-6 label-hover r50 pa ff-primary bg-accent">
									<i class="icon icon-triangle-menu"></i>
									<?= esc_html($share_mail); ?>
								</div>
							</a>
							<a href="https://twitter.com/share?url=<?= $permalink; ?>&amp;text=<?= $title; ?>" aria-label="<?= esc_attr($share_twitter); ?>" rel="noopener" target="_blank" class="link-icon-bg bg-dark link-icon-bg--medium bg-based r-50 pr f">
								<i class="icon icon-x pa pa-center"></i>
								<div class="nowrap fw-6 label-hover r50 pa ff-primary bg-accent">
									<i class="icon icon-triangle-menu"></i>
									<?= esc_html($share_twitter); ?>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-4 sidebar">
				<div class="sidebar-cta bg-light r m-b--xxsmall">
					<?php
					$cta_image = get_field('cta_sidebar_image') ?: get_field('cta_sidebar_image', 'options');
					$cta_text  = get_field('cta_sidebar_text') ?: get_field('cta_sidebar_text', 'options');
					$cta_group = get_field('cta_sidebar_button');
					if (!is_array($cta_group) || empty($cta_group['link'])) {
						$cta_group = get_field('cta_sidebar_button', 'options');
					}

					$style = is_array($cta_group) ? ($cta_group['style'] ?? '') : '';
					$link  = is_array($cta_group) ? ($cta_group['link'] ?? null) : null;

					if (is_array($link) && !empty($link['url'])) {
						if (empty($link['title'])) {
							$link['title'] = $cta_button_title;
						}
					} else {
						$link = null;
					}
					?>

					<?php if ($cta_image) : ?>
						<div class="cta__image pr ohd r-50">
							<?= wp_get_attachment_image($cta_image, 'medium', '', ['class' => 'pa cover']); ?>
						</div>
					<?php endif; ?>

					<?php if ($cta_text) : ?>
						<div class="text m-t--xxsmall"><?= $cta_text; ?></div>
					<?php endif; ?>

					<?php if ($link) :
						get_template_part('components/button/button', '', [
							'button' => $link,
							'style'  => $style,
						]);
					endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php
$args = [
	'post_type'      => 'post',
	'posts_per_page' => 3,
	'orderby'        => 'date',
	'order'          => 'DESC',
	'lang'           => $lang,
];

$posts_query = new WP_Query($args);

if ($posts_query->have_posts()) {
	$posts = $posts_query->posts;
	get_template_part('components/posts/section', '', [
		'posts' => $posts,
		'title' => $related_title,
		'space' => 'p-b--large',
		'show_divider' => false,
	]);
} else {
?>
	<section>
		<div class="container center">
			<p><?= esc_html($no_posts_text); ?></p>
		</div>
	</section>
<?php
}

wp_reset_postdata();

get_footer('', [
	'cta_background_color' => 'bg-body',
]);
