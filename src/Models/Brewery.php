<?php

declare(strict_types=1);

namespace Interns2022B\Models;

class Brewery
{
    public function __construct(
        public readonly string $name,
        public readonly City $city,
        public readonly Provider $provider,
        public readonly Country $country,
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getCity(): City
    {
        return $this->city;
    }

    public function getCountry(): Country
    {
        return $this->country;
    }

    public function getProvider(): Provider
    {
        return $this->provider;
    }
}
