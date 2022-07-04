<?php

namespace Interns2022B\Models;

use Illuminate\Support\Collection;

class Country
{

    public function __construct(
        public readonly string $name,
        public readonly Collection $cities,
    ) {}
}
