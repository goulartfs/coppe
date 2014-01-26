<div class="usquare_block">
    <?php $img = get_field('logomarca'); ?>
    <?php if($img['url']){ ?>
    <img src="<?php echo $upload_dir['baseurl'] . $img['url']; ?>"
         class="usquare_square" alt="" width="140" height="140"/>
    <?php } else{ ?>
    <img src="<?php echo get_template_directory_uri(); ?>/images/perfil.png"
         class="usquare_square" alt="" width="140" height="140"/>
    <?php } ?>

    <div class="usquare_square usquare_square_bg1">
        <div class="usquare_square_text_wrapper">

            <div class="clear"></div>
            <h2><?php print get_the_title() ?></h2>
            <span><?php print get_field('categoria') ?></span>

            <div class="short-description">
                <p>
                    <?php print get_the_excerpt() ?>
                </p>
            </div>
            <div id="usquare-more-link" class="text-right">
                <span>[+] Mais</span>
            </div>
            <ul class="social_background inline">
                <?php if (get_field('email')): ?>
                    <li><a href="mailto:<?php print get_field('email') ?>" target="_blank"><img
                            src="<?php echo get_template_directory_uri(); ?>/images/bt-email.jpg"
                            alt="E-mail"/></a></li><?php endif; ?>
                <?php if (get_field('facebook')): ?>
                    <li><a href="<?php print get_field('facebook') ?>" target="_blank"><img
                            src="<?php echo get_template_directory_uri(); ?>/images/icon_facebook.png"
                            alt="Facebook"/></a></li><?php endif; ?>
                <?php if (get_field('google')): ?>
                    <li><a href="<?php print get_field('google') ?>" target="_blank"><img
                            src="<?php echo get_template_directory_uri(); ?>/images/icon_google.png"
                            alt="Google+"/></a></li><?php endif; ?>
                <?php if (get_field('twitter')): ?>
                    <li><a href="<?php print get_field('twitter') ?>" target="_blank"><img
                            src="<?php echo get_template_directory_uri(); ?>/images/icon_twitter.png"
                            alt="Twitter"/></a></li><?php endif; ?>
                <?php if (get_field('linkedin')): ?>
                    <li><a href="<?php print get_field('linkedin') ?>" target="_blank"><img
                            src="<?php echo get_template_directory_uri(); ?>/images/icon_linkedin.png"
                            alt="Linkedin"/></a></li><?php endif; ?>
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
            <?php print get_the_content() ?>
        </div>
    </div>
    <!-- usquare_block_extended -->
</div><!-- usquare_block -->