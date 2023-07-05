<?php

declare(strict_types=1);

namespace Tests\Unit\Compare\String;

use ExeQue\Remix\Compare\String\Matches;

it('matches pattern', function () {
    $comparator = Matches::make('/foo/');

    expect($comparator->check('foo'))->toBe(true);
});

it('does not match pattern', function () {
    $comparator = Matches::make('/foo/');

    expect($comparator->check('bar'))->toBe(false);
});
