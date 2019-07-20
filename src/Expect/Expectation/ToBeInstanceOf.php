<?php

declare(strict_types=1);

namespace EasyTest\Expect\Expectation;

use function sprintf;

class ToBeInstanceOf extends Expectation
{
    /** @var mixed */
    private $actual;
    /** @var object|string */
    private $expected;

    /**
     * @param mixed         $actual
     * @param string|object $expected
     */
    public function __construct($actual, $expected)
    {
        $this->actual   = $actual;
        $this->expected = $expected;
    }

    /**
     * Checks if the the expectation is met.
     */
    public function matches(): bool
    {
        return $this->actual instanceof $this->expected;
    }

    /**
     * The error message if the assertion fails
     */
    public function error(): string
    {
        return sprintf(
            'expected a value to be an instance of %s, instead got %s',
            static::typeToString($this->expected),
            static::typeToString($this->actual)
        );
    }
}
