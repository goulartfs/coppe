<?php

/**
 * Coppe Parque setup.
 *
 * Sets up theme defaults and registers the various WordPress features.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add Visual Editor stylesheets.
 * @uses add_theme_support() To add support for automatic feed links, post
 * formats, and post thumbnails.
 * @uses register_nav_menu() To add support for a navigation menu.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 */
function coppeparque_setup() {
    /*
     * Makes Coppe Parque available for translation.
     *
     * Translations can be added to the /languages/ directory.
     * If you're building a theme based on Coppe Parque, use a find and
     * replace to change 'coppeparque' to the name of your theme in all
     * template files.
     */
    load_theme_textdomain( 'coppeparque', get_template_directory() . '/languages' );

    /*
     * This theme styles the visual editor to resemble the theme style,
     * specifically font, colors, icons, and column width.
     */
//	add_editor_style( array( 'css/editor-style.css', 'fonts/genericons.css', coppeparque_fonts_url() ) );

    // Adds RSS feed links to <head> for posts and comments.
    add_theme_support( 'automatic-feed-links' );

    /*
     * Switches default core markup for search form, comment form,
     * and comments to output valid HTML5.
     */
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

    /*
     * This theme supports all available post formats by default.
     * See http://codex.wordpress.org/Post_Formats
     */
//    add_theme_support( 'post-formats', array(
//        'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
//    ) );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menu( 'primary', __( 'Navigation Menu', 'coppeparque' ) );
    register_nav_menu( 'header_bottom_links', __( 'Header Bottom Links Menu', 'coppeparque' ) );

    /*
     * This theme uses a custom image size for featured images, displayed on
     * "standard" posts and pages.
     */
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 604, 270, true );

    // This theme uses its own gallery styles.
    add_filter( 'use_default_gallery_style', '__return_false' );
}
add_action( 'after_setup_theme', 'coppeparque_setup' );

/**
 * Return the Google font stylesheet URL, if available.
 *
 * The use of Source Sans Pro and Bitter by default is localized. For languages
 * that use characters not supported by the font, the font can be disabled.
 *
 * @since Coppe Parque 1.0
 *
 * @return string Font stylesheet or empty string if disabled.
 */
function coppeparque_fonts_url() {
    $fonts_url = '';

    /* Translators: If there are characters in your language that are not
     * supported by Source Sans Pro, translate this to 'off'. Do not translate
     * into your own language.
     */
    $source_sans_pro = _x( 'on', 'Source Sans Pro font: on or off', 'coppeparque' );

    /* Translators: If there are characters in your language that are not
     * supported by Bitter, translate this to 'off'. Do not translate into your
     * own language.
     */
    $bitter = _x( 'on', 'Bitter font: on or off', 'coppeparque' );

    if ( 'off' !== $source_sans_pro || 'off' !== $bitter ) {
        $font_families = array();

        if ( 'off' !== $source_sans_pro )
            $font_families[] = 'Source Sans Pro:300,400,700,300italic,400italic,700italic';

        if ( 'off' !== $bitter )
            $font_families[] = 'Bitter:400,700';

        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
        $fonts_url = add_query_arg( $query_args, "//fonts.googleapis.com/css" );
    }

    return $fonts_url;
}

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Coppe Parque 1.0
 *
 * @return void
 */
