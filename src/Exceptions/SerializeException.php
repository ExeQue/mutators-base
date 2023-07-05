<?php

declare(strict_types=1);

namespace ExeQue\Remix\Exceptions;

use RuntimeException;

class SerializeException extends RuntimeException implements RemixException, SerializationException
{
}
