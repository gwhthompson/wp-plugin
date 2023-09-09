<?php
/**
 * Container aware trait.
 *
 * Container implementation courtesy of Slim 3.
 *
 * @see      https://github.com/slimphp/Slim/blob/e80b0f8b4d23e165783e8bf241b31c35272b0e28/Slim/App.php
 *
 * @copyright Copyright (c) 2015 Cedaro, LLC
 * @license   MIT
 */

namespace Cedaro\WP\Plugin;

use Psr\Container\ContainerInterface;

/**
 * Container aware trait.
 */
trait ContainerAwareTrait {
    /**
     * Container.
     *
     * @var ContainerInterface
     */
    protected $container;

    /**
     * Proxy access to container services.
     *
     * @param string $name service name
     */
    public function __get($name): mixed {
        return $this->container->get($name);
    }

    /**
     * Whether a container service exists.
     *
     * @param string $name service name
     */
    public function __isset($name): bool {
        return $this->container->has($name);
    }

    /**
     * Calling a non-existant method on the class checks to see if there's an
     * item in the container that is callable and if so, calls it.
     *
     * @param string       $method method name
     * @param array<mixed> $args   method arguments
     */
    public function __call(string $method, array $args): mixed {
        if ($this->container->has($method)) {
            $callable = $this->container->get($method);
            if (is_callable($callable)) {
                return $callable(...$args);
            }
        }

        throw new \BadMethodCallException(sprintf('Method %s::%s does not exist.', static::class, $method));
    }

    /**
     * Enable access to the DI container by plugin consumers.
     */
    public function get_container(): ContainerInterface {
        return $this->container;
    }

    /**
     * Set the container.
     *
     * @param ContainerInterface $container dependency injection container
     *
     * @return $this
     *
     * @throws \InvalidArgumentException when no container is provided that implements ContainerInterface
     */
    public function set_container(ContainerInterface $container): static {
        $this->container = $container;

        return $this;
    }
}
