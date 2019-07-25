<?php

declare(strict_types=1);

namespace EasyTest\Expect;

interface Expectable
{
    /**
     * == comparison
     *
     * @param mixed $expected
     */
    public function toEqual($expected, string $message = ''): Expectable;

    /**
     * === comparison
     *
     * @param mixed $expected
     */
    public function toBeTheSameAs($expected, string $message = ''): Expectable;

    /**
     * instanceof comparison
     *
     * @param string|object $expected
     */
    public function toBeInstanceOf($expected, string $message = ''): Expectable;

    /**
     * Does function throw specifed exception
     *
     * @param string|object $exception
     */
    public function toThrow($exception, string $message = ''): Expectable;

    /**
     * Is the entry callable.
     */
    public function toBeCallable(string $message = ''): Expectable;
}
