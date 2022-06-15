<?php

declare(strict_types=1);

namespace Interns2022B;
class BreweryScrapper
{
    public const SEARCH = "choice";
    public const SHOW = "show";
    public const LIST = "list";
    public const CLEAR = "clear";
    public const EXIT = "exit";

    public array $data = [];

    public function collectData(): void
    {
        $handle = file_get_contents(__DIR__ . "/../tests/stubs/table.json");
        $this->data = json_decode($handle, associative: true);
    }

    public function getBreweries(): array
    {
        $name = readline("Please provide brewery or city name:");

        $choosenData = [];
        for ($row = 0; $row < count($this->data); $row++) {
            if (in_array($name, $this->data[$row], strict: true)) {
                $choosenData[] = $this->data[$row];
            }
        }
        return $choosenData;
    }    

    public function getProviders(): array
    {
        $providers = [];
        for ($row = 0; $row < count($this->data); $row++) {
            $providers[] = $this->data[$row]["Provider"];
        }
        return $providers;
    }

    public function clearCache(): string
    {
        $handle = __DIR__ . "/../tests/stubs/table.json";

        if (unlink($handle)) {
            $message = "File was deleted successfully";
        } else {
            $message = "File doesn't exist";
        }

        return $message;
    }
}
