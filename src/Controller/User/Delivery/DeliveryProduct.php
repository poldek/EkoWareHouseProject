<?php

namespace App\Controller\User\Delivery;

use App\Entity\DocumentProducts;
use App\Form\DeliveryProductType;
use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeliveryProduct extends AbstractController
{

    public function __construct(public ProductsRepository $productsRepository)
    {
    }

    #[Route('/delivery/product', name: 'app_delivery_product')]
    public function deliveryProduct(Request $request): Response
    {
        $productSearch = $request->get('search');
        $product = $this->productsRepository->find($productSearch);

        $documentProduct = new DocumentProducts();
        $form = $this->createForm(DeliveryProductType::class, $documentProduct);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $deliveryProduct = $form->getData();
            $this->addFlash('info', 'Product has been saved');
            return $this->redirectToRoute('app_delivery');
        }
        return $this->render('warehouse/delivery/delivery_product.html.twig',[
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }
}
