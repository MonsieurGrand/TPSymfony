<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{

    #[Route('/showproducts', name: 'products_list')]
    public function showProducts(): Response
    {
        $products =
            [
                ["name" => 'Ordinateur', "price" => 890],
                ["name" => 'Téléphone', "price" => 290],
                ["name" => 'Radio', "price" => 50],
                ["name" => 'Cassette', "price" => 20],
            ];
        return $this->render('product.html.twig', [
            'products' => $products,
        ]);
    }


    #[Route('/showproducts/{id<\d+>}', name: 'products_details')]
    public function getDetail(Request $request)
    {
        $product_id = $request->request->get('product_id');
        $nameProduct = $request->request->get('product_name');
        $priceProduct = $request->request->get('product_price');

        return $this->render('details.html.twig', [
            'id_product' => $product_id,
            'nom_product' => $nameProduct,
            'prix' => $priceProduct
        ]);
    }
}
