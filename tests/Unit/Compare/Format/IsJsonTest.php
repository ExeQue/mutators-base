<?php

declare(strict_types=1);

namespace Tests\Unit\Compare\Format;

use ExeQue\Remix\Compare\Format\IsJson;
use ExeQue\Remix\Exceptions\InvalidArgumentException;
use stdClass;

it('checks if a string is json', function (mixed $input, mixed $expected) {
    $comparator = IsJson::make();

    expect($comparator->check($input))->toBe($expected);
})->with([
    'checks if a string is json' => [
        'input'    => '{"hello":"world"}',
        'expected' => true,
    ],
    'checks if a string is not json' => [
        'input'    => 'Hello World',
        'expected' => false,
    ],
]);

it('ignores JSON_THROW_ON_ERROR flag', function () {
    $comparator = IsJson::make(flags: JSON_THROW_ON_ERROR);

    $comparator->check('Hello World');
})->throwsNoExceptions();

it('throws an exception if input is not a string', function (mixed $input) {
    IsJson::make()->check($input);
})->throws(InvalidArgumentException::class)->with([
    'array' => [
        'input' => [],
    ],
    'object' => [
        'input' => new stdClass(),
    ],
    'boolean' => [
        'input' => true,
    ],
]);
