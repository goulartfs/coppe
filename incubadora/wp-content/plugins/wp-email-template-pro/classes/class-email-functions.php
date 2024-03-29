<?php
/**
 * WP Email Template Functions
 *
 * Table Of Contents
 *
 * replace_shortcode_header()
 * replace_shortcode_footer()
 * email_header()
 * email_footer()
 * email_content()
 * apply_email_template_notice()
 * send()
 * rgb_from_hex()
 * hex_darker()
 * hex_lighter()
 * light_or_dark()
 */
class WP_Email_Template_Functions
{
	
	public static function replace_shortcode_header ($template_html='', $email_heading='') {
		global $wp_email_template_general, $wp_email_template_style, $wp_email_template_social_media;
		$background_pattern_image = 'url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAkAAAAJCAYAAADgkQYQAAAAOklEQVQYGWP8//8/AyHAREgBIyOjMQPIJFwYaIAxSI6RbOvAViC7A90qmBXI4qRZh2EFunXYrEC2DgDc+VH0jS2AGAAAAABJRU5ErkJggg==)';
				
		$header_image_html = '';
		$header_image = $wp_email_template_general['header_image'];
		if ($header_image !== FALSE && trim($header_image) != '')
			$header_image_html = '<p style="margin:0px 0 20px 0;"><img class="header_image" style="max-width:600px;" alt="'.get_bloginfo('name').'" src="'.trim(esc_attr( stripslashes( $header_image ) ) ).'"></p>';
		
		$header_text_size = 'font-size:'.$wp_email_template_style['header_font']['size'].' !important; line-height:'.(intval($wp_email_template_style['header_font']['size'])+6).'px !important; ';
		
		$header_text_style = '';
		if ( isset($wp_email_template_style['header_font']['style']) && stristr($wp_email_template_style['header_font']['style'], 'bold') !== FALSE) {
			$header_text_style .= 'font-weight:bold !important; ';
		}
		if ( isset($wp_email_template_style['header_font']['style']) && stristr($wp_email_template_style['header_font']['style'], '300') !== FALSE) {
			$header_text_style .= 'font-weight:300 !important; ';
		}
		if ( isset($wp_email_template_style['header_font']['style']) && stristr($wp_email_template_style['header_font']['style'], 'italic') !== FALSE) {
			$header_text_style .= 'font-style:italic !important; ';
		}
		if ( isset($wp_email_template_style['header_font']['style']) && stristr($wp_email_template_style['header_font']['style'], 'normal') !== FALSE) {
			$header_text_style = 'font-weight:normal !important; font-style:normal !important';
		}
		
		$content_text_size = 'font-size:'.$wp_email_template_style['content_font']['size'].' !important; line-height:'.(intval($wp_email_template_style['content_font']['size'])+6).'px !important; ';
		
		$content_text_style = '';
		if ( isset($wp_email_template_style['content_font']['style']) && stristr($wp_email_template_style['content_font']['style'], 'bold') !== FALSE) {
			$content_text_style .= 'font-weight:bold !important; ';
		}
		if ( isset($wp_email_template_style['content_font']['style']) && stristr($wp_email_template_style['content_font']['style'], '300') !== FALSE) {
			$content_text_style .= 'font-weight:300 !important; ';
		}
		if ( isset($wp_email_template_style['content_font']['style']) && stristr($wp_email_template_style['content_font']['style'], 'italic') !== FALSE) {
			$content_text_style .= 'font-style:italic !important; ';
		}
		if ( isset($wp_email_template_style['content_font']['style']) && stristr($wp_email_template_style['content_font']['style'], 'normal') !== FALSE) {
			$content_text_style = 'font-weight:normal !important; font-style:normal !important';
		}
		
		if ( isset($wp_email_template_general['deactivate_pattern_background']) && $wp_email_template_general['deactivate_pattern_background'] == 'yes') {
			$background_pattern_image= '';
		}
		
		global $wp_email_template_fonts_face;
		$google_fonts = array( $wp_email_template_style['header_font']['face'], $wp_email_template_style['content_font']['face'] );
		$external_link = $wp_email_template_fonts_face->generate_google_webfonts( $google_fonts, false );
			
		$list_header_shortcode = array(
			'blog_name' 								=> get_bloginfo('name'),
			'external_link'								=> $external_link,
			'header_image' 								=> $header_image_html,
			'email_heading'								=> stripslashes($email_heading),
			'base_colour'								=> stripslashes($wp_email_template_style['base_colour']),
			'base_colour_lighter'						=> WP_Email_Template_Functions::light_or_dark(stripslashes($wp_email_template_style['base_colour']), 20),
			'base_colour_light_or_dark'					=> WP_Email_Template_Functions::hex_lighter(stripslashes($wp_email_template_style['base_colour']), '#202020', '#ffffff'),
			'header_font'								=> stripslashes($wp_email_template_style['header_font']['face']) . ', arial, sans-serif',
			'header_text_size'							=> $header_text_size,
			'header_text_style'							=> $header_text_style,
			'header_text_colour'						=> stripslashes($wp_email_template_style['header_font']['color']),
			
			'background_colour'							=> stripslashes($wp_email_template_general['background_colour']),
			'background_pattern_image'					=> $background_pattern_image,
			'content_background_colour'					=> stripslashes($wp_email_template_style['content_background_colour']),
			'content_text_colour'						=> stripslashes($wp_email_template_style['content_font']['color']),
			'content_text_colour_lighter'				=> WP_Email_Template_Functions::hex_lighter(stripslashes($wp_email_template_style['content_font']['color']), 20),
			'content_link_colour'						=> stripslashes($wp_email_template_style['content_link_colour']),
			'content_font'								=> stripslashes($wp_email_template_style['content_font']['face']) . ', arial, sans-serif',
			'content_text_size'							=> $content_text_size,
			'content_text_style'						=> $content_text_style
		);
		
		foreach ($list_header_shortcode as $shortcode => $value) {
			$template_html = str_replace('<!--'.$shortcode.'-->', $value, $template_html);
			$template_html = str_replace('/*'.$shortcode.'*/', $value, $template_html);
		}
		
		return $template_html;
	}
	
