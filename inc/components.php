<?php
/**
 * The Classtto Component defines which INC components of the framework are loaded.
 *
 * It can be different on a per page bases. This keeps Classtto as performant and lightweight as possible
 * by only loading what is needed.
 *
 * @package Classtto\Framework\INC
 *
 * @since 1.0.0
 */

/**
 * Load Classtto INC components.
 *
 * This function loads Classtto INC components. Components are only loaded once, even if they are called many times.
 * Admin components and functions are automatically wrapped in an is_admin() check.
 *
 * @since 1.0.0
 *
 * @param string|array $components Name of the INC component(s) to include as and indexed array. The name(s) must be
 *                                 the Classtto INC component folder.
 *
 * @return bool Will always return true.
 * @SuppressWarnings(PHPMD.ElseExpression)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
function ctto_load_components( $components ) {
	static $loaded = array();

	$root = CTTO_INC_PATH;

	$common = array(
		'classes'         => array(
			$root . 'classes/init.php',
			$root . 'classes/class-template.php',
			$root . 'classes/class-html.php',
			$root . 'classes/class-image.php',
			$root . 'classes/class-custom-colors.php',
		),
		'compatibility'   => array(
			$root . 'compatibility/functions.php',
			$root . 'compatibility/class.php',
		),

		'actions'         => $root . 'actions/functions.php',
		'filters'         => $root . 'filters/functions.php',
		'fonts'           => $root . 'fonts/class.php',
		'customizer'      => array(
			$root . 'customizer/class-utils.php',
			$root . 'customizer/functions.php',
		),
		'custom-fields'   => array(
			$root . 'custom-fields/functions.php',
			$root . 'custom-fields/class.php',
		),
		'layout'          => $root . 'layout/functions.php',
		'header'          => $root . 'header/functions.php',
		'widget'          => $root . 'widget/functions.php',
		'menu'            => $root . 'menu/class.php',
		'footer'          => $root . 'footer/functions.php',
		'woocommerce'     => $root . 'woocommerce/functions.php',
		'elementor'       => $root . 'elementor/functions.php',
		'lazy-load'       => $root . 'lazy-load/functions.php',
		'events-calendar' => $root . 'events-calendar/functions.php',
	);

	// Only load admin fragments if is_admin() is true.
	if ( is_admin() ) {
		$admin = array(
			'options'    => $root . 'options/functions.php',
			'elementor'  => $root . 'elementor/functions-admin.php',
			'api'        => $root . 'api/ajax.php',
			'onboarding' => $root . 'onboarding/functions.php',
		);
	} else {
		$admin = array();
	}

	// Set dependencies.
	$dependencies = array(
		'html'      => array(
			'filters',
		),
		'fields'    => array(
			'actions',
			'html',
		),
		'options'   => 'fields',
		'post-meta' => 'fields',
		'layout'    => 'fields',
	);

	foreach ( (array) $components as $component ) {

		// Stop here if the component is already loaded or doesn't exist.
		if ( in_array( $component, $loaded, true ) || ( ! isset( $common[ $component ] ) && ! isset( $admin[ $component ] ) ) ) {
			continue;
		}

		// Cache loaded component before calling dependencies.
		$loaded[] = $component;

		// Load dependencies.
		if ( array_key_exists( $component, $dependencies ) ) {
			ctto_load_components( $dependencies[ $component ] );
		}

		$_components = array();

		// Add common components.
		if ( isset( $common[ $component ] ) ) {
			$_components = (array) $common[ $component ];
		}

		// Add admin components.
		if ( isset( $admin[ $component ] ) ) {
			$_components = array_merge( (array) $_components, (array) $admin[ $component ] );
		}

		// Load components.
		foreach ( $_components as $component_path ) {
			require_once $component_path;
		}

		/**
		 * Fires when an INC component is loaded.
		 *
		 * The dynamic portion of the hook name, $component, refers to the name of the INC component loaded.
		 *
		 * @since 1.0.0
		 */
		do_action( 'ctto_loaded_component_' . $component );
	}

	return true;
}

/**
 * Register INC component support.
 *
 * @since 1.0.0
 *
 * @param string $feature The feature to register.
 *
 * @return bool Will always return true.
 * @SuppressWarnings(PHPMD.ElseExpression)
 */
function ctto_add_component_support( $feature ) {
	global $_ctto_components_support;

	$args = func_get_args();

	if ( 1 === func_num_args() ) {
		$args = true;
	} else {
		$args = array_slice( $args, 1 );
	}

	$_ctto_components_support[ $feature ] = $args;

	return true;
}

/**
 * Gets the INC component support argument(s).
 *
 * @since 1.0.0
 *
 * @param string $feature The feature to check.
 *
 * @return mixed The argument(s) passed.
 */
function ctto_get_component_support( $feature ) {
	global $_ctto_components_support;

	if ( ! isset( $_ctto_components_support[ $feature ] ) ) {
		return false;
	}

	return $_ctto_components_support[ $feature ];
}

/**
 * Remove INC component support.
 *
 * @since 1.0.0
 *
 * @param string $feature The feature to remove.
 *
 * @return bool Will always return true.
 */
function ctto_remove_component_support( $feature ) {
	global $_ctto_components_support;
	unset( $_ctto_components_support[ $feature ] );
	return true;
}

/**
 * Initialize INC components support global.
 *
 * @ignore
 * @access private
 */
global $_ctto_components_support;

if ( ! isset( $_ctto_components_support ) ) {
	$_ctto_components_support = array();
}
