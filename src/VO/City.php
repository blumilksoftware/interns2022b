<?php

namespace Interns2022B\VO;

class City
{

    public function __construct(
        public readonly string $name,
    ) {}

    public function name(){
        return $this->name;
    }
}