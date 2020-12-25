<?php

declare(strict_types=1);

namespace Jine\EventBusBundle;

use Jine\EventBus\Bus;

class BusFactory
{
    public static function create(): EventBus
    {
        $bus = new EventBus(Bus::create());
    }
}
