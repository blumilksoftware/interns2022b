<?php

declare(strict_types=1);

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
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
    default => "unknown option"
};

$climate->out($result);
