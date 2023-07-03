<?php

declare(strict_types=1);

namespace ExeQue\Remix\Exceptions;

use RuntimeException;

class MissingTagException extends RuntimeException implements MutatorExceptionInterface
{
}
