<?php

declare(strict_types=1);

namespace ExeQue\Mutators\Exceptions;

use InvalidArgumentException as VanillaInvalidArgumentException;

class InvalidArgumentException extends VanillaInvalidArgumentException implements MutatorExceptionInterface
{
}
