<?php

namespace App\Controller\Admin\Delivery;

use App\Controller\Admin\Service\DocumentType\TypeDocument;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeliveryProduct extends AbstractDashboardController
{
    public function __construct(public TypeDocument $document)
    {
    }

    #[Route('/delivery', name: 'app_delivery')]
    public function index(): Response
    {
        $this->document->createDocumentType();
        return $this->render('admin/delivery/index.html.twig');
    }

}
