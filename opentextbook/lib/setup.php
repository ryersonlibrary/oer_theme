<?php

namespace Roots\Sage\Setup;

use Roots\Sage\Assets;

/**
 * Theme setup
 */
function setup() {
    // Make theme available for translation
    load_theme_textdomain( 'opentextbook', PB_PLUGIN_DIR . 'languages' );

    // Enable plugins to manage the document title
    // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
    add_theme_support( 'title-tag' );

    // Content width
    $GLOBALS['content_width'] = apply_filters( 'opentextbook_publisher_content_width', 640 );

    // Add image sizes for custom logo and book covers
    add_image_size( 'opentextbook-publisher-custom-logo', 99999, 55, false );
    add_image_size( 'opentextbook-publisher-book-cover', 500, 650, true );

    // Enable custom logo support
    add_theme_support( 'custom-logo', [ 'size' => 'opentextbook-publisher-site-logo' ] );

    // Enable HTML5 markup support
    // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
    add_theme_support( 'html5', [ 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ] );

    // Use main stylesheet for visual editor
    // To add custom styles edit /assets/styles/layouts/_tinymce.scss
    add_editor_style( Assets\asset_path( 'styles/main.css' ) );

    //OpenTextBook
    add_theme_support('post-formats', array( 'textbook', 'review' ) );
    register_nav_menus(
        array(
            'primary-menu' => __( 'Primary Menu' ),
            'secondary-menu' => __( 'Secondary Menu' )
        )
        );

    //NEED TO ADD SIDEBARS HERE
    $splashes=array('front','learners','educators','francais');
    foreach($splashes as $splash){
        register_sidebar( array(
            'name'          => __( ucfirst($splash).' Splash', 'opentextbook' ),
            'id'            => $splash.'-splash',
            'description'   => __( 'Add widgets here to appear in your sidebar.', 'opentextbook' ),
            'before_widget' => '<section id="'.$splash.'-splash" class="widget splash %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );
    }
    register_sidebar( array(
        'name'          => __('Footer', 'opentextbook' ),
        'id'            => 'footer',
        'description'   => __( 'Add widgets here to appear in your sidebar.', 'opentextbook' ),
        'before_widget' => '<div class="col-sm-3 col-xs-12"><div id="footer-%1$s" class="widget %2$s">',
        'after_widget'  => '</div></div>',
    ) );
}
add_action( 'after_setup_theme', __NAMESPACE__ . '\\setup' );

/**
 * Theme assets
 */
function assets() {
    wp_enqueue_style( 'opentextbook-publisher/css', Assets\asset_path( 'styles/main.css' ), false, null );
    //wp_enqueue_style( 'opentextbook-publisher/fonts', 'https://fonts.googleapis.com/css?family=Karla:400,700|Spectral:400,400i,700&amp;subset=latin-ext', false, null );
    wp_enqueue_script( 'opentextbook-publisher/skip-link-focus-fix', Assets\asset_path( 'scripts/skip-link-focus-fix.js' ), [], null, true );
    wp_enqueue_script( 'opentextbook-publisher/match-height', Assets\asset_path( 'scripts/matchheight.js' ), [ 'jquery' ], null, true );
    wp_enqueue_script( 'opentextbook-publisher/js', Assets\asset_path( 'scripts/main.js' ), [ 'jquery' ], null, true );
    if(is_page('find') || is_page('catalogue') || is_page('preview')) {
        wp_enqueue_script('opentextbook-publisher/discovery.js', Assets\asset_path('scripts/discovery.js'), ['jquery'], null, true);
    }
    
    if(is_page('catalogue')){
        wp_enqueue_script('opentextbook-publisher/preview_js', Assets\asset_path('scripts/catalogue.js'), ['jquery'], null, true);
    }

    if(is_page('preview')){
        wp_enqueue_script('opentextbook-publisher/preview_js', Assets\asset_path('scripts/preview.js'), ['jquery'], null, true);
    }
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100 );

// Clean up the admin menu
function admin_menu() {
    global $menu, $submenu;

    //remove_menu_page( 'index.php' );
    //remove_menu_page( 'edit.php' );
    //remove_menu_page( 'upload.php' );
    //remove_menu_page( 'link-manager.php' );
    //remove_menu_page( 'edit.php?post_type=page' );
    remove_menu_page( 'edit-comments.php' );
    //remove_submenu_page( 'themes.php', 'nav-menus.php' );
    //remove_menu_page( 'plugins.php' );
    remove_menu_page( 'users.php' );
    //remove_menu_page( 'tools.php' );
    //remove_menu_page( 'options-general.php' );

    //$submenu['themes.php'][6][4] = 'customize-support'; // Fix empty submenu by overriding css. See line ~152 in: ./wp-admin/menu.php
}
add_action( 'admin_menu', __NAMESPACE__ . '\\admin_menu', 1 );

// Hide the admin bar
add_filter( 'show_admin_bar', function () {
    return false;
} );