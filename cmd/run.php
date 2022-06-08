<?php

declare(strict_types=1);

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Interns2022B\BreweryScrapper;
use Interns2022B\GithubScrapper;
use League\CLImate\CLImate;

require_once __DIR__ . "/../vendor/autoload.php";

$climate = new CLImate();

$climate->green("Wow! My first simple PHP CLI application works!");
$name = $climate->input("Please type a Github organization name:")->prompt();

try {
    $scrapper = new GithubScrapper($name, new Client());
} catch (GuzzleException) {
    $climate->red("Requested organization does not exist!");
    die();
}

$option = $climate->radio("Choose data to fetch:", [
    GithubScrapper::LOCATION => "organization location",
    GithubScrapper::URL => "repository URL",
    GithubScrapper::WEB => "website",
    GithubScrapper::TWITTER => "twitter",
    GithubScrapper::EMAIL => "email",
    GithubScrapper::VERIFICATION => "verification",
])->prompt();

$result = match ($option) {
    GithubScrapper::LOCATION => $scrapper->getLocation(),
    GithubScrapper::URL => $scrapper->getRepositoryURL(),
    GithubScrapper::WEB => $scrapper->getWebsite(),
    GithubScrapper::TWITTER => $scrapper->getTwitter(),
    GithubScrapper::EMAIL => $scrapper->getEmail(),
    GithubScrapper::VERIFICATION => $scrapper->getVerification(),
    default => $climate->error("unknown option"),
};

$climate->out($result);

$breweryName = $climate->input("Please provide brewery or city name:")->prompt();
$breweryScrapper = new BreweryScrapper($breweryName, new Client());
$climate->br();
$breweryScrapper->dataToArray();
$breweryScrapper->getShowLabel($breweryName);

while (true) {
    $climate->br();
    $breweryOption = $climate->radio("Choose data to fetch:", [
        BreweryScrapper::LIST => "showing a list of providers",
        BreweryScrapper::CLEAR => "clearing cache",
        BreweryScrapper::EXIT => "exit",
    ])->prompt();

    $beweryResult = match ($breweryOption) {
        BreweryScrapper::LIST => $breweryScrapper->getList(),
        BreweryScrapper::CLEAR => $breweryScrapper->getClear(),
        EXIT => $climate->exit(),
        default => $climate->error("unknown option"),
    };
    $climate->out($breweryResult);
}
