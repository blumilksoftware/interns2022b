<?php

declare(strict_types=1);

namespace Interns2022B\VO;

class Brewery
{

    public string $id;

    public function __construct(
        public readonly string   $name,
        public readonly City     $city,
        public readonly Provider $provider,
        public readonly Country  $country,


    )
    {
    }

    public function getName()
    {
        return $this->name;
    }


    public function getCity(): City
    {
        return $this->city;
    }

    public function getProvider(): Provider
    {
        return $this->provider;
    }

    public function getCountry(): Country
    {
        return $this->country;
    }

}