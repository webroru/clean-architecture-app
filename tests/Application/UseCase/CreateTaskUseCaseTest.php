<?php

declare(strict_types=1);

namespace App\Tests\Application\UseCase;

use App\Application\UseCase\CreateTaskUseCase;
use App\Infrastructure\Repository\InMemoryTaskRepository;
use PHPUnit\Framework\TestCase;

class CreateTaskUseCaseTest extends TestCase
{
    public function testCreateTask(): void
    {
        $repository = new InMemoryTaskRepository();
        $useCase = new CreateTaskUseCase($repository);
        $task = $useCase('Test Task', 'This is a test description.');

        $this->assertNotNull($task->getId(), 'Task ID should not be null.');
        $this->assertSame('Test Task', $task->getTitle());
        $this->assertSame('This is a test description.', $task->getDescription());
        $this->assertFalse($task->isCompleted(), 'Newly created task should not be completed.');

        $tasks = $repository->findAll();
        $this->assertCount(1, $tasks, 'There should be one task in the repository.');
        $this->assertSame($task, $tasks[0]);
    }
}
