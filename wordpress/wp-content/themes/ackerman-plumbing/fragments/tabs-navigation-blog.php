<?php if ( is_home() || is_category() ) :
	$categories = carbon_get_post_meta( intval(get_option( 'page_for_posts' )), 'crb_categories' );
	$popular_posts = absint( get_query_var('popular') );
	$current_category = get_query_var( 'cat' );
?>
	<div class="tabs-head">
		<ul class="tabs-nav">
			<?php $blog_url = get_permalink( get_option('page_for_posts' ) );
			if ( !$current_category && !$popular_posts ) {
				$class = ' class="current"';
			} else {
				$class = '';
			}; ?>
			<li<?php echo $class; ?>>
				<a href="<?php echo esc_url( $blog_url ); ?>">
					<?php _e('Most Recent', 'crb') ?>
				</a>
			</li>

			<?php $popular_posts_link = $blog_url . '?popular';
			if ( $popular_posts === 1 ) {
				$class = ' class="current"';
			} else {
				$class = '';
			}; ?>
			<li<?php echo $class; ?>>
				<a href="<?php echo esc_url( $blog_url ); ?>?popular=1">
					<?php _e('Popular', 'crb') ?>
				</a>
			</li>

			<?php if ( $categories ) :
				foreach ( $categories as $category_id ) :
					$category = get_term_by( 'id', $category_id, 'category' );
					$category_link = get_term_link( $category->slug, 'category' );
					if ( $current_category === absint( $category_id ) ) {
						$class = ' class="current"';
					} else {
						$class = '';
					}
				?>
					<li<?php echo $class ?>>
						<a href="<?php echo esc_url( $category_link ) ?>">
							<?php echo $category->name; ?>
						</a>
					</li>
				<?php endforeach;
			endif ?>
		</ul><!-- /.tabs-nav -->
	</div><!-- /.tabs-head -->
<?php endif ?>