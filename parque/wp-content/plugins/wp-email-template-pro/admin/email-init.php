<?php
/**
 * Call this function when plugin is deactivated
 */
function wp_email_template_deactivate(){
	
	delete_transient("a3rev_wp_email_template_update_info");
	$respone_api = __('Connection Error! Could not reach the a3API on Amazon Cloud, the network may be busy. Please try again in a few minutes.', 'wp_email_template');
	$options = array(
		'method' 	=> 'POST', 
		'timeout' 	=> 45, 
		'body' 		=> array(
			'act'			=> 'deactivate',
			'ssl'			=> get_option('a3rev_auth_wp_email_template'),
			'plugin' 		=> get_option('a3rev_wp_email_template_plugin'),
			'domain_name'	=> $_SERVER['SERVER_NAME'],
			'address_ip'	=> $_SERVER['SERVER_ADDR'],
		) 
	);
	$server_a3 = base64_decode("aHR0cDovL2EzYXBpLmNvbS9hdXRoYXBpL2luZGV4LnBocA==");
	$raw_response = wp_remote_request( $server_a3, $options);
	if ( !is_wp_error( $raw_response ) && 200 == $raw_response['response']['code']) {
		$respone_api = $raw_response['body'];
	}
	
	delete_option ( 'a3rev_pin_wp_email_template' );
	delete_option ( 'a3rev_auth_wp_email_template' );
}

function wp_email_template_install(){
	update_option('a3rev_wp_email_template_version', '1.1.1');
	
	// Set Settings Default from Admin Init
	global $wp_email_template_admin_init;
	$wp_email_template_admin_init->set_default_settings();
	
	delete_transient("a3rev_wp_email_template_update_info");
	
	update_option('a3rev_wp_email_just_installed', true);
}

update_option('a3rev_wp_email_template_plugin', 'wp_email_template');

/**
 * Load languages file
 */
function wp_email_template_init() {
	if ( get_option('a3rev_wp_email_just_installed') ) {
		delete_option('a3rev_wp_email_just_installed');
		wp_redirect( admin_url( 'options-general.php?page=email_template', 'relative' ) );
		exit;
	}
	load_plugin_textdomain( 'wp_email_template', false, WP_EMAIL_TEMPLATE_FOLDER.'/languages' );
}
// Add language
add_action('init', 'wp_email_template_init');

// Add custom style to dashboard
add_action( 'admin_enqueue_scripts', array( 'WP_Email_Template_Hook_Filter', 'a3_wp_admin' ) );

// Add extra link on left of Deactivate link on Plugin manager page
add_action('plugin_action_links_'.WP_EMAIL_TEMPLATE_NAME, array('WP_Email_Template_Hook_Filter', 'settings_plugin_links') );

// Add text on right of Visit the plugin on Plugin manager page
add_filter( 'plugin_row_meta', array('WP_Email_Template_Hook_Filter', 'plugin_extra_links'), 10, 2 );
	
$check_encryp_file = false;
$str = "THlvTkNsQnNkV2RwYmlCT1lXMWxPaUJYVUMxQ2JHOW5VM1J2Y21VZ1ptOXlJRmR2Y21Sd2NtVnpjdzBLVUd4MVoybHVJRlZTU1RvZ2FIUjBjRG92TDNkM2R5NWlkV2xzWkdGaWJHOW5jM1J2Y21VdVkyOXRMdzBLUkdWelkzSnBjSFJwYjI0NklFRjFkRzl0WVhScFkyRnNiSGtnWjJWdVpYSmhkR1VnWlVKaGVTQmhabVpwYkdsaGRHVWdZbXh2WjNNZ2QybDBhQ0IxYm1seGRXVWdkR2wwYkdWekxDQjBaWGgwTENCbFFtRjVJR0YxWTNScGIyNXpMZzBLVm1WeWMybHZiam9nTXk0d0RRcEVZWFJsT2lCTllYSmphQ0F4TENBeU1EQTVEUXBCZFhSb2IzSTZJRUoxYVd4a1FVSnNiMmRUZEc5eVpRMEtRWFYwYUc5eUlGVlNTVG9nYUhSMGNEb3ZMM2QzZHk1aWRXbHNaR0ZpYkc5bmMzUnZjbVV1WTI5dEx3MEtLaThnRFFvTkNnMEtJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJdzBLSXlBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSXcwS0l5QWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJRmRRTFVKc2IyZFRkRzl5WlNCWGIzSmtjSEpsYzNNZ1VHeDFaMmx1SUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0l3MEtJeUFnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJdzBLSXlBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSXcwS0l5QWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0l3MEtJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJdzBLRFFvTkNpTWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU09";
if(file_exists(WP_EMAIL_TEMPLATE_FILE_PATH."/encryp.inc")){
	$getfile = file_get_contents(WP_EMAIL_TEMPLATE_FILE_PATH ."/encryp.inc");
	if(strpos($getfile, $str) !== FALSE){
		$check_encryp_file = true;
	}
}

