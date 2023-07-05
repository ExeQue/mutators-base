<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Serialization;

use ExeQue\Remix\Mutate\Serialization\Base64Encode;

it('encodes a string to base64', function () {
    $mutator = Base64Encode::make();

    expect($mutator->mutate('foo'))->toBe('Zm9v');
});
