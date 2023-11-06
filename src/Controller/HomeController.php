<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/pages', name: 'pages')]
    public function getPages(): Response
    {
        return $this->render('pages.html.twig');
    }

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

    #[Route('/showtemplate')]
    public function showTemplate()
    {
        return $this->render('base.html.twig');
    }

    #[Route('/customers', name: 'customers_list')]
    public function getCustomers(): Response
    {
        $customers =
            [
                ["name" => 'John', "product" => 1],
                ["name" => 'Laurent', "product" => 2],
                ["name" => 'Margaret', "product" => 3],
                ["name" => 'Alain', "product" => 4],
            ];
        // La logique pour récupérer les données des clients peut être ajoutée ici
        return $this->render('customer.html.twig', ['customers' => $customers]);
    }

    #[Route('/dashboard', name: 'dashboard')]
    public function index(Request $request)
    {
        $product_id = $request->request->get('product_id');
        $nameClient = $request->request->get('customer_name');
        $customer_id = $request->request->get('customer_id');

        return $this->render('dashboard.html.twig', [
            'id_product' => $product_id,
            'nom_client' => $nameClient,
            'id_client' => $customer_id
        ]);
    }
}
