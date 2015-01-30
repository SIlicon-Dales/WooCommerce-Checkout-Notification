<?php
/*
Plugin Name: WooCommerce Checkout Notification
Description: Allows the owner to display a notification during check out
Author: Samer Albahra
Version: 0.1
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) return; // Check if WooCommerce is active

add_action('admin_menu', 'wcn_setup_menu');
add_action('admin_init', 'wcn_settings');
add_action('woocommerce_before_cart', 'wcn_show_notification');

function wcn_settings() {
	register_setting('wcn-settings', 'enabled');
	register_setting('wcn-settings', 'message');
}

function wcn_setup_menu(){
	add_submenu_page( 'woocommerce', 'WooCommerce Checkout Notification', 'Notification', 'manage_options', 'woocommerce-notification', 'wcn_admin_init' );
}

function wcn_admin_init(){
    include('notification-admin.php');
}

function wcn_show_notification() {
	settings_fields('wcn-settings');
	$isEnabled = esc_attr( get_option('enabled'));
	if ($isEnabled) {
		echo '<div class="woocommerce-info">'.esc_attr( get_option('message')).'</div>';
	}
}

?>
