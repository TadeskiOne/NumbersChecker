<?php

namespace NumbersChecker\App\Entities;

use NumbersChecker\Definitions\CalcEntitiesCollectionInterface;
use NumbersChecker\Definitions\CalcEntityInterface;

final class CalcEntitiesCollection implements CalcEntitiesCollectionInterface
{
    private array $collection = [];

    public function append(CalcEntityInterface $entity): void
    {
        $this->collection[] = $entity;
    }

    public function current(): CalcEntityInterface
    {
        return current($this->collection);
    }

    /**
     * @inheritDoc
     */
    public function next(): void
    {
        next($this->collection);
    }

    /**
     * @inheritDoc
     */
    public function key(): mixed
    {
        return key($this->collection);
    }

    /**
     * @inheritDoc
     */
    public function valid(): bool
    {
        $current = current($this->collection);

        return isset($current) && $current instanceof CalcEntityInterface;
    }

    /**
     * @inheritDoc
     */
    public function rewind(): void
    {
        reset($this->collection);
    }

    public function flush(): void
    {
        $this->collection = [];
    }
}