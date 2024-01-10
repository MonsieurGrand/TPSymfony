<?php

namespace App\Controller;

use App\Entity\Feedback;
use App\Form\FeedbackType;
use Doctrine\Persistence\ManagerRegistry;
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

    #[Route('/feedlist', name: 'feedback_list')]
    public function listfeed(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Feedback::class);
        $feedback = $repository->findAll();
        // La logique pour récupérer les données des clients peut être ajoutée ici
        return $this->render('feedlist.html.twig', ['feedbacks' => $feedback]);
    }

    #[Route('/feedback/edit/{id}', name: 'feedback_edit')]
    public function edit(Request $request, ManagerRegistry $doctrine, $id): Response
    {
        $entityManager = $doctrine->getManager();
        $feedback = $entityManager->getRepository(Feedback::class)->find($id);
        if (!$feedback) {
            throw $this->createNotFoundException('Il n\'y a pas de feedback pour cet id : ' . $id);
        }
        $feedbackForm = $this->createForm(FeedbackType::class, $feedback);
        $feedbackForm->handleRequest($request);
        if ($feedbackForm->isSubmitted() && $feedbackForm->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('feedback_list');
        }
        return $this->render('feedEdit.html.twig', [
            'feedbackForm' => $feedbackForm->createView(),
        ]);
    }

    #[Route('/feedback/delete/{id}', name: 'feedback_delete')]
    public function delete(ManagerRegistry $doctrine, $id): Response
    {
        $entityManager = $doctrine->getManager();
        $feedback = $entityManager->getRepository(Feedback::class)->find($id);
        if (!$feedback) {
            throw $this->createNotFoundException('Aucun feedback pour cet id : ' . $id);
        }
        $entityManager->remove($feedback);
        $entityManager->flush();
        return $this->redirectToRoute('feedback_list');
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
