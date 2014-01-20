<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php if (has_post_thumbnail() && !post_password_required()) : ?>
            <div class="entry-thumbnail">
                <?php //the_post_thumbnail(); ?>
            </div>
        <?php endif; ?>

        <?php //if ( is_home() ) : ?>
        <?php if (is_single()) : ?>
            <h2 class="entry-title"><?php the_title(); ?></h2>
            <div class="row pos-info">
                <div class="span6">
                    Por <?php the_author() ?>
                </div>
                <div class="span6 text-right data-post">
                    <?php the_date('d/m/Y') ?><?php edit_post_link(__('Editar postagem', 'coppeincubadora'), ' - <span class="edit-link">', '</span>'); ?>
                </div>
            </div>
        <?php else : ?>
            <?php if (!is_page()) : ?>
                <h2 class="entry-title">
                    <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                </h2>
            <?php endif; ?>
        <?php endif; // is_single() ?>
        <?php //endif; // is_single() ?>


        <div class="entry-meta">
            <?php //coppeincubadora_entry_meta(); ?>
        </div>
        <!-- .entry-meta -->
    </header>
    <!-- .entry-header -->

    <?php if (is_search()) : // Only display Excerpts for Search ?>
        <div class="entry-summary">
            <?php the_excerpt(); ?>
        </div><!-- .entry-summary -->
    <?php else : ?>
        <div class="entry-content full">
            <div class="video-area">
                <?php if (get_field('embed_code')) { ?>
                    <?php the_field('embed_code'); ?>
                <?php } elseif (get_field('video')) { ?>
                    <iframe width="100%" height="400px"
                            src="//www.youtube.com/embed/<?php print getYoutubeIdFromUrl(get_field('video')); ?>?rel=0"
                            frameborder="0" allowfullscreen></iframe>
                <?php } ?>
            </div>

            <br><br>
            <?php the_content(__('Continue reading <span class="meta-nav">&rarr;</span>', 'coppeincubadora')); ?>
            <?php wp_link_pages(array('before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'coppeincubadora') . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>')); ?>
            <div>
                <?php //print do_shortcode('[social_share/]') ?>
            </div>
        </div><!-- .entry-content -->
    <?php endif; ?>

    <footer class="entry-meta">
        <?php comments_template(); ?>
        <?php if (comments_open() && !is_single()) : ?>
            <div class="comments-link">
                <?php comments_popup_link('<span class="leave-reply">' . __('Leave a comment', 'coppeincubadora') . '</span>', __('One comment so far', 'coppeincubadora'), __('View all % comments', 'coppeincubadora')); ?>
            </div> .comments-link
        <?php endif; // comments_open() ?>

        <?php if (is_single() && get_the_author_meta('description') && is_multi_author()) : ?>
            <?php get_template_part('author-bio'); ?>
        <?php endif; ?>
    </footer>
    <!-- .entry-meta -->
</article><!-- #post -->
