<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use Symfony\Component\Uid\Uuid;

interface TaskInterface
{
    public function getId(): Uuid;
    public function getTitle(): string;
    public function setTitle(string $title): self;
    public function getDescription(): string;
    public function setDescription(string $description): self;
    public function isCompleted(): bool;
    public function reopen(): self;
    public function complete(): self;
}