function coppeparque_scripts_styles() {
    /*
     * Adds JavaScript to pages with the comment form to support
     * sites with threaded comments (when in use).
     */
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
        wp_enqueue_script( 'comment-reply' );

    // Adds Masonry to handle vertical alignment of footer widgets.
    if ( is_active_sidebar( 'sidebar-1' ) )
        wp_enqueue_script( 'jquery-masonry' );

    // Loads JavaScript file with functionality specific to Coppe Parque.
    wp_enqueue_script( 'coppeparque-script', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery', 'jquery-ui-core' ), '2013-07-18', true );
    wp_enqueue_script('cooppeparque-mousewheel', get_template_directory_uri() . '/js/jquery.mousewheel.min.js', array(), '2013-12-13');
    wp_enqueue_script('cooppeparque-mCustomScrollbar', get_template_directory_uri() . '/js/jquery.mCustomScrollbar.min.js', array(), '2013-12-13');
    wp_enqueue_script('cooppeparque-jcarousel', get_template_directory_uri() . '/js/jcarousel.min.js', array(), '2013-12-13');
    wp_enqueue_script('cooppeparque-usquare', get_template_directory_uri() . '/js/jquery.usquare.js', array(), '2013-12-13');

    // Add Source Sans Pro and Bitter fonts, used in the main stylesheet.
    wp_enqueue_style( 'coppeparque-fonts', coppeparque_fonts_url(), array(), null );

    // Add Genericons font, used in the main stylesheet.
    wp_enqueue_style( 'genericons', get_template_directory_uri() . '/fonts/genericons.css', array(), '2.09' );

    // Loads our main stylesheet.
    wp_enqueue_style( 'coppeparque-style', get_stylesheet_uri(), array(), '2013-07-18' );

    // Loads the Internet Explorer specific stylesheet.
    wp_enqueue_style( 'coppeparque-bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array( 'coppeparque-style' ), '2013-07-18' );
    wp_enqueue_style( 'coppeparque-usquare_style', get_template_directory_uri() . '/css/usquare_style.css', array( 'coppeparque-style' ), '2013-12-13' );
    wp_enqueue_style( 'coppeparque-mCustomScrollbar', get_template_directory_uri() . '/css/jquery.mCustomScrollbar.css', array( 'coppeparque-style' ), '2013-12-13' );
    wp_enqueue_style( 'coppeparque-jcarousel', get_template_directory_uri() . '/css/jcarousel.css', array( 'coppeparque-style' ), '2013-12-13' );
    wp_enqueue_style( 'coppeparque-main', get_template_directory_uri() . '/css/main.css', array( 'coppeparque-style' ), '2013-07-18' );
    if(is_page_template('template-equipe.php') || is_page_template('template-residente.php')){
        wp_enqueue_script('cooppeparque-equipe', get_template_directory_uri() . '/js/equipe.js', array(), '2013-12-13');
        wp_enqueue_style( 'coppeparque-equipe', get_template_directory_uri() . '/css/equipe.css', array( 'coppeparque-style' ), '2013-12-13' );
    }
    wp_enqueue_script('cooppeparque-main', get_template_directory_uri() . '/js/main.js', array(), '2014-01-01');
//	wp_enqueue_style( 'coppeparque-ie', get_template_directory_uri() . '/css/ie.css', array( 'coppeparque-style' ), '2013-07-18' );
//	wp_style_add_data( 'coppeparque-ie', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'coppeparque_scripts_styles' );

/**
 * Filter the page title.
 *
 * Creates a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since Coppe Parque 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep   Optional separator.
 * @return string The filtered title.
 */
function coppeparque_wp_title( $title, $sep ) {
    global $paged, $page;

    if ( is_feed() )
        return $title;

    // Add the site name.
    $title .= get_bloginfo( 'name' );

    // Add the site description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
        $title = "$title $sep $site_description";

    // Add a page number if necessary.
    if ( $paged >= 2 || $page >= 2 )
        $title = "$title $sep " . sprintf( __( 'Page %s', 'coppeparque' ), max( $paged, $page ) );

    return $title;
}
add_filter( 'wp_title', 'coppeparque_wp_title', 10, 2 );

/**
 * Register two widget areas.
 *
 * @since Coppe Parque 1.0
 *
 * @return void
 */
function coppeparque_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Main Widget Area', 'coppeparque' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Appears in the footer section of the site.', 'coppeparque' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Secondary Widget Area', 'coppeparque' ),
        'id'            => 'sidebar-2',
        'description'   => __( 'Appears on posts and pages in the sidebar.', 'coppeparque' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'coppeparque_widgets_init' );

if ( ! function_exists( 'coppeparque_paging_nav' ) ) :
    /**
     * Display navigation to next/previous set of posts when applicable.
     *
     * @since Coppe Parque 1.0
     *
     * @return void
     */
    function coppeparque_paging_nav() {
        global $wp_query;

        // Don't print empty markup if there's only one page.
        if ( $wp_query->max_num_pages < 2 )
            return;
        ?>
        <nav class="navigation paging-navigation" role="navigation">
            <h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'coppeparque' ); ?></h1>
            <div class="nav-links">

                <?php if ( get_next_posts_link() ) : ?>
                    <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'coppeparque' ) ); ?></div>
                <?php endif; ?>

                <?php if ( get_previous_posts_link() ) : ?>
                    <div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'coppeparque' ) ); ?></div>
                <?php endif; ?>

            </div><!-- .nav-links -->
        </nav><!-- .navigation -->
    <?php
    }
endif;

