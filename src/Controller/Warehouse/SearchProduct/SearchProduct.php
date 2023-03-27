<?php

namespace App\Controller\Warehouse\SearchProduct;

use App\Entity\Products;
use App\Repository\ProductsRepository;
use App\Repository\UserRepository;


class SearchProduct
{
    public function __construct(
        public UserRepository $userRepository,
        public ProductsRepository $productsRepository,
    )
    {}

    public function searchProductByCode($userId, string $search): Products|bool|null
    {
        $userWarehouse = $this->userRepository->find($userId);

        $products = array();
        foreach ($userWarehouse->getWarehouses() as $value) {
            foreach ($value->getProducts() as $prod) {
                $products[] = $prod->getProductCode();
            }
        }

        $ifExist = in_array($search, $products);
        if (!$ifExist){
            return null;
        }

        $product = $this->productsRepository->findOneBy([
            'product_code' => $search
        ]);

        return $product;
    }
}
