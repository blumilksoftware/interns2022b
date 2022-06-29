<?php

namespace Interns2022B\VO;

use Illuminate\Support\Collection;

class Provider
{

    public function __construct(
        public readonly string $name,
        public Collection $breweries,
    )
    {
    }

    public function getName(): string
    {
        return $this->name;
    }


}