<?php /* Template Name: Parceiros e Filiações */ ?>
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
            <?php if (is_page() ) : ?>
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
                                if(function_exists('bcn_display'))
                                {
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
            <div class="span12">
                <?php if (have_posts()) : ?>

                    <?php /* The loop */ ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <?php get_template_part('content', get_post_format()); ?>
                    <?php endwhile; ?>

                    <?php coppeparque_paging_nav(); ?>

                <?php else : ?>
                    <?php get_template_part('content', 'none'); ?>
                <?php endif; ?>

                <?php
                $args = array( 'post_type' => 'parceiros', 'tipo'=>'Parceiro', 'posts_per_page' => 10 );
                $loop = new WP_Query( $args );
                ?>
                <script>
                    jQuery(function(){
//                        jQuery('.projeto-content').not(':first').hide();
                        jQuery('h2').click(function(){
                            if(jQuery(this).next().is(':hidden')){
                                jQuery('.projeto-content').slideUp();
                            }
                            jQuery(this).nextUntil('h2').slideToggle();
                        })
                    })
                </script>
                <?php if ($loop->have_posts()) : ?>

                    <?php /* The loop */ ?>
                    <div class="projetos-acordion">
                        <?php while ($loop->have_posts()) : $loop->the_post(); ?>
                            <?php //get_template_part('content', get_post_format()); ?>
                            <h2><?php the_title() ?></h2>
                            <div class="projeto-content">
                                <div class="row">
                                    <div class="span2"><?php the_post_thumbnail(array(100,100), array('class' => 'thumbnail text-center')) ?></div>
                                    <div class="span10">
                                        <?php the_excerpt() ?>
                                        <?php if(get_field('link')){ ?>
                                            <a href="<?php the_field('link') ?>" target="_blank"><?php the_field('link') ?></a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>

                    <?php coppeparque_paging_nav(); ?>

                <?php else : ?>
                    <?php //get_template_part('content', 'none'); ?>
                <?php endif; ?>

            </div>
        </div>
    </div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>