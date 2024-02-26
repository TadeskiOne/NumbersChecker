<?php

namespace NumbersChecker\Services;

use NumbersChecker\Definitions\CalcEntitiesCollectionInterface;
use NumbersChecker\Definitions\CalcRuleInterface;

class Calc
{
    /**
     * @var CalcRuleInterface[] $conditions
     */
    private array $conditions;

    public function setCondition(CalcRuleInterface $condition): static
    {
        $this->conditions[$condition->idenifier()] = $condition;

        return $this;
    }

    public function process(CalcEntitiesCollectionInterface $collection): \ArrayObject
    {
        $result = new \ArrayObject();

        foreach ($collection as $item) {
            $result->append(
                $this->processCondition($item->getValue())
            );
        }

        return $result;
    }

    private function processCondition(int $value): string
    {
        $result = '';
        foreach ($this->conditions as $cond) {
            if (!$cond->handle($value)) {
                continue;
            }

            $result .= $cond->getOutput();
        }

        return $result ?: $value;
    }
}