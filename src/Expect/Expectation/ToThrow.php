<?php

declare(strict_types=1);

namespace EasyTest\Expect\Expectation;

use Throwable;
use function sprintf;

class ToThrow extends Expectation
{
    /** @var callable */
    private $callable;

    /** @var object|string */
    private $error;

    /**
     * @param object|string $error
     */
    public function __construct(callable $callable, $error)
    {
        $this->callable = $callable;
        $this->error    = $error;
    }

    /**
     * Checks if the the expectation is met.
     */
    public function matches(): bool
    {
        try {
            ($this->callable)();
        } catch (Throwable $t) {
            return $t instanceof $this->error;
        }

        return false;
    }

    /**
     * The error message if the assertion fails
     */
    public function error(): string
    {
        return sprintf(
            'Expected an exception of type %s to be thrown, but it was not.',
            static::valueToString($this->error)
        );
    }
}
