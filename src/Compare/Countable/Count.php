<?php

declare(strict_types=1);

namespace ExeQue\Remix\Compare\Countable;

use ExeQue\Remix\Assert;
use ExeQue\Remix\Compare\Comparator;
use ExeQue\Remix\Compare\Number\Number;

/**
 * Check if the count of the input matches the min and max values.
 * If min and max are equal, the count must match that value regardless of the inclusive flag.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Count extends Comparator
{
    private Number $comparator;

    /**
     * @param int|null $min Minimum count. Null means no minimum.
     * @param int|null $max Maximum count. Null means no maximum.
     * @param bool $inclusive Whether to include the minimum and maximum in the comparison (default: true)
     */
    public function __construct(int $min = null, int $max = null, bool $inclusive = true)
    {
        Assert::nullOrNatural($min, 'Min must be a positive integer. Got: %s');
        Assert::nullOrNatural($max, 'Max must be a positive integer. Got: %s');

        $this->comparator = new Number($min, $max, $inclusive);
    }

    /**
     * @param int|null $min Minimum count. Null means no minimum.
     * @param int|null $max Maximum count. Null means no maximum.
     * @param bool $inclusive Whether to include the minimum and maximum in the comparison (default: true)
     */
    public static function make(int $min = null, int $max = null, bool $inclusive = true): self
    {
        return new self($min, $max, $inclusive);
    }

    /**
     * Count must be equal to the given size.
     *
     * @param int $size Size to compare to
     */
    public static function equal(int $size): self
    {
        return new self($size, $size);
    }

    /**
     * Count must be greater than or equal to the given size.
     *
     * @param int $min Minimum size
     * @param bool $inclusive Whether to include the minimum in the comparison (default: true)
     */
    public static function min(int $min, bool $inclusive = true): self
    {
        return new self($min, null, $inclusive);
    }

    /**
     * Count must be less than or equal to the given size.
     *
     * @param int $max Maximum size
     * @param bool $inclusive Whether to include the maximum in the comparison (default: true)
     */
    public static function max(int $max, bool $inclusive = true): self
    {
        return new self(null, $max, $inclusive);
    }

    /**
     * Count must be between the given sizes.
     *
     * @param int $min Minimum size
     * @param int $max Maximum size
     * @param bool $inclusive Whether to include the minimum and maximum in the comparison (default: true)
     */
    public static function between(int $min, int $max, bool $inclusive = true): self
    {
        return new self($min, $max, $inclusive);
    }

    public function check(mixed $value): bool
    {
        if (is_countable($value)) {
            return $this->comparator->check(count($value));
        }

        if ($this->objectHasCountMethod($value)) {
            return $this->comparator->check($value->count());
        }

        Assert::report(static::class . ' can only compare countable values. Got: %s', $value);
    }

    private function objectHasCountMethod(mixed $value): bool
    {
        return is_object($value) && method_exists($value, 'count');
    }
}
