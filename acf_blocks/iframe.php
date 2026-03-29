<?php
$height = get_field('height');
$color = get_field('background_color');
?>

<section class="iframe ohd pr" <?php if($color): ?>style="background-color:<?= $color ?>;"<?php endif; ?>>
    <iframe <?php if($height): ?>style="height:<?= $height ?>px;"<?php endif; ?>src="<?php the_field('embed_url') ?>" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</section>