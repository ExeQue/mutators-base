<?php

declare(strict_types=1);

namespace Tests\Unit\String;

use ExeQue\Mutators\String\Append;

test('appends a string to the end of a string', function () {
    $mutator = Append::make('bar');

    expect($mutator->mutate('foo'))->toBe('foobar');
});
