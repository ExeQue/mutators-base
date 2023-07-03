<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Array;

use ArrayIterator;
use ExeQue\Remix\Mutate\Array\ArrayMutator;

test('works with iterable instance', function () {
    $instance = new class extends ArrayMutator
    {
        protected function mutateArray(array $array): array
        {
            return $array;
        }
    };

    $input    = ['foo', 'bar'];
    $iterator = new ArrayIterator($input);

    expect($instance->mutate($input))->toBe($input)
        ->and($instance->mutate($iterator))->toBe($input);
});

test('preserves keys when used with iterator', function () {
    $instance = new class extends ArrayMutator
    {
        protected function mutateArray(array $array): array
        {
            return $array;
        }
    };

    $input    = ['foo' => 'bar', 'baz' => 'qux'];
    $iterator = new ArrayIterator($input);

    expect($instance->mutate($input))->toBe($input)
        ->and($instance->mutate($iterator))->toBe($input);
});
