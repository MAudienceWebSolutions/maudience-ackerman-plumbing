<?php if ( $type === 'slider' ) :
	$slides = carbon_get_post_meta( $section_id, 'crb_slides', 'complex' );

	if ( $slides ) : ?>
		<div class="slider-services">
			<div class="slider-clip">
				<ul class="slides bxslider">
					<li class="slide">
						<ul class="services">
							<?php foreach ( $slides  as $key => $slide ) :
								$image = $slide['image'];
								$title = $slide['title'];
								$content = $slide['content'];
								$button_text = $slide['button_text'];
								$button_link = $slide['button_link'];
							?>
								<li class="service">
									<?php if ( $image ) {
										echo wp_get_attachment_image( $image, 'section_slide' );
									};

									if ( $title ) : ?>
										<h2><?php echo $title ?></h2>
									<?php endif;

									if ( $content ) {
										echo apply_filters( 'the_content', $content );
									}; ?>
									<?php if ( $button_text && $button_link ) : ?>
										<a href="<?php echo esc_url( $button_link ); ?>" class="btn btn-primary">
											<?php echo $button_text; ?>
										</a>
									<?php endif ?>
								</li><!-- /.service -->
								
								<?php if ( $key % 2 === 1 && $key + 1 !== count($slides) ) : ?>
										</ul><!-- /.services -->
									</li><!-- /.slide -->			

									<li class="slide">
										<ul class="services">
								<?php endif ?>
							<?php endforeach ?>
						</ul><!-- /.services -->
					</li><!-- /.slide -->
				</ul><!-- /.slides -->
			</div><!-- /.slider-clip -->
		</div><!-- /.slider-services -->
	<?php endif ?>
<?php endif ?>