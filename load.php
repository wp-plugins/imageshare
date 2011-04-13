<?php
// Global variables
global $wpdb;

// Plug-in data
require_once 'config/plugindata.php';

// Database tables
require_once 'config/dbtables.php';

// Icons
require_once 'config/icons.php';

// Defines
define('WPAA_ABSPATH', ABSPATH . '/wp-content/plugins/' . $plugindata['plugin_name']);

// Plug-in classes
require_once 'includes/class.ImageShare.php';
require_once 'includes/class.ImageShare_Frontend.php';
require_once 'includes/class.ImageShare_Admin.php';
?>