<?php
/**
 * Hooks trait.
 *
 * Allows protected and private methods to be used as hook callbacks.
 *
 * @author    John P. Bloch
 * @author    Brady Vercher
 *
 * @see      https://github.com/johnpbloch/wordpress-dev
 *
 * @copyright Copyright (c) 2015 Cedaro, LLC
 * @license   MIT
 */

namespace Cedaro\WP\Plugin;

/**
 * Hooks trait.
 *
 * @author  John P. Bloch
 * @license MIT
 *
 * @see    https://github.com/johnpbloch/wordpress-dev/blob/master/src/Hooks.php
 */
trait HooksTrait {
    /**
     * Internal property to track closures attached to WordPress hooks.
     *
     * @var array<string, \Closure>
     */
    protected array $filter_map = [];

    /**
     * Add a WordPress filter.
     *
     * @return bool true
     */
    protected function add_filter(string $hook, callable $method, int $priority = 10, int $arg_count = 1): bool {
        return add_filter(
            $hook,
            $this->map_filter($this->get_wp_filter_id($hook, $method, $priority), $method, $arg_count),
            $priority,
            $arg_count
        );
    }

    /**
     * Add a WordPress action.
     *
     * This is an alias of add_filter().
     *
     * @return bool true
     */
    protected function add_action(string $hook, callable $method, int $priority = 10, int $arg_count = 1): bool {
        return $this->add_filter($hook, $method, $priority, $arg_count);
    }

    /**
     * Remove a WordPress filter.
     *
     * @return bool whether the function existed before it was removed
     */
    protected function remove_filter(string $hook, callable $method, int $priority = 10, int $arg_count = 1): bool {
        return remove_filter(
            $hook,
            $this->map_filter($this->get_wp_filter_id($hook, $method, $priority), $method, $arg_count),
            $priority
        );
    }

    /**
     * Remove a WordPress action.
     *
     * This is an alias of remove_filter().
     *
     * @return bool whether the function is removed
     */
    protected function remove_action(string $hook, callable $method, int $priority = 10, int $arg_count = 1) {
        return $this->remove_filter($hook, $method, $priority, $arg_count);
    }

    /**
     * Get a unique ID for a hook based on the internal method, hook, and priority.
     */
    protected function get_wp_filter_id(string $hook, string $method, int $priority): string {
        return _wp_filter_build_unique_id($hook, [$this, $method], $priority);
    }

    /**
     * Map a filter to a closure that inherits the class' internal scope.
     *
     * This allows hooks to use protected and private methods.
     *
     * @return \Closure The callable actually attached to a WP hook
     */
    protected function map_filter(string $id, string $method, int $arg_count): \Closure {
        if (empty($this->filter_map[$id])) {
            $this->filter_map[$id] = fn (): mixed => call_user_func_array([$this, $method], array_slice(func_get_args(), 0, $arg_count));
        }

        return $this->filter_map[$id];
    }
}
