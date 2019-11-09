<?php declare(strict_types=1);

namespace RobM\Container;

interface BootableServiceInterface
{
    /**
     * Method will be invoked on registration of a service implementing this interface.
     */
    public function boot(): void;
}
