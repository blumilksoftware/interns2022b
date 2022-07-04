<?php

declare(strict_types=1);

namespace Interns2022B;

class BreweryScrapper
{
    public const EXIT = "exit";
    protected const TABLE_DIRECTORY = __DIR__ . "/../tests/stubs/table.json";

    protected array $data = [];

    public function collectData(): void
    {
        $handle = file_get_contents(Cache::TABLE_DIRECTORY);
        $this->data = json_decode($handle, associative: true);
    }

    public function getData(): array
    {
        return $this->data;
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
