<?php
/**
 * Base hook provider.
 *
 * @copyright Copyright (c) 2017 Cedaro, LLC
 * @license   MIT
 */

namespace Cedaro\WP\Plugin;

/**
 * Base hook provider class.
 */
abstract class AbstractHookProvider implements HookProviderInterface, PluginAwareInterface {
    use HooksTrait;
    use PluginAwareTrait;

    /**
     * Registers hooks for the plugin.
     */
    abstract public function register_hooks(): mixed;
}
