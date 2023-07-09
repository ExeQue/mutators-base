<?php

declare(strict_types=1);

namespace Tests\Unit\Compare;

use ExeQue\Remix\Compare\Same;
use stdClass;

it('checks if values are identical', function (mixed $one, mixed $two, bool $expected) {
    $comparator = Same::make($one);

    expect($comparator->check($two))->toBe($expected);
})->with(function() {
    $object1 = new stdClass();
    $object2 = new stdClass();

    return [
        'strings' => [
            'one' => 'foo',
            'two' => 'foo',
            'expected' => true,
        ],
        'integers' => [
            'one' => 1,
            'two' => 1,
            'expected' => true,
        ],
        'floats' => [
            'one' => 1.0,
            'two' => 1.0,
            'expected' => true,
        ],
        'integer and float' => [
            'one' => 1,
            'two' => 1.0,
            'expected' => false,
        ],
        'string and integer' => [
            'one' => '1',
            'two' => 1,
            'expected' => false,
        ],
        'string and float' => [
            'one' => '1.0',
            'two' => 1.0,
            'expected' => false,
        ],
        'string and boolean' => [
            'one' => 'true',
            'two' => true,
            'expected' => false,
        ],
        'booleans' => [
            'one' => true,
            'two' => true,
            'expected' => true,
        ],
        'arrays' => [
            'one' => [],
            'two' => [],
            'expected' => true,
        ],
        'arrays with same values' => [
            'one' => ['foo', 'bar'],
            'two' => ['foo', 'bar'],
            'expected' => true,
        ],
        'objects of same class but not instance' => [
            'one' => $object1,
            'two' => $object2,
            'expected' => false,
        ],
        'objects of same class and instance' => [
            'one' => $object1,
            'two' => $object1,
            'expected' => true,
        ],
        'null' => [
            'one' => null,
            'two' => null,
            'expected' => true,
        ],
    ];
});
