<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Convert;

use ArrayAccess;
use ExeQue\Remix\Concerns\Definitions\UsesEncoding;
use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\Convert\ToClass;
use Tests\Fixtures\DataFixture;
use Tests\Fixtures\SpreadableDataFixture;

it('converts to class', function () {
    $data = [
        'name'    => 'John Doe',
        'age'     => 30,
        'address' => '123 Main St.',
    ];

    $mutator = ToClass::make(DataFixture::class);

    $value = $mutator->mutate($data);

    expect($value)->toBeInstanceOf(DataFixture::class)->and($value)->toEqual(new DataFixture($data));
});

it('converts to class using spread', function () {
    $data = [
        'name'    => 'John Doe',
        'age'     => 30,
        'address' => '123 Main St.',
    ];

    $mutator = ToClass::make(SpreadableDataFixture::class, true);

    $value = $mutator->mutate($data);

    expect($value)->toBeInstanceOf(SpreadableDataFixture::class)->and($value)->toEqual(new SpreadableDataFixture(...$data));
});

it('returns same object if input is the same type as the requested', function () {
    $data = new DataFixture([
        'name'    => 'John Doe',
        'age'     => 30,
        'address' => '123 Main St.',
    ]);

    $mutator = ToClass::make(DataFixture::class);

    $value = $mutator->mutate($data);

    expect($value)->toBeInstanceOf(DataFixture::class)->and($value)->toEqual($data);
});

it('throws error if class does not exist', function (string $class) {
    ToClass::make($class);
})->throws(InvalidArgumentException::class)->with([
    'bogus class' => 'BogusClass',
    'interface'   => ArrayAccess::class,
    'trait'       => UsesEncoding::class,
]);
