<?php declare(strict_types=1);

namespace RM\Container;

use League\Container\Container as BaseContainer;
use League\Container\ContainerAwareInterface;
use League\Container\ReflectionContainer;

class Container extends BaseContainer
{
    /** @var static */
    private static $instance;

    /**
     * Get the current static instance of the container
     */
    public static function getInstance(): self
    {
        if (null === static::$instance) {
            static::$instance = new static;
        }

        // Enable auto-wiring in the container
        static::$instance->delegate(
            ((new ReflectionContainer)->cacheResolutions())
        );

        // Use inflection to inject Container dependency through method injection
        static::$instance
            ->inflector(ContainerAwareInterface::class)
            ->invokeMethod('setContainer', [static::$instance]);

        // Use inflection to boot a service if required
        static::$instance
            ->inflector(BootableServiceInterface::class)
            ->invokeMethod('boot', []);

        return static::$instance;
    }
}
