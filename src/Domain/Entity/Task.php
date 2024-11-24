<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use Symfony\Component\Uid\Uuid;

class Task
{
    private readonly Uuid $id;

    public function __construct(
        private string $title,
        private ?string $description = null,
        private bool $isCompleted = false,
    ) {
        $this->id = Uuid::v4();
        $this->setTitle($title);
    }

    public function getId(): string
    {
        return $this->id->toRfc4122();
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        if (trim($title) === '') {
            throw new \InvalidArgumentException('Title cannot be empty.');
        }
        $this->title = $title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function isCompleted(): bool
    {
        return $this->isCompleted;
    }

    public function complete(): void
    {
        if ($this->isCompleted) {
            throw new \LogicException('Task is already completed.');
        }
        $this->isCompleted = true;
    }

    public function reopen(): void
    {
        if (!$this->isCompleted) {
            throw new \LogicException('Task is already open.');
        }
        $this->isCompleted = false;
    }
}
