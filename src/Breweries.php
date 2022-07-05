<?php

declare(strict_types=1);

namespace Interns2022B;

use Illuminate\Support\Collection;
use Interns2022B\Models\Brewery;

class Breweries
{
    public const SEARCH = "choice";

    protected function getCountry(Collection $countries): string
    {
        return $countries->first();
    }

    protected function getProvider(Collection $providers): string
    {
        return $providers->first();
    }


    public function getBreweries(Collection $breweriesFactory): Collection
    {
        $name = readline("Please provide brewery or city name:");

        $chosenData = new Collection();
        $chosenData->push(["Brewery name", "City", "Country", "Provider"]);

        /**
         * @var Brewery $rowValue
         */
        $breweriesFactory->each(function (Brewery $item) use ($chosenData, $name) {
            if ($item->city->name === $name || $item->name === $name) {
                $chosenData->push([$item->name, $item->city->name, $this->getCountry($item->countries), $this->getProvider($item->providers)]);
            }
        });

        return $chosenData;
    }
}

