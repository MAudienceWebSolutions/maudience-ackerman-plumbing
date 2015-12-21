<?php if ( $type === 'section_image' ) :
	$section_content = carbon_get_post_meta( $section_id, 'crb_section_content' );
	$section_image = carbon_get_post_meta( $section_id, 'crb_section_image' );
?>
	<div class="section-content">
		<div class="callout">
			<?php if ( carbon_get_post_meta( $section_id, 'crb_show_title' ) == 'yes' ) : ?>
				<h2><?php echo apply_filters( 'the_title', $section_title ); ?></h2>
			<?php endif ?>
			
			<?php if ( $content = carbon_get_post_meta( $section_id, 'crb_section_content' ) ) {
				echo apply_filters( 'the_content', $section_content );
			} ?>
		</div><!-- /.callout -->
	</div><!-- /.section-content --><!-- /.shell --><!-- /.section section-teritary -->
	
	<?php if ( $section_image ):
		$image_url = wp_get_attachment_image_src( $section_image, 'section_image' );
		$style = 'background: url(\'' . $image_url[0] . '\'); background-size: cover;';
	?>
		<div class="section-aside" style="<?php echo $style; ?>">
			<?php echo wp_get_attachment_image( $section_image, 'section_image' ); ?>
		</div><!-- /.section-aside -->
	<?php endif ?>
<?php endif ?>