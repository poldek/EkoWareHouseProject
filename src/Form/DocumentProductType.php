<?php

namespace App\Form;

use App\Entity\DocumentProducts;
use App\Entity\Products;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DocumentProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('product', EntityType::class,[
                'class' => Products::class,
                'choice_label' => function ($product) {
                    return $product->getName();
                }
            ])
            ->add('product_qty', NumberType::class)
            ->add('unit')
            ->add('tax', PercentType::class)
            ->add('product_price', MoneyType::class,[
                'currency' => 'PLN'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DocumentProducts::class,
        ]);
    }
}
