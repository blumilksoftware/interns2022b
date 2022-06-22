<?php


declare(strict_types=1);

namespace Interns2022B;

class b extends a {

    protected const A = 'ab';
    protected const B = 'b';

    public function b_self(){
        return self::B;
    }

    public function b_static(){
        return static::B;
    }
}
