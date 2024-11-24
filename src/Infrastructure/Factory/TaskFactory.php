<?php

declare(strict_types=1);

namespace App\Infrastructure\Factory;

use App\Infrastructure\Doctrine\Entity\InMemoryTask;
use App\Domain\Entity\TaskInterface;
use App\Domain\Factory\TaskFactoryInterface;
use Symfony\Component\Uid\Uuid;

class TaskFactory implements TaskFactoryInterface
{
    public function create(string $title, ?string $description = null): TaskInterface
    {
        return new InMemoryTask(Uuid::v4(), $title, $description);
    }
}
