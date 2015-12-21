<?php if ( $address = carbon_get_theme_option('crb_address') ) : ?>
	<li>
		<h5><?php _e( 'Address:', 'crb' ) ?></h5>
		
		<?php echo wpautop( $address ); ?>
	</li>
<?php endif ?>

<?php if ( $phone = carbon_get_theme_option('crb_phone') ) : ?>
	<li>
		<h5><?php _e( 'Phone:', 'crb' ) ?></h5>
		
		<?php get_template_part( 'fragments/phone' ); ?>
	</li>
<?php endif ?>							

<?php if ( $email = carbon_get_theme_option('crb_email') ) : ?>
	<li>
		<h5><?php _e( 'Email:', 'crb' ) ?></h5>
		
		<?php if ( $email ) : ?>
			<p><a href="mailto:<?php echo antispambot( $email ); ?>"><?php echo $email; ?></a></p>
		<?php endif ?>
	</li>
<?php endif ?>