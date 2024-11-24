<?php

declare(strict_types=1);

namespace App\Tests\Application\UseCase;

use App\Application\UseCase\DeleteTaskUseCase;
use App\Domain\Entity\Task;
use App\Infrastructure\Repository\InMemoryTaskRepository;
use PHPUnit\Framework\TestCase;

class DeleteTaskUseCaseTest extends TestCase
{
    public function testDeleteTask(): void
    {
        $repository = new InMemoryTaskRepository();
        $useCase = new DeleteTaskUseCase($repository);

        $task = new Task('Test Task', 'This is a test description');
        $repository->save($task);

        $useCase($task->getId());

        $this->assertNull($repository->findById($task->getId()), 'Task should not be in the repository.');
    }
}
