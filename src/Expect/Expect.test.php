<?php

declare(strict_types=1);

use EasyTest\Expect\Expect;
use function EasyTest\describe;
use function EasyTest\expect;
use function EasyTest\it;

describe(Expect::class, function (): void {
    it('should throw on a failed assertion', function (): void {
        expect(function (): void {
            expect(false)->toBeTheSameAs(true);
        })->toThrow(LogicException::class, 'ay we have an error here bud');
    });
});
