<?php

namespace App\Controller\Admin\WareHouse;

use App\Entity\Warehouses;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class WarehousesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Warehouses::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('number','Unique number Warehouse'),
            TextField::new('name'),
            DateField::new('createdAt')->onlyOnIndex(),
            TextEditorField::new('description')->onlyOnForms(),
        ];
    }
}
