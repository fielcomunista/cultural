<!doctype html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php wp_title( '&mdash;', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<meta name="viewport" content="width=device-width">

	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>

    <body <?php body_class();?>>

	<?php do_action( 'before' ); ?>

	<header class="site-header wrap cf">
		<a href="#main" title="<?php esc_attr_e( 'Skip to content', 'cultural' ); ?>" class="assistive-text"><?php _e( 'Skip to content', 'cultural' ); ?></a>

		<div class="branding">
			<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
            <?php
            $logo = get_theme_mod('site_logo');
            if ($logo == ''):
            ?>
                <h1 class="site-title"><?php bloginfo('name'); ?></h1>
            <?php else: ?>
                <img src="<?php echo esc_url($logo); ?>" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>" />
            <?php endif; ?>
            </a>
        </div>

        <nav class="access cf js-access" role="navigation">
            <?php if ( wp_is_mobile() ) :
                wp_nav_menu( array( 'theme_location' => 'mobile', 'container' => false, 'menu_class' => 'menu--mobile  menu', 'fallback_cb' => false ) );
                else :
                wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'menu--main  menu  cf', 'fallback_cb' => 'default_menu' ) ); ?>
            <?php endif; ?>
        </nav>
    </header><!-- /site-header -->

	<div class="main  cf">