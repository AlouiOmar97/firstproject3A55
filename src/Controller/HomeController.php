<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
class HomeController extends AbstractController
{
    #[Route('/', name: 'app_welcome')]
    public function index(): Response
    {
        $t="3A56";
        /*dump("Heello");
        dd($t);
        dump($t);
        die();*/
        //data from DB (Repository + entity ) ORM
        $pT="title of product!";
        return $this->render('home/index2.html.twig', [
            'controller_name' => 'HomeController',
            'title' => $t,
            'productTitle' => $pT
        ]);
    }

    #[Route('/home/{nom}', name: 'app_home')]
    public function home($nom): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'nom' => $nom
        ]);
    }

    #[Route('/msg', name: "app_msg")]
    public function msg(){
        return new Response('Ceci est un message simple');
    }

    #[Route('/redirect', name: 'app_redirect')]
    public function redirec(){
        return $this->redirectToRoute('app_msg');
    }
}