	public static function replace_shortcode_footer ($template_html='') {
		global $wp_email_template_general, $wp_email_template_style, $wp_email_template_social_media, $wp_email_template_email_footer;
		
		$background_pattern_image = 'url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAkAAAAJCAYAAADgkQYQAAAAOklEQVQYGWP8//8/AyHAREgBIyOjMQPIJFwYaIAxSI6RbOvAViC7A90qmBXI4qRZh2EFunXYrEC2DgDc+VH0jS2AGAAAAABJRU5ErkJggg==)';
		
		$header_text_size = 'font-size:'.$wp_email_template_style['header_font']['size'].' !important; line-height:'.(intval($wp_email_template_style['header_font']['size'])+6).'px !important; ';
		
		$header_text_style = '';
		if ( isset($wp_email_template_style['header_font']['style']) && stristr($wp_email_template_style['header_font']['style'], 'bold') !== FALSE) {
			$header_text_style .= 'font-weight:bold !important; ';
		}
		if ( isset($wp_email_template_style['header_font']['style']) && stristr($wp_email_template_style['header_font']['style'], '300') !== FALSE) {
			$header_text_style .= 'font-weight:300 !important; ';
		}
		if ( isset($wp_email_template_style['header_font']['style']) && stristr($wp_email_template_style['header_font']['style'], 'italic') !== FALSE) {
			$header_text_style .= 'font-style:italic !important; ';
		}
		if ( isset($wp_email_template_style['header_font']['style']) && stristr($wp_email_template_style['header_font']['style'], 'normal') !== FALSE) {
			$header_text_style = 'font-weight:normal !important; font-style:normal !important';
		}
		
		$content_text_size = 'font-size:'.$wp_email_template_style['content_font']['size'].' !important; line-height:'.(intval($wp_email_template_style['content_font']['size'])+6).'px !important; ';
		
		$content_text_style = '';
		if ( isset($wp_email_template_style['content_font']['style']) && stristr($wp_email_template_style['content_font']['style'], 'bold') !== FALSE) {
			$content_text_style .= 'font-weight:bold !important; ';
		}
		if ( isset($wp_email_template_style['content_font']['style']) && stristr($wp_email_template_style['content_font']['style'], '300') !== FALSE) {
			$content_text_style .= 'font-weight:300 !important; ';
		}
		if ( isset($wp_email_template_style['content_font']['style']) && stristr($wp_email_template_style['content_font']['style'], 'italic') !== FALSE) {
			$content_text_style .= 'font-style:italic !important; ';
		}
		if ( isset($wp_email_template_style['content_font']['style']) && stristr($wp_email_template_style['content_font']['style'], 'normal') !== FALSE) {
			$content_text_style = 'font-weight:normal !important; font-style:normal !important';
		}
		
		$facebook_html = '';
		if (isset($wp_email_template_social_media['email_facebook']) && trim(esc_attr($wp_email_template_social_media['email_facebook'])) != '')
			$facebook_html = '<a style="padding:0 2px;" href="'.trim( esc_attr (stripslashes($wp_email_template_social_media['email_facebook']) ) ).'" target="_blank" title="'.__('Facebook', 'wp_email_template').'"><img align="top" border="0" src="' . ( ( trim( $wp_email_template_social_media['facebook_icon'] ) != '' ) ? trim( $wp_email_template_social_media['facebook_icon'] ) : WP_EMAIL_TEMPLATE_IMAGES_URL.'/icon_facebook.png' ) . '" alt="'.__('Facebook', 'wp_email_template').'" /></a>';
			
		$twitter_html = '';
		if (isset($wp_email_template_social_media['email_twitter']) && trim(esc_attr($wp_email_template_social_media['email_twitter'])) != '')
			$twitter_html = '<a style="padding:0 2px;" href="'.trim( esc_attr( stripslashes($wp_email_template_social_media['email_twitter']) ) ).'" target="_blank" title="'.__('Twitter', 'wp_email_template').'"><img align="top" border="0" src="' . ( ( trim( $wp_email_template_social_media['twitter_icon'] ) != '' ) ? trim( $wp_email_template_social_media['twitter_icon'] ) : WP_EMAIL_TEMPLATE_IMAGES_URL.'/icon_twitter.png' ) . '" alt="'.__('Twitter', 'wp_email_template').'" /></a>';
			
		$linkedIn_html = '';
		if (isset($wp_email_template_social_media['email_linkedIn']) && trim(esc_attr($wp_email_template_social_media['email_linkedIn'])) != '')
			$linkedIn_html = '<a style="padding:0 2px;" href="'.trim( esc_attr( stripslashes($wp_email_template_social_media['email_linkedIn']) ) ).'" target="_blank" title="'.__('LinkedIn', 'wp_email_template').'"><img align="top" border="0" src="' . ( ( trim( $wp_email_template_social_media['linkedIn_icon'] ) != '' ) ? trim( $wp_email_template_social_media['linkedIn_icon'] ) : WP_EMAIL_TEMPLATE_IMAGES_URL.'/icon_linkedin.png' ) . '" alt="'.__('LinkedIn', 'wp_email_template').'" /></a>';
			
		$pinterest_html = '';
		if (isset($wp_email_template_social_media['email_pinterest']) && trim(esc_attr($wp_email_template_social_media['email_pinterest'])) != '')
			$pinterest_html = '<a style="padding:0 2px;" href="'.trim( esc_attr( stripslashes($wp_email_template_social_media['email_pinterest']) ) ).'" target="_blank" title="'.__('Pinterest', 'wp_email_template').'"><img align="top" border="0" src="' . ( ( trim( $wp_email_template_social_media['pinterest_icon'] ) != '' ) ? trim( $wp_email_template_social_media['pinterest_icon'] ) : WP_EMAIL_TEMPLATE_IMAGES_URL.'/icon_pinterest.png' ) . '" alt="'.__('Pinterest', 'wp_email_template').'" /></a>';
			
		$googleplus_html = '';
		if (isset($wp_email_template_social_media['email_googleplus']) && trim(esc_attr($wp_email_template_social_media['email_googleplus'])) != '')
			$googleplus_html = '<a style="padding:0 2px;" href="'.trim( esc_attr( stripslashes($wp_email_template_social_media['email_googleplus']) ) ).'" target="_blank" title="'.__('Google+', 'wp_email_template').'"><img align="top" border="0" src="' . ( ( trim( $wp_email_template_social_media['googleplus_icon'] ) != '' ) ? trim( $wp_email_template_social_media['googleplus_icon'] ) : WP_EMAIL_TEMPLATE_IMAGES_URL.'/icon_googleplus.png' ) . '" alt="'.__('Google+', 'wp_email_template').'" /></a>';
			
		$follow_text = '';
		if (trim($facebook_html) != '' || trim($twitter_html) != '' || trim($linkedIn_html) != '' || trim($pinterest_html) != '' || trim($googleplus_html) != '')
			$follow_text = __('Follow us on', 'wp_email_template');
			
		$wordpress_email_template_url = '<div style="clear:both"></div><div style="float:right;"><a href="http://a3rev.com/shop/wp-email-template/" target="_blank">'.__('WP Email Template', 'wp_email_template').'</a></div>';
		if (isset($wp_email_template_general['show_plugin_url']) && trim(esc_attr($wp_email_template_general['show_plugin_url'])) == 'no') $wordpress_email_template_url = '';
		
		if ( isset($wp_email_template_general['deactivate_pattern_background']) && $wp_email_template_general['deactivate_pattern_background'] == 'yes') {
			$background_pattern_image= '';
		}
					
		$list_footer_shortcode = array(
			'email_footer' 								=> wpautop(wptexturize(stripslashes($wp_email_template_email_footer))),
			'follow_text' 								=> $follow_text,
			'email_facebook' 							=> $facebook_html,
			'email_twitter' 							=> $twitter_html,
			'email_linkedIn' 							=> $linkedIn_html,
			'email_pinterest' 							=> $pinterest_html,
			'email_googleplus' 							=> $googleplus_html,
			'base_colour'								=> stripslashes($wp_email_template_style['base_colour']),
			'base_colour_lighter'						=> WP_Email_Template_Functions::light_or_dark(stripslashes($wp_email_template_style['base_colour']), 20),
			'base_colour_light_or_dark'					=> WP_Email_Template_Functions::hex_lighter(stripslashes($wp_email_template_style['base_colour']), '#202020', '#ffffff'),
			'header_font'								=> stripslashes($wp_email_template_style['header_font']['face']) . ', arial, sans-serif',
			'header_text_size'							=> $header_text_size,
			'header_text_style'							=> $header_text_style,
			'header_text_colour'						=> stripslashes($wp_email_template_style['header_font']['color']),
			
			'background_colour'							=> stripslashes($wp_email_template_general['background_colour']),
			'background_pattern_image'					=> $background_pattern_image,
			'content_background_colour'					=> stripslashes($wp_email_template_style['content_background_colour']),
			'content_text_colour'						=> stripslashes($wp_email_template_style['content_font']['color']),
			'content_text_colour_lighter'				=> WP_Email_Template_Functions::hex_lighter(stripslashes($wp_email_template_style['content_font']['color']), 20),
			'content_link_colour'						=> stripslashes($wp_email_template_style['content_link_colour']),
			'content_font'								=> stripslashes($wp_email_template_style['content_font']['face']) . ', arial, sans-serif',
			'content_text_size'							=> $content_text_size,
			'content_text_style'						=> $content_text_style,
			'wordpress_email_template_url'				=> $wordpress_email_template_url
		);
		
		foreach ($list_footer_shortcode as $shortcode => $value) {
			$template_html = str_replace('<!--'.$shortcode.'-->', $value, $template_html);
			$template_html = str_replace('/*'.$shortcode.'*/', $value, $template_html);
		}
		
		return $template_html;
	}
	
