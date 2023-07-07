<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\Array;

use ExeQue\Remix\Data\SortDirection;

/**
 * Sorts the keys of an array.
 *
 * Supports built-in PHP sorting flags. See https://www.php.net/manual/en/function.sort.php for more information.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class SortKeys extends ArrayMutator
{
    private SortDirection $direction;
    private int $flags;

    /**
     * @param  SortDirection  $direction The direction to sort by (optional, default: SortDirection::Asc)
     * @param  int  $flags Flags to pass to the PHP sort function (default: SORT_REGULAR)
     */
    public function __construct(SortDirection $direction = SortDirection::Asc, int $flags = SORT_REGULAR)
    {
        $this->direction = $direction;
        $this->flags     = $flags;
    }

    /**
     * @param  SortDirection  $direction The direction to sort by (optional, default: SortDirection::Asc)
     * @param  int  $flags Flags to pass to the PHP sort function (default: SORT_REGULAR)
     */
    public static function make(SortDirection $direction = SortDirection::Asc, int $flags = SORT_REGULAR): self
    {
        return new self($direction, $flags);
    }

    protected function mutateArray(array $array): array
    {
        if ($this->direction === SortDirection::Asc) {
            ksort($array, $this->flags);
        } else {
            krsort($array, $this->flags);
        }

        return $array;
    }
}
