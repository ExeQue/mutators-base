<?php

declare(strict_types=1);

namespace ExeQue\Remix\Data;

enum ScalarType
{
    case String;

    case Integer;

    case Float;

    case Boolean;

    case Null;
}
