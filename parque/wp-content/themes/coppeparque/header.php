<!DOCTYPE html>
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
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width">
        <title><?php wp_title('|', true, 'right'); ?></title>
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <!--[if lt IE 9]>
        <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
        <![endif]-->
        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
        <!--	<div id="page" class="hfeed site">
                        <header id="masthead" class="site-header" role="banner">
                                <a class="home-link" href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
                                        <h1 class="site-title"><?php bloginfo('name'); ?></h1>
                                        <h2 class="site-description"><?php bloginfo('description'); ?></h2>
                                </a>
        
                                <div id="navbar" class="navbar">
                                        <nav id="site-navigation" class="navigation main-navigation" role="navigation">
                                                <h3 class="menu-toggle"><?php _e('Menu', 'coppeparque'); ?></h3>
                                                <a class="screen-reader-text skip-link" href="#content" title="<?php esc_attr_e('Skip to content', 'coppeparque'); ?>"><?php _e('Skip to content', 'coppeparque'); ?></a>
        <?php get_search_form(); ?>
                                        </nav> #site-navigation 
                                </div> #navbar 
                        </header> #masthead 
        
                        <div id="main" class="site-main">-->
        <div id="header">
            <div class="header-top">
                <div class="container">
                    <div class="row">
                        <div class="span5 offset11 header-top-links">
                            <a href="#" title="Acesso à informação">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/acesso-informacao.jpg" alt="Acesso à informação" />
                            </a>
                            <a href="#" title="Brasil">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/brasil.jpg" alt="Brasil" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-middle">
                <div class="container">
                    <div class="row">
                        <div class="span6">
                            <a href='<?php echo esc_url(home_url('/')); ?>' title="Home">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/logo.jpg" alt="Parque Tecnológico UFRJ"/>
                            </a>
                        </div>
                        <div class="span10 text-right">
                            <div class="row">
                                <div class="span10">
                                    <ul class="top-links inline">
                                        <li class="incubadora"><a href='#' title="Incubadora de Empresas">Incubadora de Empresas</a></li>
                                        <li class="ufrj"><a href='#' title="UFRJ">UFRJ</a></li>
                                        <li class="english"><a href='#' title="English Version">English Version</a></li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="span10 search-bar">
                                    <form class="form-inline" action="#" method="get">
                                        <div class="input-prepend input-append">
                                            <label class="add-on" for="input-search">Busca</label>
                                            <input id="input-search" class="span4" type="text" name="s"/>
                                            <button class="btn" type="submit">OK</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="span10">
                                    <?php wp_nav_menu(array('theme_location' => 'header_bottom_links', 'menu_class' => 'bottom-links inline')); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-navbar">
                <div class="container">
                    <div class="row">
                        <div class="span16">
                            <?php wp_nav_menu(array('theme_location' => 'primary', 'menu_class' => 'nav-menu')); ?>
                        </div>
                    </div>
                </div>
            </div>