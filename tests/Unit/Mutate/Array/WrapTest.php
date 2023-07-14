<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Array;

use ExeQue\Remix\Mutate\Array\Wrap;

it('wraps value if not already an array', function (mixed $input, mixed $expected) {
    $mutator = Wrap::make();

    expect($mutator->mutate($input))->toBe($expected);
})->with([
    'string' => [
        'input'    => 'foo',
        'expected' => ['foo'],
    ],
    'array' => [
        'input'    => ['foo'],
        'expected' => ['foo'],
    ],
]);
