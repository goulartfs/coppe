<?php
/**
 * WP Email Template Hook Filter
 *
 * Table Of Contents
 *
 * woo_email_header_marker_start()
 * woo_email_header_marker_end()
 * woo_email_footer_marker_start()
 * woo_email_footer_marker_end()
 * preview_wp_email_template()
 * set_content_type()
 * change_wp_mail()
 * admin_head_scripts()
 * a3_wp_admin()
 * plugin_extra_links()
 * settings_plugin_links()
 */
class WP_Email_Template_Hook_Filter
{
	
	public static function woo_email_header_marker_start($email_heading='') {
		global $wp_email_template_general;
		
		if (isset($wp_email_template_general['apply_for_woo_emails']) && $wp_email_template_general['apply_for_woo_emails'] == 'yes') {
			ob_start();
			echo '<!--WOO_EMAIL_TEMPLATE_HEADER_START-->';
		}
	}
	
	public static function woo_email_header_marker_end($email_heading='') {
		global $wp_email_template_general;
		
		if (isset($wp_email_template_general['apply_for_woo_emails']) && $wp_email_template_general['apply_for_woo_emails'] == 'yes') {
			echo '<!--WOO_EMAIL_TEMPLATE_HEADER_END-->';
			ob_get_clean();
			$header = WP_Email_Template_Functions::email_header($email_heading);
			
			if (isset($_REQUEST['preview_woocommerce_mail']) && $_REQUEST['preview_woocommerce_mail'] == 'true') {
				$template_notice = WP_Email_Template_Functions::apply_email_template_notice( __('Attention! You have selected to apply your WP Email Template to all WooCommerce Emails. Go to Settings in your WordPress admin sidebar > Email Template to customize this template or to reactivate the WooCommerce Email Template.', 'wp_email_template') );
				$header = str_replace('<!--EMAIL_TEMPLATE_NOTICE-->', $template_notice, $header);
			}
			
			
			echo $header;
		}
	}
	
	public static function woo_email_footer_marker_start() {
		global $wp_email_template_general;
		
		if (isset($wp_email_template_general['apply_for_woo_emails']) && $wp_email_template_general['apply_for_woo_emails'] == 'yes') {
			ob_start();
			echo '<!--WOO_EMAIL_TEMPLATE_FOOTER_START-->';
		}
	}
	
	public static function woo_email_footer_marker_end() {
		global $wp_email_template_general;
		
		if (isset($wp_email_template_general['apply_for_woo_emails']) && $wp_email_template_general['apply_for_woo_emails'] == 'yes') {
			echo '<!--WOO_EMAIL_TEMPLATE_FOOTER_END-->';
			ob_get_clean();
			echo WP_Email_Template_Functions::email_footer();
		}
		echo '<!--NO_USE_EMAIL_TEMPLATE-->';
	}
	
	public static function preview_wp_email_template() {
		check_ajax_referer( 'preview_wp_email_template', 'security' );
		
		$email_heading = __('Email preview', 'wp_email_template');
		
		$message = '<h2>'.__('WordPress Email sit amet', 'wp_email_template').'</h2>';
		
		$message.= wpautop(__('Ut ut est qui euismod parum. Dolor veniam tation nihil assum mazim. Possim fiant habent decima et claritatem. Erat me usus gothica laoreet consequat. Clari facer litterarum aliquam insitam dolor. 

Gothica minim lectores demonstraverunt ut soluta. Sequitur quam exerci veniam aliquip litterarum. Lius videntur nisl facilisis claritatem nunc. Praesent in iusto me tincidunt iusto. Dolore lectores sed putamus exerci est. ', 'wp_email_template') );

		echo WP_Email_Template_Functions::email_content($email_heading, $message);
		
		die();
	}
	
	public static function set_content_type($content_type='') {
		if ( stristr( $content_type, 'multipart') !== false ) {
			$content_type = 'multipart/alternative';
		} else {
			$content_type = 'text/html';
		}
		return $content_type;
	}
	
	public static function change_wp_mail($email_data=array()) {
		$email_heading = $email_data['subject'] ;
		if (stristr($email_data['message'], '<!--NO_USE_EMAIL_TEMPLATE-->') === false ) {
			$email_data['message'] = WP_Email_Template_Functions::email_content($email_heading, $email_data['message']);
		}
		
		return $email_data;
	}
	
	public static function a3_wp_admin() {
		wp_enqueue_style( 'a3rev-wp-admin-style', WP_EMAIL_TEMPLATE_CSS_URL . '/a3_wp_admin.css' );
	}
				
	public static function plugin_extra_links($links, $plugin_name) {
		if ( $plugin_name != WP_EMAIL_TEMPLATE_NAME) {
			return $links;
		}
		$links[] = '<a href="http://docs.a3rev.com/user-guides/wordpress/wp-email-template/" target="_blank">'.__('Documentation', 'wp_email_template').'</a>';
		$links[] = '<a href="https://a3rev.com/forums/forum/wordpress-plugins/wp-email-template/" target="_blank">'.__('Support', 'wp_email_template').'</a>';
		return $links;
	}
	
	public static function settings_plugin_links($actions) {
		$actions = array_merge( array( 'settings' => '<a href="options-general.php?page=email_template">' . __( 'Settings', 'wp_email_template' ) . '</a>' ), $actions );
		
		return $actions;
	}
}
?>