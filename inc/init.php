<?php

/**
 * Prepare and initialize the Classtto framework.
 *
 * @package Classtto\Framework
 *
 * @since 1.0.0
 */

add_action('ctto_init', 'ctto_define_constants', -1);
/**
 * Define constants.
 *
 * @since  1.0.0
 * @ignore
 *
 * @return void
 */
function ctto_define_constants() {

    // get array line of Version meta in file /style.css => return array theme version
    $theme_data = get_file_data(get_template_directory() . '/style.css', ['Version', 'Text Domain'], 'ctto');

    // Define version.
    // get just value of version array
    define('CTTO_VERSION', array_shift($theme_data));
    define('CTTO_NAME', 'Class TTO');
    define('CTTO_SLUG', $theme_data[0]);


    // Define paths.
    if (!defined('CTTO_THEME_PATH')) {

        // wp_normalize_path convert all \ into / 
        // trailingslashit add / into lastest of path
        define('CTTO_THEME_PATH', wp_normalize_path(trailingslashit(get_template_directory())));
    }

    define('CTTO_ASSETS_PATH', CTTO_THEME_PATH . 'assets/');
    define('CTTO_LANGUAGES_PATH', CTTO_THEME_PATH . 'languages/');
    define('CTTO_INC_PATH', CTTO_THEME_PATH . 'inc/');
    define('CTTO_CLASSES_PATH', CTTO_INC_PATH . 'classes/');
    define('CTTO_FUNCS_PATH', CTTO_INC_PATH . 'functions/');
    define('CTTO_BUILDER_PATH', CTTO_INC_PATH . 'builder/');           // builders templates
    define('CTTO_RENDER_PATH', CTTO_INC_PATH . 'render/');             // loaders templates
    define('CTTO_TEMPLATES_PATH', CTTO_THEME_PATH . 'templates/');
    define('CTTO_LAYOUT_PATH', CTTO_TEMPLATES_PATH . 'layout/');       // structure of template
    define('CTTO_PARTS_PATH', CTTO_TEMPLATES_PATH . 'parts/');         // sections of template - template_parts
    define('CTTO_PATTERNS_PATH', CTTO_TEMPLATES_PATH . 'patterns/');   // components of template - block_patterns
    define('CTTO_PARTIALS_PATH', CTTO_TEMPLATES_PATH . 'partials/');   // partials - elements - blocks - widgets - shortcodes

    // Define urls.
    if (!defined('CTTO_THEME_URL')) {
        define('CTTO_THEME_URL', trailingslashit(get_template_directory_uri()));
    }

    define('CTTO_CLASSES_URL', CTTO_THEME_URL . 'classes/');
    define('CTTO_ASSETS_URL', CTTO_THEME_URL . 'assets/');
    define('CTTO_SASS_URL', CTTO_ASSETS_URL . 'sass/');
    define('CTTO_JS_URL', CTTO_ASSETS_URL . 'js/');
    define('CTTO_IMAGE_URL', CTTO_ASSETS_URL . 'images/');

    // Define admin paths.
    define('CTTO_ADMIN_PATH', CTTO_INC_PATH . 'admin/');

    // Define admin url.
    define('CTTO_ADMIN_URL', CTTO_THEME_URL . 'admin/');
    define('CTTO_ADMIN_ASSETS_URL', CTTO_ADMIN_URL . 'assets/');
    define('CTTO_ADMIN_JS_URL', CTTO_ADMIN_ASSETS_URL . 'js/');

    // Define helpers.
    define('CTTO_IMAGE_SIZE_OPTION', CTTO_SLUG . '_image_sizes');
}

add_action('ctto_init', 'ctto_load_dependencies', 5);
/**
 * Load dependencies.
 *
 * @since  1.0.0
 * @ignore
 *
 * @return void
 */
