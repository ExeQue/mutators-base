<?php

declare(strict_types=1);

namespace ExeQue\Mutators\Concerns;

use ExeQue\Mutators\Exceptions\InvalidArgumentException;
use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\StreamInterface;
use Stringable;

trait ResolvesStringInputs
{
    protected function resolveStringInput(mixed $input): string
    {
        if (is_scalar($input) || is_null($input)) {
            return (string)$input;
        }

        if ($input instanceof MessageInterface) {
            $input = $input->getBody();
        }

        if ($input instanceof StreamInterface) {
            return $input->getContents();
        }

        if ($input instanceof Stringable) {
            return (string)$input;
        }

        throw new InvalidArgumentException(
            sprintf(
                'Input must be a string, object with __toString method, or a PSR-7 StreamInterface or MessageInterface. Got %s',
                get_debug_type($input)
            )
        );
    }
}