	public static function email_header($email_heading='') {
		$file 	= 'email_header.html';
		if (file_exists(STYLESHEETPATH . '/'. $file)) {
			// $header_template_path = get_stylesheet_directory() . '/emails/'. $file; 
			$header_template_path = STYLESHEETPATH . '/emails/'. $file;
			$header_template_url = get_stylesheet_directory_uri() . '/emails/'. $file;
		} else {
			
			$header_template_path = WP_EMAIL_TEMPLATE_DIR . '/emails/'. $file;
			$header_template_url = WP_EMAIL_TEMPLATE_URL . '/emails/'. $file;
		}
		
		$template_html = file_get_contents($header_template_path);
		if ($template_html == false) {
			$ch = curl_init($header_template_url);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$template_html = curl_exec($ch);
			curl_close($ch);
		}
		
		$template_html = WP_Email_Template_Functions::replace_shortcode_header($template_html, $email_heading);
		
		return $template_html;
	}
	
	public static function email_footer() {
		$file 	= 'email_footer.html';
		
		if (file_exists(STYLESHEETPATH . '/'. $file)) {
			// $footer_template_path = get_stylesheet_directory() . '/emails/'. $file; 
			$footer_template_path = STYLESHEETPATH . '/emails/'. $file;
			$footer_template_url = get_stylesheet_directory_uri() . '/emails/'. $file;
		} else {
			$footer_template_path = WP_EMAIL_TEMPLATE_DIR . '/emails/'. $file;
			$footer_template_url = WP_EMAIL_TEMPLATE_URL . '/emails/'. $file;
		}
		
		$template_html = file_get_contents($footer_template_path);
		if ($template_html == false) {
			$ch = curl_init($footer_template_url);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$template_html = curl_exec($ch);
			curl_close($ch);
		}
		
		$template_html = WP_Email_Template_Functions::replace_shortcode_footer($template_html);
		
		return $template_html;
	}
	
