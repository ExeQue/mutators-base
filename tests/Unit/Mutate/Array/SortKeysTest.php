<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Array;

use ExeQue\Remix\Data\SortDirection;
use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\Array\SortKeys;

it('sorts an array by keys', function (mixed $direction, int $flags, mixed $input, mixed $expected) {
    $mutator = SortKeys::make($direction, $flags);

    expect($mutator->mutate($input))->toBe($expected);
})->with([
    'ascending regular' => [
        'direction' => SortDirection::Asc,
        'flags'     => SORT_REGULAR,
        'input'     => ['2' => 'baz', '10' => 'foo', '1' => 'bar'],
        'expected'  => ['1' => 'bar', '2' => 'baz', '10' => 'foo'],
    ],
    'descending regular' => [
        'direction' => SortDirection::Desc,
        'flags'     => SORT_REGULAR,
        'input'     => ['2' => 'baz', '10' => 'foo', '1' => 'bar'],
        'expected'  => ['10' => 'foo', '2' => 'baz', '1' => 'bar'],
    ],
    'ascending numeric' => [
        'direction' => SortDirection::Asc,
        'flags'     => SORT_NUMERIC,
        'input'     => ['2' => 'baz', '10' => 'foo', '1' => 'bar'],
        'expected'  => ['1' => 'bar', '2' => 'baz', '10' => 'foo'],
    ],
    'descending numeric' => [
        'direction' => SortDirection::Desc,
        'flags'     => SORT_NUMERIC,
        'input'     => ['2' => 'baz', '10' => 'foo', '1' => 'bar'],
        'expected'  => ['10' => 'foo', '2' => 'baz', '1' => 'bar'],
    ],
    'ascending string' => [
        'direction' => SortDirection::Asc,
        'flags'     => SORT_STRING,
        'input'     => ['2' => 'baz', '10' => 'foo', '1' => 'bar'],
        'expected'  => ['1' => 'bar', '10' => 'foo', '2' => 'baz'],
    ],
    'descending string' => [
        'direction' => SortDirection::Desc,
        'flags'     => SORT_STRING,
        'input'     => ['2' => 'baz', '10' => 'foo', '1' => 'bar'],
        'expected'  => ['2' => 'baz', '10' => 'foo', '1' => 'bar'],
    ],
    'ascending natural' => [
        'direction' => SortDirection::Asc,
        'flags'     => SORT_NATURAL,
        'input'     => ['2' => 'baz', '10' => 'foo', '1' => 'bar'],
        'expected'  => ['1' => 'bar', '2' => 'baz', '10' => 'foo'],
    ],
    'descending natural' => [
        'direction' => SortDirection::Desc,
        'flags'     => SORT_NATURAL,
        'input'     => ['2' => 'baz', '10' => 'foo', '1' => 'bar'],
        'expected'  => ['10' => 'foo', '2' => 'baz', '1' => 'bar'],
    ],
]);

it('aliases are identical to the original', function () {
    expect(SortKeys::asc())->toEqual(SortKeys::make(SortDirection::Asc))
        ->and(SortKeys::desc())->toEqual(SortKeys::make(SortDirection::Desc))
        ->and(SortKeys::asc(SORT_NATURAL))->toEqual(SortKeys::make(SortDirection::Asc, SORT_NATURAL))
        ->and(SortKeys::desc(SORT_NATURAL))->toEqual(SortKeys::make(SortDirection::Desc, SORT_NATURAL));
});

it('throws an exception if given a non-iterable input', function () {
    $mutator = SortKeys::make();

    $mutator->mutate('foo');
})->throws(InvalidArgumentException::class);
