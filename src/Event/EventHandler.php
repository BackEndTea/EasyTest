<?php


namespace EasyTest\Event;


use EasyTest\Event\Subscriber\EventSubscriber;

class EventHandler
{
    /**
     * Singleton instance
     *
     * @var self|null
     */
    private static $instance;

    /**
     * @var array<int, array<int, callable>>
     */
    private $listeners;

    private function __construct()
    {
        //Don't allow instantion
    }

    public static function instance(): self
    {
        if(self::$instance === null){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function dispatch(object $event): void
    {
        $name = get_class($event);

        foreach ($this->getListeners($name) as $listener) {
            $listener($event);
        }
    }

    public function addSubscriber(EventSubscriber $eventSubscriber): void
    {
        foreach ($eventSubscriber->subscribedEvents() as $eventName => $listener) {
            $this->listeners[$eventName][] = $listener;
        }
    }

    /**
     * @return array<int, callable>
     */
    private function getListeners(string $eventName): array
    {
        return $this->listeners[$eventName] ?? [];
    }
}

