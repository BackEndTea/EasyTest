<?php

declare(strict_types=1);

use EasyTest\Expect\Expect;
use function EasyTest\afterEach;
use function EasyTest\beforeEach;
use function EasyTest\describe;
use function EasyTest\expect;
use function EasyTest\it;

describe(Expect::class, function (): void {
    beforeEach(function (): void {
        // set up;
    });

    afterEach(function (): void {
        // clean up
    });

    $f = 10;

    it('should find equals', function () use ($f): void {
        expect($f)->toEqual(10);
    });
    $f = 12;
    it('should update f', function () use ($f): void {
        expect($f)->toEqual(12);
    });
});