	public static function email_content($email_heading='', $message='') {
		$html = '';
		if (stristr($message, '<!--NO_USE_EMAIL_TEMPLATE-->') === false )
			$html .= WP_Email_Template_Functions::email_header($email_heading);
		
		$html .= wpautop( make_clickable( $message) );
		
		if (stristr($message, '<!--NO_USE_EMAIL_TEMPLATE-->') === false )
			$html .= WP_Email_Template_Functions::email_footer();
				
		return $html;
	}
	
	public static function apply_email_template_notice($message='') {
		$message_html = '';	
		if ( trim($message) != '') {
			$message_html = '<div style="position:fixed; width: 79%; margin:0 10%; top: 10px; padding:5px 10px; border:1px solid #E6DB55; background:#FFFFE0; font-size:15px; line-height:20px;">'.$message.'</div>';	
		}
		
		return $message_html;
	}
		
	public static function send($to, $subject, $message, $headers = "Content-Type: text/html\r\n", $attachments = "") {
		ob_start();
			
		wp_mail( $to, $subject, $message, $headers, $attachments );
		
		ob_end_clean();
	}
	
	/**
	 * Hex darker/lighter/contrast functions for colours
	 **/
	public static function rgb_from_hex( $color ) {
		$color = str_replace( '#', '', $color );
		// Convert shorthand colors to full format, e.g. "FFF" -> "FFFFFF"
		$color = preg_replace( '~^(.)(.)(.)$~', '$1$1$2$2$3$3', $color );
	
		$rgb['R'] = hexdec( $color{0}.$color{1} );
		$rgb['G'] = hexdec( $color{2}.$color{3} );
		$rgb['B'] = hexdec( $color{4}.$color{5} );
		return $rgb;
	}
	
