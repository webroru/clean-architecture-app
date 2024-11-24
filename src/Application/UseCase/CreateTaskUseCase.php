<?php

declare(strict_types=1);

namespace App\Application\UseCase;

use App\Domain\Entity\Task;
use App\Domain\Repository\TaskRepositoryInterface;

readonly class CreateTaskUseCase
{
    public function __construct(private TaskRepositoryInterface $taskRepository)
    {
    }

    public function __invoke(string $title, ?string $description = null): Task
    {
        $task = new Task($title, $description);

        $this->taskRepository->save($task);

        return $task;
    }
}
