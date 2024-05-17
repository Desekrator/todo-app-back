<?php

namespace App\Model;

use App\Enum\PriorityEnum;
use App\Enum\StatusEnum;

class Task
{
    private $id;
    private $title;
    private $description;
    private $status;
    private $priority;

    /**
     * @param $id
     * @param $title
     * @param $description
     * @param $status
     * @param $priority
     */
    public function __construct($id, $title, $description, $status, $priority)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->status = $status;
        $this->priority = $priority;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
//        if (!in_array($status, [StatusEnum::EMPTY, StatusEnum::FINISHED, StatusEnum::PROGRESS])) {
//            throw new \InvalidArgumentException("Invalid status");
//        }

        $this->status = $status;

        return $this;
    }

    public function getPriority(): ?string
    {
        return $this->priority;
    }

    public function setPriority(string $priority): self
    {
        $this->priority = $priority;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'description' => $this->getDescription(),
            'status' => $this->getStatus(),
            'priority' => $this->getPriority(),
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['title'] ?? null,
            $data['description'] ?? null,
            $data['status'] ?? null,
            $data['priority'] ?? null
        );
    }

}