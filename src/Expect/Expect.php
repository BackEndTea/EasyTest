<?php

declare(strict_types=1);

namespace EasyTest\Expect;

use EasyTest\Expect\Expectation\Expectation;
use EasyTest\Expect\Expectation\ToBeInstanceOf;
use EasyTest\Expect\Expectation\ToBeTheSameAs;
use EasyTest\Expect\Expectation\ToEqual;
use EasyTest\Expect\Expectation\ToThrow;
use EasyTest\Expect\Expectation\TypeExpectation\ToBeCallable;

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
    public function toEqual($expected, string $message = ''): Expectable
    {
        $this->expectThat(new ToEqual($this->actual, $expected), $message);

        return $this;
    }

    /** @inheritDoc */
    public function toBeTheSameAs($expected, string $message = ''): Expectable
    {
        $this->expectThat(new ToBeTheSameAs($this->actual, $expected), $message);

        return $this;
    }

    /** @inheritDoc */
    public function toBeInstanceOf($expected, string $message = ''): Expectable
    {
        $this->expectThat(new ToBeInstanceOf($this->actual, $expected), $message);

        return $this;
    }

    /** @inheritDoc */
    public function toThrow($exception, string $message = ''): Expectable
    {
        $this->toBeCallable();
        $this->expectThat(new ToThrow($this->actual, $exception), $message);

        return $this;
    }

    /**
     * @psalm-assert callable $this->actual
     */
    public function toBeCallable(string $message = ''): Expectable
    {
        $this->expectThat(new ToBeCallable($this->actual), $message);

        return $this;
    }

    private function expectThat(Expectation $expectation, string $message = ''): void
    {
        if (! $expectation->matches()) {
            throw new AssertionFailure($message ?:$expectation->error());
        }
    }
}
