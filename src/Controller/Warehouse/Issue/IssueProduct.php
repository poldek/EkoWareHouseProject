<?php

namespace App\Controller\Warehouse\Issue;

use App\Entity\DocumentProducts;
use App\Form\IssueProductType;
use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IssueProduct extends AbstractController
{

    public function __construct(public ProductsRepository $productsRepository)
    {}

    #[Route('/issue/product', name: 'app_issue_product')]
    public function deliveryProduct(Request $request): Response
    {
        $productSearch = $request->get('search');
        $product = $this->productsRepository->find($productSearch);

        $documentProduct = new DocumentProducts();
        $form = $this->createForm(IssueProductType::class, $documentProduct);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $issueProduct = $form->getData();
            $this->addFlash('info', 'Product has been saved');
            return $this->redirectToRoute('app_issue');
        }
        return $this->render('warehouse/issue/issue_product.html.twig',[
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }
}
