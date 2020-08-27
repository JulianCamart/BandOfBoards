<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;

trait Timestapable
{
    /**
     * @ORM\Column(type="datetime")
     * @Groups({"user_read", "user_details_read"})
     */
    private $createdAt;

    /**
     * @var \DateTimeInterface
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"user_details_read"})
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
