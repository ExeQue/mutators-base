<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\Convert;

use ExeQue\Remix\Assert;
use ExeQue\Remix\Mutate\Mutator;

/**
 * Converts a value to a class instance using the given class' constructor.
 * If the value is already an instance of the given class, it will be returned as-is.
 * If the value is an array, it can be spread into the constructor by setting `$spread` to `true`.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class ToClass extends Mutator
{
    private string $class;
    private bool $spread;

    /**
     * @param string $class The class to convert to
     * @param bool $spread Whether to spread an array into the constructor or not (default: false)
     */
    public function __construct(string $class, bool $spread = false)
    {
        Assert::classExists($class, 'Class does not exist: %s');

        $this->class  = $class;
        $this->spread = $spread;
    }

    /**
     * @param string $class The class to convert to
     * @param bool $spread Whether to spread an array into the constructor or not (default: false)
     */
    public static function make(string $class, bool $spread = false): self
    {
        return new self($class, $spread);
    }

    public function mutate(mixed $value): object
    {
        if ($value instanceof $this->class) {
            return $value;
        }

        if ($this->spread) {
            $arrayConvert = ToArray::make();

            $value = $arrayConvert->mutate($value);

            return new $this->class(...$value);
        }

        return new $this->class($value);
    }
}
