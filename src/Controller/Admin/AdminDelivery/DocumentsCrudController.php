<?php

namespace App\Controller\Admin\AdminDelivery;

use App\Entity\Documents;
use App\Form\DocumentProductType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;

class DocumentsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Documents::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            DateField::new('document_date','Document date'),
            AssociationField::new('warehouse','Warehouse'),
            AssociationField::new('type','Type: Pz/Wz'),
            CollectionField::new('documentProducts','Products')
                ->allowAdd()
                ->renderExpanded()
                ->allowDelete()
                ->setEntryIsComplex(true)
                ->setEntryType(DocumentProductType::class)
                ->setFormTypeOptions([
                    'by_reference' => false,
                ])
        ];
    }

}
