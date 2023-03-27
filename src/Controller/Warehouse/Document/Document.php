<?php

namespace App\Controller\Warehouse\Document;

use App\Controller\Warehouse\CheckStatus\CreateDocument;
use App\Entity\Documents;
use App\Repository\DocumentsRepository;

class Document
{

    public function __construct(
        public DocumentsRepository $documentsRepository,
        public CreateDocument $createDocument,
    )
    {}

    public function createDocument($type): void
    {

        if($this->createDocument->document($type)) {
            return;
        }
        $document = new Documents();
        $document->setStatus(false);
        $document->setType($type);
        $document->setDocumentDate(new \DateTimeImmutable());
        $this->documentsRepository->save($document, true);
    }


    public function getDocument($type) {
        $openDocument = $this->createDocument->document($type);
        return $openDocument;
    }
}
