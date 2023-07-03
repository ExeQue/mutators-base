<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\String;

use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\String\Explode;

test('explodes a string', function () {
    $mutator = Explode::make(' ');

    expect($mutator->mutate('foo bar baz'))->toBe(['foo', 'bar', 'baz']);
});

test('fail on negative limit', function () {
    Explode::make(' ', -3);
})->throws(InvalidArgumentException::class);
