<?php

namespace App\Form;

use App\Entity\DocumentProducts;
use App\Entity\ProductUnit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DeliveryProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('product_qty', NumberType::class,[
                'label' => 'Qty: ',
                'required' => true
            ])
            ->add('unit', EntityType::class,[
                'label' => 'Unit: ',
                'class' => ProductUnit::class,
            ])
            ->add('tax', PercentType::class, [
                'label' => 'Tax: ',
                'required' => true
            ])
            ->add('product_price', MoneyType::class,[
                'label' => 'Price net: ',
                'required' => true,
                'currency' => 'PLN'
            ])
            ->add('Save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DocumentProducts::class,
        ]);
    }
}
