<?php

declare(strict_types=1);

namespace Interns2022B;
use Illuminate\Support\Collection;

class BreweryScrapper
{
    public const TEST = "test";
    public const EXIT = "exit";

    public array $toFile = [];
    protected array $data = [];

    public function test(): string
    {
        $collection = new Collection($this->data);

        $var = $collection->get(0);
        return $var["name"];
    }

    public function collectData(): void
    {
        $handle = file_get_contents(Cache::TABLE_DIRECTORY);
        $this->data = json_decode($handle, associative: true);
    }

    public function getData(): array
    {
        return $this->data;
    }
}
