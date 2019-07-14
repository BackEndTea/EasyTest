<?php
declare(strict_types=1);

namespace EasyTest\Event\Subscriber;


interface EventSubscriber
{
    /**
     * @return array<string, callable>
     */
    public function subscribedEvents(): array;
}
