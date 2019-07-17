<?php

declare(strict_types=1);

namespace EasyTest\Expect;

use function assert;

class Expect implements Expectable
{
    /** @var mixed */
    private $actual;

    /**
     * @param mixed $actual
     */
    public function __construct($actual)
    {
        $this->actual = $actual;
    }

    /** @inheritDoc */
    public function toEqual($expected): Expectable
    {
        assert($this->actual == $expected);

        return $this;
    }

    /** @inheritDoc */
    public function toBeTheSame($expected): Expectable
    {
        assert($this->actual === $expected);

        return $this;
    }

    /** @inheritDoc */
    public function toBeInstanceOf($expected): Expectable
    {
        assert($this->actual instanceof $expected);

        return $this;
    }
}
