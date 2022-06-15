<?php

declare(strict_types=1);

use Interns2022B\BreweryScrapper;
use League\CLImate\CLImate;

require_once __DIR__ . "/../vendor/autoload.php";

$climate = new CLImate();
$climate->green("Wow! My first simple PHP CLI application works!");

$breweryScrapper = new BreweryScrapper();
$breweryScrapper->collectData();

while (true) {
    $climate->br();
    $breweryOption = $climate->radio("Choose data to fetch:", [
        BreweryScrapper::SEARCH => "searching by brewery or city name",
        BreweryScrapper::LIST => "showing a list of providers",
        BreweryScrapper::CLEAR => "clearing cache",
        BreweryScrapper::BUILD => "rebuild cache",
        BreweryScrapper::EXIT => "exit",
    ])->prompt();

    match ($breweryOption) {
        BreweryScrapper::SEARCH => $climate->table($breweryScrapper->getBreweries()),
        BreweryScrapper::LIST => $climate->out($breweryScrapper->getProviders()),
        BreweryScrapper::CLEAR => $climate->out($breweryScrapper->clearCache()),
        BreweryScrapper::BUILD => $climate->out($breweryScrapper->rebuildCache()),
        BreweryScrapper::EXIT => exit(),
        default => $climate->error("unknown option"),
    };
}
