<?php

declare(strict_types=1);

namespace App\Tests\Application\UseCase;

use App\Application\UseCase\UpdateTaskUseCase;
use App\Infrastructure\Doctrine\Entity\InMemoryTask;
use App\Infrastructure\Repository\InMemoryTaskRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Uuid;

class UpdateTaskUseCaseTest extends TestCase
{
    public function testCreateTask(): void
    {
        $repository = new InMemoryTaskRepository();
        $useCase = new UpdateTaskUseCase($repository);
        $task = new InMemoryTask(Uuid::v4(), 'Test Task', 'This is a test description');
        $repository->save($task);

        $task = $useCase($task->getId()->toRfc4122(), 'New Test Task', 'This is new test description.');

        $this->assertSame('New Test Task', $task->getTitle());
        $this->assertSame('This is new test description.', $task->getDescription());
        $this->assertSame($task, $repository->findById($task->getId()->toRfc4122()));
    }
}
