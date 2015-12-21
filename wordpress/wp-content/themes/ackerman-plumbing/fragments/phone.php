<?php if ( $phone = carbon_get_theme_option('crb_phone') ) : ?> 
	<p class="phone">
		<a href="tel:<?php echo crb_sanitize_phone($phone); ?>">
			<i class="ico-phone"></i>

			<?php echo $phone; ?>
		</a>
	</p><!-- /.phone -->
<?php endif ?>