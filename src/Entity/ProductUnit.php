<?php

namespace App\Entity;

use App\Repository\ProductUnitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[UniqueEntity('name','a unit name already exists')]
#[ORM\Entity(repositoryClass: ProductUnitRepository::class)]
class ProductUnit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'unit', targetEntity: Products::class)]
    private Collection $products;

    #[ORM\OneToMany(mappedBy: 'unit', targetEntity: DocumentProducts::class)]
    private Collection $documentProducts;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->documentProducts = new ArrayCollection();
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

    public function __toString(): string
    {
        return $this->name;
    }

    /**
     * @return Collection<int, Products>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Products $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products->add($product);
            $product->setUnit($this);
        }

        return $this;
    }

    public function removeProduct(Products $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getUnit() === $this) {
                $product->setUnit(null);
            }
        }

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
            $documentProduct->setUnit($this);
        }

        return $this;
    }

    public function removeDocumentProduct(DocumentProducts $documentProduct): self
    {
        if ($this->documentProducts->removeElement($documentProduct)) {
            // set the owning side to null (unless already changed)
            if ($documentProduct->getUnit() === $this) {
                $documentProduct->setUnit(null);
            }
        }

        return $this;
    }
}
