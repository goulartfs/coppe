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
define('DB_NAME', 'coppe_incubadora');

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
define('AUTH_KEY',         '(T0}CpHMf~7;)*04XrK`7BZ`;82*~r ?SO^fYNm_v8_eNuFc%l>+Oz&3*$7RQ>SZ');
define('SECURE_AUTH_KEY',  '8/~%tW%t2;Q0:3}Xj_0h5}<d63ULyq,w*~WyXX|Qk9Mg[mz(u0]Aj`l0-QQU5c,|');
define('LOGGED_IN_KEY',    'orX#B)uYtMCw[kSCy{EW;UN[/QR9i&p7`RIv7)>Fx;br{ZTwPsB0#qD5&=-Y&CH-');
define('NONCE_KEY',        'u^IP/[I{}A(kw7pHgC!f+l.~{|XNLVlGM$%02Z;%-j.-Ip3_p{BfmA)zR0Fb,j9$');
define('AUTH_SALT',        'vzxrv-iwGt/c$1/6YZ<BZ$i/0H-P|,8f=m]!2iUF+ahdOH:LqQ2G6bR)sUPR_n>!');
define('SECURE_AUTH_SALT', 'AxYh)g?K58kF)k8_/T#0e;Kh4TMbcEf!1@YJ!(wpTn}`~ctQ9f[ G?`hven*u/n}');
define('LOGGED_IN_SALT',   'r-{e3lU8qE>W>pJN<[Sb$H3dtt0[SJHZN3Jl:4h^c{>s_i@GlkA{4kzFd3~YN~3G');
define('NONCE_SALT',       '=SKMaJDRh9~m3e%KML$~biqvQ/mGrMu>vSPpD]ock$HLc9@NCKP><]VT~m|&M3]s');

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
