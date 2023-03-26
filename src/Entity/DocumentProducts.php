<?php

namespace App\Entity;

use App\Repository\DocumentProductsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DocumentProductsRepository::class)]
class DocumentProducts
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'documentProducts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Documents $document = null;

    #[ORM\ManyToOne(inversedBy: 'documentProducts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Products $product = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $product_price = null;

    #[ORM\Column]
    private ?int $product_qty = null;

    #[ORM\ManyToOne(inversedBy: 'documentProducts')]
    private ?ProductUnit $unit = null;

    #[ORM\Column]
    private ?float $tax = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDocument(): ?Documents
    {
        return $this->document;
    }

    public function setDocument(?Documents $document): self
    {
        $this->document = $document;

        return $this;
    }

    public function getProduct(): ?Products
    {
        return $this->product;
    }

    public function setProduct(?Products $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getProductPrice(): ?string
    {
        return $this->product_price;
    }

    public function setProductPrice(string $product_price): self
    {
        $this->product_price = $product_price;

        return $this;
    }

    public function getProductQty(): ?int
    {
        return $this->product_qty;
    }

    public function setProductQty(int $product_qty): self
    {
        $this->product_qty = $product_qty;

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

    public function getTax(): ?float
    {
        return $this->tax;
    }

    public function setTax(float $tax): self
    {
        $this->tax = $tax;

        return $this;
    }
}
