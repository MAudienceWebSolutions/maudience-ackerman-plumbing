<?php if (have_posts()) : ?>
	<ul class="updates">
		<?php while (have_posts()) : the_post(); ?>
			<li <?php post_class('update') ?>>
				<?php if ( has_post_thumbnail() && !is_search() ) : ?>
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail( 'post_image' ); ?>
					</a>
				<?php endif ?>

				<div class="update-content">
					<h6>
						<?php the_title(); ?>

						<span>
							<?php the_time( 'm/d/y' ); ?>
						</span>
					</h6><!-- /.article-title -->

					<?php if ( is_search() || is_archive() || is_home() ) {
						the_excerpt();
					} else {
						the_content(__('Read the rest of this entry &raquo;', 'crb'));
					} ?>

					<a href="<?php echo the_permalink(); ?>" class="btn btn-teritary"><?php _e( 'Read More', 'crb' ) ?></a>
				</div><!-- /.article-body -->
			</li><!-- /.article -->

		<?php endwhile; ?>
	 </ul><!-- /.updates -->

	<?php get_template_part( 'fragments/custom-pagination' ); ?>
	
<?php else : ?>
	<ol class="articles">
		<li class="article post error404 not-found">
			<div class="article-body">
				<div class="article-entry">
					<p>
						<?php if ( is_category() ) { // If this is a category archive
							printf( __("Sorry, but there aren't any posts in the %s category yet.", 'crb'), single_cat_title('',false) );
						} else if ( is_date() ) { // If this is a date archive
							_e("Sorry, but there aren't any posts with this date.", 'crb');
						} else if ( is_author() ) { // If this is a category archive
							$userdata = get_user_by('id', get_queried_object_id());
							printf( __("Sorry, but there aren't any posts by %s yet.", 'crb'), $userdata->display_name );
						} else if ( is_search() ) { // If this is a search
							_e('No posts found. Try a different search?', 'crb');
						} else {
							_e('No posts found.', 'crb');
						} ?>
					</p>
					
					<?php get_search_form(); ?>
				</div><!-- /.article-entry -->
			</div><!-- /.article-body -->
		</li><!-- /.article -->
	</ol><!-- /.articles -->
<?php endif; ?>