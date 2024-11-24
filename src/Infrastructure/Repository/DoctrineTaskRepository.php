<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Infrastructure\Doctrine\Entity\Task;
use App\Domain\Entity\TaskInterface;
use App\Domain\Repository\TaskRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineTaskRepository extends ServiceEntityRepository implements TaskRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }

    public function findById(string $id): ?TaskInterface
    {
        return $this->find($id);
    }

    public function save(TaskInterface $task): void
    {
        $this->getEntityManager()->persist($task);
        $this->getEntityManager()->flush();
    }

    public function delete(TaskInterface $task): void
    {
        $this->getEntityManager()->remove($task);
        $this->getEntityManager()->flush();
    }
}
