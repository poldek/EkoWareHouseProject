<?php

namespace App\Controller\Warehouse\Product;

use App\Repository\WarehousesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    public function __construct(
        public WarehousesRepository $warehousesRepository
    )
    {}

    #[Route('/warehouse/product', name: 'app_product_warehouse')]
    public function product(Request $request): Response
    {
        $select = $request->get('warehouse');
        $warehouse = $this->warehousesRepository->find($select);
        return $this->render('warehouse/products/index.html.twig',[
            'warehouse' => $warehouse,
        ]);
    }
}
