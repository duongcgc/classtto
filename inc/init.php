<?php
/**
 * Prepare and initialize the Classtto framework.
 *
 * @package Classtto\Framework
 *
 * @since 1.0.0
 */

add_action( 'ctto_init', 'ctto_define_constants', -1 );

/**
 * Define constants.
 *
 * @since  1.0.0
 * @ignore
 *
 * @return void
 */
function ctto_define_constants() {

	// get array line of Version meta in file /style.css => return array theme version.
	$theme_data = get_file_data( get_template_directory() . '/style.css', array( 'Version', 'Text Domain' ), 'ctto' );

	// Define version.
	// get just value of version array.
	define( 'CTTO_VERSION', array_shift( $theme_data ) );
	define( 'CTTO_NAME', 'Class TTO' );
	define( 'CTTO_SLUG', $theme_data[0] );

	// Define paths.
	if ( ! defined( 'CTTO_THEME_PATH' ) ) {

		// wp_normalize_path convert all \ into /
		// trailingslashit add / into lastest of path.
		define( 'CTTO_THEME_PATH', wp_normalize_path( trailingslashit( get_template_directory() ) ) );
	}

	define( 'CTTO_ASSETS_PATH', CTTO_THEME_PATH . 'assets/' );
	define( 'CTTO_LANGUAGES_PATH', CTTO_THEME_PATH . 'languages/' );
	define( 'CTTO_INC_PATH', CTTO_THEME_PATH . 'inc/' );
	define( 'CTTO_CLASSES_PATH', CTTO_INC_PATH . 'classes/' );
	define( 'CTTO_FUNCS_PATH', CTTO_INC_PATH . 'functions/' );
	define( 'CTTO_BUILDER_PATH', CTTO_INC_PATH . 'builder/' );           // builders templates.
	define( 'CTTO_RENDER_PATH', CTTO_INC_PATH . 'render/' );             // loaders templates.
	define( 'CTTO_TEMPLATES_PATH', CTTO_THEME_PATH . 'templates/' );
	define( 'CTTO_LAYOUT_PATH', CTTO_TEMPLATES_PATH . 'layout/' );       // structure of template.
	define( 'CTTO_PARTS_PATH', CTTO_TEMPLATES_PATH . 'parts/' );         // sections of template - template_parts.
	define( 'CTTO_PATTERNS_PATH', CTTO_TEMPLATES_PATH . 'patterns/' );   // components of template - block_patterns.
	define( 'CTTO_PARTIALS_PATH', CTTO_TEMPLATES_PATH . 'partials/' );   // partials - elements - blocks - widgets - shortcodes.

	// Define urls.
	if ( ! defined( 'CTTO_THEME_URL' ) ) {
		define( 'CTTO_THEME_URL', trailingslashit( get_template_directory_uri() ) );
	}

	define( 'CTTO_CLASSES_URL', CTTO_THEME_URL . 'classes/' );
	define( 'CTTO_ASSETS_URL', CTTO_THEME_URL . 'assets/' );
	define( 'CTTO_SASS_URL', CTTO_ASSETS_URL . 'sass/' );
	define( 'CTTO_JS_URL', CTTO_ASSETS_URL . 'js/' );
	define( 'CTTO_IMAGE_URL', CTTO_ASSETS_URL . 'images/' );

	// Define admin paths.
	define( 'CTTO_ADMIN_PATH', CTTO_INC_PATH . 'admin/' );

	// Define admin url.
	define( 'CTTO_ADMIN_URL', CTTO_THEME_URL . 'admin/' );
	define( 'CTTO_ADMIN_ASSETS_URL', CTTO_ADMIN_URL . 'assets/' );
	define( 'CTTO_ADMIN_JS_URL', CTTO_ADMIN_ASSETS_URL . 'js/' );

	// Define helpers.
	define( 'CTTO_IMAGE_SIZE_OPTION', CTTO_SLUG . '_image_sizes' );
}

