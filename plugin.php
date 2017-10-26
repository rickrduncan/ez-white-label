<?php
/**
* Plugin Name:		EZ White Label
* Description:		White label WordPress CMS before delivering website to client.
* Author:			Rick R. Duncan - B3Marketing, LLC
* Author URI:		http://rickrduncan.com
*
* License:			GPLv3
* License URI:		https://www.gnu.org/licenses/gpl-3.0.html
*
* Version:			1.0.0
*/


/**
 * Add Colophon meta tag into head of document.
 *
 * @since 1.0.0
 */
add_action( 'wp_head', 'ezwl_insert_head_meta_data' );
function ezwl_insert_head_meta_data() { 	
	echo '<meta name="web_author" content="Rick R. Duncan — rickrduncan.com" />';	
}


/**
 * Customize the footer text in admin screens.
 *
 * @since 1.0.0
 */
add_filter( 'admin_footer_text', 'ezwl_modify_footer_admin' );
function ezwl_modify_footer_admin () {  
    echo '<span id="footer-thankyou">WordPress solutions by <a href="http://rickrduncan.com" target="_blank">Rick R. Duncan</a></span>';
}


/**
 * Login Screen: Use your own URL for login logo link.
 *
 * @since 1.0.0
 */
add_filter( 'login_headerurl', 'ezwl_url_login' );
function ezwl_url_login(){
	return get_bloginfo( 'wpurl' ); 
}


/**
 * Login Screen: Change login logo hover text.
 *
 * @since 1.0.0
 */
add_filter( 'login_headertitle', 'ezwl_login_logo_url_title' );
function ezwl_login_logo_url_title() {
    return 'Rick R. Duncan - WordPress Solutions Provider';
}


/**
 * Login Screen: Don't inform user which piece of credential was incorrect.
 *
 * @since 1.0.0
 */
add_filter ( 'login_errors', 'ezwl_failed_login' );
function ezwl_failed_login () {
    return 'The login information you have entered is incorrect. Please try again.';
}


/**
 * Login Screen: Set 'remember me' to be checked Part 1.
 *
 * @since 1.0.0
 */
function ezwl_rememberme_checked() {	
	echo "<script>document.getElementById('rememberme').checked = true;</script>";	
}


/**
 * Login Screen: Set 'remember me' to be checked Part 2.
 *
 * @since 1.0.0
 */
add_action( 'init', 'ezwl_login_checked_remember_me' );
function ezwl_login_checked_remember_me() {	
	add_filter( 'login_footer', 'ezwl_rememberme_checked' );
}


/**
 * Login Screen: Change login logo.
 *
 * @since 1.0.0
 */
add_action( 'login_head', 'ezwl_custom_login_logo' );
function ezwl_custom_login_logo() {
	echo '<style type="text/css">
	h1 a { background-image:url('.plugin_dir_url( __FILE__ ).'images/login-logo.png) !important; background-size: 311px 100px !important;height: 100px !important; width: 311px !important; margin-bottom: 20px !important; padding-bottom: 0 !important; }
    .login form { margin-top: 10px !important; } 
    </style>';
}


/**
 * Add contact us box into WordPress Dashboard.
 *
 * @since 1.0.0
 */
add_action('wp_dashboard_setup', 'ezwl_add_dashboard_widgets' );
function ezwl_add_dashboard_widgets() {	
	wp_add_dashboard_widget('wp_dashboard_widget', 'Theme Details', 'ezwl_theme_info');	
}

function ezwl_theme_info() {	
	echo "<ul>
	<li><strong>WordPress Developer:</strong> YOUR NAME</li>
	<li><strong>Website:</strong> <a href='http://EXAMPLE.COM'>EXAMPLE.COM</a></li>
	<li><strong>Contact:</strong> <a href='mailto:YOUREMAIL@EMAIL.COM'>YOUREMAIL@EMAIL.COM</a></li>
	</ul>";	
}


/**
 * Change WordPress welcome message from 'Howdy'
 *
 * @since 1.0.0
 */
add_filter( 'gettext', 'ezwl_change_howdy', 10, 3 ); 
function ezwl_change_howdy( $translated, $text, $domain ) {

    if ( !is_admin() || 'default' != $domain )
        return $translated;

    if ( false !== strpos( $translated, 'Howdy' ) )
        return str_replace( 'Howdy', 'Welcome', $translated );

    return $translated;
}