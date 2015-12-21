<?php
$social_icons_arrray = crb_socials_array();
foreach ( $social_icons_arrray as $social_icon ) {
	$social_icons_fields[] = Carbon_Field::factory('text', 'crb_link_' . $social_icon, ucfirst($social_icon) . ' ' . __('Link', 'crb'));
};

Carbon_Container::factory('theme_options', __('Theme Options', 'crb'))
	->add_tab(__('Contact Options', 'crb'), array(
		Carbon_Field::factory('text', 'crb_contacts_text', __('Contacts Callout Text', 'crb')),
		Carbon_Field::factory('text', 'crb_phone', __('Phone', 'crb')),
		Carbon_Field::factory('text', 'crb_address', __('Address', 'crb')),
		Carbon_Field::factory('text', 'crb_email', __('Email', 'crb')),
	))

	->add_tab(__('Header Options', 'crb'), array(
		Carbon_Field::factory('complex', 'crb_header_buttons', __('Header Buttons', 'crb'))
			->set_max(2)
			->add_fields(array(
				Carbon_Field::factory('select', 'color', __('Button Color', 'crb'))
					->add_options(array(
						'blue' => 'Blue',
						'red' => 'Red',
					)),
				Carbon_Field::factory('text', 'link', __('Button Link', 'crb'))->set_required(true),
				Carbon_Field::factory('text', 'text', __('Button Text', 'crb'))->set_required(true),
			)),
	))

	->add_tab(__('Social Icons Links', 'crb'), array_merge( $social_icons_fields, array(
		Carbon_Field::factory('text', 'crb_social_icons_text', __('Footer Social Icons Callout Text', 'crb')),
	) ) )

	->add_tab(__('Misc Options', 'crb'), array(
		Carbon_Field::factory('header_scripts', 'crb_header_script', __('Header Script', 'crb')),
		Carbon_Field::factory('footer_scripts', 'crb_footer_script', __('Footer Script', 'crb')),
	));

if ( carbon_twitter_widget_registered() ) {
	Carbon_Container::factory('theme_options', 'Twitter Settings')
		->set_page_parent(__('Theme Options', 'crb'))
		->add_fields(array(
			Carbon_Field::factory('html', 'crb_twitter_settings_html')
				->set_html('
					<div style="position: relative; background: #fff; border: 1px solid #ccc; padding: 10px;">
						<h4><strong>' . __('Twitter API requires a Twitter application for communication with 3rd party sites. Here are the steps for creating and setting up a Twitter application:', 'crb') . '</strong></h4>
						<ol style="font-weight: normal;">
							<li>' . sprintf(__('Go to <a href="%1$s" target="_blank">%1$s</a> and log in, if necessary.', 'crb'), 'https://dev.twitter.com/apps/new') . '</li>
							<li>' . __('Supply the necessary required fields and accept the <strong>Terms of Service</strong>. <strong>Callback URL</strong> field may be left empty.', 'crb') . '</li>
							<li>' . __('Submit the form.', 'crb') . '</li>
							<li>' . __('On the next screen, click on the <strong>Keys and Access Tokens</strong> tab.', 'crb') . '</li>
							<li>' . __('Scroll down to <strong>Your access token</strong> section and click the <strong>Create my access token</strong> button.', 'crb') . '</li>
							<li>' . __('Copy the following fields: <strong>Consumer Key, Consumer Secret, Access Token, Access Token Secret</strong> to the below fields.', 'crb') . '</li>
						</ol>
					</div>
				'),
			Carbon_Field::factory('text', 'crb_twitter_consumer_key', __('Consumer Key', 'crb'))
				->set_default_value(''),
			Carbon_Field::factory('text', 'crb_twitter_consumer_secret', __('Consumer Secret', 'crb'))
				->set_default_value(''),
			Carbon_Field::factory('text', 'crb_twitter_oauth_access_token', __('Access Token', 'crb'))
				->set_default_value(''),
			Carbon_Field::factory('text', 'crb_twitter_oauth_access_token_secret', __('Access Token Secret', 'crb'))
				->set_default_value(''),
		));
}