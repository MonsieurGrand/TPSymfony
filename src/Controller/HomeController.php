<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    #[Route('/bonjour')]
    public function bonjour()
    {
        return new Response('Bonjour à toutes et à tous');
    }

    public function ciao()
    {
        return new Response("Est-ce que c'est bon pour vous ?");
    }

    #[Route('/aurevoir')]
    public function aurevoir()
    {
        return $this->redirectToRoute('ciao');
    }

    #[Route('/redirectToGoogle')]
    public function redirectToGoogle()
    {
        return $this->redirect('https://www.google.com');
    }
}
