<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Form\CustomerType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CustomerController extends AbstractController
{
    #[Route('/customerform', name: 'customerform')]
    public function index(Request $request): Response
    {
        $customer = new Customer();
        $customerForm = $this->createForm(CustomerType::class, $customer);
        $customerForm->handleRequest($request);

        if ($customerForm->isSubmitted() && $customerForm->isValid()) {
            // Traitement des données soumises, par exemple, enregistrement dans la base de données.  // Pour l'instant, affichons simplement les données soumises :
            return $this->render('validCustomer.html.twig', [
                'request' => $customer,
            ]);
        }
        // Ajouter la logique de traitement du formulaire si nécessaire...
        return $this->render('formCustomer.html.twig', [
            'customerForm' => $customerForm->createView(),
        ]);
    }
}
