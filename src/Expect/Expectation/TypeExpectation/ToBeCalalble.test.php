<?php

declare(strict_types=1);

use EasyTest\Expect\Expectation\TypeExpectation\ToBeCallable;
use function EasyTest\describe;
use function EasyTest\expect;
use function EasyTest\it;

describe(ToBeCallable::class, function (): void {
    it('should succeed if a closure is provided', function (): void {
        $expect = new ToBeCallable(function (): void {
            throw new LogicException();
        });

        expect($expect->matches())->toBeTheSameAs(true);
    });

    it('should succeed if a string function is provided', function (): void {
        $expect = new ToBeCallable('gettype');

        expect($expect->matches())->toBeTheSameAs(true);
    });

    it('should succeed if an array callable type is provided', function (): void {
        $c = new class{
            public function foo(): void
            {
            }
        };

        $expect = new ToBeCallable([$c, 'foo']);

        expect($expect->matches())->toBeTheSameAs(true);
    });

    it('should succeed if a namespaced string function is provided', function (): void {
        $expect = new ToBeCallable('\EasyTest\it');

        expect($expect->matches())->toBeTheSameAs(true);
    });

    it('should not succeed if non function string is provided', function (): void {
        $expect = new ToBeCallable('\EasyTest\asdfasdf');

        expect($expect->matches())->toBeTheSameAs(false);
    });

    it('should not succeed if another type is provided', function (): void {
        $expect = new ToBeCallable(3);

        expect($expect->matches())->toBeTheSameAs(false);
    });

    it('should have the correct error message', function (): void {
        $equal = new ToBeCallable('asdf');

        expect($equal->error())
            ->toBeTheSameAs('Expected a callable, instead got a value of type string.');
    });
});
