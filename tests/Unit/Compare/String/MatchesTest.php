<?php

declare(strict_types=1);

namespace Tests\Unit\Compare\String;

use ExeQue\Remix\Compare\String\Matches;

it('checks if the value matches the pattern', function (string $pattern, string $input, bool $expected) {
    $comparator = Matches::make($pattern);

    expect($comparator->check($input))->toBe($expected);
})->with([
    'matches' => [
        'pattern'  => '/foo/',
        'input'    => 'foo',
        'expected' => true,
    ],
    'does not match' => [
        'pattern'  => '/foo/',
        'input'    => 'bar',
        'expected' => false,
    ],
]);
