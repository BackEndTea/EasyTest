<?php

declare(strict_types=1);

namespace EasyTest\Expect\Expectation\TypeExpectation;

use EasyTest\Expect\Expectation\Expectation;
use function is_callable;
use function sprintf;

/**
 * @psalm-template T
 */
class ToBeCallable extends Expectation
{
    /**
     * @psalm-var T
     * @var mixed
     */
    private $actual;

    /**
     * @param mixed $actual
     *
     * @psalm-param T $actual
     */
    public function __construct($actual)
    {
        $this->actual = $actual;
    }

    /**
     * @psalm-assert callable $this->actual
     */
    public function matches(): bool
    {
        return is_callable($this->actual);
    }

    public function error(): string
    {
        return sprintf(
            'Expected a callable, instead got a value of type %s.',
            static::typeToString($this->actual)
        );
    }
}
