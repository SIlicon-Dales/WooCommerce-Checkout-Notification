<?php
/*
Plugin Name: WooCommerce Checkout Notification
Description: Allows the owner to display a notification during check out
Author: Samer Albahra
Version: 0.1
*/

// Exit if accessed directly
if (!defined('ABSPATH')) {
	exit;
}

// Check if WooCommerce is active
if (!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
	return;
}

// Add action to show admin menu options
add_action('admin_menu', 'wcn_setup_menu');
// Add action to register settings
add_action('admin_init', 'wcn_settings');
// Bind WooCommerce before cart event to check if notification should be shown
add_action('woocommerce_before_cart', 'wcn_show_notification');

function wcn_settings() {
	register_setting('wcn-settings', 'enabled');
	register_setting('wcn-settings', 'message');
	register_setting('wcn-settings', 'class');
}

function wcn_setup_menu(){
	add_submenu_page('woocommerce', 'WooCommerce Checkout Notification', 'Checkout Notification', 'manage_options', 'woocommerce-checkout-notification', 'wcn_admin_init');
}

function wcn_admin_init(){
	// Show the admin page settings
	include('checkout-notification-admin.php');
}

function wcn_show_notification() {
	settings_fields('wcn-settings');
	$isEnabled = esc_attr(get_option('enabled'));
	$message = esc_attr(get_option('message'));
	$class = esc_attr(get_option('class'));
	if ($class === "") {
		$class = "info";
	}
	if ($isEnabled && $message !== "") {
		echo '<div class="woocommerce-'.$class.'">'.$message.'</div>';
	}
}

?>
