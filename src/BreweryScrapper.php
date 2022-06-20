<?php

declare(strict_types=1);

namespace Interns2022B;
class BreweryScrapper
{
    public const SEARCH = "choice";
    public const SHOW = "show";
    public const LIST = "list";
    public const CLEAR = "clear";
    public const BUILD = "build";
    public const EXIT = "exit";
    protected const TABLE_DIRECTORY = __DIR__ . "/../tests/stubs/table.json";

    public array $data = [];
    public array $toFile = [];

    public function collectData(): void
    {
        $handle = file_get_contents(self::TABLE_DIRECTORY);
        $this->data = json_decode($handle, associative: true);
    }

    public function getBreweries(): array
    {
        $name = readline("Please provide brewery or city name:");

        $choosenData = [];
        foreach ($this->data as $rowValue) {
            if (in_array($name, $rowValue, strict: true)) {
                $choosenData[] = $rowValue;
            }
        }
        return $choosenData;
    }

    public function getProviders(): array
    {
        $providers = [];
        foreach ($this->data as $row => $rowValue) {
            $providers[] = $this->data[$row]["provider"];
        }
        return $providers;
    }

    public function clearCache(): string
    {
        if (unlink(self::TABLE_DIRECTORY)) {
            $message = "File was deleted successfully";
        } else {
            $message = "File doesn't exist";
        }

        return $message;
    }

    public function putData(string $keyName): void
    {
        foreach ($this->data as $rowValue) {
            if ($rowValue["provider"] === $keyName) {
                $this->toFile[] = $rowValue;
            }
        }
    }

    public function rebuildCache(): void
    {
        $timeStamp = ["last Build:", "[", date("Y-m-d h:i:s"), "]", "\n"];

        $logDirectory = __DIR__ . "/../tests/stubs";

        if (!file_exists($logDirectory)) {
            mkdir($logDirectory);
        }

        $filename = $logDirectory . "/cacheChanges" . ".log";
        file_put_contents($filename, implode(" ", $timeStamp));

        $provider = $this->getProviders();
        foreach ($provider as $value) {
            $this->putData($value);
        }
        file_put_contents(self::TABLE_DIRECTORY, json_encode($this->toFile, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
        file_put_contents(self::TABLE_DIRECTORY, "\n", FILE_APPEND);
    }
}
