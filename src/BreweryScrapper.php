<?php

declare(strict_types=1);

namespace Interns2022B;

class BreweryScrapper
{
    public const SHOW = "show";
    public const LIST = "list";
    public const CLEAR = "clear";
    public const EXIT = "exit";

    public function getShowLabel($name): void
    {
        $lines = file(__DIR__ . "/../tests/stubs/table.txt");
        $found = false;
        foreach ($lines as $line) {
            if (strpos($line, $name) !== false) {
                $found = true;
                echo $line;
            }
        }
        if (!$found) {
            echo "No match found";
        }
    }

    public function getList(): void
    {
        $lines = file(__DIR__ . "/../tests/stubs/table.txt");
        foreach ($lines as $line) {
            $parts = explode("|", $line);
            if (isset($parts[0]) && $parts[5] !== "Provider ") {
                echo $parts[5];
            } else {
                echo " ";
            }
        }
    }

    public function getClear(): void
    {
        opcache_reset();
    }

    public function getExit(): string
    {
        exit();
    }
}
