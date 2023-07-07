<?php

declare(strict_types=1);

namespace ExeQue\Remix\Concerns;

use ExeQue\Remix\Assert;
use Psr\Http\Message\MessageInterface;
use Stringable;

trait ResolvesStringInput
{
    protected function resolveStringInput(mixed $value): string
    {
        // PSR-7 MessageInterface
        if ($value instanceof MessageInterface) {
            return (string)$value->getBody();
        }

        if (is_string($value) || is_null($value) || is_numeric($value) || $value instanceof Stringable) {
            return (string)$value;
        }

        // Object with __toString method (like Stringable objects from Laravel)
        if (is_object($value) && method_exists($value, 'toString')) {
            return $value->toString();
        }

        if (is_resource($value)) {
            rewind($value);

            return stream_get_contents($value);
        }

        Assert::stringable($value, 'Value must be a stringable value. Got: %s');
    }
}
