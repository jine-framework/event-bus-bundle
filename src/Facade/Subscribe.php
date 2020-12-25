<?php

declare(strict_types=1);

namespace Jine\EventBusBundle\Facade;

class Subscribe extends AbstractFacade
{
    public static function add(string $subject, string $action): void
    {
        static::$bus->subscribe($subject, $action);
    }
}
