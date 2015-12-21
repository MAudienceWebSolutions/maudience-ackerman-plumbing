<?php $home_intro_slides = carbon_get_post_meta( get_the_id(), 'crb_home_intro_slides', 'complex' );
if ( $home_intro_slides ) : ?>
	<div class="slider-intro">
		<div class="slider-clip">
			<ul class="slides bxslider">

				<?php foreach ( $home_intro_slides as $slide ) :
					$slide_image = $slide['image'];
					$slide_text = $slide['text'];
				?>
					<li class="slide">
						<?php if ( $slide_image ) {
							echo wp_get_attachment_image( $slide_image, 'slider_image' );
						};

						if ( $slide_text ) : ?>
							<div class="slide-content">
								<div class="shell">
									<h1><?php echo apply_filters( 'the_title', $slide_text ); ?></h1>
								</div><!-- /.shell -->
							</div><!-- /.slide-content -->
						<?php endif ?>
					</li><!-- /.slide -->
				<?php endforeach ?>
				
			</ul><!-- /.slides -->
		</div><!-- /.slider-clip -->
	</div><!-- /.slider-intro -->
<?php else : ?>
	<div class="shell">
		<?php the_title( '<h2 class="pagetitle">', '</h2>' ); ?>
	</div><!-- /.shell -->
<?php endif; ?>