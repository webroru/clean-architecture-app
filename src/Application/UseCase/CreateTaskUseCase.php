<?php

declare(strict_types=1);

namespace App\Application\UseCase;

use App\Domain\Entity\TaskInterface;
use App\Domain\Factory\TaskFactoryInterface;
use App\Domain\Repository\TaskRepositoryInterface;

readonly class CreateTaskUseCase
{
    public function __construct(
        private TaskRepositoryInterface $taskRepository,
        private TaskFactoryInterface $taskFactory,
    ) {
    }

    public function __invoke(string $title, ?string $description = null): TaskInterface
    {
        $task = $this->taskFactory->create($title, $description);
        $this->taskRepository->save($task);

        return $task;
    }
}
