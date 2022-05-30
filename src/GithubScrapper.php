<?php

declare(strict_types=1);

namespace Interns2022B;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\DomCrawler\Crawler;

class GithubScrapper
{
    public const LOCATION = "location";
    public const URL = "url";

    protected Crawler $crawler;

    /**
     * @throws GuzzleException
     */
    public function __construct(
        protected string $name,
        Client $client,
    ) {
        $html = $client->get($this->getRepositoryURL())->getBody()->getContents();
        $this->crawler = new Crawler($html);
    }

    public function getLocation(): string
    {
        $node = $this->crawler->filterXPath("//span[@itemprop='location']")->first();
        return $node->count() ? $node->html() : "unknown";
    }

    public function getRepositoryURL(): string
    {
        return "https://github.com/" . $this->name;
    }
}
