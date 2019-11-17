<?php
/*
Plugin Name: Smeedijzer Internet Branding
Plugin URI: https://www.smeedijzer.net
Description: Branding for Roots WordPress sites.
Version: 1.0
Author: Smeedijzer Internet
Author URI:
License: MIT
*/

namespace Smeedijzer\Branding;

/**
 * Set up autoloader
 */
require __DIR__ . '/vendor/autoload.php';

// Define constants
define('ROOTS_BRANDING_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('ROOTS_BRANDING_PLUGIN_URL', plugin_dir_url(__FILE__));

// Branding
$roots_branding = new Init();
