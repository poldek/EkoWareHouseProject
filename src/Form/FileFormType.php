<?php

namespace App\Form;

use App\Entity\DocumentFile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class FileFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', FileType::class, [
                 'label' => 'PDF or XML file(max 4 files)',
                 'mapped' => false,
                 'required' => false,
                 'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'application/xml',
                            'application/pdf',
                            'application/x-pdf',
                            'text/xml'
                        ],
                        'mimeTypesMessage' => 'Please upload a valid PDF or XML document',
                    ])
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DocumentFile::class,
        ]);
    }
}
