<?php

namespace App\Controller\Warehouse\Document;

use App\Repository\DocumentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CloseDocument extends AbstractController
{
    public function __construct(
        public DocumentsRepository $documentsRepository
    )
    {}

    #[Route('/delivery/document/save', name: 'app_delivery_document_save')]
    public function saveDocument(Request $request): RedirectResponse
    {
        $document = $request->get('document');
        $closeDocument = $this->documentsRepository->find($document);
        $closeDocument->setStatus(1);
        $this->documentsRepository->save($closeDocument, true);
        $this->addFlash('info', 'The document has by saved');
        return $this->redirectToRoute('app_home');
    }
}
