<?php

declare(strict_types=1);

namespace App\Domain\Factory;

use App\Domain\Entity\TaskInterface;

interface TaskFactoryInterface
{
    public function create(string $title, ?string $description = null): TaskInterface;
}
