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
    private ?string $document_price = null;

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

    public function getDocumentPrice(): ?string
    {
        return $this->document_price;
    }

    public function setDocumentPrice(string $document_price): self
    {
        $this->document_price = $document_price;

        return $this;
    }
}
