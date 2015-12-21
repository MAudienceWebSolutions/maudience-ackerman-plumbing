<div class="intro">
	<div class="shell">
		<?php if ( is_single() ) {
			$title = get_the_title();
		} else {
			$title = crb_get_title();
		}; ?>
		<h2 class="pagetitle">
			<?php if ( is_home() && isset($_GET['popular']) ) {
				$title .= __( ' : Popular', 'crb' );
			};
			echo $title; ?>
		</h2><!-- /.pagetitle -->
	</div><!-- /.shell -->
</div><!-- /.intro -->