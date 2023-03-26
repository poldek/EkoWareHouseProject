<?php

namespace App\Entity;

use App\Repository\ProductsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[UniqueEntity('product_code','a index with the given number already exists')]
#[ORM\Entity(repositoryClass: ProductsRepository::class)]
class Products
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;


    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(length: 255)]
    private ?string $product_code = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ProductUnit $unit = null;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: DocumentProducts::class)]
    private Collection $documentProducts;

    #[ORM\ManyToMany(targetEntity: Warehouses::class, inversedBy: 'products')]
    private Collection $warehouses;


    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->documentProducts = new ArrayCollection();
        $this->warehouses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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


    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getProductCode(): ?string
    {
        return $this->product_code;
    }

    public function setProductCode(string $product_code): self
    {
        $this->product_code = $product_code;

        return $this;
    }

    public function getUnit(): ?ProductUnit
    {
        return $this->unit;
    }

    public function setUnit(?ProductUnit $unit): self
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * @return Collection<int, DocumentProducts>
     */
    public function getDocumentProducts(): Collection
    {
        return $this->documentProducts;
    }

    public function addDocumentProduct(DocumentProducts $documentProduct): self
    {
        if (!$this->documentProducts->contains($documentProduct)) {
            $this->documentProducts->add($documentProduct);
            $documentProduct->setProduct($this);
        }

        return $this;
    }

    public function removeDocumentProduct(DocumentProducts $documentProduct): self
    {
        if ($this->documentProducts->removeElement($documentProduct)) {
            // set the owning side to null (unless already changed)
            if ($documentProduct->getProduct() === $this) {
                $documentProduct->setProduct(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    /**
     * @return Collection<int, Warehouses>
     */
    public function getWarehouses(): Collection
    {
        return $this->warehouses;
    }

    public function addWarehouse(Warehouses $warehouse): self
    {
        if (!$this->warehouses->contains($warehouse)) {
            $this->warehouses->add($warehouse);
        }

        return $this;
    }

    public function removeWarehouse(Warehouses $warehouse): self
    {
        $this->warehouses->removeElement($warehouse);

        return $this;
    }
}