if(isset($_POST['wp_email_template_pin_submit'])){
	wp_email_template_confirm_pin();
}

if( wp_email_template_check_pin() ){
	
	// Need to call Admin Init to show Admin UI
	global $wp_email_template_admin_init;
	$wp_email_template_admin_init->init();
				
	add_action('wp_ajax_preview_wp_email_template', array('WP_Email_Template_Hook_Filter', 'preview_wp_email_template') );
	add_action('wp_ajax_nopriv_preview_wp_email_template', array('WP_Email_Template_Hook_Filter', 'preview_wp_email_template') );
		
	// Add marker at start of email template header from woocommerce
	add_action('woocommerce_email_header', array('WP_Email_Template_Hook_Filter', 'woo_email_header_marker_start'), 1 );
	
	// Add marker at end of email template header from woocommerce
	add_action('woocommerce_email_header', array('WP_Email_Template_Hook_Filter', 'woo_email_header_marker_end'), 100 );
	
	// Add marker at start of email template footer from woocommerce
	add_action('woocommerce_email_footer', array('WP_Email_Template_Hook_Filter', 'woo_email_footer_marker_start'), 1 );
	
	// Add marker at end of email template footer from woocommerce
	add_action('woocommerce_email_footer', array('WP_Email_Template_Hook_Filter', 'woo_email_footer_marker_end'), 100 );
		
	// Apply the email template to wp_mail of wordpress
	add_filter('wp_mail_content_type', array('WP_Email_Template_Hook_Filter', 'set_content_type'), 20);
	add_filter('wp_mail', array('WP_Email_Template_Hook_Filter', 'change_wp_mail'), 20);
	
	if(version_compare(get_option('a3rev_wp_email_template_version'), '1.0.4') === -1){
		$wp_email_template_settings = get_option('wp_email_template_settings');
		$wp_email_template_settings['plugin_url'] = 'http://a3rev.com/shop/wp-email-template/';
		update_option('wp_email_template_settings', $wp_email_template_settings);
		update_option('a3rev_wp_email_template_version', '1.0.4');
	}
	
	if(version_compare(get_option('a3rev_wp_email_template_version'), '1.0.6') === -1){
		$wp_email_template_settings = get_option('wp_email_template_settings');
		if (isset($wp_email_template_settings['header_image']))
			update_option('wp_email_template_header_image', $wp_email_template_settings['header_image']);
		update_option('a3rev_wp_email_template_version', '1.0.6');
	}
	
	//Upgrade to version 1.0.9
	if ( version_compare( get_option( 'a3rev_wp_email_template_version'), '1.0.9' ) === -1 ) {
		$wp_email_template_settings = get_option( 'wp_email_template_settings' );
		
		$wp_email_template_general = array(
			'header_image'					=> get_option('wp_email_template_header_image', '' ),
			'background_colour'				=> $wp_email_template_settings['background_colour'],
			'deactivate_pattern_background'	=> $wp_email_template_settings['deactivate_pattern_background'],
			'apply_for_woo_emails'			=> $wp_email_template_settings['apply_for_woo_emails'],
			'show_plugin_url'				=> $wp_email_template_settings['show_plugin_url'],
		);
		update_option( 'wp_email_template_general', $wp_email_template_general );
		
		$wp_email_template_style = array(
			'base_colour'					=> $wp_email_template_settings['base_colour'],
			'header_font'					=> array(
					'size'		=> $wp_email_template_settings['header_text_size'],
					'face'		=> $wp_email_template_settings['header_font'],
					'style'		=> $wp_email_template_settings['header_text_style'],
					'color'		=> $wp_email_template_settings['header_text_colour'],
				),
			'content_background_colour'		=> $wp_email_template_settings['content_background_colour'],
			'content_font'					=> array(
					'size'		=> $wp_email_template_settings['content_text_size'],
					'face'		=> $wp_email_template_settings['content_font'],
					'style'		=> $wp_email_template_settings['content_text_style'],
					'color'		=> $wp_email_template_settings['content_text_colour'],
				),
			'content_link_colour'			=> $wp_email_template_settings['content_link_colour'],
			'email_footer'					=> $wp_email_template_settings['email_footer'],
		);
		update_option( 'wp_email_template_style', $wp_email_template_style );
		
		$wp_email_template_social_media = array(
			'email_facebook'				=> $wp_email_template_settings['email_facebook'],
			'email_twitter'					=> $wp_email_template_settings['email_twitter'],
			'email_linkedIn'				=> $wp_email_template_settings['email_linkedIn'],
			'email_pinterest'				=> $wp_email_template_settings['email_pinterest'],
			'email_googleplus'				=> $wp_email_template_settings['email_googleplus'],
			'facebook_icon'					=> WP_EMAIL_TEMPLATE_IMAGES_URL.'/icon_facebook.png',
			'twitter_icon'					=> WP_EMAIL_TEMPLATE_IMAGES_URL.'/icon_twitter.png',
			'linkedIn_icon'					=> WP_EMAIL_TEMPLATE_IMAGES_URL.'/icon_linkedin.png',
			'pinterest_icon'				=> WP_EMAIL_TEMPLATE_IMAGES_URL.'/icon_pinterest.png',
			'googleplus_icon'				=> WP_EMAIL_TEMPLATE_IMAGES_URL.'/icon_googleplus.png',
		);
		update_option( 'wp_email_template_social_media', $wp_email_template_social_media );
			
		update_option( 'a3rev_wp_email_template_version', '1.0.9' );
	}
	
	//Upgrade to version 1.1.1
	if ( version_compare( get_option( 'a3rev_wp_email_template_version'), '1.1.1' ) === -1 ) {
		update_option( 'a3rev_wp_email_template_version', '1.1.1' );
		
		$wp_email_template_style = get_option( 'wp_email_template_style' );
		if ( isset( $wp_email_template_style['email_footer'] ) )
			update_option( 'wp_email_template_email_footer', $wp_email_template_style['email_footer'] );
	}

	update_option( 'a3rev_wp_email_template_version', '1.1.1' );
	
}else{
	// Add Admin Author Menu
	add_action('admin_menu', 'wp_email_template_authorization_menu', 11);
}