	public static function hex_darker( $color, $factor = 30 ) {
		$base = WP_Email_Template_Functions::rgb_from_hex( $color );
		$color = '#';

		foreach ($base as $k => $v) :
	        $amount = $v / 100;
	        $amount = round($amount * $factor);
	        $new_decimal = $v - $amount;
	
	        $new_hex_component = dechex($new_decimal);
	        if(strlen($new_hex_component) < 2) :
	        	$new_hex_component = "0".$new_hex_component;
	        endif;
	        $color .= $new_hex_component;
		endforeach;
		        
		return $color;        
	}
	
	public static function hex_lighter( $color, $factor = 30 ) {
		$base = WP_Email_Template_Functions::rgb_from_hex( $color );
		$color = '#';

	    foreach ($base as $k => $v) :
	        $amount = 255 - $v; 
	        $amount = $amount / 100; 
	        $amount = round($amount * $factor); 
	        $new_decimal = $v + $amount; 
	     
	        $new_hex_component = dechex($new_decimal); 
	        if(strlen($new_hex_component) < 2) :
	        	$new_hex_component = "0".$new_hex_component;
	        endif;
	        $color .= $new_hex_component; 
	   	endforeach;
	         
	   	return $color;          
	}
	
	/**
	 * Detect if we should use a light or dark colour on a background colour
	 **/
	public static function light_or_dark( $color, $dark = '#000000', $light = '#FFFFFF' ) {
	    //return ( hexdec( $color ) > 0xffffff / 2 ) ? $dark : $light;
	    $hex = str_replace( '#', '', $color );

		$c_r = hexdec( substr( $hex, 0, 2 ) );
		$c_g = hexdec( substr( $hex, 2, 2 ) );
		$c_b = hexdec( substr( $hex, 4, 2 ) );
		$brightness = ( ( $c_r * 299 ) + ( $c_g * 587 ) + ( $c_b * 114 ) ) / 1000;
		
		return $brightness > 155 ? $dark : $light;
	}
	
}
?>