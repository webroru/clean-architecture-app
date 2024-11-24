<?php

declare(strict_types=1);

namespace App\Tests\Application\Service;

use App\Application\Service\TaskService;
use App\Infrastructure\Repository\InMemoryTaskRepository;
use PHPUnit\Framework\TestCase;

class TaskServiceTest extends TestCase
{
    private TaskService $taskService;

    protected function setUp(): void
    {
        $taskRepository = new InMemoryTaskRepository();
        $this->taskService = new TaskService($taskRepository);
    }

    public function testCreateTask(): void
    {
        $title = 'Test Task';
        $description = 'Test Task Description';

        $this->taskService->createTask($title, $description);

        $tasks = $this->taskService->getAllTasks();
        $this->assertCount(1, $tasks);

        $task = $tasks[0];
        $this->assertSame($title, $task->getTitle());
        $this->assertSame($description, $task->getDescription());
    }

    public function testCompleteTask(): void
    {
        $title = 'Test Task';
        $description = 'Test Task Description';

        $this->taskService->createTask($title, $description);
        $task = $this->taskService->getAllTasks()[0];

        $this->taskService->completeTask($task->getId());

        $this->assertTrue($task->isCompleted());
    }

    public function testGetAllTasks(): void
    {
        $this->assertCount(0, $this->taskService->getAllTasks());

        $this->taskService->createTask('Test Task 1', 'Description 1');
        $this->taskService->createTask('Test Task 2', 'Description 2');

        $tasks = $this->taskService->getAllTasks();
        $this->assertCount(2, $tasks);
    }
}
