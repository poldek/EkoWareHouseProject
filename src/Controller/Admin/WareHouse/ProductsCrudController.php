<?php

namespace App\Controller\Admin\WareHouse;

use App\Entity\Products;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;


class ProductsCrudController extends AbstractCrudController
{

    public static function getEntityFqcn(): string
    {
        return Products::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('product_code', 'Unique product code'),
            TextField::new('name','Name product'),
            FormField::addRow(),
            AssociationField::new('unit', 'Unit product')->setColumns(2),
            FormField::addRow(),
            AssociationField::new('warehouses')->setRequired(true)
        ];
    }
}
