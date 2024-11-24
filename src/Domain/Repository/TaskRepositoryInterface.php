<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\TaskInterface;

interface TaskRepositoryInterface
{
    public function findAll(): array;
    public function findById(string $id): ?TaskInterface;
    public function save(TaskInterface $task): void;
    public function delete(TaskInterface $task): void;
}
