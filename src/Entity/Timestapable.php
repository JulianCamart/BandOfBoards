<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;

trait Timestapable
{
    /**
     * @ORM\Column(type="datetime")
     * @Groups({"user:details:read", "product:read", "product:details:read"})
     */
    private $createdAt;

    /**
     * @var \DateTimeInterface
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"product:details:read"})
     */
    private $updatedAt;

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
