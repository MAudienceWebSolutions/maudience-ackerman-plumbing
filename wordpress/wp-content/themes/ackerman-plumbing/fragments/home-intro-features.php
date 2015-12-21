<?php $features = carbon_get_post_meta( get_the_id(), 'crb_home_intro_features', 'complex' );
if ( $features ) : ?>
	<div class="shell">
		<ul class="list-features">
			
			<?php foreach ( $features as $feature ) :
				$image = $feature['image'];
				$link = $feature['link'];
				$title = $feature['title'];
				$content = $feature['content'];
			?>
				<li>
					<a href="<?php echo $link; ?>">
						<?php echo wp_get_attachment_image( $image , 'feature_icon' ); ?>

						<span><?php echo $title; ?></span>

						<?php echo $content ?>
					</a>
				</li>
			<?php endforeach ?>

		</ul><!-- /.list-features -->
	</div><!-- /.shell -->
<?php endif ?>