add_action( 'ctto_init', 'ctto_load_dependencies', 5 );
/**
 * Load dependencies.
 *
 * @since  1.0.0
 * @ignore
 *
 * @return void
 */
function ctto_load_dependencies() {

	include_once CTTO_CLASSES_PATH . 'init.php';    // init classes.

	/**
	 * Fires before Classtto CLASSES loads.
	 *
	 * @since 1.0.0
	 */
	do_action( 'ctto_before_load_classes' );

	$components = array(
		'classes',
		'builder',
		'render',
	);

	if ( class_exists( 'Elementor\Plugin' ) ) {
		$components[] = 'elementor';
	}

	if ( class_exists( 'woocommerce' ) ) {
		$components[] = 'woocommerce';
	}

	// Load the necessary Classtto components.
	ctto_load_components( $components );

	// Add third party styles and scripts compiler support.
	// ctto_add_classes_component_support('wp_styles_compiler');
	// ctto_add_classes_component_support('wp_scripts_compiler');.

	/**
	 * Fires after Classtto CLASSES loads.
	 *
	 * @since 1.0.0
	 */
	do_action( 'ctto_after_load_classes' );
}

add_action( 'ctto_init', 'ctto_add_theme_support' );
/**
 * Add theme support.
 *
 * @since  1.0.0
 * @ignore
 *
 * @return void
 */
