<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MainAdminController
 * @package App\Controller
 * @Route("/admin/main")
 */
class MainAdminController extends AbstractController
{
    /**
     * @Route("/", name="homeAdmin")
     */
    public function home()
    {
        $title = "Contenu de vidéos en ligne";

        return $this->render('main_admin/homeAdmin.html.twig', [
            'title' => $title,
        ]);
    }
}
