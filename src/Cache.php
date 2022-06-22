<?php

declare(strict_types=1);

namespace Interns2022B;

class Cache
{
    public const CLEAR = "clear";
    public const BUILD = "build";

    public array $toFile = [];

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

        file_put_contents(BreweryScrapper::TABLE_DIRECTORY, json_encode($this->toFile, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
        file_put_contents(BreweryScrapper::TABLE_DIRECTORY, "\n", FILE_APPEND);
    }

    public function clearCache(): string
    {
        if (unlink(BreweryScrapper::TABLE_DIRECTORY)) {
            $message = "File was deleted successfully";
        } else {
            $message = "File doesn't exist";
        }

        return $message;
    }

    protected function createLogFile():void
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
