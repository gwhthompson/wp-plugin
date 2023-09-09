<?php
/**
 * Plugin interface.
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
 * Plugin interface.
 */
interface PluginInterface {
    /**
     * Retrieve the relative path to the main plugin file from the main plugin
     * directory.
     */
    public function get_basename(): string;

    /**
     * Set the plugin basename.
     *
     * @param string $basename relative path from the main plugin directory
     *
     * @return $this
     */
    public function set_basename(string $basename): static;

    /**
     * Retrieve the plugin directory.
     */
    public function get_directory(): string;

    /**
     * Set the plugin's directory.
     *
     * @param string $directory absolute path to the main plugin directory
     *
     * @return $this
     */
    public function set_directory(string $directory): static;

    /**
     * Retrieve the path to a file in the plugin.
     *
     * @param string $path Optional. Path relative to the plugin root.
     */
    public function get_path(string $path = ''): string;

    /**
     * Retrieve the absolute path for the main plugin file.
     */
    public function get_file(): string;

    /**
     * Set the path to the main plugin file.
     *
     * @param string $file absolute path to the main plugin file
     *
     * @return $this
     */
    public function set_file(string $file): static;

    /**
     * Retrieve the plugin identifier.
     */
    public function get_slug(): string;

    /**
     * Set the plugin identifier.
     *
     * @param string $slug plugin identifier
     *
     * @return $this
     */
    public function set_slug(string $slug): static;

    /**
     * Retrieve the URL for a file in the plugin.
     *
     * @param string $path Optional. Path relative to the plugin root.
     */
    public function get_url(string $path = ''): string;

    /**
     * Set the URL for plugin directory root.
     *
     * @param string $url URL to the root of the plugin directory
     *
     * @return $this
     */
    public function set_url(string $url): static;

    /**
     * Register hooks for the plugin.
     *
     * @param HookProviderInterface $hookProvider hook provider
     */
    public function register_hooks(HookProviderInterface $hookProvider): mixed;
}
