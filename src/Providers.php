<?php

declare(strict_types=1);

namespace Interns2022B;

class Providers
{
    public const LIST = "list";

    public function getProviders(array $data): array
    {
        $providers = [];
        foreach ($data as $row => $rowValue) {
            $providers[] = $data[$row]["provider"];
        }
        return $providers;
    }

}
