<?php if (have_posts()) :

	crb_set_post_views(get_the_id());

	while (have_posts()) : the_post(); ?>

		<article <?php post_class('article article-single') ?>>
			<header class="article-head">
				<?php if ( has_post_thumbnail() ) {
					the_post_thumbnail( 'post_image' );
				};
				get_template_part('fragments/post-meta'); ?>
			</header><!-- /.article-head -->

			<div class="article-body">
				<div class="article-entry">
					<?php the_content(); ?>

					<?php carbon_pagination('custom'); ?>
				</div><!-- /.article-entry -->
			</div><!-- /.article-body -->
		</article><!-- /.article -->

		<?php comments_template();
		carbon_pagination('post'); ?>

	<?php endwhile; ?>
<?php endif; ?>