<?php

declare(strict_types=1);

namespace App\Application\UseCase;

use App\Domain\Entity\Task;
use App\Domain\Repository\TaskRepositoryInterface;

readonly class UpdateTaskUseCase
{
    public function __construct(private TaskRepositoryInterface $taskRepository)
    {
    }

    public function __invoke(string $id, ?string $title, ?string $description): Task
    {
        $task = $this->taskRepository->findById($id);

        if (!$task) {
            throw new \InvalidArgumentException('Task not found.');
        }

        if ($title !== null) {
            $task->setTitle($title);
        }

        if ($description !== null) {
            $task->setDescription($description);
        }

        $this->taskRepository->save($task);

        return $task;
    }
}
