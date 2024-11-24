<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Domain\Entity\Task;
use App\Domain\Repository\TaskRepositoryInterface;

readonly class TaskService
{
    public function __construct(private TaskRepositoryInterface $taskRepository)
    {
    }

    /**
     * @return Task[]
     */
    public function getAllTasks(): array
    {
        return $this->taskRepository->findAll();
    }

    public function createTask(string $title, string $description): void
    {
        $task = new Task(
            title: $title,
            description: $description
        );

        $this->taskRepository->save($task);
    }

    public function completeTask(string $id): void
    {
        $task = $this->taskRepository->findById($id);
        if ($task) {
            $task->complete();
            $this->taskRepository->save($task);
        }
    }
}
