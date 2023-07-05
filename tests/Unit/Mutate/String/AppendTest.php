<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\String;

use ExeQue\Remix\Mutate\String\Append;

it('appends a string to the end of a string', function () {
    $mutator = Append::make('bar');

    expect($mutator->mutate('foo'))->toBe('foobar');
});