function ctto_add_theme_support() {
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* This theme does not use a hard-coded <title> tag in the document head,
		* WordPress will provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/**
	 * Add post-formats support.
	 */
	add_theme_support(
		'post-formats',
		array(
			'link',
			'aside',
			'gallery',
			'image',
			'quote',
			'status',
			'video',
			'audio',
			'chat',
		)
	);

	/**
	* Enable support for Post Thumbnails on posts and pages.
	*
	* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	*/
	add_theme_support( 'post-thumbnails' );

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
			'navigation-widgets',
		)
	);

	/*
		* Add support for core custom logo.
		*
		* @link https://codex.wordpress.org/Theme_Logo
		*/
	$logo_width  = 300;
	$logo_height = 100;

	add_theme_support(
		'custom-logo',
		array(
			'height'               => $logo_height,
			'width'                => $logo_width,
			'flex-width'           => true,
			'flex-height'          => true,
			'unlink-homepage-logo' => true,
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Add support for Block Styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add support for editor styles.
	add_theme_support( 'editor-styles' );
	$background_color = get_theme_mod( 'background_color', 'D1E4DD' );
	if ( 127 > CTTO_Custom_Colors::get_relative_luminance_from_hex( $background_color ) ) {
		add_theme_support( 'dark-editor-style' );
	}

	$editor_stylesheet_path = './assets/css/style-editor.css';

	// Note, the is_IE global variable is defined by WordPress and is used
	// to detect if the current browser is internet explorer.
	global $is_IE;
	if ( $is_IE ) {
		$editor_stylesheet_path = './assets/css/ie-editor.css';
	}

	// Enqueue editor styles.
	add_editor_style( $editor_stylesheet_path );

	// Add custom editor font sizes.
	add_theme_support(
		'editor-font-sizes',
		array(
			array(
				'name'      => esc_html__( 'Extra small', 'ctto' ),
				'shortName' => esc_html_x( 'XS', 'Font size', 'ctto' ),
				'size'      => 16,
				'slug'      => 'extra-small',
			),
			array(
				'name'      => esc_html__( 'Small', 'ctto' ),
				'shortName' => esc_html_x( 'S', 'Font size', 'ctto' ),
				'size'      => 18,
				'slug'      => 'small',
			),
			array(
				'name'      => esc_html__( 'Normal', 'ctto' ),
				'shortName' => esc_html_x( 'M', 'Font size', 'ctto' ),
				'size'      => 20,
				'slug'      => 'normal',
			),
			array(
				'name'      => esc_html__( 'Large', 'ctto' ),
				'shortName' => esc_html_x( 'L', 'Font size', 'ctto' ),
				'size'      => 24,
				'slug'      => 'large',
			),
			array(
				'name'      => esc_html__( 'Extra large', 'ctto' ),
				'shortName' => esc_html_x( 'XL', 'Font size', 'ctto' ),
				'size'      => 40,
				'slug'      => 'extra-large',
			),
			array(
				'name'      => esc_html__( 'Huge', 'ctto' ),
				'shortName' => esc_html_x( 'XXL', 'Font size', 'ctto' ),
				'size'      => 96,
				'slug'      => 'huge',
			),
			array(
				'name'      => esc_html__( 'Gigantic', 'ctto' ),
				'shortName' => esc_html_x( 'XXXL', 'Font size', 'ctto' ),
				'size'      => 144,
				'slug'      => 'gigantic',
			),
		)
	);

	// Custom background color.
	add_theme_support(
		'custom-background',
		array(
			'default-color' => 'd1e4dd',
		)
	);

	// Editor color palette.
	$black     = '#000000';
	$dark_gray = '#28303D';
	$gray      = '#39414D';
	$green     = '#D1E4DD';
	$blue      = '#D1DFE4';
	$purple    = '#D1D1E4';
	$red       = '#E4D1D1';
	$orange    = '#E4DAD1';
	$yellow    = '#EEEADD';
	$white     = '#FFFFFF';

	add_theme_support(
		'editor-color-palette',
		array(
			array(
				'name'  => esc_html__( 'Black', 'ctto' ),
				'slug'  => 'black',
				'color' => $black,
			),
			array(
				'name'  => esc_html__( 'Dark gray', 'ctto' ),
				'slug'  => 'dark-gray',
				'color' => $dark_gray,
			),
			array(
				'name'  => esc_html__( 'Gray', 'ctto' ),
				'slug'  => 'gray',
				'color' => $gray,
			),
			array(
				'name'  => esc_html__( 'Green', 'ctto' ),
				'slug'  => 'green',
				'color' => $green,
			),
			array(
				'name'  => esc_html__( 'Blue', 'ctto' ),
				'slug'  => 'blue',
				'color' => $blue,
			),
			array(
				'name'  => esc_html__( 'Purple', 'ctto' ),
				'slug'  => 'purple',
				'color' => $purple,
			),
			array(
				'name'  => esc_html__( 'Red', 'ctto' ),
				'slug'  => 'red',
				'color' => $red,
			),
			array(
				'name'  => esc_html__( 'Orange', 'ctto' ),
				'slug'  => 'orange',
				'color' => $orange,
			),
			array(
				'name'  => esc_html__( 'Yellow', 'ctto' ),
				'slug'  => 'yellow',
				'color' => $yellow,
			),
			array(
				'name'  => esc_html__( 'White', 'ctto' ),
				'slug'  => 'white',
				'color' => $white,
			),
		)
	);

	add_theme_support(
		'editor-gradient-presets',
		array(
			array(
				'name'     => esc_html__( 'Purple to yellow', 'ctto' ),
				'gradient' => 'linear-gradient(160deg, ' . $purple . ' 0%, ' . $yellow . ' 100%)',
				'slug'     => 'purple-to-yellow',
			),
			array(
				'name'     => esc_html__( 'Yellow to purple', 'ctto' ),
				'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $purple . ' 100%)',
				'slug'     => 'yellow-to-purple',
			),
			array(
				'name'     => esc_html__( 'Green to yellow', 'ctto' ),
				'gradient' => 'linear-gradient(160deg, ' . $green . ' 0%, ' . $yellow . ' 100%)',
				'slug'     => 'green-to-yellow',
			),
			array(
				'name'     => esc_html__( 'Yellow to green', 'ctto' ),
				'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $green . ' 100%)',
				'slug'     => 'yellow-to-green',
			),
			array(
				'name'     => esc_html__( 'Red to yellow', 'ctto' ),
				'gradient' => 'linear-gradient(160deg, ' . $red . ' 0%, ' . $yellow . ' 100%)',
				'slug'     => 'red-to-yellow',
			),
			array(
				'name'     => esc_html__( 'Yellow to red', 'ctto' ),
				'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $red . ' 100%)',
				'slug'     => 'yellow-to-red',
			),
			array(
				'name'     => esc_html__( 'Purple to red', 'ctto' ),
				'gradient' => 'linear-gradient(160deg, ' . $purple . ' 0%, ' . $red . ' 100%)',
				'slug'     => 'purple-to-red',
			),
			array(
				'name'     => esc_html__( 'Red to purple', 'ctto' ),
				'gradient' => 'linear-gradient(160deg, ' . $red . ' 0%, ' . $purple . ' 100%)',
				'slug'     => 'red-to-purple',
			),
		)
	);

	/*
	* Adds starter content to highlight the theme on fresh sites.
	* This is done conditionally to avoid loading the starter content on every
	* page load, as it is a one-off operation only needed once in the customizer.
	*/
	if ( is_customize_preview() ) {
		require get_template_directory() . '/inc/starter-content.php';
		add_theme_support( 'starter-content', ctto_get_starter_content() );
	}

	// Add support for responsive embedded content.
	add_theme_support( 'responsive-embeds' );

	// Add support for custom line height controls.
	add_theme_support( 'custom-line-height' );

	// Add support for experimental link color control.
	add_theme_support( 'experimental-link-color' );

	// Add support for experimental cover block spacing.
	add_theme_support( 'custom-spacing' );

	// Add support for custom units.
	// This was removed in WordPress 5.6 but is still required to properly support WP 5.5.
	add_theme_support( 'custom-units' );

	// Remove feed icon link from legacy RSS widget.
	add_filter( 'rss_widget_feed_link', '__return_false' );

	// Define thumbnail image sizes.
	\Classtto\Image::register_image_sizes();
}


