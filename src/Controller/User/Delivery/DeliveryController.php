<?php

namespace App\Controller\User\Delivery;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeliveryController extends AbstractController
{
    public function __construct(
        public UserRepository $userRepository,
        public SearchProduct $searchProduct
    )
    {
    }

    #[Route('/delivery', name: 'app_delivery')]
    public function delivery(): Response
    {
        $userWarehouse = $this->userRepository->find($this->getUser()->getId());
        return $this->render('warehouse/delivery/index.html.twig',[
                'warehouse' => $userWarehouse,
        ]);
    }


    #[Route('/delivery/document', name: 'app_delivery_document')]
    public function document(Request $request,): Response
    {
        $search = $request->get('search');
        $product = $this->searchProduct->searchProductByCode($this->getUser()->getId(), strtoupper($search));

        if(!$product){
            $this->addFlash('error', 'The searched code does not exist');
            return $this->redirectToRoute('app_delivery');
        }
        
        return $this->render('warehouse/delivery/delivery_product.html.twig',[
            'product' => $product
        ]);
    }
}
