<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Entity\TaskInterface;
use App\Domain\Repository\TaskRepositoryInterface;

class InMemoryTaskRepository implements TaskRepositoryInterface
{
    /** @var TaskInterface[] */
    private array $tasks = [];

    public function save(TaskInterface $task): void
    {
        $this->tasks[$task->getId()->toRfc4122()] = $task;
    }

    /**
     * @return TaskInterface[]
     */
    public function findAll(): array
    {
        return array_values($this->tasks);
    }

    public function findById(string $id): ?TaskInterface
    {
        return $this->tasks[$id] ?? null;
    }

    public function delete(TaskInterface $task): void
    {
        unset($this->tasks[$task->getId()->toRfc4122()]);
    }
}
