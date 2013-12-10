<?php
/** 
 * As configurações básicas do WordPress.
 *
 * Esse arquivo contém as seguintes configurações: configurações de MySQL, Prefixo de Tabelas,
 * Chaves secretas, Idioma do WordPress, e ABSPATH. Você pode encontrar mais informações
 * visitando {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. Você pode obter as configurações de MySQL de seu servidor de hospedagem.
 *
 * Esse arquivo é usado pelo script ed criação wp-config.php durante a
 * instalação. Você não precisa usar o site, você pode apenas salvar esse arquivo
 * como "wp-config.php" e preencher os valores.
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar essas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'coppe_parque');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'root');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', '');

/** nome do host do MySQL */
define('DB_HOST', 'localhost');

/** Conjunto de caracteres do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8');

/** O tipo de collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Você pode alterá-las a qualquer momento para desvalidar quaisquer cookies existentes. Isto irá forçar todos os usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '_ie_BRtW>u&=|^Y(lu(/-K[/o>.T>(7tc^)U&{JDmkM5r:R]okSD<CS5U_%z#*v+');
define('SECURE_AUTH_KEY',  '|8irRN:2/Zd7}uYQ6Tb+1mg<GAKs-{}Wj#UVw9F0-v(9U?/z,|DJfj|uF+CV<X[$');
define('LOGGED_IN_KEY',    'bw#+Oo*w`uBm3rt}D=.Y,ys}7X~+|CY!G S9K`%(kNSo9-!_h37i]&}I,2kle9Cv');
define('NONCE_KEY',        'kZl5QW[;2?]fPb%:2q?z{$7XCBI4SAq[>{|:Gw(~57*d|MVFwyF^_zO9D5`*fd+x');
define('AUTH_SALT',        'n(zBL3BGJg8@5uKE<s^?gd=VY7Yq/Q6c,$hDL0o_3H+V |b7C&Q=i}+q:3TfH$,)');
define('SECURE_AUTH_SALT', '~_CK=aN;`J6F)+-8}1yu n}o*`kH589o-tCwhPE+i4~+Nx5hwr7K4KWSJc$#v]|o');
define('LOGGED_IN_SALT',   '{I+(%qpAI:F|O3#Gk;211[QfPLw<YzX2K3oz?E,f%`p rpU~7>3)3=KIN(^o(Iu=');
define('NONCE_SALT',       'se_+]A%mn+]~&f&S}0uSNC,w:3qvk2[IGeoA+|?OdZDf=Xx8I*,*YW?C(PeSjRa{');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der para cada um um único
 * prefixo. Somente números, letras e sublinhados!
 */
$table_prefix  = 'wp_';

/**
 * O idioma localizado do WordPress é o inglês por padrão.
 *
 * Altere esta definição para localizar o WordPress. Um arquivo MO correspondente ao
 * idioma escolhido deve ser instalado em wp-content/languages. Por exemplo, instale
 * pt_BR.mo em wp-content/languages e altere WPLANG para 'pt_BR' para habilitar o suporte
 * ao português do Brasil.
 */
define('WPLANG', 'pt_BR');

/**
 * Para desenvolvedores: Modo debugging WordPress.
 *
 * altere isto para true para ativar a exibição de avisos durante o desenvolvimento.
 * é altamente recomendável que os desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
	
/** Configura as variáveis do WordPress e arquivos inclusos. */
require_once(ABSPATH . 'wp-settings.php');
