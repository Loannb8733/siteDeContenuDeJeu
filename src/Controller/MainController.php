<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MainController
 * @package App\Controller
 * @Route("/user/main")
 */
class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        $title = "Contenu de vidéos en ligne";
        
        return $this->render('main/homeUsers.html.twig', [
            'title' => $title,
            'controller_name' => 'MainController',
        ]);
    }
}
