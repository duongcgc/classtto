<?php
/**
 * The Classtto Templates allows to load Classtto template files as well as loading the entire document.
 *
 * Template functions and definitions.
 *
 * @package Classtto\Framework\Template
 *
 * @since   1.0.0
 */

namespace Classtto;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Template initial
 *
 * @since 1.0.0
 */
class Template {
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
	 * Instantiate the object.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function __construct() {

		/**
		 * Load and render the entire document (web page).  This function is the root of the Classtto' framework hierarchy.
		 * Therefore, when calling it, Classtto runs, building the web page's HTML markup and rendering it out to the
		 * browser.
		 *
		 * Here are some guidelines for calling this function:
		 *
		 *      - Call it from a primary template file, e.g. single.php, page.php, home.php, archive.php, etc.
		 *      - Do all modifications and customizations before calling this function.
		 *      - Put this function on the last line of code in the template file.
		 *
		 * @since 1.0.0
		 *
		 * @return void
		 */

		/**
		 * Fires before the document is loaded.
		 *
		 * @since 1.0.0
		 */
		do_action( 'ctto_before_load_document' );

		/**
		 * Fires when the document loads.
		 *
		 * This hook is the root of Classtto's framework hierarchy. It all starts here!
		 *
		 * @since 1.0.0
		 */
		do_action( 'ctto_load_document' );

		/**
		 * Fires after the document is loaded.
		 *
		 * @since 1.0.0
		 */
		do_action( 'ctto_after_load_document' );

	}


	/**
	 * Loads a secondary template file.
	 *
	 * This function loads Jupiter's default template file. It must be called from a secondary template file
	 * (e.g. comments.php) and must be the last function to be called. All modifications must be done before calling
	 * this function. This includes modifying markup, attributes, partials, etc.
	 *
	 * The default template files contain the hook on which the partials are attached to. Bypassing this function
	 * will completely remove the default content.
	 *
	 * @since 1.0.0
	 *
	 * @param string $file The filename of the secondary template files. __FILE__ is usually to argument to pass.
	 *
	 * @return bool True on success, false on failure.
	 */
	public static function ctto_load_default_template( $file ) {
		$file = CTTO_LAYOUT_PATH . basename( $file );

		if ( ! file_exists( $file ) ) {
			return false;
		}

		require_once $file;

		return true;
	}

	/**
	 * 1. Load the template layout file.
	 *
	 * @since 1.0.0
	 *
	 * @param string $layout The layout to load. This is filename without the extension.
	 *
	 * @return bool True on success, false on failure.
	 */
	public function ctto_load_layout_file( $layout ) {

		/**
		 * Filter to allow the child theme or plugin to short-circuit this function by passing back a `true` or
		 * truthy value.
		 *
		 * The hook's name is "ctto_pre_load_layout_" + the layout's filename (without its extension).  For example,
		 * the header layout's hook name is "ctto_pre_load_layout_header".
		 *
		 * @since 1.0.0
		 *
		 * @param bool Set to `true` to short-circuit this function. The default is `false`.
		 */
		if ( apply_filters( 'ctto_pre_load_layout_' . $layout, false ) ) {
			return false;
		}

		// If layout file does not exist, bail out.
		if ( ! file_exists( CTTO_LAYOUT_PATH . $layout . '.php' ) ) {
			return false;
		}

		require_once CTTO_LAYOUT_PATH . $layout . '.php';

		return true;
	}

	/**
	 * 2. Load the template part file.
	 *
	 * @since 1.0.0
	 *
	 * @param string $part The part to load. This is filename without the extension.
	 *
	 * @return bool True on success, false on failure.
	 */
	public function ctto_load_part_file( $part ) {

		/**
		 * Filter to allow the child theme or plugin to short-circuit this function by passing back a `true` or
		 * truthy value.
		 *
		 * The hook's name is "ctto_pre_load_part_" + the part's filename (without its extension).  For example,
		 * the header part's hook name is "ctto_pre_load_part_header".
		 *
		 * @since 1.0.0
		 *
		 * @param bool Set to `true` to short-circuit this function. The default is `false`.
		 */
		if ( apply_filters( 'ctto_pre_load_part_' . $part, false ) ) {
			return false;
		}

		// If part file does not exist, bail out.
		if ( ! file_exists( CTTO_PARTS_PATH . $part . '.php' ) ) {
			return false;
		}

		require_once CTTO_PARTS_PATH . $part . '.php';

		return true;
	}

