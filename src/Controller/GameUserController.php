<?php

namespace App\Controller;

use App\Entity\Game;
use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class GameController
 * @package App\Controller
 * @Route("/user/game")
 */
class GameUserController extends AbstractController
{
    /**
     * @Route("/", name="game_user")
     */
    public function index(GameRepository $repo)
    {
        $titleGame = 'Nouvelles sorties';
        $game = $repo->$repo->findBy([], ['CreatedAt' => 'DESC']);

        return $this->render('game_user/gameUser.html.twig', [
            'titleGame' => $titleGame,
            'gameR' => $game
        ]);
    }

    /**
     * @Route("/{id}", name="game_user_show")
     */
    public function show(Game $game) {
        return $this->render('game_user/show.html.twig', [
            'game' => $game
        ]);
    }
}
