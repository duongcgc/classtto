<?php
/**
 * Show the appropriate content for the Audio post format.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Class_TTO
 * @since Class TTO 1.0
 */

$content = get_the_content();

if ( has_block( 'core/audio', $content ) ) {
	classtto_print_first_instance_of_block( 'core/audio', $content );
} elseif ( has_block( 'core/embed', $content ) ) {
	classtto_print_first_instance_of_block( 'core/embed', $content );
} else {
	classtto_print_first_instance_of_block( 'core-embed/*', $content );
}

// Add the excerpt.
the_excerpt();
