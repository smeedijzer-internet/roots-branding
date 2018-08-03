<?php
/*
Plugin Name: Roots.io Branding
Plugin URI: https://roots.io
Description: Branding for Roots.io WordPress sites.
Version: 1.0
Author: Michael W. Delaney
Author URI:
License: MIT
*/

namespace Roots\Branding;

/**
 * Set up autoloader
 */
require __DIR__ . '/vendor/autoload.php';

// Define constants
define('ROOTS_BRANDING_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('ROOTS_BRANDING_PLUGIN_URL', plugin_dir_url(__FILE__));

// Branding
$roots_branding = new Init();
