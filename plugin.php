<?php
/*
Plugin Name: RusseBlanc Branding
Plugin URI: https://www.russeblanc.com
Description: Branding for RusseBlanc WordPress sites.
Fork from Roots Branding (https://github.com/roots/roots-branding)
Version: 1.0
Author: RusseBlanc
Author URI: https://www.russeblanc.com
License: MIT
*/

namespace RusseBlanc\Branding;

/**
 * Set up autoloader
 */
require __DIR__ . '/vendor/autoload.php';

// Define constants
define('RUSSEBLANC_BRANDING_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('RUSSEBLANC_BRANDING_PLUGIN_URL', plugin_dir_url(__FILE__));

// Branding
$russeblanc_branding = new Init();
