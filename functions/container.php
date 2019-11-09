<?php declare(strict_types=1);

use RobM\Container\Container;

if (! function_exists('container')) {
    /**
     * Access a service in the container or the container itself
     *
     * @return mixed
     */
    function container(?string $alias = null)
    {
        $container = Container::getInstance();

        return $alias ? $container->get($alias) : $container;
    }
}
