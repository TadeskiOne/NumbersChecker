<?php

namespace NumbersChecker\Services\CalcRules;

use NumbersChecker\Definitions\CalcRuleInterface;

class InRangeRule implements CalcRuleInterface
{
    public function __construct(
        private readonly array   $range,
        private readonly string  $output,
        private readonly ?string $identifier = null,
    ) {}

    public function idenifier(): string
    {
        return $this->identifier ?? (static::class . implode('_', $this->range));
    }

    public function getOutput(): string
    {
        return $this->output;
    }

    public function handle(int $value): bool
    {
        return in_array($value, $this->range);
    }
}