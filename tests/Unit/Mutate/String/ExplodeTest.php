<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\String;

use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\String\Explode;

it('explodes a string', function () {
    $mutator = Explode::make(' ');

    expect($mutator->mutate('foo bar baz'))->toBe(['foo', 'bar', 'baz']);
});

it('fail on negative limit', function () {
    Explode::make(' ', -3);
})->throws(InvalidArgumentException::class);
