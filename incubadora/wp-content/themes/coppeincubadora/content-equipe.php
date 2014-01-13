<div class="usquare_block">
    <?php if($user->profileimage){ ?>
        <img src="<?php echo $upload_dir['baseurl'] . $user->profileimage; ?>"
             class="usquare_square" alt="" width="140" height="140"/>
    <?php } else{ ?>
        <img src="<?php echo get_template_directory_uri(); ?>/images/perfil.png"
             class="usquare_square" alt="" width="140" height="140"/>
    <?php } ?>

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
            <div id="usquare-more-link" class="text-right">
                <span>[+] Mais</span>
            </div>
            <ul class="social_background inline">
                <?php if ($user->user_email): ?>
                    <li><a href="mailto:<?php print $user->user_email ?>" target="_blank"><img
                            src="<?php echo get_template_directory_uri(); ?>/images/bt-email.png"
                            alt="E-mail"/></a></li><?php endif; ?>
                <?php if ($user->facebook): ?>
                    <li><a href="<?php print $user->facebook ?>" target="_blank"><img
                            src="<?php echo get_template_directory_uri(); ?>/images/icon_facebook.png"
                            alt="Facebook"/></a></li><?php endif; ?>
                <?php if ($user->google): ?>
                    <li><a href="<?php print $user->google ?>" target="_blank"><img
                            src="<?php echo get_template_directory_uri(); ?>/images/icon_google.png"
                            alt="Google+"/></a></li><?php endif; ?>
                <?php if ($user->twitter): ?>
                    <li><a href="<?php print $user->twitter ?>" target="_blank"><img
                            src="<?php echo get_template_directory_uri(); ?>/images/icon_twitter.png"
                            alt="Twitter"/></a></li><?php endif; ?>
                <?php if ($user->linkedin): ?>
                    <li><a href="<?php print $user->linkedin ?>" target="_blank"><img
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
            <?php print $user->sobre ?>
        </div>
    </div>
    <!-- usquare_block_extended -->
</div><!-- usquare_block -->