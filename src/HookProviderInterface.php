<?php
/**
 * Hook provider interface.
 *
 * @copyright Copyright (c) 2015 Cedaro, LLC
 * @license   MIT
 */

namespace Cedaro\WP\Plugin;

/**
 * Hook provider interface.
 */
interface HookProviderInterface {
    /**
     * Registers hooks for the plugin.
     */
    public function register_hooks(): mixed;
}
