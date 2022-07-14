<?php

declare(strict_types=1);

namespace Interns2022B;

use Illuminate\Support\Collection;
use Interns2022B\Models\Brewery;

class Cache
{
    public const CLEAR = "clear";
    public const BUILD = "build";
    public const TABLE_DIRECTORY = __DIR__ . "/../tests/stubs/table.json";

    private array $toFile = [];

    /**
     * @param Collection<Brewery> $breweries
     */
    public function putData(string $provider, Collection $breweries): void
    {
        $breweries->each(function (Brewery $item) use ($provider): void {
            if ($item->providers->first() === $provider) {
                $add = [
                    "name" => $item->name,
                    "city" => $item->city->name,
                    "country" => $item->countries->first(),
                    "provider" => $item->providers->first(),
                ];
                $this->toFile[] = $add;
            }
        });
    }

    /**
     * @param Collection<Providers> $providers
     * @param Collection<Brewery> $breweries
     * @throws JsonException|\JsonException
     */
    public function rebuildCache(Collection $providers, Collection $breweries): void
    {
        $this->createLogFile();
        $collapsedProviders = $providers->collapse();

        foreach ($collapsedProviders as $provider) {
            $this->putData($provider, $breweries);
        }

        file_put_contents(self::TABLE_DIRECTORY, json_encode($this->toFile, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
        file_put_contents(self::TABLE_DIRECTORY, "\n", FILE_APPEND);

        echo filesize(self::TABLE_DIRECTORY)
            ? "File reconstructed successfully" . PHP_EOL
            : "File doesn't exist" . PHP_EOL;
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
