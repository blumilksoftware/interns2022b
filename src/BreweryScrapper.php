<?php

declare(strict_types=1);

namespace Interns2022B;
use League\CLImate\CLImate;
require_once __DIR__ . "/../vendor/autoload.php";

class BreweryScrapper
{
    public const SHOW = "show";
    public const LIST = "list";
    public const CLEAR = "clear";
    public const EXIT = "exit";

    public $allRecords = [];

    public function dataToArray(): void
    {
        $data = [];
        $handle = fopen(__DIR__ . "/../tests/stubs/table.csv", "r");

        while (($data = fgetcsv($handle, null, ";")) !== false) {
            $this->allRecords[] = $data;
        }
        fclose($handle);
    }

    public function getShowLabel($name): void
    {
        $choosenData = [];
        $climate = new CLImate();
        for ($row = 0; $row < 3; $row++) {
            if (in_array($name, $this -> allRecords[$row], true)) {
                $choosenData[] = $this->allRecords[$row];
            }
        }  
        $climate -> table($choosenData);
    }

    public function getList(): void
    {
        for ($row = 1; $row < 3; $row++) {
        }
    }

    public function getClear(): void
    {
        $climate = new CLImate();
        $handle = __DIR__ . "/../tests/stubs/table.csv";
        $climate->br();
        if (unlink($handle)) {
            $climate->green("File was deleted successfully");
        } else {
            $climate->red("Error");
        }
    }
}
