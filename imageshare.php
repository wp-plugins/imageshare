<?php
/*
Plugin Name: ImageShare
Description: The WordPress ImageShare plug-in gives you the possibility to add social bookmarking icons to images in your posts. The administrator can choose which icons should be visible in what posts on each page. The administrator also has the possibility to make visual adjustments to the display of the icons, including options for the display size, title and link for each icon.
Version: 1.0
Author: WPEssence
Author URI: http://www.wpessence.com
Plugin URI: http://www.wpessence.com/plugins/imageshare.html
License: GPLv2 or later
*/

if (!function_exists('add_action')) {
	// Include the WordPress configuration file
	require_once '../../../wp-config.php';
}

// Load plug-in essentials
require_once 'load.php';

if (!is_admin()) {
	$wpaa = new WPIS_ImageShare_Frontend($plugindata, $dbtables, $icons);
	require_once 'frontend/index.php';
}
else {
	$wpaa = new WPIS_ImageShare_Admin($plugindata, $dbtables, $icons);
	require_once 'admin/index.php';
}

// Actions
add_action('init', array(&$wpaa, 'action_init'));
add_action('admin_init', array(&$wpaa, 'action_admin_init'));

// Plug-in activation
register_activation_hook(__FILE__, array(&$wpaa, 'install'));
?>