if ( ! function_exists( 'coppeparque_post_nav' ) ) :
    /**
     * Display navigation to next/previous post when applicable.
     *
     * @since Coppe Parque 1.0
     *
     * @return void
     */
    function coppeparque_post_nav() {
        global $post;

        // Don't print empty markup if there's nowhere to navigate.
        $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
        $next     = get_adjacent_post( false, '', false );

        if ( ! $next && ! $previous )
            return;
        ?>
        <nav class="navigation post-navigation" role="navigation">
            <h1 class="screen-reader-text"><?php _e( 'Post navigation', 'coppeparque' ); ?></h1>
            <div class="nav-links">

                <?php previous_post_link( '%link', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'coppeparque' ) ); ?>
                <?php next_post_link( '%link', _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link', 'coppeparque' ) ); ?>

            </div><!-- .nav-links -->
        </nav><!-- .navigation -->
    <?php
    }
endif;

if ( ! function_exists( 'coppeparque_entry_meta' ) ) :
    /**
     * Print HTML with meta information for current post: categories, tags, permalink, author, and date.
     *
     * Create your own coppeparque_entry_meta() to override in a child theme.
     *
     * @since Coppe Parque 1.0
     *
     * @return void
     */
    function coppeparque_entry_meta() {
        if ( is_sticky() && is_home() && ! is_paged() )
            echo '<span class="featured-post">' . __( 'Sticky', 'coppeparque' ) . '</span>';

        if ( ! has_post_format( 'link' ) && 'post' == get_post_type() )
            coppeparque_entry_date();

        // Translators: used between list items, there is a space after the comma.
        $categories_list = get_the_category_list( __( ', ', 'coppeparque' ) );
        if ( $categories_list ) {
            echo '<span class="categories-links">' . $categories_list . '</span>';
        }

        // Translators: used between list items, there is a space after the comma.
        $tag_list = get_the_tag_list( '', __( ', ', 'coppeparque' ) );
        if ( $tag_list ) {
            echo '<span class="tags-links">' . $tag_list . '</span>';
        }

        // Post author
        if ( 'post' == get_post_type() ) {
            printf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
                esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                esc_attr( sprintf( __( 'View all posts by %s', 'coppeparque' ), get_the_author() ) ),
                get_the_author()
            );
        }
    }
endif;

if ( ! function_exists( 'coppeparque_entry_date' ) ) :
    /**
     * Print HTML with date information for current post.
     *
     * Create your own coppeparque_entry_date() to override in a child theme.
     *
     * @since Coppe Parque 1.0
     *
     * @param boolean $echo (optional) Whether to echo the date. Default true.
     * @return string The HTML-formatted post date.
     */
    function coppeparque_entry_date( $echo = true ) {
        if ( has_post_format( array( 'chat', 'status' ) ) )
            $format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'coppeparque' );
        else
            $format_prefix = '%2$s';

        $date = sprintf( '<span class="date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
            esc_url( get_permalink() ),
            esc_attr( sprintf( __( 'Permalink to %s', 'coppeparque' ), the_title_attribute( 'echo=0' ) ) ),
            esc_attr( get_the_date( 'c' ) ),
            esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
        );

        if ( $echo )
            echo $date;

        return $date;
    }
endif;

if ( ! function_exists( 'coppeparque_the_attached_image' ) ) :
    /**
     * Print the attached image with a link to the next attached image.
     *
     * @since Coppe Parque 1.0
     *
     * @return void
     */
    function coppeparque_the_attached_image() {
        /**
         * Filter the image attachment size to use.
         *
         * @since Coppe parque 1.0
         *
         * @param array $size {
         *     @type int The attachment height in pixels.
         *     @type int The attachment width in pixels.
         * }
         */
        $attachment_size     = apply_filters( 'coppeparque_attachment_size', array( 724, 724 ) );
        $next_attachment_url = wp_get_attachment_url();
        $post                = get_post();

        /*
         * Grab the IDs of all the image attachments in a gallery so we can get the URL
         * of the next adjacent image in a gallery, or the first image (if we're
         * looking at the last image in a gallery), or, in a gallery of one, just the
         * link to that image file.
         */
        $attachment_ids = get_posts( array(
            'post_parent'    => $post->post_parent,
            'fields'         => 'ids',
            'numberposts'    => -1,
            'post_status'    => 'inherit',
            'post_type'      => 'attachment',
            'post_mime_type' => 'image',
            'order'          => 'ASC',
            'orderby'        => 'menu_order ID'
        ) );

        // If there is more than 1 attachment in a gallery...
        if ( count( $attachment_ids ) > 1 ) {
            foreach ( $attachment_ids as $attachment_id ) {
                if ( $attachment_id == $post->ID ) {
                    $next_id = current( $attachment_ids );
                    break;
                }
            }

            // get the URL of the next image attachment...
            if ( $next_id )
                $next_attachment_url = get_attachment_link( $next_id );

            // or get the URL of the first image attachment.
            else
                $next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
        }

        printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
            esc_url( $next_attachment_url ),
            the_title_attribute( array( 'echo' => false ) ),
            wp_get_attachment_image( $post->ID, $attachment_size )
        );
    }
