<?php

declare(strict_types=1);

namespace App\Tests\Application\UseCase;

use App\Application\UseCase\DeleteTaskUseCase;
use App\Infrastructure\Doctrine\Entity\InMemoryTask;
use App\Infrastructure\Repository\InMemoryTaskRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Uuid;

class DeleteTaskUseCaseTest extends TestCase
{
    public function testDeleteTask(): void
    {
        $repository = new InMemoryTaskRepository();
        $useCase = new DeleteTaskUseCase($repository);

        $task = new InMemoryTask(Uuid::v4(), 'Test Task', 'This is a test description');
        $repository->save($task);

        $useCase($task->getId()->toRfc4122());

        $this->assertNull($repository->findById($task->getId()->toRfc4122()), 'Task should not be in the repository.');
    }
}
