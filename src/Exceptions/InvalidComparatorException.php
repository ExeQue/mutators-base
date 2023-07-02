<?php

declare(strict_types=1);

namespace ExeQue\Mutators\Exceptions;

use LogicException;

class InvalidComparatorException extends LogicException implements MutatorExceptionInterface
{
}
