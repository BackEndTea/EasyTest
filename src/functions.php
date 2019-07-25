<?php

declare(strict_types=1);

namespace EasyTest;

use EasyTest\Event\AddAfterEach;
use EasyTest\Event\AddBeforeEach;
use EasyTest\Event\EventHandler;
use EasyTest\Event\TestFailed;
use EasyTest\Event\TestFinished;
use EasyTest\Event\TestStart;
use EasyTest\Expect\AssertionFailure;
use EasyTest\Expect\Expect;
use EasyTest\Expect\Expectable;
use Throwable;

function describe(string $name, callable $suite): void
{
    echo $name . "\n";
    $suite();
}

function it(string $name, callable $test): void
{
    echo '    ' . $name;
    $dispatcher = EventHandler::instance();
    $dispatcher->dispatch(new TestStart());
    try {
        $test();
    } catch (AssertionFailure $e) {
        echo "\e[0;31;40m FAILED\n" . $e->getMessage() . "\e[0m\n";
        $dispatcher->dispatch(new TestFailed());
    } catch (Throwable $t) {
        echo "\e[0;31;40m FAILED\n" . $t->getMessage() . "\e[0m\n";
        $dispatcher->dispatch(new TestFailed());
    }
    echo "\n";
    $dispatcher->dispatch(new TestFinished());
}

/**
 * @param mixed $expected
 */
function expect($expected): Expectable
{
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
