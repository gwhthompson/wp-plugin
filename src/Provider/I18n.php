<?php
/**
 * Internationalization provider.
 *
 * @package   Cedaro\WP\Plugin
 * @copyright Copyright (c) 2015 Cedaro, LLC
 * @license   MIT
 */

namespace Cedaro\WP\Plugin\Provider;

use Cedaro\WP\Plugin\HookProviderInterface;
use Cedaro\WP\Plugin\HooksTrait;
use Cedaro\WP\Plugin\PluginAwareInterface;
use Cedaro\WP\Plugin\PluginAwareTrait;

/**
 * Internationalization class.
 *
 * @package Cedaro\WP\Plugin
 */
final class I18n implements PluginAwareInterface, HookProviderInterface {

	use HooksTrait;
 use PluginAwareTrait;
 /**
	 * Register hooks.
	 *
	 * Loads the text domain during the `plugins_loaded` action.
	 */
	public function register_hooks(): void {
		if ( did_action( 'plugins_loaded' ) !== 0 ) {
			$this->load_textdomain();
		} else {
			$this->add_action( 'plugins_loaded', 'load_textdomain' );
		}
	}

	/**
	 * Load the text domain to localize the plugin.
	 */
	private function load_textdomain(): void {
		$plugin_rel_path = dirname( $this->plugin->get_basename() ) . '/languages';
		load_plugin_textdomain( $this->plugin->get_slug(), false, $plugin_rel_path );
	}
}
