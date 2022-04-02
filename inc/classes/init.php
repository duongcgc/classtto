<?php

/**
 *
 * Load the INC components.
 *
 * @since 1.0.0
 *
 * @package Classtto\Framework\INC
 */

// Stop here if the INC was already loaded.
if (defined('CTTO_INC')) {
    return;
}

// Declare Classtto INC.
define('CTTO_INC', true);

// Mode.
if (!defined('SCRIPT_DEBUG')) {
    define('SCRIPT_DEBUG', false); // @phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedConstantFound -- Valid use case as we need it defined.
}

// Assets.
define('CTTO_MIN_CSS', SCRIPT_DEBUG ? '' : '.min');
define('CTTO_MIN_JS', SCRIPT_DEBUG ? '' : '.min');
define('CTTO_RTL', is_rtl() ? '-rtl' : '');

// Path.
if (!defined('CTTO_INC_PATH')) {
    define('CTTO_INC_PATH', wp_normalize_path(trailingslashit(dirname(__FILE__))));
}

define('CTTO_INC_ADMIN_PATH', CTTO_INC_PATH . 'admin/');

// Load dependencies here, as these are used further down.
require_once CTTO_INC_PATH . 'utilities/functions.php';
require_once CTTO_INC_PATH . 'components.php';

// Url.
if (!defined('CTTO_INC_URL')) {
    define('CTTO_INC_URL', jupiterx_path_to_url(CTTO_INC_PATH));
}

// Backwards compatibility constants.
define('CTTO_INC_COMPONENTS_PATH', CTTO_INC_PATH);
define('CTTO_INC_COMPONENTS_ADMIN_PATH', CTTO_INC_PATH . 'admin/');
define('CTTO_INC_COMPONENTS_URL', CTTO_INC_URL);
