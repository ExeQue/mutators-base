<?php

declare(strict_types=1);

namespace Tests\Unit\Debugging;

use ExeQue\Remix\Debugging\Log;
use JsonSerializable;
use Psr\Log\AbstractLogger;
use Psr\Log\NullLogger;
use Tests\Fixtures\DataFixture;

it('logs a value', function (mixed $input, array $expected) {
    $mutator = Log::make($this->logger);

    $mutator->mutate($input);

    expect($this->logger->logs)->toBe($expected);
})->with(function () {
    return [
        'string' => [
            'input'    => 'foo',
            'expected' => [
                [
                    'level'   => 'debug',
                    'message' => 'foo',
                    'context' => [],
                ],
            ],
        ],
        'int' => [
            'input'    => 1,
            'expected' => [
                [
                    'level'   => 'debug',
                    'message' => '1',
                    'context' => [],
                ],
            ],
        ],
        'float' => [
            'input'    => 1.1,
            'expected' => [
                [
                    'level'   => 'debug',
                    'message' => '1.1',
                    'context' => [],
                ],
            ],
        ],
        'bool' => [
            'input'    => true,
            'expected' => [
                [
                    'level'   => 'debug',
                    'message' => 'true',
                    'context' => [],
                ],
            ],
        ],
        'null' => [
            'input'    => null,
            'expected' => [
                [
                    'level'   => 'debug',
                    'message' => 'null',
                    'context' => [],
                ],
            ],
        ],
        'array' => [
            'input'    => ['foo' => 'bar'],
            'expected' => [
                [
                    'level'   => 'debug',
                    'message' => '{"foo":"bar"}',
                    'context' => [],
                ],
            ],
        ],
        'object' => [
            'input'    => new DataFixture(['foo' => 'bar']),
            'expected' => [
                [
                    'level'   => 'debug',
                    'message' => 'Tests\Fixtures\DataFixture: O:26:"Tests\Fixtures\DataFixture":1:{s:4:"data";a:1:{s:3:"foo";s:3:"bar";}}',
                    'context' => [],
                ],
            ],
        ],
        'object with __toString' => [
            'input' => new class
            {
                public function __toString(): string
                {
                    return 'foo';
                }
            },
            'expected' => [
                [
                    'level'   => 'debug',
                    'message' => 'foo',
                    'context' => [],
                ],
            ],
        ],
        'object with JsonSerializable' => [
            'input' => new class implements JsonSerializable
            {
                public function jsonSerialize(): array
                {
                    return ['foo' => 'bar'];
                }
            },
            'expected' => [
                [
                    'level'   => 'debug',
                    'message' => 'Anonymous class: {"foo":"bar"}',
                    'context' => [],
                ],
            ],
        ],
    ];
});

it('adds prefix to log', function () {
    $mutator = Log::make($this->logger, prefix: 'prefix');

    $mutator->mutate('foo');

    expect($this->logger->logs)->toBe([
        [
            'level'   => 'debug',
            'message' => 'prefix: foo',
            'context' => [],
        ],
    ]);
});

it('adds context to log', function () {
    $mutator = Log::make($this->logger, context: ['foo' => 'bar']);

    $mutator->mutate('foo');

    expect($this->logger->logs)->toBe([
        [
            'level'   => 'debug',
            'message' => 'foo',
            'context' => ['foo' => 'bar'],
        ],
    ]);
});

it('returns the old default logger when setting a new one', function () {
    $oldLogger = new NullLogger();

    Log::setDefaultLogger($oldLogger);

    $newLogger = $this->logger;

    expect(Log::setDefaultLogger($newLogger))->toBe($oldLogger);
});

it('uses default logger if non is set', function () {
    Log::setDefaultLogger($this->logger);

    $mutator = Log::make();

    $mutator->mutate('foo');

    expect($this->logger->logs)->toBe([
        [
            'level'   => 'debug',
            'message' => 'foo',
            'context' => [],
        ],
    ]);
});

it('fails if no default logger is set and none is provided', function () {
    Log::setDefaultLogger(null);

    Log::make();
})->throws(\InvalidArgumentException::class);

beforeEach(function () {
    $this->logger = new class extends AbstractLogger
    {
        public array $logs = [];

        public function log($level, \Stringable|string $message, array $context = []): void
        {
            $this->logs[] = [
                'level'   => $level,
                'message' => $message,
                'context' => $context,
            ];
        }
    };
});

afterEach(function () {
    Log::setDefaultLogger(null);
});
