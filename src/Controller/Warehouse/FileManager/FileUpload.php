<?php

namespace App\Controller\Warehouse\FileManager;

use App\Controller\Warehouse\CheckStatus\CreateDocument;
use App\Repository\DocumentFileRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileUpload extends AbstractController
{

    public function __construct(
        public DocumentFileRepository $documentFileRepository,
        public CreateDocument $createDocument,
        public SluggerInterface $slugger
    )
    {}

    public function uploadFile($file, $fileDocument): Response
    {

        if ($file) {
            $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $this->slugger->slug($originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('files_directory'),
                    $newFilename
                );
            } catch (FileException $e) {
            }

            $fileDocument->setName($newFilename);
            $fileDocument->setDocument($this->createDocument->document(CreateDocument::PZ));
        }
        $this->documentFileRepository->save($fileDocument, true);
        $this->addFlash('upload', 'File has by upload');
        return $this->redirectToRoute('app_delivery_open_document');
    }
}
