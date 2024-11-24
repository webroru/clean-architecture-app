<?php

declare(strict_types=1);

namespace App\Application\UseCase;

use App\Domain\Entity\Task;
use App\Domain\Repository\TaskRepositoryInterface;

readonly class GetTasksUseCase
{
    public function __construct(private TaskRepositoryInterface $taskRepository)
    {
    }

    /**
     * @return Task[]
     */
    public function __invoke(): array
    {
        return $this->taskRepository->findAll();
    }
}
