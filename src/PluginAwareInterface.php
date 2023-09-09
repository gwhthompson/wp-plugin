<?php
/**
 * Plugin aware interface.
 *
 * @copyright Copyright (c) 2015 Cedaro, LLC
 * @license   MIT
 */

namespace Cedaro\WP\Plugin;

/**
 * Plugin aware interface.
 */
interface PluginAwareInterface {
    /**
     * Set the main plugin instance.
     *
     * @param PluginInterface $plugin main plugin instance
     *
     * @return $this
     */
    public function set_plugin(PluginInterface $plugin): static;
}
