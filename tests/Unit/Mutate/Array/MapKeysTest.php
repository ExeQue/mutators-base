<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Array;

use ExeQue\Remix\Mutate\Array\MapKeys;

test('applies callback to each key in array', function () {
    $mutator = MapKeys::make(fn ($key) => $key . 'bar');

    expect($mutator->mutate(['foo' => 1, 'bar' => 2, 'baz' => 3]))->toBe(['foobar' => 1, 'barbar' => 2, 'bazbar' => 3]);
});
