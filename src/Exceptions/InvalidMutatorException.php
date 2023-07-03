<?php

declare(strict_types=1);

namespace ExeQue\Remix\Exceptions;

use LogicException;

class InvalidMutatorException extends LogicException implements MutatorExceptionInterface
{
}
