<?php

declare(strict_types=1);

namespace Interns2022B;

use Illuminate\Support\Collection;
use Interns2022B\Models\Brewery;

class Breweries
{
    public const SEARCH = "choice";

    public function getBreweries(Collection $breweriesFactory): Collection
    {
        $name = readline("Please provide brewery or city name:");

        $chosenData = new Collection();
        $chosenData->push(["Nazwa browaru", "Miasto"]);
        /**
         * @var Brewery $rowValue
         */
        $breweriesFactory->each(function (Brewery $item) use ($chosenData, $name) {
            if ($item->city->name === $name || $item->name === $name) {
                $chosenData->push([$item->name, $item->city->name]);
            }
        });

        return $chosenData;
    }
}