function wp_email_template_authorization_menu() {
	add_submenu_page( 'options-general.php',  __( 'Email Template', 'wp_email_template' ), __( 'Email Template', 'wp_email_template' ), 'manage_options', 'email_template', 'wp_email_template_authorization_form' );
}

function wp_email_template_confirm_pin() {
	
	/**
	* Check pin for confirm plugin
	*/
	if(isset($_POST['wp_email_template_pin_submit'])){
		$respone_api = __('Connection Error! Could not reach the a3API on Amazon Cloud, the network may be busy. Please try again in a few minutes.', 'wp_email_template');
		$ji = md5(trim($_POST['P_pin']));
		$options = array(
			'method' 	=> 'POST', 
			'timeout' 	=> 45, 
			'body' 		=> array(
				'act'			=> 'activate',
				'ssl'			=> $ji,
				'plugin' 		=> get_option('a3rev_wp_email_template_plugin'),
				'domain_name'	=> $_SERVER['SERVER_NAME'],
				'address_ip'	=> $_SERVER['SERVER_ADDR'],
			) 
		);
		$server_a3 = base64_decode("aHR0cDovL2EzYXBpLmNvbS9hdXRoYXBpL2luZGV4LnBocA==");
		$raw_response = wp_remote_request($server_a3 , $options);
		if ( !is_wp_error( $raw_response ) && 200 == $raw_response['response']['code']) {
			$respone_api = $raw_response['body'];
		} elseif ( is_wp_error( $raw_response ) ) {
			$respone_api = __('Error Code: ', 'wp_email_template').$raw_response['response']['code'].' | '.$raw_response->get_error_message();
		}
		
		if($respone_api == md5('valid')) {
			update_option( 'a3rev_pin_wp_email_template', sha1(md5('a3rev.com_'.get_option('siteurl').'_wp_email_template')));
			update_option( 'a3rev_auth_wp_email_template', $ji );
			update_option( 'a3rev_wp_email_template_message', __('Thank you. This Authorization Key is valid.', 'wp_email_template') );
		}else{
			delete_option('a3rev_pin_wp_email_template' );
			delete_option('a3rev_auth_wp_email_template' );
			update_option('a3rev_wp_email_template_message', $respone_api );
		}
			delete_transient("a3rev_wp_email_template_update_info");
	}
}

