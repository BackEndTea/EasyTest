<?php

declare(strict_types=1);

namespace EasyTest\Expect\Expectation;

use function sprintf;

class ToBeTheSameAs extends Expectation
{
    /** @var mixed */
    private $actual;

    /** @var mixed */
    private $expected;

    /**
     * @param mixed $actual
     * @param mixed $expected
     */
    public function __construct($actual, $expected)
    {
        $this->expected = $expected;
        $this->actual   = $actual;
    }

    public function matches(): bool
    {
        return $this->actual === $this->expected;
    }

    public function error(): string
    {
        return sprintf(
            'Expected a value identical to %s, instead got %s',
            static::valueToString($this->expected),
            static::valueToString($this->actual)
        );
    }
}
