<?php

namespace App\Controller\Admin\User;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;

class EventHandlerForm
{
    public function __construct( public FormHashPassword $hashPassword)
    {
    }

    public function addPasswordEventListener(FormBuilderInterface $formBuilder,): FormBuilderInterface
    {
        return $formBuilder->addEventListener(FormEvents::POST_SUBMIT, $this->hashPassword->hashPassword());
    }
}
