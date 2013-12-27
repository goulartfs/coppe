<?php /* Template Name: Equipe */ ?>
<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
get_header();
?>
<div id="content">
<?php if (!is_home() && !is_search()) { ?>
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <?php if (is_page()) : ?>
                <div class="content-header">
                    <div class="container">
                        <div class="row">
                            <div class="span16">
                                <h1><?php the_title() ?></h1>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="content-bread">
                <div class="container">
                    <div class="row">
                        <div class="span16">
                            <div class="breadcrumb">
                                <?php
                                if (function_exists('bcn_display')) {
                                    bcn_display();
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
<?php } ?>
    <div class="content">
    <div class="container">
    <div class="row">
    <div class="span12">
        <div class="row">
            <div class="span12 content-area">
                <?php if (have_posts()) : ?>

                    <?php /* The loop */ ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <?php get_template_part('content', get_post_format()); ?>
                    <?php endwhile; ?>

                    <?php coppeparque_paging_nav(); ?>

                <?php else : ?>
                    <?php get_template_part('content', 'none'); ?>
                <?php endif; ?>
                <div>
                    <?php
                    // The Query
                    $args = array('meta_key' => 'is_equipe', 'meta_value' => '1');
                    $user_query = new WP_User_Query($args);
                    $upload_dir = wp_upload_dir();

                    // User Loop
                    ?>
                </div>
                <div class="usquare_module_wrapper">

                    <div class="usquare_module_shade"></div>
                    <?php
                    if (!empty($user_query->results)) {
                        foreach ($user_query->results as $user) {
//                            var_dump($user);
                            ?>
                            <div class="usquare_block">
                                <img src="<?php echo $upload_dir['baseurl'] . $user->profileimage; ?>"
                                     class="usquare_square" alt="" width="140" height="140"/>

                                <div class="usquare_square usquare_square_bg1">
                                    <div class="usquare_square_text_wrapper">

                                        <div class="clear"></div>
                                        <h2><?php print $user->display_name ?></h2>
                                        <span><?php print $user->cargo ?></span>

                                        <div class="short-description">
                                            <p>
                                                <?php print $user->description ?>
                                            </p>
                                        </div>
                                        <ul class="social_background inline">
                                            <?php if ($user->user_email): ?>
                                                <li><a href="mailto:<?php print $user->user_email ?>"><img
                                                        src="<?php echo get_template_directory_uri(); ?>/images/bt-email.jpg"
                                                        alt="social"/></a></li><?php endif; ?>
                                            <?php if ($user->facebook): ?>
                                                <li><a href="<?php print $user->facebook ?>"><img
                                                        src="<?php echo get_template_directory_uri(); ?>/images/icon_facebook.png"
                                                        alt="social"/></a></li><?php endif; ?>
                                            <?php if ($user->google): ?>
                                                <li><a href="<?php print $user->google ?>"><img
                                                        src="<?php echo get_template_directory_uri(); ?>/images/icon_google.png"
                                                        alt="social"/></a></li><?php endif; ?>
                                            <?php if ($user->twitter): ?>
                                                <li><a href="<?php print $user->twitter ?>"><img
                                                        src="<?php echo get_template_directory_uri(); ?>/images/icon_twitter.png"
                                                        alt="social"/></a></li><?php endif; ?>
                                            <?php if ($user->linkedin): ?>
                                                <li><a href="<?php print $user->linkedin ?>"><img
                                                        src="<?php echo get_template_directory_uri(); ?>/images/icon_linkedin.png"
                                                        alt="social"/></a></li><?php endif; ?>
                                        </ul>
                                        <div class="clear"></div>
                                    </div>
                                    <!-- usquare_square_wrapper -->
                                </div>
                                <!--div    usquare_square -->
                                <div class="usquare_block_extended usquare_square_bg1">
                                    <a href="#" class="close"><img
                                            src="<?php echo get_template_directory_uri(); ?>/images/close.jpg"
                                            alt="close"/></a>

                                    <div class="clear"></div>
                                    <span class="bold">info:</span>

                                    <div class="usquare_about">
                                        <?php print $user->sobre ?>
                                    </div>
                                </div>
                                <!-- usquare_block_extended -->
                            </div><!-- usquare_block -->
                        <?php
                        }
                    } else {
                        echo 'Nenhum membro encontrado.';
                    }
                    ?>

                    <div class="clear"></div>
                </div>
                <!-- usquare_module_wrapper -->
            </div>
        </div>
    </div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>