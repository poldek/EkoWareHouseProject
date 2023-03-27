<?php

namespace App\Controller\Warehouse\Issue;

use App\Controller\Warehouse\SearchProduct\SearchProduct;
use App\Repository\DocumentProductsRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IssueController extends AbstractController
{
    public function __construct(
        public UserRepository             $userRepository,
        public SearchProduct              $searchProduct,
        public DocumentProductsRepository $documentProductsRepository,
    ){}

    #[Route('/issue', name: 'app_issue')]
    public function delivery(): Response
    {
        $userWarehouse = $this->userRepository->find($this->getUser()->getId());
        return $this->render('warehouse/issue/index.html.twig', [
            'warehouse' => $userWarehouse,
        ]);
    }

    #[Route('/issue/search', name: 'app_issue_search')]
    public function deliverySearch(Request $request,): RedirectResponse
    {

        $search = $request->get('search');
        $product = $this->searchProduct->searchProductByCode($this->getUser()->getId(), strtoupper($search));

        if(!$product){
            $this->addFlash('info', 'The searched code does not exist');
            return $this->redirectToRoute('app_issue');
        }
        return $this->redirectToRoute('app_issue_product', [
            'search' => $product->getId()
        ]);
    }
}
