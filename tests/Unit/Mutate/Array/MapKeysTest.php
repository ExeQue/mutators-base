<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Array;

use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\Array\MapKeys;

it('applies callback to each key in array', function () {
    $mutator = MapKeys::make(static fn ($key) => $key . 'bar');

    expect($mutator->mutate(['foo' => 1, 'bar' => 2, 'baz' => 3]))->toBe(['foobar' => 1, 'barbar' => 2, 'bazbar' => 3]);
});

it('throws an exception if given a non-iterable input', function () {
    $mutator = MapKeys::make(static fn () => true);

    $mutator->mutate('foo');
})->throws(InvalidArgumentException::class);
