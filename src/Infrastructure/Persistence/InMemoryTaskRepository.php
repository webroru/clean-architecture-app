<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence;

use App\Domain\Entity\Task;
use App\Domain\Repository\TaskRepositoryInterface;

class InMemoryTaskRepository implements TaskRepositoryInterface
{
    /** @var Task[] */
    private array $tasks = [];

    public function save(Task $task): void
    {
        $this->tasks[$task->getId()] = $task;
    }

    /**
     * @return Task[]
     */
    public function findAll(): array
    {
        return array_values($this->tasks);
    }
}
