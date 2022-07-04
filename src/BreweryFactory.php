<?php

namespace Interns2022B;

use Illuminate\Support\Collection;
use Interns2022B\Models\City;
use Interns2022B\Models\Brewery;

class BreweryFactory
{
    public function create(array $breweriesData): Collection
    {
        $transformed = new Collection();
        foreach ($breweriesData as $breweryData) {
            $brewery = new Brewery(
                name: $breweryData["name"],
                city: new City(name: $breweryData["city"]),
                providers: new Collection((array)$breweryData["provider"]),
                countries: new Collection((array)$breweryData["country"]),
            );
            $transformed->push($brewery);
        }

        return $transformed;
    }

}