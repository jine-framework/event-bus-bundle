<?php

declare(strict_types=1);

namespace Jine\EventBusBundle\Facade;

use Jine\EventBus\Dto\Service;

class Register extends AbstractFacade
{
    public static function service(string $serviceId): Service
    {
        return static::$bus->registerService($serviceId);
    }
}
