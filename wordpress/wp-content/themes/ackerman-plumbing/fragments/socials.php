<?php $social_icons = crb_socials_array(); ?>
<div class="socials">
	<ul>
	<?php foreach ( $social_icons as $social_icon ) :
		if ( $social_icon_link = carbon_get_theme_option( 'crb_link_' . $social_icon ) ) : ?>
			<li class="icon">
				<a href="<?php echo $social_icon_link ?>" target="_blank">
					<i class="ico ico-<?php echo $social_icon ?>"></i>
				</a>
			</li>
		<?php endif;
	endforeach ?>
	</ul>
</div><!-- /.socials -->
