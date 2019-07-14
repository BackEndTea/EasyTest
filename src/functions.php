<?php

declare(strict_types=1);

namespace EasyTest;

use EasyTest\Event\AddAfterEach;
use EasyTest\Event\AddBeforeEach;
use EasyTest\Event\EventHandler;
use EasyTest\Event\Subscriber\TestStartSubscriber;
use EasyTest\Event\TestFinished;
use EasyTest\Event\TestStart;
use EasyTest\Expect\Expect;
use EasyTest\Expect\Expectable;

$dispatcher = EventHandler::instance();
$dispatcher->addSubscriber(new TestStartSubscriber());

function describe(string $name, callable $suite): void
{
    echo $name ."\n";
    $suite();
}

function it(string $name, callable $test) : void
{
    echo "    ".$name ."\n";
    $dispatcher= EventHandler::instance();
    $dispatcher->dispatch(new TestStart());
    $test();
    $dispatcher->dispatch(new TestFinished());
}
function expect($expected): Expectable {
    return new Expect($expected);
}

function beforeEach(callable $before): void
{
    $handler = EventHandler::instance();
    $handler->dispatch(new AddBeforeEach($before));
}

function afterEach(callable $after): void
{
    $handler = EventHandler::instance();
    $handler->dispatch(new AddAfterEach($after));
}
