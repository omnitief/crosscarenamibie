<?php
$show_kvk = $args['kvk'] ?? true;
$show_btw = $args['btw'] ?? true;
$class = $args['class'] ?? '';
$address_class = $args['address_class'] ?? '';
$phone = get_field('phone');
$phone_url = get_field('phone_url');
$email = get_field('email');
$address = get_field('address', 'options'); 

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

<div class="contact-items <?= $class; ?>">
	<?php 
	if ($address) {
		?>
		<div class="<?= $address_class; ?> link-icon pr">
			<i class="icon icon-pin pa"></i>
			<div>
				<?= $address; ?>
			</div>
		</div>
		<?php
	}

	if ($phone || $email) {
		echo "<div>";
	}

		if ($email) {
			?>
			<a class="link-icon pr dif" href="mailto:<?= $email; ?>" title="<?= $email; ?>"><i class="icon icon-at pa"></i><span><span class="pr"><?= $email; ?></span></span></a><br>
			<?php
		}

		if ($phone) {
			?>
			<a class="link-icon pr dif" href="tel:<?= $phone_url; ?>" title="<?= $phone; ?>"><i class="icon icon-phone pa"></i><span><span class="pr"><?= $phone; ?></span></span></a>
			<?php
		}

	if ($phone || $email) {
		echo "</div>";
	}

	if ($show_kvk || $show_btw) {
		echo "<div class='m-t--xxsmall'>";

		if (get_field('kvk', 'options')) {
			$kvk = get_field('kvk', 'options'); 
			$kvk_text = get_field('kvk_text', 'options');
			?>
			<p><?= $kvk_text; ?><?= $kvk; ?></p>
			<?php
		}
		
		if (get_field('btw', 'options')) {
			$btw = get_field('btw', 'options'); 
			$btw_text = get_field('btw_text', 'options');
			?>
			<p><?= $btw_text; ?><?= $btw; ?></p>
			<?php
		}

		echo "</div>";
	}
	?>
</div>