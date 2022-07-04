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
        /**
         * @var Brewery $rowValue
         */
        $breweriesFactory->each(function (Brewery $item) use ($chosenData, $name) {
            if ($item->city->name === $name || $item->name === $name) {
                $chosenData->push($item);

            }
        });

//        $breweriesFactory->filter(
//            fn (Brewery $item): bool => $item->city->name !== $name || $item->name !== $name
//        );
//
//        foreach ($breweriesFactory as $rowValue) {
//            if ($rowValue->city->name === $name || $rowValue->name === $name) {
//                $chosenData->push($rowValue);
//            }
//        }
//        var_dump($chosenData);
        return $chosenData;
    }
}
