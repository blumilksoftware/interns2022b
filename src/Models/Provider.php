<?php

declare(strict_types=1);

namespace Interns2022B\Models;

use Illuminate\Support\Collection;

class Provider
{
    public function __construct(
        public readonly string $name,
        public readonly Collection $breweries,
    ) {}
}
