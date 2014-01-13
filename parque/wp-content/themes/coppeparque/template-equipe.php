<?php /* Template Name: Equipe */ ?>
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
                // The Query
                $args = array('meta_key' => 'is_equipe', 'meta_value' => '1');
                $user_query = new WP_User_Query($args);
                $upload_dir = wp_upload_dir();

                if (!empty($user_query->results)) {
                    foreach ($user_query->results as $user) {
                        $categorias[$user->categoria][] = $user->id;
                    }
                }

                // User Loop
                ?>
                <?php
                foreach ($categorias as $chave => $valor) {
                    ?>
                    <h2 class="flit"><?php print $chave ?></h2>
                    <div class="equipe-block">
                        <div class="usquare_module_wrapper">

                            <div class="usquare_module_shade"></div>
                            <?php
                            $user_query = new WP_User_Query(array('include' => $valor));
                            foreach ($user_query->results as $user) {
                                //                            var_dump($user);
                                include('content-equipe.php');
                            }
                            ?>
                            <div class="clear"></div>
                        </div>
                        <div class="clearfix "></div>
                    </div>
                <?php
                }
                ?>
                <!-- usquare_module_wrapper -->
            </div>
        </div>
    </div>
    <script>
        jQuery(function () {
            jQuery('.equipe-block').hide();
            jQuery('.content-area h2.flit').click(function () {
                jQuery(this).nextUntil('h2.flit').slideToggle();
                jQuery(this).toggleClass('active');
            }).css('cursor', 'pointer').css('margin-bottom', '0');
        })
    </script>

<?php get_sidebar(); ?>
<?php get_footer(); ?>