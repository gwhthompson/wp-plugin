<?php
/**
 * Common plugin functionality.
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
 * Base plugin class.
 */
abstract class AbstractPlugin implements PluginInterface {
    /**
     * Plugin basename.
     *
     * Ex: plugin-name/plugin-name.php
     */
    protected string $basename = '';

    /**
     * Absolute path to the main plugin directory.
     */
    protected string $directory = '';

    /**
     * Absolute path to the main plugin file.
     */
    protected string $file = '';

    /**
     * Plugin identifier.
     */
    protected string $slug = '';

    /**
     * URL to the main plugin directory.
     *
     * @var string
     */
    protected $url;

    /**
     * Retrieve the absolute path for the main plugin file.
     */
    public function get_basename(): string {
        return $this->basename;
    }

    /**
     * Set the plugin basename.
     *
     * @param string $basename relative path from the main plugin directory
     *
     * @return $this
     */
    public function set_basename(string $basename): static {
        $this->basename = $basename;

        return $this;
    }

    /**
     * Retrieve the plugin directory.
     */
    public function get_directory(): string {
        return $this->directory;
    }

    /**
     * Set the plugin's directory.
     *
     * @param string $directory absolute path to the main plugin directory
     *
     * @return $this
     */
    public function set_directory($directory): static {
        $this->directory = rtrim($directory, '/').'/';

        return $this;
    }

    /**
     * Retrieve the path to a file in the plugin.
     *
     * @param string $path Optional. Path relative to the plugin root.
     */
    public function get_path(string $path = ''): string {
        return $this->directory.ltrim($path, '/');
    }

    /**
     * Retrieve the absolute path for the main plugin file.
     */
    public function get_file(): string {
        return $this->file;
    }

    /**
     * Set the path to the main plugin file.
     *
     * @param string $file absolute path to the main plugin file
     *
     * @return $this
     */
    public function set_file(string $file): static {
        $this->file = $file;

        return $this;
    }

    /**
     * Retrieve the plugin identifier.
     */
    public function get_slug(): string {
        return $this->slug;
    }

    /**
     * Set the plugin identifier.
     *
     * @param string $slug plugin identifier
     *
     * @return $this
     */
    public function set_slug(string $slug): static {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Retrieve the URL for a file in the plugin.
     *
     * @param string $path Optional. Path relative to the plugin root.
     */
    public function get_url(string $path = ''): string {
        return $this->url.ltrim($path, '/');
    }

    /**
     * Set the URL for plugin directory root.
     *
     * @param string $url URL to the root of the plugin directory
     *
     * @return $this
     */
    public function set_url(string $url): static {
        $this->url = rtrim($url, '/').'/';

        return $this;
    }

    /**
     * Register a hook provider.
     *
     * @param HookProviderInterface $hookProvider hook provider
     *
     * @return $this
     */
    public function register_hooks(HookProviderInterface $hookProvider): static {
        if ($hookProvider instanceof PluginAwareInterface) {
            $hookProvider->set_plugin($this);
        }

        $hookProvider->register_hooks();

        return $this;
    }
}
