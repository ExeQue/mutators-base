<?php

declare(strict_types=1);

namespace Tests\Unit\Concerns;

use ExeQue\Mutators\Concerns\ResolvesStringInputs;
use ExeQue\Mutators\Exceptions\InvalidArgumentException;
use Mockery;
use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\StreamInterface;
use Stringable;

test('resolves string input', function (mixed $input, string $expected) {
    $implementation = new class
    {
        use ResolvesStringInputs {
            resolveStringInput as public;
        }
    };

    expect($implementation->resolveStringInput($input))->toBe($expected);
})->covers(ResolvesStringInputs::class)->with(function () {
    return [
        'string' => [
            'input'  => 'foo',
            'output' => 'foo',
        ],
        'integer' => [
            'input'  => 1,
            'output' => '1',
        ],
        'float' => [
            'input'  => 1.1,
            'output' => '1.1',
        ],
        'true' => [
            'input'  => true,
            'output' => '1',
        ],
        'false' => [
            'input'  => false,
            'output' => '',
        ],
        'null' => [
            'input'  => null,
            'output' => '',
        ],
    ];
});

test('resolves from PSR-7 StreamInterface', function () {
    $implementation = new class
    {
        use ResolvesStringInputs {
            resolveStringInput as public;
        }
    };

    $stream = Mockery::mock(StreamInterface::class)->expects('getContents')->andReturn('foo')->getMock();

    expect($implementation->resolveStringInput($stream))->toBe('foo');
});

test('resolves from PSR-7 MessageInterface', function () {
    $implementation = new class
    {
        use ResolvesStringInputs {
            resolveStringInput as public;
        }
    };

    $stream  = Mockery::mock(StreamInterface::class)->expects('getContents')->andReturn('foo')->getMock();
    $message = Mockery::mock(MessageInterface::class)->expects('getBody')->andReturn($stream)->getMock();

    expect($implementation->resolveStringInput($message))->toBe('foo');
});

test('resolves from Stringable object', function () {
    $implementation = new class
    {
        use ResolvesStringInputs {
            resolveStringInput as public;
        }
    };

    $stringable = new class implements Stringable
    {
        public function __toString(): string
        {
            return 'foo';
        }
    };

    expect($implementation->resolveStringInput($stringable))->toBe('foo');
});

test('fails if input is not supported', function () {
    $implementation = new class
    {
        use ResolvesStringInputs {
            resolveStringInput as public;
        }
    };

    $object = new class
    {
    };

    $implementation->resolveStringInput($object);
})->throws(InvalidArgumentException::class);
