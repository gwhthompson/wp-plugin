<?php
/**
 * Plugin factory.
 *
 * @copyright Copyright (c) 2017 Cedaro, LLC
 * @license   MIT
 */

namespace Cedaro\WP\Plugin;

/**
 * Plugin factory class.
 */
final class PluginFactory {
    /**
     * Create a plugin instance.
     *
     * @param string $slug     plugin slug
     * @param string $filename Optional. Absolute path to the main plugin file.
     *                         This should be passed if the calling file is not
     *                         the main plugin file.
     *
     * @return Plugin plugin instance
     */
    public static function create(string $slug, string $filename = ''): Plugin {
        // Use the calling file as the main plugin file.
        if ($filename === '') {
            $backtrace = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 1);
            $filename = $backtrace[0]['file'] ?? '';
        }

        return ( new Plugin() )
            ->set_basename(plugin_basename($filename))
            ->set_directory(plugin_dir_path($filename))
            ->set_file($filename)
            ->set_slug($slug)
            ->set_url(plugin_dir_url($filename))
        ;
    }
}
