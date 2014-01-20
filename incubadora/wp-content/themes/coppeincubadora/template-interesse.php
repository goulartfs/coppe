<?php /* Template Name: Interesse */ ?>
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
                    $args = array('category_name' => 'interesse', 'posts_per_page' => 10);
                    $loop = new WP_Query($args);
                    ?>
                    <?php if ($loop->have_posts()) : ?>

                        <?php /* The loop */ ?>
                        <div class="canal-acordion">
                            <?php while ($loop->have_posts()) : $loop->the_post(); ?>
                                <div class="row video-content">
                                    <div class="span5 video-block">
                                        <div class="video-area">
                                            <?php if (get_field('embed_code')) { ?>
                                                <?php the_field('embed_code'); ?>
                                            <?php } elseif (get_field('video')) { ?>
                                                <iframe width="295"
                                                        src="//www.youtube.com/embed/<?php print getYoutubeIdFromUrl(get_field('video')); ?>?rel=0"
                                                        frameborder="0" allowfullscreen>
                                                </iframe>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="span7">
                                        <h2><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>

                                        <div class="row pos-info">
                                            <div class="span3">
                                                Por <?php the_author() ?>
                                            </div>
                                            <div class="span4 text-right data-post">
                                                <?php the_date('d/m/Y') ?>
                                            </div>
                                        </div>
                                        <?php
                                        global $more;
                                        $more = 0;
                                        ?>
                                        <div class="edital-content">
                                            <?php the_content('<span data-target="' . get_the_ID() . '">[+] MAIS</span>'); ?>
                                        </div>
                                        <?php
                                        global $more;
                                        $more = 1;
                                        ?>
                                        <div class="pos-more" rel="<?php the_ID() ?>">
                                            <?php the_content('', true, ''); ?>
                                        </div>
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
    <script>
        jQuery(function () {
            jQuery('.pos-more').hide();
            jQuery('.more-link').click(function (e) {
                e.preventDefault();
                if (!jQuery(this).hasClass('active')) {
                    jQuery('.pos-more').fadeOut();
                    jQuery('.more-link').removeClass('active');
                }
                jQuery('.pos-more[rel=' + jQuery(this).find('span').data('target') + ']').fadeToggle();
                jQuery(this).toggleClass('active');
            })
        })
    </script>

<?php get_sidebar(); ?>
<?php get_footer(); ?>