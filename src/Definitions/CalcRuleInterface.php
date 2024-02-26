<?php

namespace NumbersChecker\Definitions;

interface CalcRuleInterface
{
    public function idenifier(): string;

    public function getOutput(): string;

    public function handle(int $value): bool;
}