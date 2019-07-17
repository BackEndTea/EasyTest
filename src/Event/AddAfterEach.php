<?php

declare(strict_types=1);

namespace EasyTest\Event;

class AddAfterEach
{
    /** @var callable */
    private $afterEach;

    public function __construct(callable $afterEach)
    {
        $this->afterEach = $afterEach;
    }

    public function afterEach(): callable
    {
        return $this->afterEach;
    }
}
