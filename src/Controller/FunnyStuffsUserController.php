<?php

namespace App\Controller;

use App\Entity\FunnyStuffs;
use App\Repository\FunnyStuffsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class FunnyStuffsUserController
 * @package App\Controller
 * @Route("/user/funny-stuff")
 */
class FunnyStuffsUserController extends AbstractController
{
    /**
     * @Route("/", name="funny_stuffs_user")
     */
    public function index(FunnyStuffsRepository $repo): Response
    {
        $title = 'Funny stuffs';
        $funnyStuffs = $repo->findBy([], ['createdAt' => 'DESC']);

        return $this->render('funny_stuffs_user/funnyStuffsUser.html.twig', [
            'funnyStuffs' => $funnyStuffs,
            'title' => $title
        ]);
    }

    /**
     * @Route("/{id}", name="funny_stuffs_user_show")
     */
    public function show(FunnyStuffs $funnyStuffs) {
        return $this->render('funny_stuffs_user/show.html.twig', [
            'funnyStuffs' => $funnyStuffs
        ]);
    }
}
