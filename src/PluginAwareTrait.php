<?php
/**
 * Basic implementation of PluginAwareInterface.
 *
 * @copyright Copyright (c) 2015 Cedaro, LLC
 * @license   MIT
 */

namespace Cedaro\WP\Plugin;

/**
 * Plugin aware trait.
 */
trait PluginAwareTrait {
    /**
     * Main plugin instance.
     *
     * @var PluginInterface
     */
    protected $plugin;

    /**
     * Set the main plugin instance.
     *
     * @param PluginInterface $plugin main plugin instance
     *
     * @return $this
     */
    public function set_plugin(PluginInterface $plugin): static {
        $this->plugin = $plugin;

        return $this;
    }
}
