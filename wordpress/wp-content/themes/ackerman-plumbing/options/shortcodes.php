<?php

/**
 * Returns current year
 *
 * @uses [year]
 */
add_shortcode('year', 'crb_shortcode_year');
function crb_shortcode_year() {
	return date('Y');
}

/**
 * Button Shortcode
 */
add_shortcode('button', 'crb_shortcode_button');
function crb_shortcode_button($atts, $content) {
	$atts = shortcode_atts(
		array(
			'size' => 'big',
			'link' => '#',
		),
		$atts, 'button'
	);

	ob_start();
	?>
	<a href="<?php echo esc_url($atts['link']); ?>" class="btn btn-<?php echo esc_attr( $atts['size'] ); ?>">
		<?php echo $content; ?>
	</a>
	<?php
	$html = ob_get_clean();

	return $html;
}
