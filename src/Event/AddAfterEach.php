<?php


namespace EasyTest\Event;


class AddAfterEach
{
    /**
     * @var callable
     */
    private $afterEach;

    public function __construct(callable $beforeEach)
    {
        $this->afterEach = $beforeEach;
    }

    public function afterEach(): callable
    {
        return $this->afterEach;
    }


}
