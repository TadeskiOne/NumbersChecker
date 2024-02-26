<?php

namespace NumbersChecker\Services\CalcRules;

use NumbersChecker\Definitions\CalcRuleInterface;

class ModRule implements CalcRuleInterface
{
    public function __construct(
        private readonly int     $divider,
        private readonly string  $output,
        private readonly ?string $identifier = null,
    ) {}

    public function idenifier(): string
    {
        return $this->identifier ?? (static::class . $this->divider);
    }

    public function getOutput(): string
    {
        return $this->output;
    }

    public function handle(int $value): bool
    {
        return $value % $this->divider === 0;
    }
}