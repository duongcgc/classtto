<?php
/**
 * Customize API: Class_TTO_Customize_Notice_Control class
 *
 * @package WordPress
 * @subpackage Class_TTO
 * @since Class TTO 1.0
 */

/**
 * Customize Notice Control class.
 *
 * @since Class TTO 1.0
 *
 * @see WP_Customize_Control
 */
class Class_TTO_Customize_Notice_Control extends WP_Customize_Control {
	/**
	 * The control type.
	 *
	 * @since Class TTO 1.0
	 *
	 * @var string
	 */
	public $type = 'ctto-notice';

	/**
	 * Renders the control content.
	 *
	 * This simply prints the notice we need.
	 *
	 * @since Class TTO 1.0
	 *
	 * @return void
	 */
	public function render_content() {
		?>
		<div class="notice notice-warning">
			<p><?php esc_html_e( 'To access the Dark Mode settings, select a light background color.', 'ctto' ); ?></p>
			<p><a href="<?php echo esc_url( __( 'https://wordpress.org/support/article/twenty-twenty-one/#dark-mode-support', 'ctto' ) ); ?>">
				<?php esc_html_e( 'Learn more about Dark Mode.', 'ctto' ); ?>
			</a></p>
		</div>
		<?php
	}
}
