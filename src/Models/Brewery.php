<?php

declare(strict_types=1);

namespace Interns2022B\Models;

use Illuminate\Support\Collection;

class Brewery
{
    public function __construct(
        public readonly string $name,
        public readonly City $city,
        public Collection $providers,
        public Collection $countries,
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getCity(): City
    {
        return $this->city;
    }

    public function getCountries(): Collection
    {
        return $this->countries;
    }

    public function getProviders(): Collection
    {
        return $this->providers;
    }
}
