<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    public function __construct(

        public UserRepository $userRepository
    )
    {
    }

    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
        $warehouse = $this->userRepository->find($this->getUser()->getId());
        return $this->render('home/index.html.twig',[
            'warehouses' => $warehouse
        ]);
    }

}