	/**
	 * 3. Load the template pattern file.
	 *
	 * @since 1.0.0
	 *
	 * @param string $pattern The pattern to load. This is filename without the extension.
	 *
	 * @return bool True on success, false on failure.
	 */
	public function ctto_load_partten_file( $pattern ) {

		/**
		 * Filter to allow the child theme or plugin to short-circuit this function by passing back a `true` or
		 * truthy value.
		 *
		 * The hook's name is "ctto_pre_load_pattern_" + the pattern's filename (without its extension).  For example,
		 * the header pattern's hook name is "ctto_pre_load_pattern_header".
		 *
		 * @since 1.0.0
		 *
		 * @param bool Set to `true` to short-circuit this function. The default is `false`.
		 */
		if ( apply_filters( 'ctto_pre_load_pattern_' . $pattern, false ) ) {
			return false;
		}

		// If pattern file does not exist, bail out.
		if ( ! file_exists( CTTO_PATTERNS_PATH . $pattern . '.php' ) ) {
			return false;
		}

		require_once CTTO_PATTERNS_PATH . $pattern . '.php';

		return true;
	}

	/**
	 * 4. Load the template partial file.
	 *
	 * This function can be short-circuited using the filter event "ctto_pre_load_partial_".
	 *
	 * @since 1.0.0
	 *
	 * @param string $partial The partial to load. This is its filename without the extension.
	 *
	 * @return bool True on success, false on failure.
	 */
	public function ctto_load_partial_file( $partial ) {

		/**
		 * Filter to allow the child theme or plugin to short-circuit this function by passing back a `true` or
		 * truthy value.
		 *
		 * The hook's name is "ctto_pre_load_partial_" + the partial's filename (without its extension).  For example,
		 * the header partial's hook name is "ctto_pre_load_partial_header".
		 *
		 * @since 1.0.0
		 *
		 * @param bool Set to `true` to short-circuit this function. The default is `false`.
		 */
		if ( apply_filters( 'ctto_pre_load_partial_' . $partial, false ) ) {
			return false;
		}

		// If partial file does not exist, bail out.
		if ( ! file_exists( CTTO_PARTIALS_PATH . $partial . '.php' ) ) {
			return false;
		}

		require_once CTTO_PARTIALS_PATH . $partial . '.php';

		return true;
	}

	/**
	 * Render the current comment's HTML markup.
	 *
	 * This function is a callback that is registered to {@see wp_list_comments()}.  It adds the args and depth to the
	 * global comment, renders the opening <li> tag, and fires the "ctto_comment" event to render the comment.
	 *
	 * @since 1.0.0
	 *
	 * @see   wp_list_comments()
	 *
	 * @param WP_Comment $comment Instance of the current comment, i.e. which is also the global comment.
	 * @param array      $args    Array of arguments.
	 * @param int        $depth   Depth of the comment in reference to its parents.
	 *
	 * @return void
	 */
	public function ctto_comment_callback( $comment, array $args, $depth ) {
		// To give us access, add the args and depth as public properties on the comment's global instance.
		global $comment;
		$comment->args  = $args;
		$comment->depth = $depth;

		// Render the opening <li> tag.
		$comment_class = empty( $args['has_children'] ) ? '' : 'parent';
		printf(
			'<li id="comment-%d" %s>',
			(int) get_comment_ID(),
			comment_class( $comment_class, $comment, null, false )
		);

		/**
		 * Render the comment's HTML markup.
		 *
		 * @since 1.0.0
		 */
		do_action( 'ctto_comment' );

		// The </li> tag is intentionally omitted.
	}

}
