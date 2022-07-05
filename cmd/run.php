<?php

declare(strict_types=1);

use Interns2022B\Breweries;
use Interns2022B\BreweryFactory;
use Interns2022B\BreweryScrapper;
use Interns2022B\Cache;
use Interns2022B\Providers;
use League\CLImate\CLImate;

require_once __DIR__ . "/../vendor/autoload.php";

$climate = new CLImate();
$climate->green("Wow! My first simple PHP CLI application works!");

$breweryScrapper = new BreweryScrapper();
$cache = new Cache();
$providerService = new Providers();
$breweries = new Breweries();
$breweryFactory = new BreweryFactory();

$breweryScrapper->collectData();
$breweriesData = $breweryScrapper->getData();
$providers = $providerService->getProviders($breweriesData);
$breweriesFactory = $breweryFactory->create($breweriesData);
//$janusz=($breweries->getBreweries($breweriesFactory));
//var_dump($janusz);
while (true) {
    $climate->br();
    $breweryOption = $climate->radio("Choose data to fetch:", [
        Breweries::SEARCH => "searching by brewery or city name",
        Providers::LIST => "showing a list of providers",
        Cache::CLEAR => "clearing cache",
        Cache::BUILD => "rebuild cache",
        BreweryScrapper::EXIT => "exit",
    ])->prompt();

    match ($breweryOption) {
        Breweries::SEARCH => $climate->table($breweries->getBreweries($breweriesFactory)->toArray()),
        Providers::LIST => $climate->out($providers),
        Cache::CLEAR => $climate->out($cache->clearCache()),
        Cache::BUILD => $cache->rebuildCache($providers, $breweriesData),
        BreweryScrapper::EXIT => exit(),
        default => $climate->error("unknown option"),
    };
}
