<?php

declare(strict_types=1);

namespace App\Tests\Application\UseCase;

use App\Application\UseCase\GetTasksUseCase;
use App\Infrastructure\Doctrine\Entity\InMemoryTask;
use App\Infrastructure\Repository\InMemoryTaskRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Uuid;

class GetTasksUseCaseTest extends TestCase
{
    public function testGetTasks(): void
    {
        $repository = new InMemoryTaskRepository();
        $task1 = new InMemoryTask(Uuid::v4(), 'Task 1', 'Description 1');
        $task2 = new InMemoryTask(Uuid::v4(), 'Task 2', 'Description 2');
        $repository->save($task1);
        $repository->save($task2);

        $tasks = (new GetTasksUseCase($repository))();

        $this->assertCount(2, $tasks, 'Should return 2 tasks.');
        $this->assertSame($task1, $tasks[0]);
        $this->assertSame($task2, $tasks[1]);
    }
}
