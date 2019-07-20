# Easy Test
[![Build Status](https://travis-ci.org/BackEndTea/EasyTest.svg?branch=master)](https://travis-ci.org/BackEndTea/EasyTest)

Easy test is a small php test framework.

## Usage

```php
<?php

use function EasyTest\afterEach;
use function EasyTest\beforeEach;
use function EasyTest\describe;
use function EasyTest\expect;
use function EasyTest\it;

describe('MyClass', function () {

  beforeEach(function () {
      // set up;
  });

  afterEach(function () {
      // clean up
  });

  it('should equal something', function () {
    expect(10)->toEqual(10);
  });
  it('should fail if it is not equal', function () {
    expect(12)->toEqual(12);
  });
});

```
## Why

I wanted to make this, mostly to see if it would be hard to write
a test framework like this in PHP.
