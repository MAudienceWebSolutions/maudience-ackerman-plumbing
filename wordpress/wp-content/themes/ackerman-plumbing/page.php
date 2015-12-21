<?php get_header(); ?>
	<?php get_template_part( 'fragments/intro-page' ); ?>
	
	<div class="main">
		<div class="shell">
			<div class="content">
				<?php if (have_posts()) : ?>
					<div class="article-primary">
						<?php while (have_posts()) : the_post(); ?>
							<div <?php post_class('post'); ?>>
								<?php
								the_content(__('<p class="serif">' . __('Read the rest of this page &raquo;', 'crb') . '</p>'));
								
								carbon_pagination('custom');
								
								edit_post_link(__('Edit this entry.', 'crb'), '<p>', '</p>'); 
								?>
							</div>	
						<?php endwhile; ?>
					</div><!-- /.article-primary -->
				<?php endif; ?>
			</div><!-- /.content -->
			<?php get_sidebar(); ?>
		</div><!-- /.shell -->
	</div><!-- /.main -->
<?php get_footer(); ?>