<?php

declare(strict_types=1);

namespace Interns2022B;

class a
{
    protected const A = "a";

    protected Providers $providers;
    protected string $name;

    public function a_self()
    {
        return self::A;
    }

    public function a_static()
    {
        return static::A;
    }
}
