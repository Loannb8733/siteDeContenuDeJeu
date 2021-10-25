<?php

namespace App\Controller;

use App\Repository\LegendsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class LegendsUserController
 * @package App\Controller
 * @Route("/user/legends")
 */
class LegendsUserController extends AbstractController
{
    /**
     * @Route("/", name="legends_user")
     */
    public function index(LegendsRepository $repo)
    {
        $title = 'Légendes';
        $legends = $repo->findBy([], ['createdAt' => 'DESC']);

        return $this->render('legends_user/legendsUser.html.twig', [
            'legends' => $legends,
            'title' => $title
        ]);
    }
}
