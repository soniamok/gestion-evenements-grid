<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Repository\EvenementRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index(EvenementRepository $evenementRepository): Response
    {
            $evenements = $evenementRepository->findAll();
        return $this->render('main/index.html.twig',[
        'evenements' => $evenements]);
    }
}
