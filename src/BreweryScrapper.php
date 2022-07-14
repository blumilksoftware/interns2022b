<?php

declare(strict_types=1);

namespace Interns2022B;

use Symfony\Component\DomCrawler\Crawler;

class BreweryScrapper
{
    protected Crawler $sections;
    private array $casparyData = [];

    public function casparyScrapper(): void
    {
        $url = "https://www.caspary.com/en/references.html";
        $html = file_get_contents($url);
        $crawler = new Crawler($html);

        $this->walker = $crawler->filterXPath("//*[@id='referenzmenu']");
        $fetchedCountry = $this->walker->filterXPath("//span[@class='col-sm-12 title']");
        $item = $this->walker->filterXPath("//span");

        $countries = [];
        $fetchedRecords = [];
        $countryName = "";

        for ($pointerPosition = 0; $pointerPosition < $fetchedCountry->count(); $pointerPosition++) {
            $countries[] = $fetchedCountry->eq($pointerPosition)->text();
        }

        for ($pointerPosition = 0; $pointerPosition < $item->count(); $pointerPosition++) {
            if ($item->eq($pointerPosition)->text() !== "") {
                $fetchedRecords[] = $item->eq($pointerPosition)->text();
            }
        }

        for ($pointerPosition = 0; $pointerPosition < count($fetchedRecords) - 1; $pointerPosition += 2) {
            if (in_array($fetchedRecords[$pointerPosition], $countries, true)) {
                $countryName = $fetchedRecords[$pointerPosition];
                $add = [
                    "name" => $fetchedRecords[$pointerPosition + 1],
                    "city" => $fetchedRecords[$pointerPosition + 2],
                    "country" => $countryName,
                    "provider" => "Caspary",
                ];
                $this->casparyData[] = $add;
                $pointerPosition++;
            } else {
                $add = [
                    "name" => $fetchedRecords[$pointerPosition],
                    "city" => $fetchedRecords[$pointerPosition + 1],
                    "country" => $countryName,
                    "provider" => "Caspary",
                ];
                $this->casparyData[] = $add;
            }
        }
        file_put_contents(Cache::TABLE_DIRECTORY, json_encode($this->casparyData, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
        file_put_contents(Cache::TABLE_DIRECTORY, "\n", FILE_APPEND);
    }
}
