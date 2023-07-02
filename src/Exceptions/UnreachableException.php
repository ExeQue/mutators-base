<?php

declare(strict_types=1);

namespace ExeQue\Mutators\Exceptions;

use LogicException;

class UnreachableException extends LogicException implements MutatorExceptionInterface
{
}
