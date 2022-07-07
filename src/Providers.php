<?php

declare(strict_types=1);

namespace Interns2022B;

use Illuminate\Support\Collection;
use Interns2022B\Models\Brewery;

class Providers
{
    public const LIST = "list";

    /**
     * @return Collection
     * @var Collection<Brewery> $breweries
     */

    public function getProviders(Collection $breweries): Collection
    {
        $providers = new Collection();
        $breweries->each(function (Brewery $item) use ($providers): void {
            $providers->push([$item->providers->first()]);
        });

        return $providers;
    }
}
