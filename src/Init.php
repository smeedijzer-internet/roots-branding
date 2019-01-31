<?php

namespace Roots\Branding;

// Set up plugin class
class Init
{
    public function __construct()
    {
        add_action('login_enqueue_scripts', [$this, 'login_logo']);
        add_filter('admin_footer_text', [$this, 'admin_footer'], 11);
        add_action('admin_bar_menu', [$this, 'remove_wp_logo'], 999);
        add_action('admin_bar_menu', [$this, 'create_menu'], 1);
        add_action('wp_before_admin_bar_render', [$this, 'menu_custom_logo']);
        add_filter('login_headerurl', [$this, 'login_logo_url']);
        add_filter('login_headertitle', [$this, 'login_logo_title']);

        // IF SOIL
        /**
         * Enable features from Soil when plugin is activated
         * @link https://roots.io/plugins/soil/
         */
        add_theme_support('soil-clean-up');
        add_theme_support('soil-disable-asset-versioning');
        add_theme_support('soil-disable-trackbacks');
        add_theme_support('soil-jquery-cdn');
        add_theme_support('soil-nav-walker');
        add_theme_support('soil-nice-search');
        add_theme_support('soil-relative-urls');

        add_action('phpmailer_init', [$this, 'disable_xmailer']);
        function disable_xmailer($phpmailer) {
            $phpmailer->XMailer = ' ';
        }

        // THUMBNAIL SIZE & QUALITY
        function my_custom_jpeg_quality()
        {
            return 100;
        }
        add_filter('jpeg_quality', [$this, 'my_custom_jpeg_quality']);

        // Hide WordPress Version Info
        remove_action('wp_head', [$this, 'wp_generator']);

        // Remove WordPress Version Number In URL Parameters From JS/CSS
        function hide_wordpress_version_in_script($src, $handle)
        {
            $src = remove_query_arg('ver', $src);
            return $src;
        }
        add_filter( 'style_loader_src', [$this, 'hide_wordpress_version_in_script'], 10, 2 );
        add_filter( 'script_loader_src', [$this, 'hide_wordpress_version_in_script'], 10, 2 );

        /* ADMIN CONFIG */
        // Custom admin login header logo
        function msk_custom_admin_color_palette()
        {
            wp_admin_css_color(
                'msk-colors',
                __('RusseBlanc'),
                App\asset_path('styles/wp-admin.css'),
                array('rgb(213, 43, 30)', 'rgb(31, 31, 31)', 'rgb(213, 43, 30)', 'rgb(255, 255, 255)'),
                array('rgb(213, 43, 30)', 'rgb(31, 31, 31)', 'rgb(213, 43, 30)', 'rgb(255, 255, 255)')
            );
        }
        add_action('admin_init', [$this, 'msk_custom_admin_color_palette']);

        function msk_default_admin_color_palette($user_id) {
            $args = array(
            'ID' => $user_id,
            'admin_color' => 'msk-colors'
            );

            wp_update_user($args);
        }
        add_action('user_register', [$this, 'msk_default_admin_color_palette']);
    }

    /**
    * Remove WordPress admin bar menu
    */
    public function remove_wp_logo($wp_admin_bar)
    {
        $wp_admin_bar->remove_node('wp-logo');
    }

    /**
    * Replace login screen logo
    */
    public function login_logo()
    {
        ?>
    <style type="text/css">
      body.login div#login h1 a {
      background-image: url( <?=(ROOTS_BRANDING_PLUGIN_URL . 'assets/images/logo-icon.svg')?> );
      background-repeat: no-repeat;
      background-size: auto;
      width: 300px;
    }
    </style>
  <?php
    }

    /**
     * Replace login screen logo link
     */
    public function login_logo_url($url)
    {
        return 'https://wwww.russeblanc.com';
    }



    // Replace login logo title
    public function login_logo_title()
    {
        return 'Propulsé avec ❤️ par <a href="https://www.russeblanc.com" style="color:#d52b1e" target="_blank">RUSSE<strong>BLANC</strong></a>';
    }


    // Create custom admin bar m enu
    public function create_menu()
    {
        global $wp_admin_bar;
        $menu_id = 'my-logo';
        $wp_admin_bar->add_node([
          'id' => $menu_id,
          'title' =>
          '<span class="ab-icon">' . file_get_contents(ROOTS_BRANDING_PLUGIN_DIR . "assets/images/logo-icon.svg") . '</span>',
          'href' => '/'
          ]);
        $wp_admin_bar->add_node([
          'parent' => $menu_id,
          'title' => __('Homepage'),
          'id' => 'RusseBlanc',
          'href' => 'https://wwww.russeblanc.com',
          'meta' => ['target' => '_blank']
          ]);
    }


    /**
    * Replace login screen logo
    */
    public function menu_custom_logo()
    {
        ?>
    <style type="text/css">
      #wpadminbar #wp-admin-bar-my-logo > .ab-item .ab-icon {
        height: 20px;
        width: 20px;
        margin-right: 0 !important;
        padding-top: 7px !important;
      }
      #wpadminbar #wp-admin-bar-my-logo > .ab-item .ab-icon svg * {
        fill: currentColor;
      }
    </style>
  <?php
    }

    /**
    * Add "designed and developed..." to admin footer.
    */
    public function admin_footer($content)
    {
        return 'Imaginé & développé avec ❤️ par <a href="https://www.russeblanc.com" style="color:#d52b1e" target="_blank">RUSSE<strong>BLANC</strong></a>';
    }
}
