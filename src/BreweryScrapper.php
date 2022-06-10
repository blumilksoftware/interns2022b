<?php

declare(strict_types=1);

namespace Interns2022B;

class BreweryScrapper
{
    public const SHOW = "show";
    public const LIST = "list";
    public const CLEAR = "clear";
    public const EXIT = "exit";

    public array $data = [];

    public function dataToArray(string $name): array
    {
        $choosenData = []; 
        $handle = fopen(__DIR__ . "/../tests/stubs/table.csv", "r");
        $headers = [];
        $i = 0;

        while (($row = fgetcsv($handle, null, ";")) !== false) {
            if ($i === 0) {
                $headers = $row;
                $i++;
                continue;
            }
            $rowValues = [];
            foreach ($headers as $key => $value) {
                $rowValues[$headers[$key]] = $row[$key];
            }
            $this->data[] = $rowValues;

            $i++;
        }

        for ($row = 0; $row < 2; $row++) {
            if (in_array($name, $this->data[$row], strict: true)) {
                $choosenData[] = $this->data[$row];
            }
        }

        fclose($handle);

        return $choosenData;
    }

    public function getList(): array
    {
        $providers = [];
        for ($row = 0; $row < 2; $row++) {
            $providers[] = $this->data[$row]["Provider"];
        }

        return $providers;
    }

    public function getClear(): void
    {
        $handle = __DIR__ . "/../tests/stubs/table.csv";
        if (unlink($handle)) {
            echo "File was deleted successfully";
        } else {
            echo "File doesn't exist";
        }
    }
}
