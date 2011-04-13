<?php
// Unset the plugin data variable if it is set
unset($plugindata);

// Set the scope for the variable to store the data in to global
global $plugindata;

// Plugin data
$plugindata = array(
	'version' => '1.0',
	'unique_plugin_identifier' => 'imageshare',
	'plugin_name' => 'imageshare',
	'general_prefix' => 'wpis',
	'table_prefix' => $wpdb->prefix . 'wpis_',
	'options_prefix' => 'wpis_',
	'head_title_prefix' => 'ImageShare Plug-in: '
);

// Additional plugin data, based of off (part of) the existing plugin data
$plugindata['plugin_page'] = 'admin.php?page=' . $plugindata['unique_plugin_identifier'];
$plugindata['plugin_url'] = WP_PLUGIN_URL . '/' . $plugindata['plugin_name'];
?>