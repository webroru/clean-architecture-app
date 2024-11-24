<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Domain\Entity\TaskInterface;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity]
class Task implements TaskInterface
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\GeneratedValue(strategy: 'NONE')]
    private Uuid $id;

    #[ORM\Column(length: 255)]
    private string $title;

    #[ORM\Column(length: 255)]
    private string $description;

    #[ORM\Column]
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
