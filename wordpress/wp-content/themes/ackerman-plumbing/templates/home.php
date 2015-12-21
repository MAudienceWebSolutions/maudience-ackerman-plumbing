<?php
/**
 * Template Name: Home
 */
get_header();
the_post(); ?>

	<div class="intro">
		<?php get_template_part( 'fragments/home-intro-slider' );
		get_template_part( 'fragments/home-intro-features' ); ?>
	</div><!-- /.intro -->

	<div class="main">
		<?php $sections = carbon_get_post_meta( get_the_id(), 'crb_home_section_association' );
		if ( $sections ) :
			foreach ( $sections as $section_id ) :
				$section = get_post( $section_id );
				$type = carbon_get_post_meta( $section_id, 'type' );
				$section_title = $section->post_title;
				$show_title = carbon_get_post_meta( $section_id, 'crb_show_title' );
			?>

				<section class="section section-<?php echo $type ?>">
					<div class="shell">
						<?php include( locate_template( 'fragments/section-slider.php' ) );
						include( locate_template( 'fragments/section-list.php' ) );
						include( locate_template( 'fragments/section-image.php' ) );
						include( locate_template( 'fragments/section-columns.php' ) ); ?>
					</div><!-- /.shell -->
				</section>
				
			<?php endforeach ?>
		<?php endif ?>
	</div><!-- /.main -->
<?php get_footer(); ?>