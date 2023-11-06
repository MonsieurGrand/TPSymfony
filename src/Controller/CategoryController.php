<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/category/{id<\d+>}', name: 'category_show')]
    public function getCategorie(int $id)
    {
        $category_id = $id;

        return $this->render('category.html.twig', [
            'id_category' => $category_id,
        ]);
    }
}
