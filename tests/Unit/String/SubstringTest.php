<?php

declare(strict_types=1);

namespace Tests\Unit\String;

use ExeQue\Mutators\Exceptions\InvalidArgumentException;
use ExeQue\Mutators\String\Substring;

test('fails if encoding is invalid', function () {
    Substring::make(0, 0, 'foo');
})->throws(InvalidArgumentException::class, 'Invalid encoding provided. Got: "foo"');

test('gets substring', function () {
    $mutator = Substring::make(0, 3);

    expect($mutator->mutate('foobar'))->toBe('foo');
});
