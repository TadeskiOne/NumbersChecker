<?php

namespace NumbersChecker\Definitions;

interface CalcEntitiesCollectionInterface extends \Iterator
{
    public function append(CalcEntityInterface $entity): void;
    public function current(): CalcEntityInterface;
    public function flush(): void;
}