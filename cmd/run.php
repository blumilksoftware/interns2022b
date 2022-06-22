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

//$a = new \Interns2022B\a();
//$b = new \Interns2022B\b();
//$climate->out($b->b_self());
//$climate->br()->out($b->b_static());
//
//$climate->out($b->a_self());
//$climate->br()->out($b->a_static());
//die();






$breweryScrapper = new BreweryScrapper();
$cache = new Cache();
$providerService = new Providers();
$breweries = new Breweries();

$breweryScrapper->collectData();
$breweriesData = $breweryScrapper->getData();
$providers = $providerService->getProviders($breweriesData);

while (true) {
    $climate->br();
    $breweryOption = $climate->radio("Choose data to fetch:", [
        Breweries::SEARCH => "searching by brewery or city name",
        Providers::LIST => "showing a list of providers",
        Cache::CLEAR => "clearing cache",
        Cache::BUILD => "rebuild cache",
        BreweryScrapper::EXIT => "exit",
        BreweryScrapper::TEST => "test",
    ])->prompt();

    match ($breweryOption) {
        Breweries::SEARCH => $climate->table($breweries->getBreweries()),
        Providers::LIST => $climate->out($providers),
        Cache::CLEAR => $climate->out($cache->clearCache()),
        Cache::BUILD => $cache->rebuildCache($providers, $breweriesData),
        BreweryScrapper::EXIT => exit(),
        BreweryScrapper::TEST => $climate->out($breweryScrapper->test()),
        default => $climate->error("unknown option"),
    };
}
