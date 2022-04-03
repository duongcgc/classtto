<?php
/**
 * This class creates an anonymous callback, which is required since Jupiter still supports PHP 5.2.
 *
 * @package Classtto\Framework\Actions
 *
 * @since   1.0.0
 */

/**
 * Anonymous Action.
 *
 * @since   1.0.0
 * @ignore
 * @access  private
 *
 * @package Classtto\Framework\Actions
 */
final class Anonymous_Action {

	/**
	 * The callback to register to the given $hook.
	 *
	 * @var string
	 */
	public $callback;

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
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Constructor.
	 *
	 * @param string $hook        The name of the action to which the $callback is hooked.
	 * @param array  $callback    The callback to register to the given $hook and arguments to pass.
	 * @param int    $priority    Optional. Used to specify the order in which the functions
	 *                            associated with a particular action are executed. Default 10.
	 *                            Lower numbers correspond with earlier execution,
	 *                            and functions with the same priority are executed
	 *                            in the order in which they were added to the action.
	 * @param int    $number_args Optional. The number of arguments the function accepts. Default 1.
	 */
	public function __construct( $hook, array $callback, $priority = 10, $number_args = 1 ) {
		/**
		 * Fires before the anonymous_action is loaded.
		 *
		 * @since 1.0.0
		 */
		do_action( 'ctto_before_load_anonymous_action' );

		$this->callback = $callback;

		add_action( $hook, array( $this, 'callback' ), $priority, $number_args );		

		/**
		 * Fires when the anonymous_action loads.
		 *
		 * This hook is the root of Classtto's framework hierarchy. It all starts here!
		 *
		 * @since 1.0.0
		 */
		do_action( 'ctto_load_anonymous_action' );

		/**
		 * Fires after the anonymous_action is loaded.
		 *
		 * @since 1.0.0
		 */
		do_action( 'ctto_after_load_anonymous_action' );
	}

	/**
	 * Get action content and set it as the callback.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function callback() {
		echo call_user_func_array( $this->callback[0], $this->callback[1] ); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped -- The callback handles escaping its output, as Jupiter does not know what HTML or content will be passed back to it.
	}
}
