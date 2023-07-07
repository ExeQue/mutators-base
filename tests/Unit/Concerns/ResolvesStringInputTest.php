<?php

declare(strict_types=1);

namespace Tests\Unit\Concerns;

use ExeQue\Remix\Concerns\ResolvesStringInput;
use ExeQue\Remix\Exceptions\InvalidArgumentException;
use Mockery;
use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\StreamInterface;
use Stringable;

it('resolves string inputs from values', function (mixed $input) {
    $implementation = new class
    {
        use ResolvesStringInput {
            resolveStringInput as public;
        }
    };

    $implementation->resolveStringInput($input);
})->throwsNoExceptions()->with(function () {
    $streamInterface  = Mockery::mock(StreamInterface::class)->allows('getContents')->andReturn('foo')->getMock();
    $messageInterface = Mockery::mock(MessageInterface::class)->allows('getBody')->andReturn($streamInterface)->getMock();
    $stringable       = Mockery::mock(Stringable::class)->allows('__toString')->andReturn('foo')->getMock();
    $toStringObject   = new class
    {
        public function toString(): string
        {
            return 'foo';
        }
    };

    return [
        'string'                      => 'foo',
        'int'                         => 1,
        'float'                       => 1.1,
        'null'                        => null,
        'resource'                    => fopen('php://memory', 'rb'),
        StreamInterface::class        => $streamInterface,
        MessageInterface::class       => $messageInterface,
        Stringable::class             => $stringable,
        'object with toString method' => $toStringObject,
    ];
});

it('fails to resolve string inputs from values', function (mixed $input) {
    $implementation = new class
    {
        use ResolvesStringInput {
            resolveStringInput as public;
        }
    };

    $implementation->resolveStringInput($input);
})->throws(InvalidArgumentException::class)->with(function () {
    $resource = fopen('php://memory', 'rb');
    fclose($resource);

    return [
        'array'  => fn () => [],
        'object' => new class
        {
        },
        'callable' => fn () => function () {
        },
        'closed resource' => $resource,
    ];
});
