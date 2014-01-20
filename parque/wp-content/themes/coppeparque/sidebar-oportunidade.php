<?php
$args = array('post_type' => 'empresa', 'posts_per_page' => -1);
$loop = new WP_Query($args);
$empresas = array();
$url_form = $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'];
if ($loop->have_posts()) :
    while ($loop->have_posts()) : $loop->the_post();
        $empresas[get_the_ID()] = get_the_title();
    endwhile;
endif;

if (is_active_sidebar('sidebar-2')) : ?>
    <div id="tertiary" class="sidebar-container" role="complementary">
        <div class="sidebar-inner">
            <div class="widget-area">
                <?php dynamic_sidebar('sidebar-2'); ?>
            </div>
            <!-- .widget-area -->
        </div>
        <!-- .sidebar-inner -->
    </div><!-- #tertiary -->
<?php endif; ?>
<div id="sidebar" class="span4">
    <div class="sidebar filter">
        <h2>Encontre Vagas</h2>
        <form action="<?php print $url_form ?>" method="post">
<!--            <input class="filter-palavra" name="w" type="text" placeholder="PALAVRA"/>-->
            <div class="input-append">
                <input class="filter-palavra" name="w" type="text" placeholder="PALAVRA" value="<?php print isset($_POST['w'])?$_POST['w']:'' ?>" />
                <button class="btn" type="submit">Ir!</button>
            </div>
        </form>
        <form action="<?php print $url_form ?>" method="post">
            <select class="filter-categoria" name="c">
                <option value="null">Categoria</option>
                <option value="Estágio" <?php print $_POST['c']=='Estágio'?'selected':'' ?>>Estágio</option>
                <option value="Emprego" <?php print $_POST['c']=='Emprego'?'selected':'' ?>>Emprego</option>
            </select>
        </form>
        <form action="<?php print $url_form ?>" method="post">
            <select class="filter-empresa" name="e">
                <option value="null">Empresa</option>
                <?php foreach ($empresas as $id => $empresa) { ?>
                    <option value="<?php print $id ?>" <?php print $_POST['e']==$id?'selected':'' ?>><?php print $empresa ?></option>
                <?php } ?>
            </select>
        </form>
        <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') { ?>
        <a href="<?php print $url_form ?>" title="Limpar filtro"><button class="btn btn-block">Limpar Filtro</button></a>
        <?php } ?>
    </div>
    <div class="sidebar">
        <a href="?page_id=33">
            <img src="<?php echo get_template_directory_uri(); ?>/images/banner-cadastro.jpg"/>
        </a>
    </div>
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