<?php

namespace App\Controller\Admin\User;

use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class FormHashPassword
{
    public function __construct(
        public UserPasswordHasherInterface $userPasswordHasher
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
            $user = new User();
            $hash = $this->userPasswordHasher->hashPassword($user, $password);
            $form->getData()->setPassword($hash);
        };
    }
}
