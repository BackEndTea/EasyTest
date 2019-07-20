<?php

declare(strict_types=1);

use EasyTest\Expect\Expectation\ToEqual;
use function EasyTest\describe;
use function EasyTest\expect;
use function EasyTest\it;

describe(ToEqual::class, function (): void {
    it('should match when values are equal', function (): void {
        $equal = new ToEqual(3, '3');

        expect($equal->matches())->toEqual(true)->toBeTheSameAs(true);
    });

    it('should match when values are identical', function (): void {
        $equal = new ToEqual(3, 3);

        expect($equal->matches())->toEqual(true)->toBeTheSameAs(true);
    });

    it('should not match when values are not equal', function (): void {
        $equal = new ToEqual(3, 6);

        expect($equal->matches())->toEqual(false)->toBeTheSameAs(false);
    });

    it('should have the correct error message', function (): void {
        $equal = new ToEqual('foo', 'bar');

        expect($equal->error())->toEqual('Expected a value equal to "bar", instead got "foo"');
    });
});
