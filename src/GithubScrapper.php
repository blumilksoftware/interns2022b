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
    public const WEB = "website";
    public const TWITTER = "twitter";
    public const EMAIL = "email";
    public const VERIFICATION = "verification";

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

    public function getWebsite(): string
    {
        $nodeWeb = $this->crawler->filterXPath("//a[@rel='nofollow']")->first();
        return $nodeWeb->count() ? $nodeWeb->html() : "unknown";
    }

    public function getTwitter(): string
    {
        $nodeTwitter = $this->crawler->filterXPath("//a[contains(@href, 'twitter')]")->first();
        return $nodeTwitter->count() ? $nodeTwitter->html() : "unknown";
    }

    public function getEmail(): string
    {
        $nodeEmail = $this->crawler->filterXPath("//a[@itemprop='email']")->first();
        return $nodeEmail->count() ? $nodeEmail->html() : "unknown";
    }

    public function getVerification(): string
    {
        $nodeVerification = $this->crawler->filterXPath("//summary[@title='Label: Verified']")->first();
        return $nodeVerification->count() ? $nodeVerification->html() : "not verified";
    }
}
