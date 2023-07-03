<?php

declare(strict_types=1);

namespace Tests\Unit\String;

use ExeQue\Mutators\String\Reverse;

test('reverses input', function (string $input, string $expected) {
    $mutator = Reverse::make();

    expect($mutator->mutate($input))->toBe($expected);
})->with([
    'non-multi-byte' => [
        'input'    => 'foo',
        'expected' => 'oof',
    ],
    'multi-byte' => [
        'input'    => 'æg',
        'expected' => 'gæ',
    ],
]);