function ctto_load_dependencies() {

    include_once CTTO_CLASSES_PATH . 'init.php';    // init classes

    /**
     * Fires before Classtto CLASSES loads.
     *
     * @since 1.0.0
     */
    do_action('ctto_before_load_classes');

    $components = [
        'classes',
        // 'compatibility',
        // 'actions',
        // 'post-meta',
        // 'image',
        // 'fonts',
        // 'customizer',
        // 'custom-fields',
        // 'layout',
        // 'header',
        // 'menu',
        // 'widget',
        // 'footer',
        // 'onboarding',        
    ];

    if (class_exists('Elementor\Plugin')) {
        $components[] = 'elementor';
    }

    if (class_exists('woocommerce')) {
        $components[] = 'woocommerce';
    }

    // Load the necessary Classtto components.
    ctto_load_components($components);

    // Add third party styles and scripts compiler support.
    // ctto_add_classes_component_support('wp_styles_compiler');
    // ctto_add_classes_component_support('wp_scripts_compiler');

    /**
     * Fires after Classtto CLASSES loads.
     *
     * @since 1.0.0
     */
    do_action('ctto_after_load_classes');
}

add_action('ctto_init', 'ctto_add_theme_support');
/**
 * Add theme support.
 *
 * @since  1.0.0
 * @ignore
 *
 * @return void
 */
function ctto_add_theme_support() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));

    // Gutenberg.
    add_theme_support('wp-block-styles');
    add_theme_support('editor-styles');

    // Jupiter specific.
    add_theme_support('ctto-default-styling');

    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-slider');
    add_theme_support('woocommerce');

    // Define thumbnail image sizes
    \Classtto\Image::register_image_sizes();
}


add_action('ctto_init', 'ctto_includes');
/**
 * Include framework files.
 *
 * @since  1.0.0
 * @ignore
 *
 * @return void
 */
function ctto_includes() {

    // Include admin.
    if (is_admin()) {
        // require_once CTTO_ADMIN_PATH . 'tgmpa/class-tgm-plugin-activation.php';
        // require_once CTTO_ADMIN_PATH . 'tgmpa/functions.php';
        // require_once CTTO_ADMIN_PATH . 'assets.php';
        // require_once CTTO_ADMIN_PATH . 'core-install/core-install.php';
        // require_once CTTO_ADMIN_PATH . 'functions.php';
        // require_once CTTO_ADMIN_PATH . 'license-manager.php';
        // require_once CTTO_ADMIN_PATH . 'control-panel/control-panel.php';
        // require_once CTTO_ADMIN_PATH . 'setup-wizard/setup-wizard.php';
        // require_once CTTO_ADMIN_PATH . 'update-plugins/class-update-plugins.php';
        // require_once CTTO_ADMIN_PATH . 'update-plugins/functions.php';
        // require_once CTTO_ADMIN_PATH . 'update-theme/class-update-theme.php';
        // require_once CTTO_ADMIN_PATH . 'notices/survey-notification-bar.php';
        // require_once CTTO_ADMIN_PATH . 'notices/feedback-notification-bar.php';
        // require_once CTTO_ADMIN_PATH . 'welcome/welcome.php';
    }

    // Include assets. Here make attachment scripts and styles into main template
    include_once CTTO_CLASSES_PATH . 'class-ctto-assets.php';

    // Include renderers. Here connector partials with main template
    include_once CTTO_RENDER_PATH . 'template-layout.php';
    include_once CTTO_RENDER_PATH . 'template-parts.php';
    include_once CTTO_RENDER_PATH . 'template-patterns.php';
    include_once CTTO_RENDER_PATH . 'template-partials.php';
    include_once CTTO_RENDER_PATH . 'template-menu.php';
    include_once CTTO_RENDER_PATH . 'widget-area.php';
    include_once CTTO_RENDER_PATH . 'menu-walker.php';
}

/**
 * Fires before Classtto loads.
 *
 * @since 1.0.0
 */
do_action('ctto_before_init');

/**
 * Load Classtto framework.
 * 
 * 1 - ctto_define_constants
 * 
 * 2 - ctto_load_dependencies
 *          
 * 3 - ctto_add_theme_support
 * 
 * 4 - ctto_includes
 * 
 * 5 - ctto_load_textdomain
 * 
 * 6 - ctto_wc_add_theme_support
 * 
 * @since 1.0.0
 */
do_action('ctto_init');

/**
 * Fires after Classtto loads.
 *
 * @since 1.0.0
 */
do_action('ctto_after_init');
