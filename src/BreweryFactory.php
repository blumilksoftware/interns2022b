<?php

declare(strict_types=1);

namespace Interns2022B;

use Illuminate\Support\Collection;
use Interns2022B\Models\Brewery;
use Interns2022B\Models\City;

class BreweryFactory
{
    public function create(array $breweryData): Collection
    {
        $transformed = new Collection();
        foreach ($breweryData as $row) {
            $brewery = new Brewery(
                name: $row["name"],
                city: new City(name: $row["city"]),
                providers: new Collection((array)$row["provider"]),
                countries: new Collection((array)$row["country"]),
            );
            $transformed->push($brewery);
        }

        return $transformed;
    }
}
