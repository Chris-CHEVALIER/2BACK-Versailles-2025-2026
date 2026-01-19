<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    #[Route("/product/create", name: "product_create")]
    public function create(Request $request, ManagerRegistry $doctrine): Response
    {
        $product = new Product(); // Produit vide (name = null, etc.)
        $form = $this->createForm(ProductType::class, $product);

        // Traitement pour hydrater l'objet "$product" vide
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->persist($product);
            $em->flush();
            return $this->redirectToRoute("home");
        }

        return $this->render("product/form.html.twig", [
            "form" => $form->createView()
        ]);
    }

    #[Route("/product/update/{id}", name: "product_update")]
    public function update(Request $request, ManagerRegistry $doctrine, Product $product): Response
    {
        $form = $this->createForm(ProductType::class, $product);

        // Traitement pour hydrater l'objet "$product" vide
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $doctrine->getManager()->flush();
            return $this->redirectToRoute('home');
        }

        return $this->render("product/form.html.twig", [
            "form" => $form->createView()
        ]);
    }

    #[Route("/product/delete/{id}", name: "product_delete")]
    public function delete(ManagerRegistry $doctrine, Product $product): Response
    {
        $em = $doctrine->getManager();
        $em->remove($product);
        $em->flush();

        return $this->redirectToRoute("home");
    }

    #[Route("/", name: "home")]
    public function readAll(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Product::class);
        $products = $repository->findAll();
        return $this->render("product/index.html.twig", [
            "products" => $products
        ]);
    }

    #[Route("/product/read/{id}", name: "product_read")]
    public function read(Product $product): Response
    {
        return $this->render("product/read.html.twig", [
            "product" => $product
        ]);
    }
}
