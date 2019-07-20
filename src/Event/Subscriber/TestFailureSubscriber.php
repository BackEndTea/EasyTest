<?php

declare(strict_types=1);

namespace EasyTest\Event\Subscriber;

use EasyTest\Event\TestFailed;

class TestFailureSubscriber implements EventSubscriber
{
    /** @var int */
    private $failureCount = 0;

    public function testFailed(TestFailed $failed): void
    {
        $this->failureCount++;
    }

    /**
     * @return array<string, callable>
     */
    public function subscribedEvents(): array
    {
        return [
            TestFailed::class => [$this, 'testFailed'],
        ];
    }

    public function getFailureCount(): int
    {
        return $this->failureCount;
    }
}
