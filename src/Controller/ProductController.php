<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    #[Route("/product/create", name: "product_create")]
    public function create(Request $request): Response
    {
        $product = new Product(); // Produit vide (name = null, etc.)
        $form = $this->createForm(ProductType::class, $product);

        // Traitement pour hydrater l'objet "$product" vide
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            dump($product);
        }

        return $this->render("product/form.html.twig", [
            "form" => $form->createView()
        ]);
    }
}
