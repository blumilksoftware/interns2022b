<?php

declare(strict_types=1);

namespace Interns2022B\Models;

class City
{
    public function __construct(
        public readonly string $name,
    ) {}

    public function getName(): string
    {
        return $this->name;
    }
}
