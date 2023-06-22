<?php
/**
 * Plugin Name:       Noobs Core Blocks Xtender
 * Description:       Elevate content creation with NoobsCoreBlockXtender: a powerful WordPress plugin that enhances WordPress Block. Unlock advanced blocks, customize styles, and integrate interactive elements effortlessly. Unleash your creativity, captivate users, and take your website to new heights.
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           1.0.0
 * Author:            Noobs
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       noobs-core-blocks-xtender
 * Domain Path:       /languages
 */
final class Noobs_Core_Block_Xtender {
	/**
	 * plugin version
	 * @var string
	 */
	const VERSION = '1.0.0';

	/**
	 * \Noobs_Core_Block_Xtender class constructor.
	 * private for singleton
	 * @return void
	 * @since 1.0.0
	 */
	private function __construct() {
		$this->noobs_core_blocks_xtender_constant();
		
		add_action('plugins_loaded', [$this, 'noobs_core_blocks_xtender_load_textdomain']);
		add_action('enqueue_block_editor_assets', [$this, 'noobs_core_blocks_xtender_enqueue_block_editor_assets']);
		add_action("enqueue_block_assets", [$this, 'noobs_core_blocks_xtender_enqueue_block_assets']);
		add_action("admin_enqueue_scripts", [$this, 'noobs_core_blocks_xtender_admin_scripts']);
		add_action('init', [$this, 'init']);
		add_filter("render_block", [$this, 'noobs_core_blocks_xtender_render_block'], 10, 2);

		// load after plugin activation
		register_activation_hook(__FILE__, [$this, 'noobs_core_blocks_xtender_activation']);

	}

	public static function init() {
		static $instance = false;
		if (!$instance) {
			$instance = new self();
		}
		return $instance;
	}

	public function noobs_core_blocks_xtender_load_textdomain() {
		load_plugin_textdomain('noobs-core-blocks-xtender', false, NOOBS_CORE_BLOCKS_XTENDER_PATH . '/languages');
	}

	public function noobs_core_blocks_xtender_enqueue_block_editor_assets() {}

	public function noobs_core_blocks_xtender_enqueue_block_assets() {}

	public function noobs_core_blocks_xtender_admin_scripts($screen) {
		if (is_admin()) {
			wp_localize_script("wp-block-editor", "NoobsCoreBlocksXtender", [
				"screen" => $screen
			]);
		}
	}

	function noobs_core_blocks_xtender_genrate_class($block) {
		$classes = [];

		return $classes;
	}

	function noobs_core_blocks_xtender_render_block( $block_content, $block ) {
		return  $block_content;
	}

	public function noobs_core_blocks_xtender_activation() {
		//Update vertion to the options table
		update_option("noobs_core_blocks_xtender_version", NOOBS_CORE_BLOCKS_XTENDER_VERSION);
		//added installed time after checking time exist or not
		if (!get_option("noobs_core_blocks_xtender_installed_time")) {
			add_option("noobs_core_blocks_xtender_installed_time", time());
		}
	}

	public function noobs_core_blocks_xtender_constant() {
		define('NOOBS_CORE_BLOCKS_XTENDER_VERSION', self::VERSION);
		define('NOOBS_CORE_BLOCKS_XTENDER_URL', plugin_dir_url(__FILE__));
		define('NOOBS_CORE_BLOCKS_XTENDER_PATH', plugin_dir_path(__FILE__));
	}
}

function noobs_core_blocks_xtender() {
	return Noobs_Core_Block_Xtender::init();
}

noobs_core_blocks_xtender();
