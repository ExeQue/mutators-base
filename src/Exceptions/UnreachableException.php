<?php

declare(strict_types=1);

namespace ExeQue\Remix\Exceptions;

use LogicException;

class UnreachableException extends LogicException implements RemixException
{
}
