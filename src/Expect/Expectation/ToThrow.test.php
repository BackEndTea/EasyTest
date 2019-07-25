<?php

declare(strict_types=1);

use EasyTest\Expect\Expectation\ToThrow;
use EasyTest\Expect\Throwable;
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

    it('should allow for a Throwable expectation', function (): void {
        $object = new Throwable(LogicException::class, 'the message', 12);

        $throw = new ToThrow(function (): void {
            throw new LogicException('the message', 12);
        }, $object);

        expect($throw->matches())->toBeTheSameAs(true);
    });

    it('should allow for a Throwable expectation, with a previous', function (): void {
        $object = new Throwable(
            LogicException::class,
            'the message',
            12,
            new Throwable(
                null,
                'message',
                10)
        );

        $throw = new ToThrow(function (): void {
            throw new LogicException('the message', 12, new RuntimeException('message', 10));
        }, $object);

        expect($throw->matches())->toBeTheSameAs(true);
    });

    it('should allow to only specify a code', function (): void {
        $object = new Throwable(
            null,
            null,
            8
        );

        $throw = new ToThrow(function (): void {
            throw new LogicException('the message', 8, new RuntimeException('message', 10));
        }, $object);

        expect($throw->matches())->toBeTheSameAs(true);
    });

    it('should allow to only specify a code', function (): void {
        $object = new Throwable(
            null,
            null,
            16
        );

        $throw = new ToThrow(function (): void {
            throw new LogicException('the message', 8, new RuntimeException('message', 10));
        }, $object);

        expect($throw->matches())->toBeTheSameAs(false);
    });

    it('should be able to fail on a previous', function (): void {
        $object = new Throwable(
            null,
            null,
            null,
            new Throwable(null, 'wrong message')
        );

        $throw = new ToThrow(function (): void {
            throw new LogicException('the message', 8, new RuntimeException('message', 10));
        }, $object);

        expect($throw->matches())->toBeTheSameAs(false);
    });
});
