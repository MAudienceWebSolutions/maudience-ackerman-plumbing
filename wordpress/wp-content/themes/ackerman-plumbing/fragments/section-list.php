<?php if ( $type === 'list_section' ) :
	$list_items = carbon_get_post_meta( $section_id, 'crb_list_items', 'complex' ); ?>
	<?php if ( $show_title ) : ?>
		<h2><?php echo apply_filters( 'the_title', $section_title ); ?></h2>
	<?php endif ?>

	<div class="tube">
		<img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/tube.png" height="113" width="850" alt="">

		<div class="tube-fill"></div><!-- /.tube-fill -->
		
		<?php if ( $list_items ) : ?>
			<ul>
				<?php foreach ( $list_items as $list_item ) : ?>
					<li><?php echo $list_item['text'] ?></li>
				<?php endforeach ?>
			</ul>
		<?php endif ?>
	</div><!-- /.tube -->
<?php endif ?>