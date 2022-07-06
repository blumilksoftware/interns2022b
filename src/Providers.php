<?php

declare(strict_types=1);

namespace Interns2022B;

use Illuminate\Support\Collection;
use Interns2022B\Models\Brewery;

class Providers
{
    public const LIST = "list";

    public function getProviders(Collection $breweriesFactory): Collection
    {
        $providers = new Collection();
        $breweriesFactory->each(function (Brewery $item) use ($providers): void {
            $providers->push([$item->providers->first()]);
        });

        return $providers;
    }
}
