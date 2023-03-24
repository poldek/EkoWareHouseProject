<?php

namespace App\Controller\Admin\Service\DocumentType;

use App\Entity\DocumentType;
use App\Repository\DocumentTypeRepository;

class TypeDocument
{

    public function __construct(
        public DocumentTypeRepository $documentTypeRepository,
        public Type $type)
    {
    }

    public function createDocumentType(): void
    {

        if($this->documentTypeRepository->findAll()){
            return;
        }

        foreach ($this->type->typeDocumentName() as $value) {
            $documentType = new DocumentType();
            $documentType->setName($value['name']);
            $documentType->setType($value['type']);
            $this->documentTypeRepository->save($documentType,true);
        }
    }
}
