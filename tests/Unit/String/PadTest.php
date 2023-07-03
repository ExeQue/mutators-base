<?php

declare(strict_types=1);

namespace Tests\Unit\String;

use ExeQue\Mutators\String\Pad;

test('pads string with additional characters', function (string $input, int $length, string $pad, string $expected) {
    $mutator = Pad::make($length, $pad);

    expect($mutator->mutate($input))->toBe($expected);
})->with([
    'non-multibyte string' => [
        'input'    => 'foo',
        'length'   => 6,
        'pad'      => 'bar',
        'expected' => 'foobar',
    ],
    'multibyte string' => [
        'input'    => 'æøå',
        'length'   => 6,
        'pad'      => 'bar',
        'expected' => 'æøåbar',
    ],
]);

test('alias matches direction', function (string $method, string $input, string $expected) {
    $mutator = Pad::$method(6, ' ');

    expect($mutator->mutate($input))->toBe($expected);
})->with([
    'Pad::both()' => [
        'method' => 'both',
        'input'  => 'foo',
        'output' => ' foo  ',
    ],
    'Pad::left()' => [
        'method' => 'left',
        'input'  => 'foo',
        'output' => '   foo',
    ],
    'Pad::right()' => [
        'method' => 'right',
        'input'  => 'foo',
        'output' => 'foo   ',
    ],
]);
