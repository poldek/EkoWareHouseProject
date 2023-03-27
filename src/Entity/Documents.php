<?php

namespace App\Entity;

use App\Repository\DocumentsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DocumentsRepository::class)]

class Documents
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $document_date = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at;


    #[ORM\OneToMany(mappedBy: 'document', targetEntity: DocumentProducts::class, cascade: ['persist','remove'])]
    private Collection $documentProducts;

    #[ORM\Column]
    private ?bool $status = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\OneToMany(mappedBy: 'document', targetEntity: DocumentFile::class)]
    private Collection $documentFiles;


    public function __construct()
    {
        $this->created_at = new \DateTimeImmutable();
        $this->documentProducts = new ArrayCollection();
        $this->documentFiles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getDocumentDate(): ?\DateTimeImmutable
    {
        return $this->document_date;
    }

    public function setDocumentDate(\DateTimeImmutable $document_date): self
    {
        $this->document_date = $document_date;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

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
            $documentProduct->setDocument($this);
        }

        return $this;
    }

    public function removeDocumentProduct(DocumentProducts $documentProduct): self
    {
        if ($this->documentProducts->removeElement($documentProduct)) {
            // set the owning side to null (unless already changed)
            if ($documentProduct->getDocument() === $this) {
                $documentProduct->setDocument(null);
            }
        }

        return $this;
    }

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

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

    /**
     * @return Collection<int, DocumentFile>
     */
    public function getDocumentFiles(): Collection
    {
        return $this->documentFiles;
    }

    public function addDocumentFile(DocumentFile $documentFile): self
    {
        if (!$this->documentFiles->contains($documentFile)) {
            $this->documentFiles->add($documentFile);
            $documentFile->setDocument($this);
        }

        return $this;
    }

    public function removeDocumentFile(DocumentFile $documentFile): self
    {
        if ($this->documentFiles->removeElement($documentFile)) {
            // set the owning side to null (unless already changed)
            if ($documentFile->getDocument() === $this) {
                $documentFile->setDocument(null);
            }
        }

        return $this;
    }
}
