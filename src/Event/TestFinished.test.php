<?php

declare(strict_types=1);

use EasyTest\Event\TestFinished;
use EasyTest\Event\TestStart;
use function EasyTest\describe;
use function EasyTest\expect;
use function EasyTest\it;

describe(TestStart::class, function (): void {
    it('should be able to be instantiated', function (): void {
        expect(new TestFinished())
        ->toEqual(new TestFinished())
        ->toBeInstanceOf(TestFinished::class);
    });
});
