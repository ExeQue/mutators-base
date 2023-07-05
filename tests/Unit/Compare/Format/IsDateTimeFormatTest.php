<?php

declare(strict_types=1);

namespace Tests\Unit\Compare\Format;

use ExeQue\Remix\Compare\Format\IsDateTimeFormat;

it('checks if a string is a date time format', function () {
    $comparator = IsDateTimeFormat::make('Y-m-d H:i:s');

    expect($comparator->check('2020-01-01 00:00:00'))->toBe(true);
});

it('checks if a string is not a date time format', function () {
    $comparator = IsDateTimeFormat::make('Y-m-d H:i:s');

    expect($comparator->check('2020-01-01'))->toBe(false);
});

it('does not throw exceptions when given an invalid input', function () {
    $comparator = IsDateTimeFormat::make('Y-m-d H:i:s');

    $comparator->check('this is not a datetime string');
})->throwsNoExceptions();
