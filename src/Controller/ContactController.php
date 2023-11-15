<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    public function submit(Request $request)
    {
        $name = $request->request->get('nom');
        $prenom = $request->request->get('prenom');
        $mail = $request->request->get('email');
        return $this->render('contact.html.twig', ['nom' => $name, 'prenom' => $prenom, 'mail' => $mail]);
    }

    /*
    #[Route('/contact', name: 'app_contact')]
    public function index(): Response
    {
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }
    */
}
