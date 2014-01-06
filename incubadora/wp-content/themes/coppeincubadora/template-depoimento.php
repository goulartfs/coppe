<?php /* Template Name: Depoimentos */ ?>
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
                <div class="wrapper">
                    <?php if (have_posts()) : ?>

                        <?php /* The loop */ ?>
                        <?php while (have_posts()) : the_post(); ?>
                            <?php get_template_part('content', get_post_format()); ?>
                        <?php endwhile; ?>

                        <?php coppeincubadora_paging_nav(); ?>

                    <?php else : ?>
                        <?php get_template_part('content', 'none'); ?>
                    <?php endif; ?>

                    <?php
                    $args = array('post_type' => 'depoimentos', 'posts_per_page' => -1);
                    $loop = new WP_Query($args);
                    ?>
                    <?php if ($loop->have_posts()) : ?>

                        <?php /* The loop */ ?>
                        <div class="depoimento-acordion">
                            <?php while ($loop->have_posts()) : $loop->the_post(); ?>
                                <div class="depoimento-block">
                                    <div class="depoimento-content">
                                        <?php the_post_thumbnail(array(130, 130), array('class' => 'alignleft thumbnail text-center')) ?>
                                        <?php the_content() ?>
                                    </div>
                                    <div class="pos-content">
                                        <div class="depoente"><?php the_title() ?></div>
                                        <?php the_field('cargo') ?>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>

                        <?php coppeincubadora_paging_nav(); ?>

                    <?php else : ?>
                        <?php //get_template_part('content', 'none'); ?>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>