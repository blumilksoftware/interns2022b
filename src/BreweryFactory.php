<?php

namespace Interns2022B;

use Illuminate\Support\Collection;
use Interns2022B\VO\Brewery;
use Interns2022B\VO\City;
use Interns2022B\VO\Country;
use Interns2022B\VO\Provider;

class BreweryFactory
{


    /**
     * @param array $breweryData
     * @return Collection<Brewery>
     */
    public function create(array $breweryData): Collection
    {
        $transformed = new Collection();

        foreach ($breweryData as $row){

            $brewery = new Brewery(
                name: $row['name'],
                city: new City(name: $row['city']),
                provider: new Provider(name: $row['provider']),
                country: new Country(name: $row['country']),
            );
            $transformed->push($brewery);
        }

        return $transformed;
    }

}