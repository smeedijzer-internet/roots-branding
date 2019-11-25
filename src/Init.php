<?php

namespace Smeedijzer\Branding;

use WP;

// Set up plugin class
class Init
{
    public function __construct()
    {


        add_action('login_enqueue_scripts', [$this, 'login_logo'], 999);
        add_filter('admin_footer_text', [$this, 'admin_footer'], 11);
        add_action('admin_bar_menu', [$this, 'remove_wp_logo'], 99);
        add_action('admin_bar_menu', [$this, 'create_menu'], 1);
        add_action('wp_before_admin_bar_render', [$this, 'menu_custom_logo']);
        add_filter('login_headerurl', [$this, 'login_logo_url']);
        add_filter('login_headertext', [$this, 'login_logo_headertext']);



        add_action( 'login_head', 'wpdev_filter_login_head', 100 );

    }

    public function wpdev_filter_login_head() {

        if ( has_custom_logo() ) :

            $image = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );
            ?>
            <style type="text/css">
                .login h1 a {
                    background-image: url(<?php echo esc_url( $image[0] ); ?>);
                    -webkit-background-size: <?php echo absint( $image[1] )?>px;
                    background-size: <?php echo absint( $image[1] ) ?>px;
                    height: <?php echo absint( $image[2] ) ?>px;
                    width: <?php echo absint( $image[1] ) ?>px;
                }
            </style>
        <?php
        endif;
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
        if ( function_exists( 'the_custom_logo' ) ) {

            $custom_logo_id = get_theme_mod( 'custom_logo' );
            $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
        }
            if ( has_custom_logo() ) {
                echo '<img src="' . esc_url( $logo ) . '" alt="' . get_bloginfo( 'name' ) . '">';
} else {
                echo '<h1>'. get_bloginfo( 'name' ) .'</h1>';
            }
        ?>

    <style type="text/css">
      body.login div#login h1 a {
      background-image: url( <?= esc_url(  wp_get_attachment_image_src(get_theme_mod( 'custom_logo' ), 'full')[0]) ?> );
      background-repeat: no-repeat;
      background-size: auto;
      width: 300px;
          background-color: red;
    }
    </style>
  <?php

    }



    /**
     * Replace login screen logo link
     */
    public function login_logo_url($url)
    {
        return home_url();
    }



    // Replace login logo title
    public function login_logo_headertext()
    {
        return 'Ontwikkeld door Smeedijzer Internet';
    }


    // Create custom admin bar menu
    public function create_menu()
    {
        global $wp_admin_bar;
        $menu_id = 'my-logo';
        $wp_admin_bar->add_node([
          'id' => $menu_id,
          'title' =>
          //'<span class="ab-icon">' . file_get_contents(ROOTS_BRANDING_PLUGIN_DIR . "assets/images/logo-icon.svg") . '</span>',
              '<span class="ab-icon"><img height="20" width="100%" src="' .get_site_icon_url(  ) . '" class="" alt="Nationaal Programma Groningen"></span>',

          'href' => '/'
          ]);
//        $wp_admin_bar->add_node([
//          'parent' => $menu_id,
//          'title' => __('Homepage'),
//          'id' => 'my-logo-home',
//          'href' => 'https://roots.io',
//          'meta' => ['target' => '_blank']
//          ]);
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
        padding: 7px 0!important;
      }
      #wpadminbar #wp-admin-bar-my-logo > .ab-item .ab-icon img {
          width: auto;
          height: 100%;
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
        return '';
    }
}
