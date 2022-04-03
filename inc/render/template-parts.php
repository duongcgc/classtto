<?php
/**
 * Loads the Classtto template parts.
 *
 * The template parts contain the structural markup and hooks to which the fragments are attached.
 *
 * @package Classtto\Framework\Render
 *
 * @since   1.0.0
 */

add_action( 'ctto_load_document', 'ctto_header_template', 5 );
/**
 * Echo header template part.
 *
 * @since 1.0.0
 *
 * @return void
 */
function ctto_header_template() {
	get_header();
}
