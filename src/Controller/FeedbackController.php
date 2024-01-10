<?php

namespace App\Controller;

use App\Entity\Feedback;
use App\Form\FeedbackType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FeedbackController extends AbstractController
{
    #[Route('/feedback', name: 'feedback')]
    public function feedback(Request $request, ManagerRegistry $doctrine): Response
    {
        $feedback = new Feedback();
        $feedback->setDateSoumission(new \DateTime());
        $form = $this->createForm(FeedbackType::class, $feedback);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Traitez les données ici
            $entityManager = $doctrine->getManager();
            $feedback = $form->getData();
            $entityManager->persist($feedback);
            $entityManager->flush();

            return $this->render('validFeedback.html.twig', [
                'request' => $feedback,
            ]);
        }
        return $this->render('formFeedback.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
