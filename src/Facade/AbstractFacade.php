<?php

declare(strict_types=1);

namespace Jine\EventBusBundle\Facade;

use Jine\Config\Config;
use Jine\EventBus\Bus;

abstract class AbstractFacade
{
    protected static Bus $bus;
    protected Config $config;

    public function __construct(Bus $bus, Config $config)
    {
        static::$bus = $bus;
        $this->config = $config;
    }
    public function plugPreload(): void
    {
        $filePath = $this->config->get('kernel', 'preloadPath');

        if (is_file($filePath)) {
            require_once $filePath;
        }
    }

    public function plugApp(): void
    {
        $filePath = $this->config->get('kernel', 'appPath');

        if (is_file($filePath)) {
            require_once $filePath;
        }
    }
}
