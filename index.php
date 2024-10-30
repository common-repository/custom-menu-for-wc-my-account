<?php
/*
Plugin Name: Custom Menu for WC My Account
Plugin URI:
Description: Add unlimited number of Menu for WooCommerce My Account Page.	
Version: 1.0
Author: Blitz Mobile Apps
License: GPLv2
Author URI: https://blitzmobileapps.com/
Requires at least: 5.0
Tested up to: 5.6
Text Domain: custom-menu-for-wc-my-account
 */

define('WACM_PATH', dirname(__FILE__));
$plugin = plugin_basename(__FILE__);
define('WACM_URL', plugin_dir_url($plugin));

require WACM_PATH.'/inc/menu_page.php';
require WACM_PATH.'/inc/mainFunction.php';