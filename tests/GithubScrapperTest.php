<?php

declare(strict_types=1);

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Interns2022B\GithubScrapper;
use PHPUnit\Framework\TestCase;

class GithubScrapperTest extends TestCase
{
    /**
     * @throws GuzzleException
     */
    public function testProperBehaviour(): void
    {
        $client = $this->getMockedClient("blumilksoftware.github.20220530183500.html");
        $scrapper = new GithubScrapper("blumilksoftware", $client);

        $this->assertSame("Legnica, PL", $scrapper->getLocation());
        $this->assertSame("https://github.com/blumilksoftware", $scrapper->getRepositoryURL());
    }

    public function testNotExistingOrganization(): void
    {
        $client = $this->getMockedClient("redmilksoftware.github.20220530184100.html", 404);

        $this->expectException(GuzzleException::class);
        new GithubScrapper("redmilksoftware", $client);
    }

    /**
     * @throws GuzzleException
     */
    public function testNotLocalizedOrganization(): void
    {
        $client = $this->getMockedClient("fingo.github.20220530184500.html");
        $scrapper = new GithubScrapper("fingo", $client);

        $this->assertSame("unknown", $scrapper->getLocation());
        $this->assertSame("https://github.com/fingo", $scrapper->getRepositoryURL());
    }

    protected function getMockedClient(string $filename, int $status = 200): Client
    {
        $mock = new MockHandler([
            new Response($status, [], file_get_contents(__DIR__ . "/stubs/$filename")),
        ]);
        $handlerStack = HandlerStack::create($mock);

        return new Client(["handler" => $handlerStack]);
    }
}
