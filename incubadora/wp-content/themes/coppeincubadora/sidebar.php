<?php
/**
 * The sidebar containing the secondary widget area
 *
 * Displays on posts and pages.
 *
 * If no active widgets are in this sidebar, hide it completely.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
	<div id="tertiary" class="sidebar-container" role="complementary">
		<div class="sidebar-inner">
			<div class="widget-area">
				<?php dynamic_sidebar( 'sidebar-2' ); ?>
			</div><!-- .widget-area -->
		</div><!-- .sidebar-inner -->
	</div><!-- #tertiary -->
<?php endif; ?>
                <div id="sidebar" class="span4">
                    <div class="sidebar">
                        <h2>Notícias do Parque</h2>
                        <div class="widget">
                            <span class="sidebar-title">Últimas Notícias</span>
                            <ul>
                                <li><a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing</a></li>
                                <li><a href="#">Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</a></li>
                            </ul>
                        </div>
                        <div class="more text-right">
                            <a href="#">[+] Mais</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>