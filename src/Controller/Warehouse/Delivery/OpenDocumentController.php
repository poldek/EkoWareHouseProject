<?php

namespace App\Controller\Warehouse\Delivery;

use App\Controller\Warehouse\CheckStatus\CreateDocument;
use App\Controller\Warehouse\Document\Document;
use App\Controller\Warehouse\FileManager\FileUpload;
use App\Entity\DocumentFile;
use App\Form\FileFormType;
use App\Repository\DocumentFileRepository;
use App\Repository\DocumentProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class OpenDocumentController extends AbstractController
{
    private const MAX_UPLOAD_FILE = '4';

    public function __construct(
        public Document       $document,
        public DocumentProductsRepository $documentProductsRepository,
        public DocumentFileRepository $documentFileRepository,
        public FileUpload $fileUpload,
    )
    {}

    #[Route('/delivery/open/document', name: 'app_delivery_open_document')]
    public function openDocument(Request $request): Response
    {
        $openDocument = $this->document->getDocument(CreateDocument::PZ);

        $fileDocument = new DocumentFile();
        $form = $this->createForm(FileFormType::class, $fileDocument);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $file */
            $file = $form->get('name')->getData();
            if($file && $this->maxUploadFunction($openDocument)) {
                $this->fileUpload->uploadFile($file, $fileDocument);
            } else {
                $this->addFlash('upload', 'the file cannot be uploaded');
                return $this->redirectToRoute('app_delivery_open_document');
            }
        }

        $productDocument = $this->documentProductsRepository->findBy([
            'document' => $openDocument->getId()
        ]);

        $uploadFile = $this->documentFileRepository->findBy([
            'document' => $openDocument->getId()
        ]);


        return $this->render('warehouse/delivery/open_document.html.twig', [
            'openDocument' => $openDocument,
            'productDocument' => $productDocument,
            'uploadFile' => $uploadFile,
            'form' => $form,
        ]);
    }

    private function maxUploadFunction($openDocument): bool {
        $uploadFile = $this->documentFileRepository->findBy([
            'document' => $openDocument->getId()
        ]);
        if(count($uploadFile) >= self::MAX_UPLOAD_FILE) {
            return false;
        }
        return true;
    }
}
