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

    public function getWebsite(): string {
        $node_web = $this->crawler->filterXPath("//a[@rel='nofollow']")->first();
        return $node_web->count() ? $node_web->html() : "unknown";
    }

    public function getTwitter(): string
    {
        return "https://twitter.com/" . $this->name;
    }

   public function getEmail(): string {
        $node_email = $this->crawler->filterXPath("//a[@itemprop='email']")->first();
        return $node_email->count() ? $node_email->html() : "unknown";
    }

    public function getVerification(): string {
        $node_verification = $this->crawler->filterXPath("//summary[@title='Label: Verified']")->first();
        return $node_verification->count() ? $node_verification->html() : "not verified";
    }

}
