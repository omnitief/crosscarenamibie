<?php 
$accordion_items = $args['accordion'];
$class = $args['class'] ?? '';
?>

<div class="accordion f f_c <?= $class; ?>">
	<?php
	foreach ($accordion_items as $item) {
		?>
		<div class="accordion__item r border pr">
			<div class="accordion__item__header f f-c f--sb">
				<p class="text-large m-b--none ff-secondary fw-7">
					<?= $item['title']; ?>
				</p>
				<?php if($item['text']) { ?><i class="icon icon-plus cl-accent"></i><?php } ?>
			</div>
			<?php if($item['text']) { ?>
			<div class="accordion__item__body">
				<div class="accordion__item__body__inner">
					<div class="text">
						<?= $item['text']; ?>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
		<?php
	}
	?>
</div>