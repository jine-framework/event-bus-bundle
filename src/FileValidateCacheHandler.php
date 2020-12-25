<?php

declare(strict_types=1);

namespace Jine\EventBusBundle;

use Jine\EventBus\Contract\ValidateCacheHandlerInterface;

use function is_file;
use function file_get_contents;
use function file_put_contents;

class FileValidateCacheHandler implements ValidateCacheHandlerInterface
{
    private string $fileCachePath;

    private const FILE_NAME = 'bus_validation';

    public function __construct(string $fileCachePath)
    {
        $this->fileCachePath = $fileCachePath;
    }

    public function readHash(): string
    {
        $filePath = $this->fileCachePath . '/' . self::FILE_NAME;

        if (is_file($filePath)) {
            return file_get_contents($filePath);
        }
        return '';
    }

    public function writeHash(string $hash): void
    {
        $filePath = $this->fileCachePath . '/' . self::FILE_NAME;

        file_put_contents($filePath, $hash);
    }
}
