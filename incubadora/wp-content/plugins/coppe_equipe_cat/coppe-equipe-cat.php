<?php
/*
Plugin Name: Coppe - Equipe Categoria
Plugin URI: http://fsynthis.com.br
Description: Ordernar a exibição de categorias de Equipe
Version: 1.0
Author: Filipe G. Synthis
Author URI: http://fsynthis.com.br
License: GPLv2
*/
/*
 *      Copyright 2012 Filipe G. Synthis <contato@fsynthis.com.br>
 *
 *      This program is free software; you can redistribute it and/or modify
 *      it under the terms of the GNU General Public License as published by
 *      the Free Software Foundation; either version 3 of the License, or
 *      (at your option) any later version.
 *
 *      This program is distributed in the hope that it will be useful,
 *      but WITHOUT ANY WARRANTY; without even the implied warranty of
 *      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *      GNU General Public License for more details.
 *
 *      You should have received a copy of the GNU General Public License
 *      along with this program; if not, write to the Free Software
 *      Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 *      MA 02110-1301, USA.
 */

// Registamos a função para correr na ativação do plugin
register_activation_hook(__FILE__, 'cec_install_hook');

function cec_install_hook()
{

    if (version_compare(PHP_VERSION, '5.2.1', '<')
        or version_compare(get_bloginfo('version'), '3.3', '<')
    ) {
        deactivate_plugins(basename(__FILE__));
    }

    add_option('ordem-equipe-categoria', '0');
}

// create custom plugin settings menu
add_action('admin_menu', 'baw_create_menu');

function baw_create_menu()
{

    //create new top-level menu
    add_menu_page('Coppe Plugin Configurações', 'Coppe', 'administrator', __FILE__, 'baw_settings_page', plugins_url('/images/icon.png', __FILE__));

    //call register settings function
    add_action('admin_init', 'register_mysettings');
}


function register_mysettings()
{
    //register our settings
    register_setting('baw-settings-group', 'coppe-cat-order');
}

function baw_settings_page()
{
    ?>
    <div class="wrap">
        <h2>Coppe - Ordernar Categoria de Equipe</h2>

        <form method="post" action="options.php">
            <?php settings_fields('baw-settings-group'); ?>
            <?php do_settings_sections('baw-settings-group'); ?>
            <?php
            $args = array('meta_key' => 'is_equipe', 'meta_value' => '1');
            $user_query = new WP_User_Query($args);

            if (!empty($user_query->results)) {
                foreach ($user_query->results as $user) {
                    $categorias[$user->categoria][] = $user->id;
                }
            }

            $opcao = get_option('coppe-cat-order');
            ?>
            <table class="form-table" style="width: 350px;">
                <tr>
                    <th>Categoria</th>
                    <th>Ordem de Exibição</th>
                </tr>
            <?php
            foreach ($categorias as $cat => $inutil) {
                ?>
                    <tr valign="top">
                        <th scope="row"><?php print ucfirst($cat); ?></th>
                        <td><input type="text" name="coppe-cat-order[<?php print $cat ?>]"
                                   value="<?php print $opcao[$cat] ?>"/></td>
                    </tr>
            <?php
            }
            ?>
                </table>
            <?php submit_button(); ?>

        </form>
    </div>
<?php } ?>