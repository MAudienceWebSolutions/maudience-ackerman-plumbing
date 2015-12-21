<?php if ( $header_buttons = carbon_get_theme_option('crb_header_buttons', 'complex') ) : ?>
	<nav class="nav-utilities">
		<ul class="menu">
			<?php foreach ( $header_buttons as $header_button ) :
				$button_color = $header_button['color'];
				$button_link = $header_button['link'];
				$button_text = $header_button['text'];

				if ( $button_color === 'red' ) {
					$class = ' class="menu-item-secondary"';
				} else {
					$class = '';
				};
			?>
				<li<?php echo $class; ?>>
					<a href="<?php echo esc_url( $button_link ); ?>"><?php echo $button_text ?></a>
				</li>
			<?php endforeach ?>
		</ul>
	</nav><!-- /.nav-utilities -->
<?php endif ?>