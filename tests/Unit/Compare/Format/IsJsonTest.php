<?php

declare(strict_types=1);

namespace Tests\Unit\Compare\Format;

use ExeQue\Remix\Compare\Format\IsJson;

it('checks if a string is json', function () {
    $comparator = IsJson::make();

    expect($comparator->check('{"foo": "bar"}'))->toBe(true);
});

it('checks if a string is not json', function () {
    $comparator = IsJson::make();

    expect($comparator->check('Hello World'))->toBe(false);
});

it('removes JSON_THROW_ON_ERROR flag', function () {
    $comparator = IsJson::make(flags: JSON_THROW_ON_ERROR);

    $comparator->check('Hello World');
})->throwsNoExceptions();
