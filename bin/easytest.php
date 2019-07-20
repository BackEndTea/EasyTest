<?php
declare(strict_types=1);

use EasyTest\Event\EventHandler;
use EasyTest\Event\Listener\TestSuiteStartListener;
use EasyTest\Event\Subscriber\TestFailureSubscriber;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Finder\Finder;

(static function(array $argv) {
    (static function(array $files){
        foreach ($files as $file) {
            if (file_exists($file)) {
                require $file;
                return;
            }
        }
        fwrite(
            STDERR,
            'You need to set up the project dependencies using Composer:' . PHP_EOL . PHP_EOL .
            '    composer install' . PHP_EOL . PHP_EOL .
            'You can learn all about Composer on https://getcomposer.org/.' . PHP_EOL
        );

        exit(1);
    }
    )([
        __DIR__ . '/../../../autoload.php',
        __DIR__ . '/../vendor/autoload.php',
        __DIR__ . '/vendor/autoload.php',
    ]);
    require_once __DIR__ . '/../vendor/autoload.php';

    $finder = Finder::create()
        ->in(getcwd())
        ->path($argv[1])
        ->files()
    ;
    $failureSubscriber = new TestFailureSubscriber();
    EventHandler::instance()->addSubscriber($failureSubscriber);
    foreach ($finder as $file) {
        include_once $file->getPathname();
    }
    if($failureSubscriber->getFailureCount() !== 0) {
        exit(1);
    }

})($argv);

