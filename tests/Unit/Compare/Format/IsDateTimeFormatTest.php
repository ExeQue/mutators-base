<?php

declare(strict_types=1);

namespace Tests\Unit\Compare\Format;

use ExeQue\Remix\Compare\Format\IsDateTimeFormat;

it('checks if a string is a datetime format', function (string $format, mixed $value, mixed $expected) {
    $comparator = IsDateTimeFormat::make($format);

    expect($comparator->check($value))->toBe($expected);
})->with([
    'checks if a string is a datetime format' => [
        'format'   => 'Y-m-d H:i:s',
        'value'    => '2020-01-01 00:00:00',
        'expected' => true,
    ],
    'checks if a string is not a datetime format' => [
        'format'   => 'Y-m-d H:i:s',
        'value'    => '2020-01-01',
        'expected' => false,
    ],
    'checks if a string is not a datetime format (invalid format)' => [
        'format'   => 'Y-m-d H:i:s',
        'value'    => 'this is not a datetime string',
        'expected' => false,
    ],
]);