add_action( 'ctto_init', 'ctto_includes' );
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
	if ( is_admin() ) {
		require_once CTTO_ADMIN_PATH . 'tgmpa/class-tgm-plugin-activation.php';
		require_once CTTO_ADMIN_PATH . 'tgmpa/functions.php';
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
		// require_once CTTO_ADMIN_PATH . 'welcome/welcome.php';.
	}

	// Include assets. Here make attachment scripts and styles into main template.
	include_once CTTO_CLASSES_PATH . 'class-assets.php';

	// Include renderers. Here connector partials with main template.
	include_once CTTO_RENDER_PATH . 'template-layout.php';
	include_once CTTO_RENDER_PATH . 'template-parts.php';
	include_once CTTO_RENDER_PATH . 'template-patterns.php';
	include_once CTTO_RENDER_PATH . 'template-partials.php';
	include_once CTTO_RENDER_PATH . 'template-menu.php';
	include_once CTTO_RENDER_PATH . 'widget-area.php';
	include_once CTTO_RENDER_PATH . 'menu-walker.php';
}

add_action( 'ctto_init', 'ctto_load_textdomain' );
/**
 * Load text domain.
 *
 * @since 1.0.0
 * @ignore
 *
 * @return void
 */
function ctto_load_textdomain() {
	/**
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Class TTO, use a find and replace
	 * to change 'ctto' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'ctto', CTTO_LANGUAGES_PATH );
}

/**
 * Fires before Classtto loads.
 *
 * @since 1.0.0
 */
do_action( 'ctto_before_init' );

/**
 * Load Classtto framework.
 *
 * 1 - ctto_define_constants *
 * 2 - ctto_load_dependencies *
 * 3 - ctto_add_theme_support *
 * 4 - ctto_includes *
 * 5 - ctto_load_textdomain *
 * 6 - ctto_wc_add_theme_support
 *
 * @since 1.0.0
 */
do_action( 'ctto_init' );

/**
 * Fires after Classtto loads.
 *
 * @since 1.0.0
 */
do_action( 'ctto_after_init' );
