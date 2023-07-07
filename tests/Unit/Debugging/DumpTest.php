<?php

declare(strict_types=1);


namespace Tests\Unit\Debugging;

use ExeQue\Remix\Debugging\Dump;
use Symfony\Component\VarDumper\VarDumper;

it('passes value to dump', function () {
    $mutator = Dump::make();

    $mutator->mutate('foo');

    expect($this->dumps)->toBe(['foo']);
});

it('passes constructor arguments to dump after the value', function () {
    $mutator = Dump::make('bar', 'baz');

    $mutator->mutate('foo');

    expect($this->dumps)->toBe(['foo', 'bar', 'baz']);
});

beforeEach(function () {
    $this->dumps = [];

    $this->previousHandler = VarDumper::setHandler(function ($var) {
        $this->dumps[] = $var;
    });
});

afterEach(function() {
    VarDumper::setHandler($this->previousHandler);
});
