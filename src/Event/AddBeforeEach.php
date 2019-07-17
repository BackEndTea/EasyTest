<?php

declare(strict_types=1);

namespace EasyTest\Event;

class AddBeforeEach
{
    /** @var callable */
    private $beforeEach;

    public function __construct(callable $beforeEach)
    {
        $this->beforeEach = $beforeEach;
    }

    public function beforeEach(): callable
    {
        return $this->beforeEach;
    }
}
