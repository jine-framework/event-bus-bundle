<?php

declare(strict_types=1);

namespace Jine\EventBusBundle;

use Jine\EventBus\Bus;
use Jine\Config\Config;
use Jine\EventBus\Dto\Result;
use Jine\EventBusBundle\Facade\Register;
use Jine\EventBusBundle\Facade\Subscribe;

use function class_exists;

class EventBus
{
    private Bus $bus;
    private Register $register;
    private Subscribe $subscribe;

    public function __construct(Bus $bus)
    {
        $this->bus = $bus;
    }

    public function init(Config $config): void
    {
        $this->register = new Register($this->bus, $config);
        $this->subscribe = new Subscribe($this->bus, $config);

        $busValidationHandler = $config->get('kernel.bus', 'BusValidatorHandler');

        if (class_exists($busValidationHandler)) {
            $this->bus->setValidateCacheHandler(new $busValidationHandler);
        } else {
            $this->bus->setValidateCacheHandler(
                new FileValidateCacheHandler($config->get('kernel.bus', 'ValidateCachePath'))
            );
        }
    }

    public function plugPreload(): void
    {
        $this->register->plugPreload();
        $this->subscribe->plugPreload();
    }

    public function plugApp(): void
    {
        $this->register->plugApp();
        $this->subscribe->plugApp();
    }

    public function getResult(string $actionFullName): ?Result
    {
        return $this->bus->getResult($actionFullName);
    }

    public function run(string $startAction): void
    {
        $this->bus->validate();
        $this->bus->run($startAction);
    }
}
