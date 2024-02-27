<?php

namespace NumbersChecker\Services\CalcRules;

use NumbersChecker\Definitions\CalcRuleInterface;

class GreaterThanRule implements CalcRuleInterface
{
    public function __construct(
        private readonly int     $compareWith,
        private readonly string  $output,
        private readonly ?string $identifier = null,
    ) {}

    public function idenifier(): string
    {
        return $this->identifier ?? (static::class . $this->compareWith);
    }

    public function getOutput(): string
    {
        return $this->output;
    }

    public function handle(int $value): bool
    {
        return $value > $this->compareWith;
    }
}