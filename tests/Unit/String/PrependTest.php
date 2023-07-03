<?php

declare(strict_types=1);

namespace Tests\Unit\String;

use ExeQue\Mutators\String\Prepend;

test('appends a string to the end of a string', function () {
    $mutator = Prepend::make('foo');

    expect($mutator->mutate('bar'))->toBe('foobar');
});
