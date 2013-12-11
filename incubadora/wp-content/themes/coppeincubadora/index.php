<?php
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
<!--                                <ul class="breadcrumb">
                                    <li><a href="#">Home</a> <span class="divider">/</span></li>
                                    <li><a href="#">Library</a> <span class="divider">/</span></li>
                                    <li class="active">Data</li>
                                </ul>-->
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

                                <?php coppeincubadora_paging_nav(); ?>

                            <?php else : ?>
                                <?php get_template_part('content', 'none'); ?>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>

                <?php get_sidebar(); ?>
                <?php get_footer(); ?>