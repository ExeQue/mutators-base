<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Array;

use ExeQue\Remix\Data\SortDirection;
use ExeQue\Remix\Mutate\Array\SortKeys;

it('sorts array by keys', function () {
    $mutator = SortKeys::make();

    expect($mutator->mutate(['b' => 'foo', 'a' => 'bar']))->toBe(['a' => 'bar', 'b' => 'foo']);
});

it('sorts array by keys descending', function () {
    $mutator = SortKeys::make(SortDirection::Desc);

    expect($mutator->mutate(['a' => 'bar', 'b' => 'foo']))->toBe(['b' => 'foo', 'a' => 'bar']);
});
