<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LuckyController extends AbstractController
{
    #[Route("/lucky/number", name: "number", methods: ["GET"])]
    public function number(): Response
    {
        $number = random_int(0, 100);
        return $this->render("lucky/number.html.twig", ["number" => $number]);
    }

    #[Route("/", name: "home", methods: ["GET"])]
    public function home(Request $request): Response
    {
        $firstName = $request->query->get("firstName");
        $lastName = $request->query->get("lastName");
        $age = $request->query->get("age");
        if (!$firstName || !$lastName || !$age) {
            throw $this->createNotFoundException("Le prénom, le nom ou l'âge n'est pas définit.");
        }
        return $this->render("lucky/home.html.twig", ["firstName" => $firstName, "lastName" => $lastName, "age" => $age]);
    }

    #[Route("/redirect", name: "redirect", methods: ["GET"])]
    public function redirectUser(): RedirectResponse
    {
        return $this->redirectToRoute("home", ["firstName" => "Cyprien", "lastName" => "Bidaud", "age" => 20]);
    }
}
