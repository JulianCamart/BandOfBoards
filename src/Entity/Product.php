<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Controller\ProductUpdate;


/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 * @ApiResource(
 *     collectionOperations={
 *          "get"={
 *              "normalization_context"={"groups"={"product:read"}}
 *          },
 *          "post"
 *      },
 *     itemOperations={
 *          "get"={
 *              "normalization_context"={"groups"={"product:details:read"}}
 *          },
 *          "put_update"={
 *              "method"="PUT",
 *              "path"="/products/{id}/",
 *              "controller"=ProductUpdate::class
 *          },
 *          "patch",
 *          "delete"
 *     }
 * )
 */
class Product
{
    use ResourceId;
    use Timestapable;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user:details:read", "product:read", "product:details:read"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"product:read", "product:details:read"})
     */
    private $model;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user:details:read", "product:read", "product:details:read"})
     */
    private $brand;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user:details:read", "product:read", "product:details:read"})
     */
    private $type;

    /**
     * @ORM\Column(type="decimal", precision=3, scale=2)
     * @Groups({"product:read", "product:details:read"})
     */
    private $size;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"product:details:read"})
     */
    private $gripped;

    /**
     * @ORM\Column(type="decimal", precision=4, scale=2)
     * @Groups({"user:details:read", "product:read", "product:details:read"})
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"product:details:read"})
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"product:read", "product:details:read"})
     */
    private $vendor;

    public function __construct()
    {
        $this->createdAt = new \DateTime();

    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(string $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getGripped(): ?bool
    {
        return $this->gripped;
    }

    public function setGripped(bool $gripped): self
    {
        $this->gripped = $gripped;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getVendor(): UserInterface
    {
        return $this->vendor;
    }

    public function setVendor(UserInterface $vendor): self
    {
        $this->vendor = $vendor;

        return $this;
    }
}
