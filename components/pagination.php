<?php
$pages = $args['pages'];
$search_page = $args['search_page'] ?? false;
$current_page = $args['current_page'] ?? false;
$search_query = '';

if ( ! $current_page ) {
	$current_page = isset($_GET['is_page']) ? max( $_GET['is_page'], 1 ) : 1;
}

if ($pages <= 1) {
	return;
}
?>

<div class="col-12 pagination m-t--xsmall f f--c">
	<div class="pagination__button f f--fs">
		<?php
		if ( $current_page > 1 ) {
			?>
			<a class="btn-icon r-50 pr ohd prev large bg-dark page-numbers prevnext" data-page-index="<?= $current_page - 1 ?>" href="?is_page=<?= $current_page - 1 ?>" rel="prev" title="<?php _e('Navigeer naar de vorige pagina', 'swift')  ?>">
				<i class="icon icon-arrow pa pa-center"></i>	
				<i class="icon icon-arrow pa pa-center"></i>
			</a>
			<?php
		}
		?>
	</div>
	<div class="pagination__center f f--c f-c gap-xsmall">
		<?php
		for ( $page = 1; $page <= $pages; $page++ ) {
			$is_current_page = $page == $current_page ? 'current' : '';

			if ( $page <= 1 || $page >= $pages || ($page >= $current_page - 1 && $page <= $current_page + 1) ) {
				$class = "";

				if ( $page === $current_page - 1 || $page === $current_page + 1 ) {
					$class = 'dn md-f';
				}
				?>
				<a class="btn-icon large page-numbers ff-primary fw-7 f f-c f--c r-50 bg-dark <?= $class; ?> <?= $is_current_page ?>" data-page-index="<?= $page ?>" href="?is_page=<?= $page ?>" title="<?php _e('Navigeer pagina', 'swift')  ?> <?= $page ?>"><?= $page ?></a>
				<?php
			} else {
				if ( $page == 2 && $current_page > 3 ) {
					?>
					<span class="page-numbers fw-7 f f-c f--c page-numbers--dots">...</span>
					<?php
				}
				
				if ( $page == $pages - 1 && $current_page < $pages - 2 ) {
					?>
					<span class="page-numbers fw-7 f f-c f--c page-numbers--dots">...</span>
					<?php
				}
			}
		}
		?>
	</div>
	<div class="pagination__button f f--fe">
		<?php
		if ( $current_page < $pages ) {
			?>
			<a class="btn-icon r-50 pr ohd next large bg-dark page-numbers prevnext" data-page-index="<?= $current_page + 1 ?>" href="?is_page=<?= $current_page + 1 ?>" rel="next" title="<?php _e('Navigeer naar de volgende pagina', 'swift')  ?>">
				<i class="icon icon-arrow pa pa-center"></i>	
				<i class="icon icon-arrow pa pa-center"></i>
			</a>
			<?php
		}
		?>
	</div>
</div>