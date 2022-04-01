<?php
/**
 * Block Styles
 *
 * @link https://developer.wordpress.org/reference/functions/register_block_style/
 *
 * @package WordPress
 * @subpackage Class_TTO
 * @since Class TTO 1.0
 */

if ( function_exists( 'register_block_style' ) ) {
	/**
	 * Register block styles.
	 *
	 * @since Class TTO 1.0
	 *
	 * @return void
	 */
	function classtto_register_block_styles() {
		// Columns: Overlap.
		register_block_style(
			'core/columns',
			array(
				'name'  => 'classtto-columns-overlap',
				'label' => esc_html__( 'Overlap', 'classtto' ),
			)
		);

		// Cover: Borders.
		register_block_style(
			'core/cover',
			array(
				'name'  => 'classtto-border',
				'label' => esc_html__( 'Borders', 'classtto' ),
			)
		);

		// Group: Borders.
		register_block_style(
			'core/group',
			array(
				'name'  => 'classtto-border',
				'label' => esc_html__( 'Borders', 'classtto' ),
			)
		);

		// Image: Borders.
		register_block_style(
			'core/image',
			array(
				'name'  => 'classtto-border',
				'label' => esc_html__( 'Borders', 'classtto' ),
			)
		);

		// Image: Frame.
		register_block_style(
			'core/image',
			array(
				'name'  => 'classtto-image-frame',
				'label' => esc_html__( 'Frame', 'classtto' ),
			)
		);

		// Latest Posts: Dividers.
		register_block_style(
			'core/latest-posts',
			array(
				'name'  => 'classtto-latest-posts-dividers',
				'label' => esc_html__( 'Dividers', 'classtto' ),
			)
		);

		// Latest Posts: Borders.
		register_block_style(
			'core/latest-posts',
			array(
				'name'  => 'classtto-latest-posts-borders',
				'label' => esc_html__( 'Borders', 'classtto' ),
			)
		);

		// Media & Text: Borders.
		register_block_style(
			'core/media-text',
			array(
				'name'  => 'classtto-border',
				'label' => esc_html__( 'Borders', 'classtto' ),
			)
		);

		// Separator: Thick.
		register_block_style(
			'core/separator',
			array(
				'name'  => 'classtto-separator-thick',
				'label' => esc_html__( 'Thick', 'classtto' ),
			)
		);

		// Social icons: Dark gray color.
		register_block_style(
			'core/social-links',
			array(
				'name'  => 'classtto-social-icons-color',
				'label' => esc_html__( 'Dark gray', 'classtto' ),
			)
		);
	}
	add_action( 'init', 'classtto_register_block_styles' );
}
