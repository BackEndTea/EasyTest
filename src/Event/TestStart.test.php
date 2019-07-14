<?php

use function EasyTest\describe;
use function EasyTest\expect;
use function EasyTest\it;
use EasyTest\Event\TestStart;

describe(TestStart::class, function () {
  it('should be able to be instantiated', function () {
    expect(new TestStart())
      ->toEqual(new TestStart())
      ->toBeInstanceOf(TestStart::class);
  });
});
