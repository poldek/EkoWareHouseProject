<?php

namespace App\Controller\Admin\User;

use App\Security\HashedPassword;


class FormHashPassword
{
    public function __construct(
        public HashedPassword $password
    ) {}

    public function hashPassword()
    {

        return function($event) {
            $form = $event->getForm();
            if (!$form->isValid()) {
                return;
            }
            $password = $form->get('password')->getData();
            if ($password === null) {
                return;
            }
            $form->getData()->setPassword($this->password->hasherPassword($password));
        };
    }
}
