<?php

declare(strict_types=1);

namespace Interns2022B\Models;

use Illuminate\Support\Collection;

/**
 * @property Collection<Provider> $providers
 * @property Collection<Country> $countries
 */

class Brewery
{
    public function __construct(
        public readonly string $name,
        public readonly City $city,
        public readonly Collection $providers,
        public readonly Collection $countries,
    ) {}
}
