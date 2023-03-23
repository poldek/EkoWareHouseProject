<?php

namespace App\Security;

use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class HashedPassword
{
    public function __construct(
        public UserPasswordHasherInterface $userPasswordHasher
    ) {}

    public function hasherPassword ($password): string
    {
        $user = new User();
        return $this->userPasswordHasher->hashPassword($user, $password);
    }
}
