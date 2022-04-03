<?php
/**
 * Block Styles
 *
 * @link https://developer.wordpress.org/reference/functions/register_block_style/
 *
 * @package WordPress
 * @subpackage CTTO
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
	function ctto_register_block_styles() {
		// Columns: Overlap.
		register_block_style(
			'core/columns',
			array(
				'name'  => 'ctto-columns-overlap',
				'label' => esc_html__( 'Overlap', 'ctto' ),
			)
		);

		// Cover: Borders.
		register_block_style(
			'core/cover',
			array(
				'name'  => 'ctto-border',
				'label' => esc_html__( 'Borders', 'ctto' ),
			)
		);

		// Group: Borders.
		register_block_style(
			'core/group',
			array(
				'name'  => 'ctto-border',
				'label' => esc_html__( 'Borders', 'ctto' ),
			)
		);

		// Image: Borders.
		register_block_style(
			'core/image',
			array(
				'name'  => 'ctto-border',
				'label' => esc_html__( 'Borders', 'ctto' ),
			)
		);

		// Image: Frame.
		register_block_style(
			'core/image',
			array(
				'name'  => 'ctto-image-frame',
				'label' => esc_html__( 'Frame', 'ctto' ),
			)
		);

		// Latest Posts: Dividers.
		register_block_style(
			'core/latest-posts',
			array(
				'name'  => 'ctto-latest-posts-dividers',
				'label' => esc_html__( 'Dividers', 'ctto' ),
			)
		);

		// Latest Posts: Borders.
		register_block_style(
			'core/latest-posts',
			array(
				'name'  => 'ctto-latest-posts-borders',
				'label' => esc_html__( 'Borders', 'ctto' ),
			)
		);

		// Media & Text: Borders.
		register_block_style(
			'core/media-text',
			array(
				'name'  => 'ctto-border',
				'label' => esc_html__( 'Borders', 'ctto' ),
			)
		);

		// Separator: Thick.
		register_block_style(
			'core/separator',
			array(
				'name'  => 'ctto-separator-thick',
				'label' => esc_html__( 'Thick', 'ctto' ),
			)
		);

		// Social icons: Dark gray color.
		register_block_style(
			'core/social-links',
			array(
				'name'  => 'ctto-social-icons-color',
				'label' => esc_html__( 'Dark gray', 'ctto' ),
			)
		);
	}
	add_action( 'init', 'ctto_register_block_styles' );
}
