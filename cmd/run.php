<?php

declare(strict_types=1);

use Interns2022B\Breweries;
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

$breweryScrapper->collectData();
$breweriesData = $breweryScrapper->getData();
$providers = $providerService->getProviders($breweriesData);

$breweryFactory = new \Interns2022B\BreweryFactory();
$test = $breweryFactory->create($breweriesData);

/* @var \Interns2022B\VO\Brewery $x */
$x = $test->first();
$cityName = $x->city->name;
$cityName2 = $x->city->getName();

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
        Breweries::SEARCH => $climate->table($breweries->getBreweries($breweriesData)),
        Providers::LIST => $climate->table((array)$providers),
        Cache::CLEAR => $climate->out($cache->clearCache()),
        Cache::BUILD => $cache->rebuildCache($providers, $breweriesData),
        BreweryScrapper::EXIT => exit(),
        default => $climate->error("unknown option"),
    };
}
