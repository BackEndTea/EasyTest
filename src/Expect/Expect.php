<?php

declare(strict_types=1);

namespace EasyTest\Expect;

class Expect implements Expectable
{
    private $actual;

    public function __construct($actual)
    {
        $this->actual = $actual;
    }

    public function toEqual($expected): Expectable
    {
        assert($this->actual == $expected);
        return $this;
    }


    public function toBeTheSame($expected): Expectable
    {
        assert($this->actual === $expected);
        return $this;
    }

    public function toBeInstanceOf($expected): Expectable
    {
        assert($this->actual instanceof $expected);
        return $this;
    }
}
