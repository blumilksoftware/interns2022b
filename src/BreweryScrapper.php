<?php

declare(strict_types=1);

namespace Interns2022B;

class BreweryScrapper
{
    public const EXIT = "exit";

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
}
