<?php

declare(strict_types=1);

namespace Interns2022B;

class Cache
{
    public const CLEAR = "clear";
    public const BUILD = "build";
    public const TABLE_DIRECTORY = __DIR__ . "/../tests/stubs/table.json";

    private array $toFile = [];

    public function putData(string $provider, array $breweriesData): void
    {
        foreach ($breweriesData as $rowValue) {
            if ($rowValue["provider"] === $provider) {
                $this->toFile[] = $rowValue;
            }
        }
    }

    public function rebuildCache(array $providers, array $breweriesData): void
    {
        $this->createLogFile();

        foreach ($providers as $provider) {
            $this->putData($provider, $breweriesData);
        }

        file_put_contents(self::TABLE_DIRECTORY, json_encode($this->toFile, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
        file_put_contents(self::TABLE_DIRECTORY, "\n", FILE_APPEND);
    }

    public function clearCache(): string
    {
        return unlink(static::TABLE_DIRECTORY)
            ? "File was deleted successfully"
            : "File doesn't exist";
    }

    protected function createLogFile(): void
    {
        $timeStamp = ["last Build:", "[", date("Y-m-d h:i:s"), "]", "\n"];

        $logDirectory = __DIR__ . "/../tests/stubs";

        if (!file_exists($logDirectory)) {
            mkdir($logDirectory);
        }

        $filename = $logDirectory . "/cacheChanges" . ".log";
        file_put_contents($filename, implode(" ", $timeStamp));
    }
}
