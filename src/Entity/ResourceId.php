<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;

trait ResourceId
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"user:read", "user:details:read", "product:read", "product:details:read"})
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
