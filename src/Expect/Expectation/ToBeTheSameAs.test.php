<?php

declare(strict_types=1);

use EasyTest\Expect\Expectation\ToBeTheSameAs;
use function EasyTest\describe;
use function EasyTest\expect;
use function EasyTest\it;

describe(ToBeTheSameAs::class, function (): void {
    it('should match when values are identical', function (): void {
        $equal = new ToBeTheSameAs(3, 3);

        expect($equal->matches())->toBeTheSameAs(true);
    });

    it('should not match when values are not equal', function (): void {
        $equal = new ToBeTheSameAs(3, 6);

        expect($equal->matches())->toBeTheSameAs(false);
    });

    it('should not match when values are equal but not identical', function (): void {
        $equal = new ToBeTheSameAs(3, '3');

        expect($equal->matches())->toBeTheSameAs(false);
    });

    it('should have the correct error message', function (): void {
        $equal = new ToBeTheSameAs('foo', 'bar');

        expect($equal->error())->toEqual('Expected a value identical to "bar", instead got "foo"');
    });
});
