<?php

namespace Interns2022B\VO;

use Illuminate\Support\Collection;

class Country
{

    public function __construct(
        public readonly string $name,
        public Collection $city,
    )
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

}