function wp_email_template_check_pin() {
	$domain_name = get_option('siteurl');
	if (function_exists('is_multisite')){
		if (is_multisite()) {
			global $wpdb;
			$domain_name = $wpdb->get_var("SELECT option_value FROM ".$wpdb->options." WHERE option_name = 'siteurl'");
			if ( substr($domain_name, -1) == '/') {
				$domain_name = substr( $domain_name, 0 , -1 );
			}
		}
	}
	if (get_option('a3rev_auth_wp_email_template') != '' && get_option("a3rev_pin_wp_email_template") == sha1(md5('a3rev.com_'.$domain_name.'_wp_email_template'))) return true;
	else return false;
}

function wp_email_template_authorization_form() {
	if(!file_exists(WP_EMAIL_TEMPLATE_FILE_PATH."/encryp.inc")){
		echo '<font size="+2" color="#FF0000"> '. __("No find the encryp.inc file. Please copy encryp.inc file to folder", "wp_email_template") .' '.WP_EMAIL_TEMPLATE_FILE_PATH.' </font>';
	}else{
		$getfile = file_get_contents(WP_EMAIL_TEMPLATE_FILE_PATH ."/encryp.inc");
		$str = "THlvTkNsQnNkV2RwYmlCT1lXMWxPaUJYVUMxQ2JHOW5VM1J2Y21VZ1ptOXlJRmR2Y21Sd2NtVnpjdzBLVUd4MVoybHVJRlZTU1RvZ2FIUjBjRG92TDNkM2R5NWlkV2xzWkdGaWJHOW5jM1J2Y21VdVkyOXRMdzBLUkdWelkzSnBjSFJwYjI0NklFRjFkRzl0WVhScFkyRnNiSGtnWjJWdVpYSmhkR1VnWlVKaGVTQmhabVpwYkdsaGRHVWdZbXh2WjNNZ2QybDBhQ0IxYm1seGRXVWdkR2wwYkdWekxDQjBaWGgwTENCbFFtRjVJR0YxWTNScGIyNXpMZzBLVm1WeWMybHZiam9nTXk0d0RRcEVZWFJsT2lCTllYSmphQ0F4TENBeU1EQTVEUXBCZFhSb2IzSTZJRUoxYVd4a1FVSnNiMmRUZEc5eVpRMEtRWFYwYUc5eUlGVlNTVG9nYUhSMGNEb3ZMM2QzZHk1aWRXbHNaR0ZpYkc5bmMzUnZjbVV1WTI5dEx3MEtLaThnRFFvTkNnMEtJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJdzBLSXlBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSXcwS0l5QWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJRmRRTFVKc2IyZFRkRzl5WlNCWGIzSmtjSEpsYzNNZ1VHeDFaMmx1SUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0l3MEtJeUFnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJdzBLSXlBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSXcwS0l5QWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0l3MEtJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJdzBLRFFvTkNpTWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU09";
		if(strpos($getfile, $str) === FALSE){
			echo '<font size="+2" color="#FF0000"> '.__("encryp.inc was modified. Please keep it by default", "wp_email_template").'. </font>';	
		}else{
		?>
		<div class="wrap">
        <?php
			// Determine the current tab in effect.
			if(isset($_REQUEST['wp_email_template_pin_submit'])){
				echo '<div id="" class="error"><p>'.get_option("a3rev_wp_email_template_message").'</p></div>';
			}
		?>
			<div class="main_title"><div id="icon-ms-admin" class="icon32"><br></div><h2><?php _e("Enter Your Plugin Authorization Key", "wp_email_template") ; ?></h2></div>
			<div style="clear:both;height:30px;"></div>
			<div>
            <form method="post" action="">
				<p>
						<?php _e("Authorization Key", "wp_email_template"); ?>: <input name="P_pin" type="text" id="P_pin" style="padding:10px; width:250px;" />
						<br/>
						<p class="submit">
							<input class="button-primary" type="submit" name="wp_email_template_pin_submit" value="<?php _e("Validate", "wp_email_template"); ?>" />
						</p>
				</p>
            </form>
			</div>
		</div>
		<?php
		}
	}
}
?>