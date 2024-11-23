<?php

declare(strict_types=1);

namespace App\Application\UseCase;

use App\Domain\Entity\Task;
use App\Domain\Repository\TaskRepositoryInterface;

class CreateTaskUseCase
{
    public function __construct(
        private readonly TaskRepositoryInterface $taskRepository
    ) {}

    public function __invoke(string $title, ?string $description = null): Task
    {
        $task = new Task(
            title: $title,
            description: $description
        );

        $this->taskRepository->save($task);

        return $task;
    }
}