endif;

/**
 * Return the post URL.
 *
 * @uses get_url_in_content() to get the URL in the post meta (if it exists) or
 * the first link found in the post content.
 *
 * Falls back to the post permalink if no URL is found in the post.
 *
 * @since Coppe Parque 1.0
 *
 * @return string The Link format URL.
 */
function coppeparque_get_link_url() {
    $content = get_the_content();
    $has_url = get_url_in_content( $content );

    return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}

/**
 * Extend the default WordPress body classes.
 *
 * Adds body classes to denote:
 * 1. Single or multiple authors.
 * 2. Active widgets in the sidebar to change the layout and spacing.
 * 3. When avatars are disabled in discussion settings.
 *
 * @since Coppe Parque 1.0
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function coppeparque_body_class( $classes ) {
    if ( ! is_multi_author() )
        $classes[] = 'single-author';

    if ( is_active_sidebar( 'sidebar-2' ) && ! is_attachment() && ! is_404() )
        $classes[] = 'sidebar';

    if ( ! get_option( 'show_avatars' ) )
        $classes[] = 'no-avatars';

    return $classes;
}
add_filter( 'body_class', 'coppeparque_body_class' );

/**
 * Adjust content_width value for video post formats and attachment templates.
 *
 * @since Coppe Parque 1.0
 *
 * @return void
 */
function coppeparque_content_width() {
    global $content_width;

    if ( is_attachment() )
        $content_width = 724;
    elseif ( has_post_format( 'audio' ) )
        $content_width = 484;
}
add_action( 'template_redirect', 'coppeparque_content_width' );

/**
 * Add postMessage support for site title and description for the Customizer.
 *
 * @since Coppe Parque 1.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 * @return void
 */
function coppeparque_customize_register( $wp_customize ) {
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'coppeparque_customize_register' );

/**
 * Enqueue Javascript postMessage handlers for the Customizer.
 *
 * Binds JavaScript handlers to make the Customizer preview
 * reload changes asynchronously.
 *
 * @since Coppe Parque 1.0
 *
 * @return void
 */
function coppeparque_customize_preview_js() {
    wp_enqueue_script( 'coppeparque-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20130226', true );
}
add_action( 'customize_preview_init', 'coppeparque_customize_preview_js' );

//function populate_empresa($value){
//$args = array( 'post_type' => 'projeto', 'posts_per_page' => 10 );
//$loop = new WP_Query( $args );
//while ($loop->have_posts()):
//$loop->the_post();
//the_title();
//endwhile;
//
//    $choices = array(array('text'=>'Empresa', 'value'=>'Empresa'), array('text'=>'Empresa1', 'value'=>'Empresa1'), array('text'=>'Empresa2', 'value'=>'Empresa2'));
//
//return $choices;
//}
//add_filter("gform_field_value_empresa", "populate_empresa");

// update the '51' to the ID of your form
add_filter('gform_pre_render_1', 'populate_empresas');
function populate_empresas($form){
    foreach($form['fields'] as &$field){
        if($field['type'] != 'select' || strpos($field['cssClass'], 'populate-empresas') === false)
            continue;

        $posts = get_posts('post_type=empresa');
       $choices = array(array('text' => 'Selecione uma empresa', 'value' => 'null'));
        foreach($posts as $post){
            $acf = get_field_object('email', $post->ID);
            $choices[] = array('text' => $post->post_title, 'value' => $acf['value']);
        }
        $field['choices'] = $choices;
    }
    return $form;
}
add_filter('gform_pre_render_1', 'populate_oportunidade');
function populate_oportunidade($form){
    foreach($form['fields'] as &$field){
        if($field['type'] != 'select' || strpos($field['cssClass'], 'populate-oportunidade') === false)
            continue;

        $posts = get_posts('post_type=oportunidade');
        $choices = array(array('text' => 'Selecione uma oportunidade', 'value' => ''));
        foreach($posts as $post){
            $choices[] = array('text' => $post->post_title, 'value' => $post->post_title);
        }
        $field['choices'] = $choices;
    }
    return $form;
}

