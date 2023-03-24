<?php

namespace App\Entity;

use App\Repository\ProductsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[UniqueEntity('index_product','a index with the given number already exists')]
#[ORM\Entity(repositoryClass: ProductsRepository::class)]
class Products
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(options: ['default' => 0])]
    private ?int $qty = null;

    #[ORM\Column]
    private ?float $vat = null;

    #[Assert\Length(
        min: 1,
        max: 9,
        minMessage: 'Incorrect amount',
        maxMessage: 'incorrect amount',
    )]
    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $price = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(length: 255)]
    private ?string $index_product = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ProductUnit $unit = null;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: DocumentProducts::class)]
    private Collection $documentProducts;


    public function __construct()
    {
        $this->qty = 0;
        $this->createdAt = new \DateTimeImmutable();
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

    public function getQty(): ?int
    {
        return $this->qty;
    }

    public function setQty(?int $qty): self
    {
        $this->qty = $qty;

        return $this;
    }


    public function getVat(): ?float
    {
        return $this->vat;
    }

    public function setVat(float $vat): self
    {
        $this->vat = $vat;

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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getIndexProduct(): ?string
    {
        return $this->index_product;
    }

    public function setIndexProduct(string $index_product): self
    {
        $this->index_product = $index_product;

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
}
