<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\Array;

use ExeQue\Remix\Data\SortDirection;

/**
 * Sorts an array. The callback is used to retrieve the value to sort by. If no callback is provided, the value itself is used.
 *
 * Preserves key association by default. To reset key association, set `$preserveKeys` to false.
 *
 * Supports built-in PHP sorting flags. See https://www.php.net/manual/en/function.sort.php for more information.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Sort extends ArrayMutator
{
    private SortDirection $direction;
    private $callback;
    private bool $preserveKeys;
    private int $flags;

    /**
     * @param SortDirection $direction The direction to sort by (optional, default: SortDirection::Asc)
     * @param callable|null $callback The callback to retrieve the value to sort by (optional)
     * @param bool $preserveKeys Whether to preserve key association (default: true)
     * @param int $flags Flags to pass to the PHP sort function (default: SORT_REGULAR)
     */
    public function __construct(SortDirection $direction = SortDirection::Asc, callable $callback = null, bool $preserveKeys = true, int $flags = SORT_REGULAR)
    {
        $this->direction    = $direction;
        $this->callback     = $callback;
        $this->preserveKeys = $preserveKeys;
        $this->flags        = $flags;
    }

    /**
     * @param SortDirection $direction The direction to sort by (optional, default: SortDirection::Asc)
     * @param callable|null $callback The callback to retrieve the value to sort by (optional)
     * @param bool $preserveKeys Whether to preserve key association (default: true)
     * @param int $flags Flags to pass to the PHP sort function (default: SORT_REGULAR)
     */
    public static function make(SortDirection $direction = SortDirection::Asc, callable $callback = null, bool $preserveKeys = true, int $flags = SORT_REGULAR): self
    {
        return new self($direction, $callback, $preserveKeys, $flags);
    }

    /**
     * Sorts an array in ascending order.
     *
     * @param callable|null $callback The callback to retrieve the value to sort by (optional)
     * @param bool $preserveKeys Whether to preserve key association (default: true)
     * @param int $flags Flags to pass to the PHP sort function (default: SORT_REGULAR)
     */
    public static function asc(callable $callback = null, bool $preserveKeys = true, int $flags = SORT_REGULAR): self
    {
        return new self(SortDirection::Asc, $callback, $preserveKeys, $flags);
    }

    /**
     * Sorts an array in descending order.
     *
     * @param callable|null $callback The callback to retrieve the value to sort by (optional)
     * @param bool $preserveKeys Whether to preserve key association (default: true)
     * @param int $flags Flags to pass to the PHP sort function (default: SORT_REGULAR)
     */
    public static function desc(callable $callback = null, bool $preserveKeys = true, int $flags = SORT_REGULAR): self
    {
        return new self(SortDirection::Desc, $callback, $preserveKeys, $flags);
    }

    protected function mutateArray(array $array): array
    {
        $retriever = $this->resolveValueRetriever();

        $results = [];

        foreach ($array as $key => $value) {
            $results[$key] = $retriever($value, $key);
        }

        if ($this->direction === SortDirection::Asc) {
            asort($results, $this->flags);
        } else {
            arsort($results, $this->flags);
        }

        foreach (array_keys($results) as $key) {
            $results[$key] = $array[$key];
        }

        if ($this->preserveKeys === false) {
            return array_values($results);
        }

        return $results;
    }

    private function resolveValueRetriever(): callable
    {
        return $this->callback ?? static function ($item) {
            return $item;
        };
    }
}
