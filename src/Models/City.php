<?php

namespace Interns2022B\Models;

use JsonSerializable;

class City implements JsonSerializable
{

    public function __construct(
        public readonly string $name,
    )
    {
    }

    public function jsonSerialize(): array
    {
        return
            ["name"=>$this->name];
    }

}