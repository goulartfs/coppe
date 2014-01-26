<?php /* Template Name: Empresas Residentes */ ?>
<?php
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
                <?php
                $args = array('post_type' => 'empresa', 'posts_per_page' => 10, 'meta_key' => 'is_visible', 'meta_value' => '1');
                $loop = new WP_Query($args);
                // The Query
                // User Loop
                ?>
                <?php while ($loop->have_posts()) : $loop->the_post(); ?>
                    <h2 class="flit"><?php print $chave ?></h2>
                    <div class="equipe-block">
                        <div class="usquare_module_wrapper">

                            <div class="usquare_module_shade"></div>
                            <?php include('content-residente.php'); ?>
                            <div class="clear"></div>
                        </div>
                        <div class="clearfix "></div>
                    </div>
                <?php
                endwhile;
                ?>
                <!-- usquare_module_wrapper -->
            </div>
        </div>
    </div>
    <script>
        jQuery(function () {
//            jQuery('.equipe-block').hide();
//            jQuery('.content-area h2.flit').click(function () {
//                jQuery(this).nextUntil('h2.flit').slideToggle();
//                jQuery(this).toggleClass('active');
//            }).css('cursor', 'pointer');
//        })
    </script>

<?php get_sidebar(); ?>
<?php get_footer(); ?>