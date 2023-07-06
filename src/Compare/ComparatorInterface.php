<?php

declare(strict_types=1);

namespace ExeQue\Remix\Compare;

interface ComparatorInterface
{
    public function __invoke(mixed $value): bool;
    public function check(mixed $value): bool;
}
