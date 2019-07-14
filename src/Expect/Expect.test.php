<?php

use function EasyTest\afterEach;
use function EasyTest\beforeEach;
use function EasyTest\describe;
use function EasyTest\expect;
use function EasyTest\it;
use EasyTest\Expect\Expect;

describe(Expect::class, function () {

  beforeEach(function () {
      // set up;
  });

  afterEach(function () {
      // clean up
  });

  $f = 10;


  it('should find equals', function () use ($f) {
    expect($f)->toEqual(10);
  });
  $f = 12;
  it('should update f', function () use ($f) {
      expect($f)->toEqual(12);
  });
});
