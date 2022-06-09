<?php

declare(strict_types=1);

use GuzzleHttp\Client;
use Interns2022B\BreweryScrapper;
use League\CLImate\CLImate;

require_once __DIR__ . "/../vendor/autoload.php";

$climate = new CLImate();
$climate->green("Wow! My first simple PHP CLI application works!");

$breweryName = $climate->input("Please provide brewery or city name:")->prompt();
$breweryScrapper = new BreweryScrapper($breweryName, new Client());
$climate->br();

$result = $breweryScrapper->dataToArray($breweryName);
$climate->table($result);

while (true) {
    $climate->br();
    $breweryOption = $climate->radio("Choose data to fetch:", [
        BreweryScrapper::LIST => "showing a list of providers",
        BreweryScrapper::CLEAR => "clearing cache",
        BreweryScrapper::EXIT => "exit",
    ])->prompt();

    $breweryResult = match ($breweryOption) {
        BreweryScrapper::LIST => $breweryScrapper->getList(),
        BreweryScrapper::CLEAR => $breweryScrapper->getClear(),
        BreweryScrapper::EXIT => exit(),
        default => $climate->error("unknown option"),
    };
    $climate->out($breweryResult);
}
