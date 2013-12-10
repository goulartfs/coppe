<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

<!--		</div> #main 
		<footer id="colophon" class="site-footer" role="contentinfo">
			<?php get_sidebar( 'main' ); ?>

			<div class="site-info">
				<?php do_action( 'coppeparque_credits' ); ?>
				<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'coppeparque' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'coppeparque' ); ?>"><?php printf( __( 'Proudly powered by %s', 'coppeparque' ), 'WordPress' ); ?></a>
			</div> .site-info 
		</footer> #colophon 
	</div> #page 

	
</body>
</html>-->
<div class="content-pos">
                    <div class="container">
                        <div class="row">
                            <div class="span12">
                                <form class="form-inline" action="#" method="post">
                                    <div class="input-prepend input-append">
                                        <label class="add-on" for="input-email">Receba nossa newsletter</label>
                                        <input id="input-email" class="span6" type="text" name="email" placeholder="Ex: email@email.com.br"/>
                                        <button class="btn" type="button">Assinar</button>
                                    </div>
                                </form>
                            </div>
                            <div class="span4 text-right">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/links-sociais.jpg" alt="Redes Sociais"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="footer">
                <div class="footer-top">
                    <div class="container">
                        <div class="row">
                            <div class="span16 text-center">
                                <p>
                                    UFRJ - Caixa Postal 68568 - CEP: 21941-972 Rio de Janeiro - RJ - Telefone: +55 (21) 3733-1951 / FAX +55 (21) 3867-6840
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom">
                    <div class="container">
                        <div class="row">
                            <div class="span3">
                                <ul>
                                    <li>O Parque</li>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                </ul>
                            </div>
                            <div class="span3">
                                <ul>
                                    <li>Residentes</li>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                </ul>
                            </div>
                            <div class="span4">
                                <ul>
                                    <li>Como se instalar</li>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                </ul>
                            </div>
                            <div class="span3">
                                <ul>
                                    <li>Notícias</li>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                </ul>
                            </div>
                            <div class="span3">
                                <ul>
                                    <li>Sala de Imprensa</li>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php wp_footer(); ?>
</body>
</html>