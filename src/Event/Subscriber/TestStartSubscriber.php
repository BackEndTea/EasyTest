<?php

declare(strict_types=1);

namespace EasyTest\Event\Subscriber;

use EasyTest\Event\AddAfterEach;
use EasyTest\Event\AddBeforeEach;
use EasyTest\Event\TestFinished;
use EasyTest\Event\TestStart;

class TestStartSubscriber implements EventSubscriber
{
    /** @var callable|null */
    private $before;

    /** @var callable|null */
    private $after;

    public function beforeTest(AddBeforeEach $before): void
    {
        $this->before = $before->beforeEach();
    }

    public function afterTest(AddAfterEach $after): void
    {
        $this->after = $after->afterEach();
    }

    public function testStart(TestStart $start): void
    {
        if (! $this->before) {
            return;
        }

        ($this->before)();
    }

    public function testFinished(TestFinished $finished): void
    {
        if (! $this->after) {
            return;
        }

        ($this->after)();
    }

    /**
     * @return array<string, callable>
     */
    public function subscribedEvents(): array
    {
        return [
            TestStart::class => [$this, 'testStart'],
            TestFinished::class => [$this, 'testFinished'],
            AddBeforeEach::class => [$this, 'beforeTest'],
            AddAfterEach::class => [$this, 'afterTest'],
        ];
    }
}
