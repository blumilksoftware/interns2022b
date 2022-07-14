<?php

declare(strict_types=1);

use Interns2022B\Breweries;
use Interns2022B\BreweryData;
use Interns2022B\BreweryFactory;
use Interns2022B\BreweryScrapper;
use Interns2022B\Cache;
use Interns2022B\Providers;
use League\CLImate\CLImate;

require_once __DIR__ . "/../vendor/autoload.php";

$climate = new CLImate();
$climate->green("Wow! My first simple PHP CLI application works!");

$breweryData = new BreweryData();
$cache = new Cache();
$providerService = new Providers();
$breweries = new Breweries();
$breweryFactory = new BreweryFactory();
$breweryScrapper = new BreweryScrapper();

$breweryScrapper->casparyScrapper();
$breweryData->collectData();
$breweriesData = $breweryData->getData();
$breweriesFactory = $breweryFactory->create($breweriesData);
$providers = $providerService->getProviders($breweriesFactory);

while (true) {
    $climate->br();
    $breweryOption = $climate->radio("Choose data to fetch:", [
        Breweries::SEARCH => "searching by brewery or city name",
        Providers::LIST => "showing a list of providers",
        Cache::CLEAR => "clearing cache",
        Cache::BUILD => "rebuild cache",
        BreweryData::EXIT => "exit",
    ])->prompt();

    match ($breweryOption) {
        Breweries::SEARCH => $climate->table($breweries->getBreweries($breweriesFactory)->toArray()),
        Providers::LIST => $climate->table($providers->toArray()),
        Cache::CLEAR => $climate->out($cache->clearCache()),
        Cache::BUILD => $cache->rebuildCache($providers, $breweriesFactory),
        BreweryData::EXIT => exit(),
        default => $climate->error("unknown option"),
    };
}
