<?php /* Template Name: Oportunidades */ ?>
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
$url_form = $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'];
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

                        <?php coppeparque_paging_nav(); ?>

                    <?php else : ?>
                        <?php get_template_part('content', 'none'); ?>
                    <?php endif; ?>

                    <?php
                    $args = array('post_type' => 'oportunidade', 'posts_per_page' => 10);

                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        if (isset($_POST['w']) && $_POST['c']!='null') {
                            $args = array('post_type' => 'oportunidade', 'posts_per_page' => 10, 's' => $_POST['w']);
                            $filter_term = "Palavra";
                            $filter_value=$_POST['w'];
                            $filtered = true;
                        }
                        if (isset($_POST['c']) && $_POST['c']!='null') {
                            $args = array('post_type' => 'oportunidade', 'posts_per_page' => 10, 'meta_key' => 'tipo', 'meta_value' => $_POST['c']);
                            $filter_term = "Categoria";
                            $filter_value=$_POST['c'];
                            $filtered = true;
                        }
                        if (isset($_POST['e']) && $_POST['e']!='null') {
                            $args = array('post_type' => 'oportunidade', 'posts_per_page' => 10, 'meta_key' => 'empresa_residente', 'meta_value' => $_POST['e']);
                            $filter_term = "Empresa";
                            $filter_value = get_post($_POST['e']);
                            $filter_value = $filter_value->post_title;
                            $filtered = true;
                        }
                    }

                    $loop = new WP_Query($args);
                    if ($loop->have_posts()) :
                        ?>
                        <h2 class="first">Vagas Oferecidas</h2>
                        <?php if($filtered){ ?>
                        <h4>Filtrando por <em><?php print $filter_term ?></em>: <strong>"<em><?php print $filter_value ?></em>"</strong></h4>
                        <?php } ?>

                        <div class="oportunidade-block">
                            <?php /* The loop */ ?>
                            <?php while ($loop->have_posts()) : $loop->the_post(); ?>
                                <div class="vaga-item">
                                    <?php
                                    $vaga['title'] = get_the_title();
                                    $vaga['content'] = get_the_content();

                                    /*
                                    *  Show selected image cropped to a specific size
                                    *  Return value = ID ( allows us to get more data about the image )
                                    *  This example uses the WP function: wp_get_attachment_image - http://codex.wordpress.org/Function_Reference/wp_get_attachment_image
                                    */

                                    //                                $attachment_id = get_field('field_name');
                                    //                                $size = "full"; // (thumbnail, medium, large, full or custom size)
                                    //                                wp_get_attachment_image( $img['id'], $size );
                                    ?>
                                    <?php $post = get_field('empresa_residente'); ?>
                                    <?php setup_postdata($post); ?>
                                    <?php $img = get_field('logomarca'); ?>
                                    <?php //print wp_get_attachment_image( $img['id'], 'full' ); ?>
                                    <div class="row">
                                        <div class="span3">
                                            <?php if ($img): ?>
                                                <a class="thumbnail" href="<?php the_field('link'); ?>" target="_blank">
                                                    <img
                                                        src="<?php print $img['url'] ?>"
                                                        alt="<?php the_title(); ?>"/>
                                                </a>
                                            <?php else: ?>
                                                <a class="thumbnail">
                                                    <img src="http://placehold.it/148x103&text=blank"/>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                        <div class="span9">
                                            <?php if (get_the_title()): ?>
                                                <h2 class="flit"><?php the_title() ?></h2>
                                            <?php endif; ?>

                                            <div class="vaga-block">
                                                <h3><?php print $vaga['title'] ?></h3>

                                                <div class="vaga-content">
                                                    <?php print $vaga['content'] ?>
                                                    <div class="text-right">
                                                        <a href="?page_id=382&er=<?php print urlencode(get_the_title()) ?>&o=<?php print urlencode($vaga['title']) ?>&e=<?php print urlencode(get_field('email')) ?>">
                                                            <button class="btn btn-info">Cadastre-se</button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>

                            <?php coppeparque_paging_nav(); ?>
                        </div>

                    <?php else : ?>
                        <h2 class="first">Nenhuma oportunidade encontrada</h2>
                        <p>
                            Tente efetuar uma outra pesquisa.
                        </p>
                        <p>
                            <a href="<?php print $url_form ?>"><button class="btn btn-primary">Limpar filtro</button></a>
                        </p>
                    <?php
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
    <script>
        jQuery(function () {
            jQuery('.vaga-content').hide();
            jQuery('.vaga-item h2').click(function () {
                jQuery(this).next('.vaga-block').find('.vaga-content').slideToggle();
                jQuery(this).toggleClass('active');
            }).css('cursor', 'pointer');
        })
    </script>
<?php get_sidebar('oportunidade'); ?>
<?php get_footer(); ?>