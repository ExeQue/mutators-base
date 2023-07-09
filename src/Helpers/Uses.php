<?php

declare(strict_types=1);

namespace ExeQue\Remix\Helpers;

class Uses
{
    /**
     * Ported from `illuminate/support` to prevent package collisions.
     *
     * @see https://github.com/laravel/framework/blob/10.x/src/Illuminate/Support/helpers.php#L86
     */
    public static function classUsesRecursive(object|string $class)
    {
        if (is_object($class)) {
            $class = get_class($class);
        }

        $results = [];

        if(!class_exists($class) && !trait_exists($class)) {
            return $results;
        }

        /** @noinspection SuspiciousLoopInspection */
        foreach (array_reverse(class_parents($class)) + [$class => $class] as $class) {
            $results += self::traitUsesRecursive($class);
        }

        return array_unique($results);
    }

    /**
     * Ported from `illuminate/support` to prevent package collisions.
     *
     * @see https://github.com/laravel/framework/blob/10.x/src/Illuminate/Support/helpers.php#L364
     */
    public static function traitUsesRecursive(object|string $trait): array|bool
    {
        $traits = class_uses($trait) ?: [];

        /** @noinspection SuspiciousLoopInspection */
        foreach ($traits as $trait) {
            $traits += self::traitUsesRecursive($trait);
        }

        return $traits;
    }
}
