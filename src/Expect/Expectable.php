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
    public function toBeTheSameAs($expected): Expectable;

    /**
     * instanceof comparison
     *
     * @param string|object $expected
     */
    public function toBeInstanceOf($expected): Expectable;
}
