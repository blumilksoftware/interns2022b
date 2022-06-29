<?php

declare(strict_types=1);

namespace Interns2022B;

use Illuminate\Support\Collection;
use Interns2022B\Models\Brewery;
use Interns2022B\Models\City;
use Interns2022B\Models\Country;
use Interns2022B\Models\Provider;

class BreweryFactory
{
    public function create(array $breweryData): Collection
    {
        $transformed = new Collection();
        foreach ($breweryData as $row) {
            $brewery = new Brewery(
                name: $row["name"],
                city: new City(name: $row["city"]),
                provider: new Provider(
                    name: $row["provider"],
                    breweries: new Collection((array)$row["name"]),
                ),
                country: new Country(
                    name: $row["country"],
                    cities: new Collection((array)$row["city"]),
                ),
            );
            $transformed->push($brewery);
        }

        return $transformed;
    }
}
