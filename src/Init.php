<?php

namespace Roots\Branding;

// Set up plugin class
class Init
{
    public function __construct()
    {
        add_action('login_enqueue_scripts', [$this, 'loginLogo']);
        add_filter('admin_footer_text', [$this, 'adminFooter'], 11);
        add_action('admin_bar_menu', [$this, 'removeWPLogo'], 999);
        add_action('admin_bar_menu', [$this, 'createMenu'], 1);
        add_action('wp_before_admin_bar_render', [$this, 'menuCustomLogo']);
        add_filter('login_headerurl', [$this, 'loginLogoUrl']);
        add_filter('login_headertext', [$this, 'loginLogoHeadertext']);
    }


    /**
    * Remove WordPress admin bar menu
    */
    public function removeWPLogo($wp_admin_bar)
    {
        $wp_admin_bar->remove_node('wp-logo');
    }


    /**
    * Replace login screen logo
    */
    public function loginLogo()
    {
        ?>
          <style>
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
    public function loginLogoUrl($url)
    {
        return 'https://roots.io';
    }



    // Replace login logo title
    public function loginLogoHeadertext()
    {
        return 'Powered by Roots';
    }


    // Create custom admin bar m enu
    public function createMenu()
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
          'id' => 'my-logo-home',
          'href' => 'https://roots.io',
          'meta' => ['target' => '_blank']
        ]);
    }


    /**
    * Replace login screen logo
    */
    public function menuCustomLogo()
    {
        ?>
          <style>
            #wpadminbar #wp-admin-bar-my-logo > .ab-item .ab-icon {
              height: 20px;
              width: 20px;
              margin-right: 0 !important;
              padding-top: 7px !important;
            }

            #wpadminbar #wp-admin-bar-my-logo > .ab-item .ab-icon svg * {
              fill: currentColor;
            }

            .components-button.edit-post-fullscreen-mode-close.has-icon::after {
              content: url( <?=ROOTS_BRANDING_PLUGIN_URL . 'assets/images/logo-icon-white.svg' ?> );
              width: 50px;
              height: 35px;
            }

            .components-button.edit-post-fullscreen-mode-close.has-icon svg {
              display: none;
            }
          </style>
        <?php
    }

    /**
    * Add "designed and developed..." to admin footer.
    */
    public function adminFooter($content)
    {
        return 'Site powered by <a href="https://roots.io">Roots</a>';
    }
}
