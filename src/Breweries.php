<?php

declare(strict_types=1);

namespace Interns2022B;

class Breweries extends BreweryScrapper
{
    public const SEARCH = "choice";

    public function getBreweries(): array
    {
        $name = readline("Please provide brewery or city name:");

        $chosenData = [];
        foreach (parent::data as $rowValue) {
            if (in_array($name, $rowValue, strict: true)) {
                $chosenData[] = $rowValue;
            }
        }
        return $chosenData;
    }
}
