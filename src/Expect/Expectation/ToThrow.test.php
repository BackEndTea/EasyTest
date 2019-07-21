<?php

declare(strict_types=1);

use EasyTest\Expect\Expectation\ToThrow;
use function EasyTest\describe;
use function EasyTest\expect;
use function EasyTest\it;

describe(ToThrow::class, function (): void {
    it('should succeed if function throws specified exception', function (): void {
        $equal = new ToThrow(function (): void {
            throw new LogicException();
        }, LogicException::class);

        expect($equal->matches())->toBeTheSameAs(true);
    });

    it('should succeed if function throws specified exception', function (): void {
        $equal = new ToThrow(function (): void {
            throw new LogicException();
        }, new LogicException());

        expect($equal->matches())->toBeTheSameAs(true);
    });

    it('should not succeed if function throws another exception', function (): void {
        $equal = new ToThrow(function (): void {
            throw new LogicException();
        }, RuntimeException::class);

        expect($equal->matches())->toBeTheSameAs(false);
    });

    it('should not succeed if function does not throw an error', function (): void {
        $equal = new ToThrow(function (): void {
            $a = 3;
        }, RuntimeException::class);

        expect($equal->matches())->toBeTheSameAs(false);
    });

    it('should have the correct error message', function (): void {
        $equal = new ToThrow(function (): void {
            $a = 3;
        }, RuntimeException::class);

        expect($equal->error())
            ->toBeTheSameAs(
                'Expected an exception of type "RuntimeException" to be thrown, but it was not.'
            );
    });
});
