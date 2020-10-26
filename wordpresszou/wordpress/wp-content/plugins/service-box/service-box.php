<?php
/**
 * Plugin Name: Service Box
 * Version: 1.4.0
 * Description:  Service Box plugin is manage your showcase of your services. Easily add unlimited services box with drag and drop builder Api.
 * Author: wpshopmart
 * Author URI: https://wpshopmart.com/
 * Plugin URI: https://www.wpshopmart.com/plugins/
 */
 
/**
 * DEFINE PATHS
*/
 
 if ( ! defined( 'ABSPATH' ) ) exit; 
define("wpshopmart_service_box_directory_url", plugin_dir_url(__FILE__));
define("wpshopmart_service_box_text_domain", "wpsm_servicebox");

/**
 * PLUGIN Install
 */
require_once("ink/install/installation.php");

function wpsm_servicebox_default_data() {
	
	$settings_array = serialize( array(
		"service_acc_sec_title" 	 => "yes",
		"service_display_icon" 		 => "yes",
		"service_display_readmore"     => "yes",
		"service_title_clr"         => "#000000",
		"service_icon_clr" => "#636363",
		"service_icon_bg_clr" => "#dddddd",
		"service_des_clr" => "#7f7f7f",
		"service_readmore_clr"    => "#4c4c4c",
		"service_readmore_bg_clr"  => "#ffffff",
		"service_box_bg_clr_dsn2"  => "#e5e5e5",
		"service_title_font_size"     		 => "22",
		"service_des_font_size"     	 => "19",
		"service_readmore_font_size"     	 => "16",
		"custom_css"      =>"",
		"font_family"      =>"Open Sans",
		"sb_web_link_label"      =>"Read More",
		"sb_layout"      =>"6",
		"templates"      =>"1",
		) );

	add_option('servicebox_default_Settings', $settings_array);
		
}
register_activation_hook( __FILE__, 'wpsm_servicebox_default_data' );
 
/**
 * service box cpt + admin panel
 */
require_once("ink/admin/menu.php");

/**
 * Service Box SHORTCODE
 */
require_once("template/shortcode.php"); 

add_action('admin_menu' , 'wpsm_servicebox_recom_menu');
function wpsm_servicebox_recom_menu() {
	$submenu2 = add_submenu_page('edit.php?post_type=wpsm_servicebox_r', __('free_vs_pro', wpshopmart_service_box_text_domain), __('Free Vs Pro', wpshopmart_service_box_text_domain), 'administrator', 'wpsm_servicebox_fvp_page', 'wpsm_servicebox_fvp_page_funct');
	$submenu = add_submenu_page('edit.php?post_type=wpsm_servicebox_r', __('More_Free_Plugins', wpshopmart_service_box_text_domain), __('More Free Plugins', wpshopmart_service_box_text_domain), 'administrator', 'wpsm_servicebox_recom_page', 'wpsm_servicebox_recom_page_funct');
	
	//add hook to add styles and scripts for service box page
    add_action( 'admin_print_styles-' . $submenu, 'wpsm_servicebox_recom_js_css' );
    add_action( 'admin_print_styles-' . $submenu2, 'wpsm_servicebox_fvp_js_css' );
}
function wpsm_servicebox_recom_js_css(){
	wp_enqueue_style('wpsm_servicebox_bootstrap_css_recom', wpshopmart_service_box_directory_url.'assets/css/bootstrap.css');
	wp_enqueue_style('wpsm_servicebox_help_css', wpshopmart_service_box_directory_url.'assets/css/help.css');
}
function wpsm_servicebox_recom_page_funct(){
	require_once('ink/admin/free.php');
}
function wpsm_servicebox_fvp_js_css(){
	wp_enqueue_style('wpsm_servicebox_settings_fvp', wpshopmart_service_box_directory_url.'assets/css/settings.css');
	
}
function wpsm_servicebox_fvp_page_funct(){
	require_once('ink/admin/fvp.php');
}
?>