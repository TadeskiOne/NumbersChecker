<?php

namespace NumbersChecker\App\Entities;

use NumbersChecker\Definitions\CalcEntityInterface;

final class CalcEntity implements CalcEntityInterface
{
    public function __construct(private readonly int $value)
    {
    }

    public function getValue(): int
    {
        return $this->value;
    }
}