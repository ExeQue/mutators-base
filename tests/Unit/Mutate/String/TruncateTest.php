<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\String;

use ExeQue\Remix\Mutate\String\Truncate;

it('does not truncate string when length is greater than string length', function () {
    $mutator = Truncate::make(10);

    expect($mutator->mutate('foo'))->toBe('foo');
});

it('truncates string when length is less than string length', function () {
    $mutator = Truncate::make(2);

    expect($mutator->mutate('foo'))->toBe('fo...');
});

it('does not truncate string when length is equal to string length', function () {
    $mutator = Truncate::make(3);

    expect($mutator->mutate('foo'))->toBe('foo');
});

it('changes ellipsis when prompted', function () {
    $mutator = Truncate::make(2, '---');

    expect($mutator->mutate('foo'))->toBe('fo---');
});
