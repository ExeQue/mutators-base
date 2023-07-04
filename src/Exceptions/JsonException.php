<?php

declare(strict_types=1);

namespace ExeQue\Remix\Exceptions;

use JsonException as VanillaJsonException;

class JsonException extends VanillaJsonException implements RemixException
{
}
