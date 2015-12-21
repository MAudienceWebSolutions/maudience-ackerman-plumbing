<?php 
get_header();

	get_template_part( 'fragments/intro-page' ); ?>
	
	<div class="main">
		<div class="tabs">

			<?php include( locate_template( 'fragments/tabs-navigation-blog.php' ) );

			if ( is_single() ) : ?>
				<div class="shell">
					<div class="content">
						<div class="article-primary">
							<?php get_template_part( 'loop', 'single' ); ?>
						</div><!-- /.article-primary -->
					</div><!-- /.content -->
					
					<?php get_sidebar(); ?>
				</div><!-- /.shell -->

			<?php else : ?>
				<div class="tabs-body">
					<div class="shell">
						<?php get_template_part( 'loop' );  ?>
					</div><!-- /.shell -->
				</div><!-- /.tabs-body -->
			<?php endif; ?>

		</div><!-- /.tabs -->
	</div><!-- /.main -->
<?php get_footer(); ?>