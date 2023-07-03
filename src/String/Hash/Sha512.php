<?php

declare(strict_types=1);

namespace ExeQue\Mutators\String\Hash;

use ExeQue\Mutators\Alias;
use ExeQue\Mutators\Concerns\Makes;
use ExeQue\Mutators\String\Hash;

/**
 * Alias for `Hash` with algorithm set to `sha512`
 *
 * @see Hash
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Sha512 extends Alias
{
    use Makes;

    public function __construct()
    {
        parent::__construct(Hash::make('sha512'));
    }
}
