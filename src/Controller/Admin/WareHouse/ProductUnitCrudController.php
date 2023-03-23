<?php

namespace App\Controller\Admin\WareHouse;

use App\Entity\ProductUnit;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductUnitCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProductUnit::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name')->setColumns(2),
        ];
    }
}
