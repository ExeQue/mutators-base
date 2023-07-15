<?php

declare(strict_types=1);

namespace ExeQue\Remix\Compare\String;

use ExeQue\Remix\Assert;
use ExeQue\Remix\Compare\Number\Number;

/**
 * Check if the length of the input matches the min and max values.
 * If min and max are equal, the count must match that value regardless of the inclusive flag.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Length extends StringComparator
{
    private Number $comparator;

    /**
     * @param int|null $min Minimum length. Null means no minimum.
     * @param int|null $max Maximum length. Null means no maximum.
     * @param bool $inclusive Whether to include the minimum and maximum in the comparison (default: true)
     */
    public function __construct(int $min = null, int $max = null, bool $inclusive = true)
    {
        Assert::nullOrNatural($min, 'Min must be a non-negative integer. Got: %s');
        Assert::nullOrNatural($max, 'Max must be a non-negative integer. Got: %s');

        $this->comparator = new Number($min, $max, $inclusive);
    }

    /**
     * @param int|null $min Minimum length. Null means no minimum.
     * @param int|null $max Maximum length. Null means no maximum.
     * @param bool $inclusive Whether to include the minimum and maximum in the comparison (default: true)
     */
    public static function make(int $min = null, int $max = null, bool $inclusive = true): self
    {
        return new self($min, $max, $inclusive);
    }

    /**
     * Length must be equal to the given size.
     *
     * @param int $size Size to compare to
     */
    public static function equal(int $size): self
    {
        return self::make($size, $size);
    }

    /**
     * Length must be greater than or equal to the given size.
     *
     * @param int $min Minimum size
     * @param bool $inclusive Whether to include the minimum in the comparison (default: true)
     */
    public static function min(int $min, bool $inclusive = true): self
    {
        return self::make($min, null, $inclusive);
    }

    /**
     * Length must be less than or equal to the given size.
     *
     * @param int $max Maximum size
     * @param bool $inclusive Whether to include the maximum in the comparison (default: true)
     */
    public static function max(int $max, bool $inclusive = true): self
    {
        return self::make(null, $max, $inclusive);
    }

    /**
     * Length must be between the given sizes.
     *
     * @param int $min Minimum size
     * @param int $max Maximum size
     * @param bool $inclusive Whether to include the minimum and maximum in the comparison (default: true)
     */
    public static function between(int $min, int $max, bool $inclusive = true): self
    {
        return self::make($min, $max, $inclusive);
    }

    protected function checkString(string $value): bool
    {
        return $this->comparator->check(mb_strlen($value));
    }
}
