<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Entity;

use App\Domain\Entity\TaskInterface;
use Symfony\Component\Uid\Uuid;

class InMemoryTask implements TaskInterface
{
    private Uuid $id;

    private string $title;

    private string $description;

    private bool $isCompleted = false;

    public function __construct(Uuid $id, string $title, ?string $description)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function isCompleted(): bool
    {
        return $this->isCompleted;
    }

    public function complete(): self
    {
        if ($this->isCompleted) {
            throw new \LogicException('Task is already completed.');
        }
        $this->isCompleted = true;
        return $this;
    }

    public function reopen(): self
    {
        if (!$this->isCompleted) {
            throw new \LogicException('Task is already open.');
        }
        $this->isCompleted = false;
        return $this;
    }
}
