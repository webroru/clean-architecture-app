<?php

declare(strict_types=1);

namespace App\Application\UseCase;

use App\Domain\Repository\TaskRepositoryInterface;

readonly class DeleteTaskUseCase
{
    public function __construct(private TaskRepositoryInterface $taskRepository)
    {
    }

    public function __invoke(string $id): void
    {
        $task = $this->taskRepository->findById($id);

        if (!$task) {
            throw new \InvalidArgumentException('Task not found.');
        }

        $this->taskRepository->delete($task);
    }
}
