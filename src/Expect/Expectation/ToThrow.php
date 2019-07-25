<?php

declare(strict_types=1);

namespace EasyTest\Expect\Expectation;

use Throwable;
use function get_class;
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

            if ($this->error instanceof \EasyTest\Expect\Throwable) {
                return $this->matchesCustomError($t, $this->error);
            }

            return $t instanceof $this->error;
        }

        return false;
    }

    private function matchesCustomError(Throwable $t, \EasyTest\Expect\Throwable $expect): bool
    {
        if ($expect->class !== null
            && get_class($t) !== $expect->class
        ) {
            return false;
        }

        if ($expect->message !== null
            && $t->getMessage() !== $expect->message
        ) {
            return false;
        }

        if ($expect->code !== null
            && $t->getCode() !== $expect->code
        ) {
            return false;
        }

        if ($expect->previous !== null) {

            $p = $t->getPrevious();

            return $p !== null && $this->matchesCustomError($p, $expect->previous);
        }

        return true;
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
