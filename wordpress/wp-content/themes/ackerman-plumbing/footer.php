				<footer class="footer">
				<div class="shell">
					<div class="footer-content">
						<?php if ( $contacts = carbon_get_theme_option('crb_contacts_text') ) : ?>
							<h4><?php echo apply_filters( 'the_title', $contacts ); ?></h4>
						<?php endif; ?>

						<div class="footer-cols">
							<?php get_template_part( 'fragments/contacts' ); ?>
						</div><!-- /.footer-cols -->
					</div><!-- /.footer-content -->
					
					<div class="footer-aside">
						<?php if ( $footer_socials_text = carbon_get_theme_option('crb_social_icons_text') ) : ?>
							<h4><?php echo apply_filters( 'the_title', $footer_socials_text ); ?></h4>
						<?php endif;

						get_template_part( 'fragments/socials' ); ?>
					</div><!-- /.footer-aside -->
				</div><!-- /.shell -->
			</footer><!-- /.footer -->
		</div><!-- /.wrapper -->
	<?php wp_footer(); ?>
</body>
</html>