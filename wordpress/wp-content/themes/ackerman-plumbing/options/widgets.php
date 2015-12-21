<?php
/**
 * Register the new widget classes here so that they show up in the widget list. 
 */
function crb_register_widgets() {
	register_widget('ThemeWidgetRichText');
	register_widget('CrbFeaturedPostsWidget');
	register_widget('CrbContactWidget');
}
add_action('widgets_init', 'crb_register_widgets');

/**
 * Displays a block with a title and WYSIWYG rich text content
 */
class ThemeWidgetRichText extends Carbon_Widget {
	function __construct() {
		$this->setup(__('Rich Text', 'crb'), __('Displays a block with title and WYSIWYG content.', 'crb'), array(
			Carbon_Field::factory('text', 'title', __('Title', 'crb')),
			Carbon_Field::factory('rich_text', 'content', __('Content', 'crb')),
		));
	}
	
	function front_end($args, $instance) {
		if ($instance['title']) {
			$title = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);
		
			echo $args['before_title'] . $title . $args['after_title'];
		}
		
		echo apply_filters('the_content', $instance['content']);
	}
}

/**
 * Displays a block with latest tweets from particular user
 */
class CrbLatestTweetsWidget extends Carbon_Widget {
	protected $form_options = array(
		'width' => 300
	);

	function __construct() {
		$this->setup(__('Latest Tweets', 'crb'), __('Displays a block with your latest tweets', 'crb'), array(
			Carbon_Field::factory('text', 'title', __('Title', 'crb')),
			Carbon_Field::factory('text', 'username', __('Username', 'crb')),
			Carbon_Field::factory('text', 'count', __('Number of Tweets to show', 'crb'))->set_default_value('5'),
		));
	}

	function front_end($args, $instance) {
		if ( !carbon_twitter_is_configured() ) {
			return; //twitter settings are not configured
		}

		$tweets = TwitterHelper::get_tweets($instance['username'], $instance['count']);
		if (empty($tweets)) {
			return; //no tweets, or error while retrieving
		}

		if ($instance['title']) {
			$title = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);

			echo $args['before_title'] . $title . $args['after_title'];
		}
		?>
		<ul>
			<?php foreach ($tweets as $tweet): ?>
				<li><?php echo $tweet->tweet_text; ?> - <span><?php printf(__('%1$s ago', 'crb'), $tweet->time_distance); ?></span></li>
			<?php endforeach ?>
		</ul>
		<?php
	}
}

/**
 * Featured Posts Widget
 */
class CrbFeaturedPostsWidget extends Carbon_Widget {
	function __construct() {
		$this->setup(__('Theme Widget - Featured Posts', 'crb'), __('Displays a block with posts that have been featured.', 'crb'), array(
			Carbon_Field::factory('text', 'title', __('Title', 'crb'))->set_default_value('Featured Posts', 'crb'),
			Carbon_Field::factory('text', 'crb_number_of_posts', __('Number of Posts', 'crb'))
				->set_default_value(3),
		));
	}
	
	/**
	 * Called when rendering the widget in the front-end
	 */
	function front_end($args, $instance) {
		if ($instance['title']) {
			$title = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);

			echo $args['before_title'] . $title . $args['after_title'];
		};
		if ( absint( $instance['crb_number_of_posts'] ) ) {
			$post_count = $instance['crb_number_of_posts'];
		} else {
			$post_count = 3;
		};
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => $post_count,
			'meta_key' => '_crb_feature_post',
			'meta_value' => 'yes',
		);

		$featured_posts = get_posts( $args );
		?>
		<?php if ( $featured_posts ) : ?>
			<div class="updates">
				<?php foreach ( $featured_posts as $featured_post ) : ?>
					<div class="update update-secondary">
						<?php if ( has_post_thumbnail( $featured_post->ID ) ) {
							$featured_image = get_post_thumbnail_id( $featured_post->ID );
							echo wp_get_attachment_image( $featured_image, 'featured_post_image' );
						} ?>

						<div class="update-content">
							<h6>
								<?php echo $featured_post->post_title ?>
								&nbsp;&nbsp;|&nbsp;&nbsp;
								<?php echo get_the_date( 'm/d/y', $featured_post->ID ); ?>
							</h6>
							
							<?php echo wpautop( wp_trim_words( $featured_post->post_content, 13, '' ) ); ?>
							
							<a href="<?php echo get_permalink( $featured_post->ID ); ?>"><?php _e( 'Read More', 'crb' ) ?></a>
						</div><!-- /.update-content -->
					</div><!-- /.update update-secondary -->
				<?php endforeach ?>
			</div><!-- /.updates -->			
		<?php endif;
	}
}

/**
 * Contact Us Widget
 */
class CrbContactWidget extends Carbon_Widget {
	function __construct() {
		$this->setup(__('Theme Widget - Contact Us', 'crb'), __('Displays a block with contact information added from the theme options.', 'crb'), array(
			Carbon_Field::factory('text', 'title', __('Title', 'crb'))->set_default_value('Contact Us:', 'crb'),
		));
	}

	function front_end($args, $instance) {
		if ($instance['title']) {
			$title = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);

			echo $args['before_title'] . $title . $args['after_title'];
			$address = carbon_get_theme_option('crb_address');
			$phone = carbon_get_theme_option('crb_phone');
			$email = carbon_get_theme_option('crb_email');
		};
		if ( $address || $phone || $email ) : ?>
			<ul class="list-contacts">
				<?php get_template_part( 'fragments/contacts' ); ?>
			</ul><!-- /.list-contacts -->
		<?php endif;
	}
}