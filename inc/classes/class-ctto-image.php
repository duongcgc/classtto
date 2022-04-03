<?php

/**
 * The Classtto Image allows to load Classtto template files as well as loading the entire document.
 *
 * Image functions and definitions.
 *
 * @package Classtto\Framework\Image
 *
 * @since   1.0.0
 *
 */

namespace Classtto;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Image initial
 *
 * @since 1.0.0
 */
class Image {
    /**
     * Instance
     *
     * @var $instance
     */
    protected static $instance = null;

    /**
     * Initiator
     *
     * @since 1.0.0
     * @return object
     */
    public static function instance() {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Instantiate the object.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function __construct() {

        /**
         * Fires before the image is loaded.
         *
         * @since 1.0.0
         */
        do_action( 'ctto_before_load_image' );

        /**
         * Fires when the image loads.
         *
         * This hook is the root of Classtto's framework hierarchy. It all starts here!
         *
         * @since 1.0.0
         */
        do_action( 'ctto_load_image' );

        /**
         * Fires after the image is loaded.
         *
         * @since 1.0.0
         */
        do_action( 'ctto_after_load_image' );
    }


    /**
     * Register custom image sizes.
     *
     * @since 1.13.0
     *
     * @return void
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public static function register_image_sizes() {
    }
}
