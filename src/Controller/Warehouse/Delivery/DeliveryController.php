<?php

namespace App\Controller\Warehouse\Delivery;

use App\Controller\Warehouse\CheckStatus\CreateDocument;
use App\Controller\Warehouse\Document\Document;
use App\Controller\Warehouse\SearchProduct\SearchProduct;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeliveryController extends AbstractController
{
    public function __construct(
        public UserRepository $userRepository,
        public SearchProduct $searchProduct,
        public Document $document,
    )
    {}

    #[Route('/delivery', name: 'app_delivery')]
    public function delivery(): Response
    {
        $this->document->createDocument(CreateDocument::PZ);
        $openDocument = $this->document->getDocument(CreateDocument::PZ);
        $userWarehouse = $this->userRepository->find($this->getUser()->getId());
        return $this->render('warehouse/delivery/index.html.twig',[
                'warehouse' => $userWarehouse,
                'openDocument' => $openDocument
        ]);
    }


    #[Route('/delivery/search', name: 'app_delivery_search')]
    public function deliverySearch(Request $request,)
    {

        $search = $request->get('search');
        $product = $this->searchProduct->searchProductByCode($this->getUser()->getId(), strtoupper($search));

        if(!$product){
            $this->addFlash('info', 'The searched code does not exist');
            return $this->redirectToRoute('app_delivery');
        }
            return $this->redirectToRoute('app_delivery_product', [
                'search' => $product->getId()
            ]);
    }
}
