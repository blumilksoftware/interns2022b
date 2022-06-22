<?php

declare(strict_types=1);

namespace Interns2022B;
use Illuminate\Support\Collection;

class BreweryScrapper
{
    public const TEST = "test";
    public const EXIT = "exit";
    public const TABLE_DIRECTORY = __DIR__ . "/../tests/stubs/table.json";

    protected array $data = [];
    public array $toFile = [];

    public function test(): string
    {
        $collection = new Collection($this->data);

        $var = $collection->get(0);
        return $var["name"];
    }

    public function collectData(): void
    {
        $handle = file_get_contents(static::TABLE_DIRECTORY);
        $this->data = json_decode($handle, associative: true);
    }
    public function getData():array
    {
        return $this->data;
    }
}
