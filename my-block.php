<?php
/**
 * Plugin Name:       My Block
 * Description:       Example block scaffolded with Create Block tool.
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            Sally CJ
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       my-block
 *
 * @package           create-block
 */

namespace Create_Block\My_Block;

/**
 * Loads the plugin's translated strings (in MO files) and registers the "My Block" block.
 */
function init() {
	load_plugin_textdomain(
		'my-block',
		false,
		dirname( plugin_basename( __FILE__ ) ) . '/languages'
	);

	register_block_type( __DIR__ . '/build' );
}
add_action( 'init', __NAMESPACE__ . '\\init' );

/**
 * Sets translated strings for the "My Block"'s editor script.
 */
function set_script_translations() {
	wp_set_script_translations(
		'create-block-my-block-editor-script',
		'my-block',
		plugin_dir_path( __FILE__ ) . 'languages'
	);
}
add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\\set_script_translations' );

/**
 * Adds an admin menu page for our settings page.
 */
function add_settings_page_admin_menu() {
	add_menu_page(
		'my-block',
		__( 'My Block', 'my-block' ),
		'manage_options',
		'my-block',
		__NAMESPACE__ . '\\settings_page_admin_menu_page',
		'dashicons-buddicons-replies'
	);
}
add_action( 'admin_menu', __NAMESPACE__ . '\\add_settings_page_admin_menu' );

/**
 * Renders our settings page. #my-block will be replaced dynamically via JS/React.
 */
function settings_page_admin_menu_page() {
	?>
		<div class="wrap">
			<div id="my-block"><?php esc_html_e( 'My Block Local', 'my-block' ); ?></div>
		</div>
	<?php
}

/**
 * Enqueues our settings page script and set translated strings for that script.
 *
 * @param string $hook_suffix The current admin page.
 */
function settings_page_admin_scripts( $hook_suffix ) {
	// Do nothing if we're not on our admin menu page.
	if ( get_plugin_page_hook( 'my-block', '' ) !== $hook_suffix ) {
		return;
	}

	$asset = include plugin_dir_path( __FILE__ ) . 'build/settings-page.asset.php';

	wp_enqueue_script(
		'my-settings-page',
		plugin_dir_url( __FILE__ ) . 'build/settings-page.js',
		$asset['dependencies'],
		$asset['version'],
		true
	);

	wp_set_script_translations(
		'my-settings-page',
		'my-block',
		plugin_dir_path( __FILE__ ) . 'languages'
	);
}
add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\\settings_page_admin_scripts' );
