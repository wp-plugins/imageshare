<?php
// Load plug-in essentials
require_once 'load.php';

$wpaa = new WPIS_ImageShare($plugindata);

$wpaa->uninstall();
?>