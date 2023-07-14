<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Number;

use ExeQue\Remix\Mutate\Number\Abs;

it('returns the absolute value of a number', function (mixed $input, mixed $expected) {
    $mutator = Abs::make();

    expect($mutator->mutate($input))->toBe($expected);
})->with(function () {
    return [
        'int' => [
            'input'    => -1,
            'expected' => 1,
        ],
        'float' => [
            'input'    => -1.1,
            'expected' => 1.1,
        ],
    ];
});
