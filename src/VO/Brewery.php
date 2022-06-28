<?php

declare(strict_types=1);

namespace Interns2022B\VO;

class Brewery
{

    public string $id;

    public function __construct(
        string $name,
        public readonly City $city,
        public readonly Provider $provider,
        public readonly Country $country,


){
        $this->id = (string)rand(0,1000);
    }

}