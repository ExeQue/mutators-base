<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Convert;

use ExeQue\Remix\Mutate\Convert\BinToHex;

it('converts string to hex', function () {
    $input   = 'Hello there, General Kenobi. Hello there, Mr. Anderson';
    $mutator = BinToHex::make();

    expect($mutator->mutate($input))->toBe(bin2hex($input));
});
