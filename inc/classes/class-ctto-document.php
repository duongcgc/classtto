<?php

/**
 * Document functions and definitions.
 *
 * @package Classtto
 */

namespace Classtto;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Document initial
 *
 * @since 1.0.0
 */
class Document {
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
        


    }

    
}