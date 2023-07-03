<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\String;

use ExeQue\Remix\Mutate\String\Prepend;

test('appends a string to the end of a string', function () {
    $mutator = Prepend::make('foo');

    expect($mutator->mutate('bar'))->toBe('foobar');
});
