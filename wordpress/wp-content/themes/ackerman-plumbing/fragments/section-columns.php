<?php if ( $type === 'columns_section' ) :
	$list_items = carbon_get_post_meta( $section_id, 'crb_section_content_list', 'complex' );
	$content_left = carbon_get_post_meta( $section_id, 'crb_section_content' );
	$content_right = carbon_get_post_meta( $section_id, 'crb_section_content_aside' );
?>
	<div class="section-content">
		<?php if ( $show_title ) : ?>
			<h2><?php echo apply_filters( 'the_title', $section_title ); ?></h2>
		<?php endif;

		if ( $content_left ) {
			echo apply_filters( 'the_content', $content_left );
		};

		if ( $list_items ) : ?>
			<ol class="list-steps">
				<?php foreach ( $list_items as $key => $list_item ) :
					$list_item_title = $list_item['title'];
					$list_item_content = $list_item['content'];
				?>
					<li>
						<?php if ( $list_item_title ): ?>
							<h5>
								<span><?php echo $key + 1 . '.' ?></span>
								<?php echo apply_filters( 'the_title', $list_item_title ); ?>
							</h5>

							<?php if ( $list_item_content ) {
								echo wpautop( $list_item_content );
							} ?>
						<?php endif ?>
					</li>
				<?php endforeach ?>
			</ol>
		<?php endif ?>
	</div><!-- /.section-content -->
	
	<div class="section-aside">
		<?php
		if ( $content_right ) {
			echo apply_filters( 'the_content', $content_right );
		}; ?>
	</div><!-- /.section-aside --><!-- /.shell -->
<?php endif ?>