<?php

declare(strict_types=1);

namespace ExeQue\Remix\Exceptions;

use InvalidArgumentException as VanillaInvalidArgumentException;

class InvalidArgumentException extends VanillaInvalidArgumentException implements RemixException
{
}
