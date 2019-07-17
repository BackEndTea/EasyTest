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
    public function toEqual($expected): Expectable;

    /**
     * === comparison
     *
     * @param mixed $expected
     */
    public function toBeTheSame($expected): Expectable;

    /**
     * instanceof comparison
     *
     * @param string|object $expected
     */
    public function toBeInstanceOf($expected): Expectable;
}
