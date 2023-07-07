<?php

declare(strict_types=1);

namespace Tests\Unit\Compare;

use ArrayIterator;
use ExeQue\Remix\Compare\IsType;
use ExeQue\Remix\Concerns\Makes;
use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\Array\Reverse;
use Iterator;
use stdClass;

it('supports all types', function (string $type, mixed $value) {
    expect(IsType::make($type)->check($value))->toBeTrue();
})->with([
    'string'   => ['string', 'foo'],
    'int'      => ['int', 1],
    'float'    => ['float', 1.1],
    'bool'     => ['bool', true],
    'scalar'   => ['scalar', 'foo'],
    'numeric'  => ['numeric', '1.23'],
    'array'    => ['array', []],
    'object'   => ['object', new stdClass()],
    'null'     => ['null', null],
    'callable' => ['callable', function () {
    }],
    'iterable'  => ['iterable', new ArrayIterator()],
    'resource'  => ['resource', fopen('php://memory', 'rb')],
    'class'     => [stdClass::class, new stdClass()],
    'interface' => [Iterator::class, new ArrayIterator()],
    'trait'     => [Makes::class, Reverse::make()],
]);

it('fails if given unsupported type', function () {
    IsType::make('foobar');
})->throws(InvalidArgumentException::class);

it('has aliases for all types', function () {
    expect(IsType::int()->check(1))->toBeTrue()
        ->and(IsType::float()->check(1.1))->toBeTrue()
        ->and(IsType::bool()->check(true))->toBeTrue()
        ->and(IsType::string()->check('foo'))->toBeTrue()
        ->and(IsType::scalar()->check('foo'))->toBeTrue()
        ->and(IsType::numeric()->check('1.23'))->toBeTrue()
        ->and(IsType::array()->check([]))->toBeTrue()
        ->and(IsType::object()->check(new stdClass()))->toBeTrue()
        ->and(IsType::null()->check(null))->toBeTrue()
        ->and(IsType::callable()->check(fn () => ''))->toBeTrue()
        ->and(IsType::iterable()->check(new ArrayIterator()))->toBeTrue()
        ->and(IsType::resource()->check(fopen('php://memory', 'rb')))->toBeTrue()
        ->and(IsType::class(stdClass::class)->check(new stdClass()))->toBeTrue()
        ->and(IsType::interface(Iterator::class)->check(new ArrayIterator()))->toBeTrue()
        ->and(IsType::trait(Makes::class)->check(Reverse::make()))->toBeTrue();
});
