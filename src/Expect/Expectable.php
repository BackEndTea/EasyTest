<?php

namespace EasyTest\Expect;


interface Expectable
{
    /**
     * == comparison
     * @param mixed $expected
     * @return Expectable
     */
    public function toEqual($expected): Expectable;

    /**
     * === comparison
     * @param mixed $expected
     * @return Expectable
     */
    public function toBeTheSame($expected): Expectable;

    /**
     * instanceof comparison
     * @param string|object $expected
     * @return Expectable
     */
    public function toBeInstanceOf($expected): Expectable;

}
