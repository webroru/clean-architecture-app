<?php

declare(strict_types=1);

namespace App\Tests\Application\UseCase;

use App\Application\UseCase\UpdateTaskUseCase;
use App\Domain\Entity\Task;
use App\Infrastructure\Repository\InMemoryTaskRepository;
use PHPUnit\Framework\TestCase;

class UpdateTaskUseCaseTest extends TestCase
{
    public function testCreateTask(): void
    {
        $repository = new InMemoryTaskRepository();
        $useCase = new UpdateTaskUseCase($repository);
        $task = new Task('Test Task', 'This is a test description');
        $repository->save($task);

        $task = $useCase($task->getId(), 'New Test Task', 'This is new test description.');

        $this->assertSame('New Test Task', $task->getTitle());
        $this->assertSame('This is new test description.', $task->getDescription());
        $this->assertSame($task, $repository->findById($task->getId()));
    }
}
