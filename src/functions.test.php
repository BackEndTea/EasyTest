<?php

declare(strict_types=1);

use function EasyTest\afterEach;
use function EasyTest\beforeEach;
use function EasyTest\describe;
use function EasyTest\expect;
use function EasyTest\it;

describe('beforeEach()', function (): void {
    $c = new class {
        /** @var int  */
        public $prop = 0;
    };

    beforeEach(function () use ($c): void {
        ++$c->prop;
    });

    it('should be called before every test', function () use ($c): void {
        expect($c->prop)->toBeTheSameAs(1);
    });

    it('should be called before every test', function () use ($c): void {
        expect($c->prop)->toBeTheSameAs(2);
    });

    it('should be called before every test', function () use ($c): void {
        expect($c->prop)->toBeTheSameAs(3);
    });
});

describe('afterTeact()', function (): void {
    $c = new class {
        /** @var int  */
        public $prop = 0;
    };
    afterEach(function () use ($c): void {
        ++$c->prop;
    });

    it('should be called after every test', function () use ($c): void {
        expect($c->prop)->toBeTheSameAs(0);
    });

    it('should be called after every test', function () use ($c): void {
        expect($c->prop)->toBeTheSameAs(1);
    });

    it('should be called after every test', function () use ($c): void {
        expect($c->prop)->toBeTheSameAs(2);
    });
});
