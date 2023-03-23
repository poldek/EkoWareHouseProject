<?php

namespace App\Controller\Admin\WareHouse;

use App\Entity\Products;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\PercentField;
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
            TextField::new('index_product', 'Unique product index'),
            TextField::new('name','Name product'),
            NumberField::new('price', 'Price')->setNumDecimals(2)->setColumns(2),
            PercentField::new('vat','Vat rate')->setColumns(2),
            FormField::addRow(),
            TextField::new('unit', 'Unit')->setColumns(2),
            NumberField::new('qty','Qty')->setColumns(2),
        ];
    }
}
