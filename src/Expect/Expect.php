<?php

declare(strict_types=1);

namespace EasyTest\Expect;

use EasyTest\Expect\Expectation\Expectation;
use EasyTest\Expect\Expectation\ToBeInstanceOf;
use EasyTest\Expect\Expectation\ToBeTheSameAs;
use EasyTest\Expect\Expectation\ToEqual;
use EasyTest\Expect\Expectation\ToThrow;

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
        $this->expectThat(new ToEqual($this->actual, $expected));

        return $this;
    }

    /** @inheritDoc */
    public function toBeTheSameAs($expected): Expectable
    {
        $this->expectThat(new ToBeTheSameAs($this->actual, $expected));

        return $this;
    }

    /** @inheritDoc */
    public function toBeInstanceOf($expected): Expectable
    {
        $this->expectThat(new ToBeInstanceOf($this->actual, $expected));

        return $this;
    }

    /** @inheritDoc */
    public function toThrow($exception): Expectable
    {
        $this->expectThat(new ToThrow($this->actual, $exception));

        return $this;
    }

    private function expectThat(Expectation $expectation): void
    {
        if (! $expectation->matches()) {
            throw new AssertionFailure($expectation->error());
        }
    }
}
