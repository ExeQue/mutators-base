<?php

declare(strict_types=1);

namespace Tests\Unit\String;

use ExeQue\Mutators\Exceptions\InvalidArgumentException;
use ExeQue\Mutators\String\Explode;

test('explodes a string', function () {
    $mutator = Explode::make(' ');

    expect($mutator->mutate('foo bar baz'))->toBe(['foo', 'bar', 'baz']);
});

test('fail on negative limit', function () {
    Explode::make(' ', -3);
})->throws(InvalidArgumentException::class);
