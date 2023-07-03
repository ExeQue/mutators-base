<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\String;

use ExeQue\Remix\Data\StringCase;
use ExeQue\Remix\Mutate\String\Casing;

test('covers casing', function (StringCase $casing) {
    $mutator = Casing::make($casing);

    $mutator->mutate('foo');
})->with(StringCase::cases())->throwsNoExceptions();
