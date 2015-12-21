<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div class="wrapper">
		<header class="header">
			<div class="shell">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo"><?php bloginfo( 'name' ); ?></a>

				<div class="header-inner">
					<?php get_template_part( 'fragments/socials' );
					get_template_part( 'fragments/phone' ); ?>
				</div><!-- /.header-inner -->
				
				<?php get_template_part( 'fragments/header-buttons' ); ?>
			</div><!-- /.shell -->
		</header><!-- /.header -->

		<?php if ( has_nav_menu( 'main-menu' ) ) : ?>
			<nav class="nav">
				<div class="shell">
					<a href="#" class="btn-menu"><span></span></a>

					<ul class="menu menu-holder">
						<li>
							<?php $args = array(
								'theme_location' => 'main-menu',
								'fallback_cb' => '',
								'container' => '',
							);

							wp_nav_menu( $args ); ?>
						</li>

						<li>
							<?php get_search_form(); ?>
						</li>
					</ul><!-- /.menu -->
				</div><!-- /.shell -->
			</nav><!-- /.nav -->
		<?php endif; ?>
	